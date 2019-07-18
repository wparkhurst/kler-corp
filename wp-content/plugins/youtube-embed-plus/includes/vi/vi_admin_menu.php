<?php

if (self::vi_logged_in())
{
    self::$admin_page_hooks[] = add_submenu_page('youtube-my-preferences', 'Monetize With vi', '<img style="width: 16px; height: 16px; vertical-align: text-top;" src="' . plugins_url(self::$folder_name . '/images/icon-monetize.svg') . '" />&nbsp;&nbsp;Monetize', 'manage_options', 'youtube-ep-vi', array(get_class(), 'vi_admin_dashboard'));
}
else if (!(bool) (self::$alloptions[self::$opt_vi_hide_monetize_tab]) || self::vi_script_setup_done())
{
    $page_parent = null;
    if (filter_input(INPUT_GET, 'page') == 'youtube-ep-vi' || self::vi_script_setup_done())
    {
        $page_parent = 'youtube-my-preferences';
    }
    self::$admin_page_hooks[] = add_submenu_page($page_parent, 'Monetize With vi', '<img style="width: 16px; height: 16px; vertical-align: text-top;" src="' . plugins_url(self::$folder_name . '/images/icon-monetize.svg') . '" />&nbsp;&nbsp;Monetize? <sup>new</sup>', 'manage_options', 'youtube-ep-vi', array(get_class(), 'vi_admin_dashboard_pre'));
}
