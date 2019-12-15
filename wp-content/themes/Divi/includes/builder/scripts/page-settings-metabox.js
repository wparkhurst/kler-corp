(function ($) {
  var $metabox              = $('#et_settings_meta_box');
  var $container            = $metabox.find('.et_pb_page_settings_container:first');
  var $toggleBuilderWrapper = $('.et_pb_toggle_builder_wrapper');
  var $pageSettings         = $('.et_pb_page_setting');
  var $layoutSettings       = $('.et_pb_page_layout_settings');
  var $postFormat           = $('#formatdiv');
  var options               = window.et_pb_options;

  function hide() {
    var $pageLayoutSettings = $layoutSettings.closest('#et_settings_meta_box').find('.et_pb_page_layout_settings');

    if ($pageSettings.filter(':visible').length > 1) {
      $pageLayoutSettings.hide();
      $layoutSettings.find('.et_pb_side_nav_settings').show();
    } else {
      if (options.post_type !== 'post' && options.is_third_party_post_type === 'no') {
        $pageLayoutSettings.hide();
      }

      $layoutSettings.closest('#et_settings_meta_box').find('.et_pb_side_nav_settings').show();
      $layoutSettings.closest('#et_settings_meta_box').find('.et_pb_single_title').show();
    }

    if ($pageLayoutSettings.length > 0) {
      var $fullwidth = $pageLayoutSettings.find('option[value="et_full_width_page"]');

      if ($fullwidth.length > 0) {
        $fullwidth.show();
      }
    }

    // On post, hide post format UI and layout settings if pagebuilder is activated
    if ($postFormat.length) {
      var active = $postFormat.find('input[type="radio"]:checked').val();

      $postFormat.hide();
      $('.et_divi_format_setting.et_divi_' + active + '_settings').hide();
    }

    // Show project navigation option when builder enabled
    if (options.post_type === 'project') {
      $layoutSettings.closest('#et_settings_meta_box').find('.et_pb_project_nav').show();
    }
  }

  function hideSettingsIncompatibleWithTB() {
	  if ( $container.hasClass('et_pb_page_settings_container--tb-has-header') ) {
		  $metabox.find('.et_pb_nav_settings').hide();
	  }

	  if ( $container.hasClass('et_pb_page_settings_container--tb-has-body') ) {
		  $metabox.find('.et_pb_page_layout_settings, .et_pb_single_title').hide();
	  }
  }

  if ($toggleBuilderWrapper.hasClass('et_pb_builder_is_used')) {
    hide();
  }

  hideSettingsIncompatibleWithTB();

  if ($container.height() === 0) {
    // Dirty fix for metabox ending up empty when all settings get disabled due to various conditions.
    $metabox.hide();
  }
}(jQuery));
