<?php
namespace W3TC;

if ( !defined( 'W3TC_SKIPLIB_AWS' ) ) {
	require_once W3TC_LIB_DIR . '/Aws/aws-autoloader.php';
}

/**
 * CDN engine for S3 push type
 */
class CdnEngine_S3 extends CdnEngine_Base {
	private $api;

	public function __construct( $config = array() ) {
		$config = array_merge( array(
				'key' => '',
				'secret' => '',
				'bucket' => '',
				'bucket_location' => '',
				'cname' => array(),
			), $config );

		parent::__construct( $config );
	}

	/**
	 * Formats URL
	 */
	function _format_url( $path ) {
		$domain = $this->get_domain( $path );

		if ( $domain ) {
			$scheme = $this->_get_scheme();

			// it does not support '+', requires '%2B'
			$path = str_replace( '+', '%2B', $path );
			$url = sprintf( '%s://%s/%s', $scheme, $domain, $path );

			return $url;
		}

		return false;
	}

	/**
	 * Inits S3 object
	 *
	 * @param string  $error
	 * @return boolean
	 */
	public function _init() {
		if ( !is_null( $this->api ) ) {
			return;
		}

		if ( empty( $this->_config['key'] ) ) {
			throw new \Exception( 'Empty access key.' );
		}

		if ( empty( $this->_config['secret'] ) ) {
			throw new \Exception( 'Empty secret key.' );
		}

		if ( empty( $this->_config['bucket'] ) ) {
			throw new \Exception( 'Empty bucket.' );
		}

		$credentials = new \Aws\Credentials\Credentials(
			$this->_config['key'],
			$this->_config['secret'] );

		$this->api = new \Aws\S3\S3Client( array(
				'credentials' => $credentials,
				'region' => $this->_config['bucket_location'],
				'version' => '2006-03-01'
			)
		);
	}

	/**
	 * Uploads files to S3
	 *
	 * @param array   $files
	 * @param array   $results
	 * @param boolean $force_rewrite
	 * @return boolean
	 */
	public function upload( $files, &$results, $force_rewrite = false,
		$timeout_time = NULL ) {
		$error = null;

		try {
			$this->_init();
		} catch ( \Exception $ex ) {
			$results = $this->_get_results( $files, W3TC_CDN_RESULT_HALT, $ex->getMessage() );
			return false;
		}

		foreach ( $files as $file ) {
			$local_path = $file['local_path'];
			$remote_path = $file['remote_path'];

			// process at least one item before timeout so that progress goes on
			if ( !empty( $results ) ) {
				if ( !is_null( $timeout_time ) && time() > $timeout_time ) {
					return 'timeout';
				}
			}

			$results[] = $this->_upload( $file, $force_rewrite );

			if ( $this->_config['compression'] && $this->_may_gzip( $remote_path ) ) {
				$file['remote_path_gzip'] = $remote_path . $this->_gzip_extension;
				$results[] = $this->_upload_gzip( $file, $force_rewrite );
			}
		}

		return !$this->_is_error( $results );
	}

	/**
	 * Uploads single file to S3
	 *
	 * @param array   CDN file array
	 * @param boolean $force_rewrite
	 * @return array
	 */
	private function _upload( $file, $force_rewrite = false ) {
		$local_path = $file['local_path'];
		$remote_path = $file['remote_path'];

		if ( !file_exists( $local_path ) ) {
			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, 'Source file not found.', $file );
		}

