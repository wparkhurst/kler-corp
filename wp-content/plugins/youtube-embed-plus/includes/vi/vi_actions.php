<?php
add_action("wp_ajax_my_embedplus_vi_cache_endpoints_ajax", array(get_class(), 'vi_cache_endpoints_ajax'));
add_action("wp_ajax_my_embedplus_vi_login_ajax", array(get_class(), 'vi_login_ajax'));
add_action("wp_ajax_my_embedplus_vi_toggle_ajax", array(get_class(), 'vi_toggle_ajax'));
add_action("wp_ajax_my_embedplus_vi_hide_feature_ajax", array(get_class(), 'vi_hide_feature_ajax'));

add_action('admin_init', array(get_class(), 'vi_adstxt_download'));
add_action('admin_notices', array(get_class(), 'vi_notice_login_reminder'));

if (function_exists('tenup_display_ads_txt'))
{
    add_action('init', array(get_class(), 'vi_adstxt_lookup'), 100);
}

add_shortcode('embed-vi-ad', array(get_class(), 'vi_js_shortcode'));

if ((bool)self::$alloptions[self::$opt_vi_active])
{
    add_filter('the_content', array(get_class(), 'vi_js_placement'));
    self::wp_insert_vi_gdpr_popup_init();
}

if (self::vi_logged_in())
{
    add_action("wp_ajax_my_embedplus_vi_logout_ajax", array(get_class(), 'vi_logout_ajax'));
    add_action("wp_ajax_my_embedplus_vi_reports_ajax", array(get_class(), 'vi_reports_ajax'));
    add_action("wp_ajax_my_embedplus_vi_adstxt_status_soft_ajax", array(get_class(), 'vi_adstxt_status_soft_ajax'));

    add_action('admin_init', array(get_class(), 'vi_token_expire'), 9);

    add_filter('cron_schedules', array(get_class(), 'vi_cron_interval'));
    add_action('ytvi_cron_cache_js_hook', array(get_class(), 'vi_cron_cache_js'));
    if (!wp_next_scheduled('ytvi_cron_cache_js_hook'))
    {
        wp_schedule_event(time(), 'ytvi_fifteen_days', 'ytvi_cron_cache_js_hook');
        //wp_schedule_event(time(), 'ytvi_two_minutes', 'ytvi_cron_cache_js_hook'); // testing
    }
}
