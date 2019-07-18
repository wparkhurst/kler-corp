<?php $us_map = $this->options; ?>
var us_config = {
	'default':{
		'borderclr':'<?php echo $us_map['borderclr']; ?>',
		'visnames':'<?php echo $us_map['visnames']; ?>',
		'lakesfill':'<?php echo $us_map['lakesfill']; ?>',
		'lakesoutline':'<?php echo $us_map['lakesoutline']; ?>'
	}<?php echo (isset($us_map['url_1']))?',':''; ?><?php $i = 1; 	while (isset($us_map['url_'.$i])) { ?>'us_<?php echo $i; ?>':{
		'hover': '<?php echo str_replace(array("\n","\r","\r\n","'"),array('','','','’'), is_array($us_map['info_'.$i]) ?
				array_map('stripslashes_deep', $us_map['info_'.$i]) : stripslashes($us_map['info_'.$i])); ?>',
		'url':'<?php echo $us_map['url_'.$i]; ?>',
		'targt':'<?php echo $us_map['turl_'.$i]; ?>',
		'upclr':'<?php echo $us_map['upclr_'.$i]; ?>',
		'ovrclr':'<?php echo $us_map['ovrclr_'.$i]; ?>',
		'dwnclr':'<?php echo $us_map['dwnclr_'.$i]; ?>',
		'enbl':<?php echo $us_map['enbl_'.$i]=='1'?'true':'false'; ?>,
		'visnames':'us_vn<?php echo $i; ?>',
		}
		<?php echo (isset($us_map['url_'.($i+1)]))?',':''; ?><?php $i++;} ?>
}