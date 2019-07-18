/* eslint-disable quotes */
/* eslint-disable space-in-parens */
/* eslint-disable valid-jsdoc */
/**
 * BLOCK: epyt/youtube
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./style.scss";
import "./editor.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { Component, Fragment } = wp.element;
const { ServerSideRender, Button, Modal } = wp.components;
//const { withState } = wp.compose;

import debounce from "lodash/debounce";

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("epyt/youtube", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("YouTube Wizard"), // Block title.
	// <defs><style>.epytcls-1{fill:red;}.epytcls-2{fill-rule:evenodd;fill:url(#radial-gradient);}.epytcls-3{fill:#31aaff;}.epytcls-4{fill:#fff;}</style><radialGradient id="radial-gradient" cx="193" cy="85.85" r="77.53" gradientUnits="userSpaceOnUse"><stop offset="0.17" stop-color="#fff"/><stop offset="0.68" stop-color="#31aaff"/></radialGradient></defs>
	icon: (
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 292.89 282.69">
			<title>YouTube Wizard Icon</title>
			<g id="Layer_2" data-name="Layer 2">
				<g id="Слой_1" data-name="Слой 1">
					<g id="g5360">
						<g id="g4167">
							<path
								id="path4156"
								className="epytcls-1"
								d="M139.27,87.65s-87.11,0-109,5.68A36,36,0,0,0,5.68,118.12C0,140,0,185.26,0,185.26s0,45.44,5.68,67A35.47,35.47,0,0,0,30.3,276.84c22,5.85,109,5.85,109,5.85s87.28,0,109.14-5.68a34.64,34.64,0,0,0,24.44-24.62c5.86-21.69,5.86-67,5.86-67s.17-45.45-5.86-67.31a34.41,34.41,0,0,0-24.44-24.45C226.55,87.65,139.27,87.65,139.27,87.65Zm-27.72,55.77L184,185.26l-72.48,41.65V143.42Z"
							/>
						</g>
					</g>
					<path
						className="epytcls-2"
						d="M143.39,153.45c10.52-19.27,14.91-39.2,19.18-58.61q.68-3,1.33-6l.12-.54-.25-.48c-13.87-26.66-41.06-52.54-57.1-66.42,21,11.33,60,31.21,84,36.13l.63.13.53-.37c4.14-2.92,8.28-5.7,12.28-8.4,13.41-9,26.27-17.67,38.31-30.64-10.26,20.67-14.18,40.47-18.14,64.42l-.09.58.32.48c18.19,27.91,40.93,50.88,54.81,63.7C261.68,137.5,230,121.76,197,115.29l-.57-.12-3.83,2.35C176,127.67,159,138.08,143.39,153.45Z"
					/>
					<path
						className="epytcls-3"
						d="M237.47,25.4c-7.73,18.08-11.19,36-14.67,57l-.19,1.15.64,1c15,23,33.15,42.76,46.87,56.19-18.4-9.59-45.13-21.49-72.87-26.93l-1.15-.22-1,.61-3.33,2c-14.47,8.86-29.26,17.93-43.24,30.34,7.94-17,11.77-34.43,15.51-51.43q.66-3,1.33-6l.24-1.06-.51-1c-11.66-22.4-32.12-43.86-48-58.48C139,40,170,54.82,190.37,59l1.27.26,1.06-.74c4.12-2.91,8.25-5.69,12.25-8.38,11.27-7.59,22.16-14.91,32.52-24.74M254.86,0l-.74,1.11L254.86,0Zm-.74,1.11C235.26,28.88,213.71,40,191,56.06c-33.55-6.88-97.91-43.92-97.91-43.92s49,37.13,69.38,76.37c-6,26.61-11,54.9-31.35,80.94,19.83-25.28,42.66-38.61,65.58-52.69,50.06,9.8,96.22,40.55,96.22,40.55s-38.84-31-67.13-74.4c4.89-29.58,9.81-54,28.36-81.8Z"
					/>
					<polyline
						className="epytcls-4"
						points="102.6 133.11 102.6 133.11 192.98 185.28 102.6 237.22 102.6 133.11"
					/>
				</g>
			</g>
		</svg>
	),
	category: "embed", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [__("gallery"), __("live"), __("video")], // playlist
	description: __( 'Embed a video, playlist, channel, gallery, or live stream.' ),
	attributes: {
		shortcode: {
			type: "string",
			default: ""
		}
	},

	/**
	 * The edit function describes the structure of your block in the context of the editor.
	 * This represents what the editor will render when the block is used.
	 *
	 * The "edit" property must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	edit: class extends Component {
		state = { show: false };

		constructor(props) {
			super(...arguments);
			this.props = props;

			//this.onMessage = this.onMessage.bind(this);
		}

		componentDidMount() {
			window.addEventListener("message", this.onMessage);
			this.gbPreviewSetup("componentDidMount");
		}

		componentDidUpdate() {
			this.gbPreviewSetup("componentDidUpdate");
		}

		componentWillUnmount() {
			window.removeEventListener("message", this.onMessage);
		}

		showModal = () => {
			this.setState({ show: true });
		};

		hideModal = () => {
			this.setState({ show: false });
		};

		onMessage = e => {
			try {
				if (
					e.data.indexOf("youtubeembedplus") === 0 &&
					e.data.indexOf(this.props.clientId) > 0
				) {
					let embedcode = "";
					embedcode = e.data.split("|")[1];
					// if (embedcode.indexOf("[") !== 0)
					// {
					//     embedcode = "<p>" + embedcode + "</p>";
					// }
					this.props.setAttributes({ shortcode: embedcode.toString() });
					this.hideModal(); // close modal
					this.gbPreviewSetup("onMessage");
				}
			} catch (err) {}
		};

		gbPreviewSetup = debounce(myContext => {
			setTimeout(() => {
				window._EPYTA_.gbPreviewSetup();
			}, 1500);
		}, 50);

		render() {
			if (this.props.attributes.shortcode) {
				const ssr = (
					<ServerSideRender
						block="epyt/youtube"
						attributes={this.props.attributes}
					/>
				);
				return ssr;
			}

			return (
				<div className="components-placeholder editor-media-placeholder wp-block-image epytblock">
					<div className="components-placeholder__label">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 292.89 282.69"
							width="20"
							height="20"
							className="dashicon"
						>
							<title>YouTube Wizard Icon</title>
							<g id="Layer_2" data-name="Layer 2">
								<g id="Слой_1" data-name="Слой 1">
									<g id="g5360">
										<g id="g4167">
											<path
												id="path4156"
												className="epytcls-1"
												d="M139.27,87.65s-87.11,0-109,5.68A36,36,0,0,0,5.68,118.12C0,140,0,185.26,0,185.26s0,45.44,5.68,67A35.47,35.47,0,0,0,30.3,276.84c22,5.85,109,5.85,109,5.85s87.28,0,109.14-5.68a34.64,34.64,0,0,0,24.44-24.62c5.86-21.69,5.86-67,5.86-67s.17-45.45-5.86-67.31a34.41,34.41,0,0,0-24.44-24.45C226.55,87.65,139.27,87.65,139.27,87.65Zm-27.72,55.77L184,185.26l-72.48,41.65V143.42Z"
											/>
										</g>
									</g>
									<path
										className="epytcls-2"
										d="M143.39,153.45c10.52-19.27,14.91-39.2,19.18-58.61q.68-3,1.33-6l.12-.54-.25-.48c-13.87-26.66-41.06-52.54-57.1-66.42,21,11.33,60,31.21,84,36.13l.63.13.53-.37c4.14-2.92,8.28-5.7,12.28-8.4,13.41-9,26.27-17.67,38.31-30.64-10.26,20.67-14.18,40.47-18.14,64.42l-.09.58.32.48c18.19,27.91,40.93,50.88,54.81,63.7C261.68,137.5,230,121.76,197,115.29l-.57-.12-3.83,2.35C176,127.67,159,138.08,143.39,153.45Z"
									/>
									<path
										className="epytcls-3"
										d="M237.47,25.4c-7.73,18.08-11.19,36-14.67,57l-.19,1.15.64,1c15,23,33.15,42.76,46.87,56.19-18.4-9.59-45.13-21.49-72.87-26.93l-1.15-.22-1,.61-3.33,2c-14.47,8.86-29.26,17.93-43.24,30.34,7.94-17,11.77-34.43,15.51-51.43q.66-3,1.33-6l.24-1.06-.51-1c-11.66-22.4-32.12-43.86-48-58.48C139,40,170,54.82,190.37,59l1.27.26,1.06-.74c4.12-2.91,8.25-5.69,12.25-8.38,11.27-7.59,22.16-14.91,32.52-24.74M254.86,0l-.74,1.11L254.86,0Zm-.74,1.11C235.26,28.88,213.71,40,191,56.06c-33.55-6.88-97.91-43.92-97.91-43.92s49,37.13,69.38,76.37c-6,26.61-11,54.9-31.35,80.94,19.83-25.28,42.66-38.61,65.58-52.69,50.06,9.8,96.22,40.55,96.22,40.55s-38.84-31-67.13-74.4c4.89-29.58,9.81-54,28.36-81.8Z"
									/>
									<polyline
										className="epytcls-4"
										points="102.6 133.11 102.6 133.11 192.98 185.28 102.6 237.22 102.6 133.11"
									/>
								</g>
							</g>
						</svg>
						YouTube Wizard
					</div>
					<div className={this.props.isSelected ? "" : "epytblock__faded--off"}>
						<div className="components-placeholder__instructions">
							Click the button below to easily embed a video, playlist, channel,
							gallery, or live stream.
						</div>
						<div className="components-placeholder__fieldset">
							<div>
								<Button isDefault onClick={this.showModal}>
									Open Wizard
								</Button>
								{this.state.show ? (
									<Modal
										title="YouTube Wizard"
										className="epytblock epytblock__modal"
										onRequestClose={this.hideModal}
									>
										<iframe
											title="YouTube Wizard"
											src={
												window._EPYTA_.wizhref +
												"&clientId=" +
												this.props.clientId
											}
										/>
									</Modal>
								) : null}
							</div>
						</div>
					</div>
				</div>
			);
		}
	},

	/**
	 * The save function defines the way in which the different attributes should be combined
	 * into the final markup, which is then serialized by Gutenberg into post_content.
	 *
	 * The "save" property must be specified and must be a valid function.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
	 */
	save: function(props) {
		return <Fragment>{props.attributes.shortcode}</Fragment>;
	}
});