		try {
			if ( !$force_rewrite ) {
				try {
					$info = $this->api->headObject( array(
						'Bucket' => $this->_config['bucket'],
						'Key' => $remote_path )
					);

					$hash = '"' . @md5_file( $local_path ) . '"';
					$s3_hash = ( isset( $info['ETag'] ) ? $info['ETag'] : '' );

					if ( $hash === $s3_hash ) {
						return $this->_get_result( $local_path, $remote_path,
							W3TC_CDN_RESULT_OK, 'Object up-to-date.', $file );
					}
				} catch ( \Aws\Exception\AwsException $ex ) {
					if ( $ex->getAwsErrorCode() == 'NotFound' ) {
					} else {
						throw $ex;
					}
				}
			}

			$headers = $this->_get_headers( $file );
			$result = $this->_put_object( array(
					'Key' => $remote_path,
					'SourceFile' => $local_path,
					'Metadata' => $headers
				)
			);

			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_OK, 'OK', $file );
		} catch ( \Exception $ex ) {
			$error = sprintf( 'Unable to put object (%s).', $ex->getMessage() );

			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, $error, $file );
		}
	}

	/**
	 * Uploads gzip version of file
	 */
	private function _upload_gzip( $file, $force_rewrite = false ) {
		$local_path = $file['local_path'];
		$remote_path = $file['remote_path_gzip'];

		if ( !function_exists( 'gzencode' ) ) {
			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, "GZIP library doesn't exist.", $file );
		}

		if ( !file_exists( $local_path ) ) {
			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, 'Source file not found.', $file );
		}

		$contents = @file_get_contents( $local_path );

		if ( $contents === false ) {
			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, 'Unable to read file.', $file );
		}

		$data = gzencode( $contents );

		try {
			if ( !$force_rewrite ) {
				try {
					$info = $this->api->headObject( array(
						'Bucket' => $this->_config['bucket'],
						'Key' => $remote_path )
					);

					$hash = '"' . md5( $data ) . '"';
					$s3_hash = ( isset( $info['ETag'] ) ? $info['ETag'] : '' );

					if ( $hash === $s3_hash ) {
						return $this->_get_result( $local_path, $remote_path,
							W3TC_CDN_RESULT_OK, 'Object up-to-date.', $file );
					}
				} catch ( \Aws\Exception\AwsException $ex ) {
					if ( $ex->getAwsErrorCode() == 'NotFound' ) {
					} else {
						throw $ex;
					}
				}
			}

			$headers = $this->_get_headers( $file );
			$headers = array_merge( $headers, array(
					'Vary' => 'Accept-Encoding',
					'Content-Encoding' => 'gzip'
				) );

			$result = $this->_put_object( array(
					'Key' => $remote_path,
					'Body' => $data,
					'Metadata' => $headers
				)
			);

			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_OK, 'OK', $file );
		} catch ( \Exception $ex ) {
			$error = sprintf( 'Unable to put object (%s).', $ex->getMessage() );

			return $this->_get_result( $local_path, $remote_path,
				W3TC_CDN_RESULT_ERROR, $error, $file );
		}
	}

	/**
	 * Wrapper to set headers well
	 */
	private function _put_object( $data ) {
		$data['ACL'] = 'public-read';
		$data['Bucket'] = $this->_config['bucket'];

		if ( isset( $data['Metadata']['Content-Type'] ) ) {
			$data['ContentType'] = $data['Metadata']['Content-Type'];
		}
		if ( isset( $data['Metadata']['Content-Encoding'] ) ) {
			$data['ContentEncoding'] = $data['Metadata']['Content-Encoding'];
		}
		if ( isset( $data['Metadata']['Cache-Control'] ) ) {
			$data['CacheControl'] = $data['Metadata']['Cache-Control'];
		}

		return $this->api->putObject( $data );
	}

	/**
	 * Deletes files from S3
	 *
	 * @param array   $files
	 * @param array   $results
	 * @return boolean
	 */
	public function delete( $files, &$results ) {
		$error = null;

		try {
			$this->_init();
		} catch ( \Exception $ex ) {
			$results = $this->_get_results( $files, W3TC_CDN_RESULT_HALT, $ex->getMessage() );
			return false;
		}

		foreach ( $files as $file ) {
			$local_path = $file['local_path'];
			$remote_path = $file['remote_path'];

			try {
				$this->api->deleteObject( array(
						'Bucket' => $this->_config['bucket'],
						'Key' => $remote_path
					) );
				$results[] = $this->_get_result( $local_path, $remote_path,
					W3TC_CDN_RESULT_OK, 'OK', $file );
			} catch ( \Exception $ex ) {
				$results[] = $this->_get_result( $local_path, $remote_path,
					W3TC_CDN_RESULT_ERROR,
					sprintf( 'Unable to delete object (%s).',
						$ex->getMessage() ),
					$file );
			}

			if ( $this->_config['compression'] ) {
				$remote_path_gzip = $remote_path . $this->_gzip_extension;

				try {
					$this->api->deleteObject( array(
							'Bucket' => $this->_config['bucket'],
							'Key' => $remote_path_gzip
						) );
					$results[] = $this->_get_result( $local_path, $remote_path_gzip,
						W3TC_CDN_RESULT_OK, 'OK', $file );
				} catch ( \Exception $ex ) {
					$results[] = $this->_get_result( $local_path, $remote_path_gzip,
						W3TC_CDN_RESULT_ERROR,
						sprintf( 'Unable to delete object (%s).',
							$ex->getMessage() ),
						$file );
				}
			}
		}

		return !$this->_is_error( $results );
	}

	/**
	 * Test CDN connectivity works
	 */
	public function test( &$error ) {
		if ( !parent::test( $error ) ) {
			return false;
		}

		$key = 'test_s3_' . md5( time() );

		$this->_init();
		$buckets = $this->api->listBuckets();

		$bucket_found = false;
		foreach ( $buckets['Buckets'] as $bucket ) {
			if ( $bucket['Name'] == $this->_config['bucket'] ) {
				$bucket_found = true;
			}
		}

		if ( !$bucket_found ) {
			throw new \Exception( 'Bucket doesn\'t exist: %s.', $this->_config['bucket'] );
		}

		$result = $this->api->putObject( array(
				'ACL' => 'public-read',
				'Bucket' => $this->_config['bucket'],
				'Key' => $key,
				'Body' => $key
			)
		);

		$object = $this->api->getObject( array(
				'Bucket' => $this->_config['bucket'],
				'Key' => $key
			) );

		if ( $object['Body'] != $key ) {
			$error = 'Objects are not equal.';

			$this->api->deleteObject( array(
					'Bucket' => $this->_config['bucket'],
					'Key' => $key
				) );

			return false;
		}

		$this->api->deleteObject( array(
				'Bucket' => $this->_config['bucket'],
				'Key' => $key
			) );

		return true;
	}

	/**
	 * Returns CDN domain
	 *
	 * @return array
	 */
	public function get_domains() {
		if ( !empty( $this->_config['cname'] ) ) {
			return (array) $this->_config['cname'];
		} elseif ( !empty( $this->_config['bucket'] ) ) {
			$domain = sprintf( '%s.s3.amazonaws.com', $this->_config['bucket'] );

			return array(
				$domain
			);
		}

		return array();
	}

	/**
	 * Returns via string
	 *
	 * @return string
	 */
	public function get_via() {
		return sprintf( 'Amazon Web Services: S3: %s', parent::get_via() );
	}

	/**
	 * Creates bucket
	 */
	public function create_container() {
		$this->_init();

		try {
			$buckets = $this->api->listBuckets();
		} catch ( \Exception $ex ) {
			throw new \Exception( 'Unable to list buckets: ' . $ex->getMessage() );
		}

		foreach ( $buckets['Buckets'] as $bucket ) {
			if ( $bucket['Name'] == $this->_config['bucket'] ) {
				throw new \Exception( 'Bucket already exists: ' . $this->_config['bucket'] );
			}
		}

		try {
			$result = $this->api->createBucket( array(
				'Bucket' => $this->_config['bucket'],
			) );
		} catch ( \Exception $e) {
			throw new \Exception( 'Failed to create bucket: ' . $ex->getMessage() );
		}
	}

	/**
	 * How and if headers should be set
	 *
	 * @return string W3TC_CDN_HEADER_NONE, W3TC_CDN_HEADER_UPLOADABLE, W3TC_CDN_HEADER_MIRRORING
	 */
	public function headers_support() {
		return W3TC_CDN_HEADER_UPLOADABLE;
	}
}
