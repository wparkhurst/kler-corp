<?php
/*
  Plugin Name: YouTube
  Plugin URI: https://www.embedplus.com/dashboard/pro-easy-video-analytics.aspx?ref=plugin
  Description: YouTube Embed and YouTube Gallery WordPress Plugin. Embed a responsive video, YouTube channel, playlist gallery, or live stream
  Version: 13.1
  Author: EmbedPlus Team
  Author URI: https://www.embedplus.com
 */

/*
  YouTube
  Copyright (C) 2019 EmbedPlus.com

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program. If not, see <http://www.gnu.org/licenses/>.

 */

//define('WP_DEBUG', true);

class YouTubePrefs
{

    public static $folder_name = 'youtube-embed-plus';
    public static $curltimeout = 30;
    public static $version = '13.1';
    public static $opt_version = 'version';
    public static $optembedwidth = null;
    public static $optembedheight = null;
    public static $defaultheight = null;
    public static $defaultwidth = null;
    public static $oembeddata = null;
    public static $opt_center = 'centervid';
    public static $opt_glance = 'glance';
    public static $opt_autoplay = 'autoplay';
    public static $opt_debugmode = 'debugmode';
    public static $opt_old_script_method = 'old_script_method';
    public static $opt_cc_load_policy = 'cc_load_policy';
    public static $opt_iv_load_policy = 'iv_load_policy';
    public static $opt_loop = 'loop';
    public static $opt_modestbranding = 'modestbranding';
    public static $opt_rel = 'rel';
    public static $opt_showinfo = 'showinfo';
    public static $opt_fs = 'fs';
    public static $opt_playsinline = 'playsinline';
    public static $opt_autohide = 'autohide';
    public static $opt_controls = 'controls';
    public static $opt_theme = 'theme';
    public static $opt_color = 'color';
    public static $opt_listType = 'listType';
    public static $opt_dohl = 'dohl';
    public static $opt_hl = 'hl';
    public static $opt_nocookie = 'nocookie';
    public static $opt_gdpr_consent = 'gdpr_consent';
    public static $opt_gdpr_consent_message = 'gdpr_consent_message';
    public static $opt_gdpr_consent_button = 'gdpr_consent_button';
    public static $gdpr_cookie_name = 'ytprefs_gdpr_consent';
    public static $opt_playlistorder = 'playlistorder';
    public static $opt_acctitle = 'acctitle';
    public static $opt_pro = 'pro';
    public static $opt_oldspacing = 'oldspacing';
    public static $opt_frontend_only = 'frontend_only';
    public static $opt_responsive = 'responsive';
    public static $opt_responsive_all = 'responsive_all';
    public static $opt_origin = 'origin';
    public static $opt_widgetfit = 'widgetfit';
    public static $opt_evselector_light = 'evselector_light';
    public static $opt_stop_mobile_buffer = 'stop_mobile_buffer';
    public static $opt_restrict_wizard = 'restrict_wizard';
    public static $opt_restrict_wizard_roles = 'restrict_wizard_roles';
    public static $opt_ajax_compat = 'ajax_compat';
    public static $opt_ytapi_load = 'ytapi_load';
    public static $opt_defaultdims = 'defaultdims';
    public static $opt_defaultwidth = 'width';
    public static $opt_defaultheight = 'height';
    public static $opt_defaultvol = 'defaultvol';
    public static $opt_vol = 'vol';
    public static $opt_apikey = 'apikey';
    public static $opt_migrate = 'migrate';
    public static $opt_migrate_youtube = 'migrate_youtube';
    public static $opt_migrate_embedplusvideo = 'migrate_embedplusvideo';
    public static $opt_gallery_pagesize = 'gallery_pagesize';
    public static $opt_gallery_columns = 'gallery_columns';
    public static $opt_gallery_collapse_grid = 'gallery_collapse_grid';
    public static $opt_gallery_collapse_grid_breaks = 'gallery_collapse_grid_breaks';
    public static $opt_gallery_scrolloffset = 'gallery_scrolloffset';
    public static $opt_gallery_hideprivate = 'gallery_hideprivate';
    public static $opt_gallery_showtitle = 'gallery_showtitle';
    public static $opt_gallery_showpaging = 'gallery_showpaging';
    public static $opt_gallery_thumbplay = 'gallery_thumbplay';
    public static $opt_gallery_autonext = 'gallery_autonext';
    public static $opt_gallery_channelsub = 'gallery_channelsub';
    public static $opt_gallery_channelsublink = 'gallery_channelsublink';
    public static $opt_gallery_channelsubtext = 'gallery_channelsubtext';
    public static $opt_gallery_customarrows = 'gallery_customarrows';
    public static $opt_gallery_customprev = 'gallery_customprev';
    public static $opt_gallery_customnext = 'gallery_customnext';
    public static $opt_not_live_content = 'not_live_content';
    public static $opt_admin_off_scripts = 'admin_off_scripts';
    public static $opt_onboarded = 'onboarded';
    public static $opt_alloptions = 'youtubeprefs_alloptions';
    public static $alloptions = null;
    public static $yt_options = array();
    public static $dft_bpts = array(array('bp' => array('min' => 0, 'max' => 767), 'cols' => 1));
    public static $dft_roles = array('administrator', 'editor', 'author', 'contributor', 'subscriber');
    //public static $epbase = 'http://localhost:2346';
    public static $epbase = '//www.embedplus.com';
    public static $double_plugin = false;
    public static $scriptsprinted = 0;
    public static $min = '.min';
    public static $badentities = array('&#215;', '×', '&#8211;', '–', '&amp;', '&#038;', '&#38;');
    public static $goodliterals = array('x', 'x', '--', '--', '&', '&', '&');
    public static $wizard_hook = '';
    public static $onboarding_hook = '';
    public static $admin_page_hooks = array();
    public static $get_api_key_msg = 'The ### feature now requires a (free) YouTube API key from Google. Please follow the easy steps <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">in this video</a> to create and save your API key.';
    public static $dft_gdpr_consent_message = '<p><strong>Please accept YouTube cookies to play this video.</strong> By accepting you will be accessing content from YouTube, a service provided by an external third party.</p><p><a href="https://policies.google.com/privacy" target="_blank">YouTube privacy policy</a></p><p>If you accept this notice, your choice will be saved and the page will refresh.</p>';
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public static $vi_last_category_update_interval = '1 hour';
    public static $vi_script_tag_done = false;
    public static $vi_dft_js_settings = array(
        //"adUnitType" => "NATIVE_VIDEO_UNIT",
        "divId" => "ytvi_story_container",
        "language" => "en-us",
        "iabCategory" => "",
        "font" => "Arial",
        "fontSize" => 12,
        "keywords" => "",
        "textColor" => "#000000",
        "backgroundColor" => "#ffffff",
        "vioptional1" => "",
        "vioptional2" => "",
        "vioptional3" => "",
        "float" => true,
        //"logoUrl" => "",
        "dfpSupport" => true,
        "sponsoredText" => "",
        "poweredByText" => ""
    );
    public static $opt_vi_active = 'vi_active';
    public static $opt_vi_hide_monetize_tab = 'vi_hide_monetize_tab';
    public static $opt_vi_endpoints = 'vi_endpoints';
    public static $opt_vi_token = 'vi_token';
    public static $opt_vi_last_login = 'vi_last_login';
    public static $opt_vi_last_category_update = 'vi_last_category_update';
    public static $opt_vi_adstxt = 'vi_adstxt';
    public static $opt_vi_js_settings = 'vi_js_settings';
    public static $opt_vi_js_script = 'vi_js_script';
    public static $opt_vi_js_posttypes = 'vi_js_posttypes';
    public static $opt_vi_js_position = 'vi_js_position';
    public static $opt_vi_show_gdpr_authorization = 'vi_show_gdpr_authorization';
    public static $opt_vi_show_privacy_button = 'vi_show_privacy_button';
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public static $oldytregex = '@^\s*https?://(?:www\.)?(?:(?:youtube.com/(?:(?:watch)|(?:embed)|(?:playlist))/{0,1}\?)|(?:youtu.be/))([^\s"]+)\s*$@im';
    public static $ytregex = '@^[\r\t ]*https?://(?:www\.)?(?:(?:youtube.com/(?:(?:watch)|(?:embed)|(?:playlist))/{0,1}\?)|(?:youtu.be/))([^\s"]+)[\r\t ]*$@im';
    public static $justurlregex = '@https?://(?:www\.)?(?:(?:youtube.com/(?:(?:watch)|(?:embed)|(?:playlist))/{0,1}\?)|(?:youtu.be/))([^\[\s"]+)@i';

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        register_deactivation_hook(__FILE__, array(get_class(), 'on_deactivation'));
        add_action('admin_init', array(get_class(), 'check_double_plugin_warning'));
        add_action('admin_notices', array(get_class(), 'separate_version_message'));

        self::$alloptions = get_option(self::$opt_alloptions);
        if ((defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) || self::$alloptions[self::$opt_debugmode] == 1)
        {
            self::$min = '';
        }

        if (self::$alloptions == false || version_compare(self::$alloptions[self::$opt_version], self::$version, '<'))
        {
            self::initoptions();
        }


        if (self::$alloptions[self::$opt_oldspacing] == 1)
        {
            self::$ytregex = self::$oldytregex;
        }

        self::$optembedwidth = intval(get_option('embed_size_w'));
        self::$optembedheight = intval(get_option('embed_size_h'));

        self::$yt_options = array(
            self::$opt_autoplay,
            self::$opt_cc_load_policy,
            self::$opt_iv_load_policy,
            self::$opt_loop,
            self::$opt_modestbranding,
            self::$opt_rel,
            self::$opt_showinfo,
            self::$opt_fs,
            self::$opt_playsinline,
            self::$opt_autohide,
            self::$opt_controls,
            self::$opt_hl,
            self::$opt_theme,
            self::$opt_color,
            self::$opt_listType,
            'index',
            'list',
            'start',
            'end'
        );

        add_action('media_buttons', array(get_class(), 'media_button_wizard'), 11);


        self::do_ytprefs();
        add_action('admin_menu', array(get_class(), 'ytprefs_plugin_menu'));
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(get_class(), 'my_plugin_action_links'));

        if (!is_admin())
        {
            if (self::$alloptions[self::$opt_old_script_method] == 1)
            {
                add_action('wp_print_scripts', array(get_class(), 'jsvars'));
                add_action('wp_enqueue_scripts', array(get_class(), 'jsvars'));
            }

            add_action('wp_enqueue_scripts', array(get_class(), 'ytprefsscript'), 100);
            add_action('wp_enqueue_scripts', array(get_class(), 'fitvids'), 101);
        }

        add_filter('ytprefs_gdpr_consent_message', array(get_class(), 'filter_gdpr_consent_message'));

        add_action("wp_ajax_my_embedplus_onboarding_save_ajax", array(get_class(), 'onboarding_save_ajax'));
        add_action("wp_ajax_my_embedplus_onboarding_save_apikey_ajax", array(get_class(), 'onboarding_save_apikey_ajax'));
        add_action("wp_ajax_my_embedplus_glance_vids", array(get_class(), 'my_embedplus_glance_vids'));
        add_action("wp_ajax_my_embedplus_glance_count", array(get_class(), 'my_embedplus_glance_count'));
        add_action("wp_ajax_my_embedplus_dismiss_double_plugin_warning", array(get_class(), 'my_embedplus_dismiss_double_plugin_warning'));
        add_action("wp_ajax_my_embedplus_gallery_page", array(get_class(), 'my_embedplus_gallery_page'));
        add_action("wp_ajax_nopriv_my_embedplus_gallery_page", array(get_class(), 'my_embedplus_gallery_page'));
        add_action('admin_enqueue_scripts', array(get_class(), 'admin_enqueue_scripts'), 10, 1);
        /////////////////////////////////////
        include_once(EPYTVI_INCLUDES_PATH . 'vi_actions.php');
        include_once(EPYTGB_INCLUDES_PATH . 'gutenberg_hooks.php');
    }

    public static function separate_version_message()
    {
        if (current_user_can('manage_options') && self::$alloptions[self::$opt_pro] && strlen(trim(self::$alloptions[self::$opt_pro])) > 10)
        {
            $class = 'notice notice-error is-dismissible';
            $message = 'Important message to YouTube Pro users: From version 11.7 onward, you must <a href="https://www.embedplus.com/youtube-pro/download/?prokey=' . esc_attr(self::$alloptions[self::$opt_pro]) . '" target="_blank">download the separate plugin here</a> to regain your Pro features. All your settings will automatically migrate after installing the separate Pro download. Thank you for your support and patience during this transition.';

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), wp_kses_post($message));
        }
    }

    public static function my_plugin_action_links($links)
    {
        $links[] = '<a href="' . esc_url(admin_url('admin.php?page=youtube-my-preferences')) . '">Settings</a>';
        $links[] = '<a href="https://www.embedplus.com/dashboard/pro-easy-video-analytics.aspx?ref=actionlinks" target="_blank">Pro Version</a>';
        return $links;
    }

    public static function show_glance_list()
    {
        $glancehref = self::show_glance();
        $cnt = self::get_glance_count();

        //display via list
        return
                '<li class="page-count">
            <a href="' . $glancehref . '" class="thickbox ytprefs_glance_button" id="ytprefs_glance_button" title="YouTube Embeds At a Glance">
                ' . number_format_i18n($cnt) . ' With YouTube
            </a>
        </li>';
    }

    public static function show_glance_table()
    {
        $glancehref = self::show_glance();
        $cnt = self::get_glance_count();
        return
                '<tr>
            <td class="first b"><a title="YouTube Embeds At a Glance" href="' . $glancehref . '" class="thickbox ytprefs_glance_button">' . number_format_i18n($cnt) . '</a></td>
            <td class="t"><a title="YouTube Embeds At a Glance" href="' . $glancehref . '" id="ytprefs_glance_button" class="thickbox ytprefs_glance_button">With YouTube</a></td>
        </tr>';
    }

    public static function get_glance_count()
    {
        global $wpdb;
        $query_sql = "
                SELECT count(*) as mytotal
                FROM $wpdb->posts
                WHERE (post_content LIKE '%youtube.com/%' OR post_content LIKE '%youtu.be/%')
                AND post_status = 'publish'";

        $query_result = $wpdb->get_results($query_sql, OBJECT);

        return intval($query_result[0]->mytotal);
    }

    public static function show_glance()
    {
        $glancehref = admin_url('admin.php?page=youtube-ep-glance') . '&random=' . rand(1, 1000) . '&TB_iframe=true&width=780&height=800';
        return $glancehref;
    }

    public static function glance_page()
    {
        ?>
        <div class="wrap">
            <style type="text/css">
                #wphead {display:none;}
                #wpbody{margin-left: 0px;}
                .wrap {font-family: Arial; padding: 0px 10px 0px 10px; line-height: 180%;}
                .bold {font-weight: bold;}
                .orange {color: #f85d00;}
                sup.orange {text-transform: lowercase; font-weight: bold; color: #f85d00;}
                #adminmenuback {display: none;}
                #adminmenu, adminmenuwrap {display: none;}
                #wpcontent, .auto-fold #wpcontent {margin-left: 0px;}
                #wpadminbar {display:none;}
                html.wp-toolbar {padding: 0px;}
                #footer, #wpfooter, .auto-fold #wpfooter {display: none;}
                #wpfooter {clear: both}
                .acctitle {background-color: #dddddd; border-radius: 5px; padding: 7px 15px 7px 15px; cursor: pointer; margin: 10px; font-weight: bold; font-size: 12px;}
                .acctitle:hover {background-color: #cccccc;}
                .accbox {display: none; position: relative; margin:  5px 8px 30px 15px; clear: both; line-height: 180%;}
                .accclose {position: absolute; top: -38px; right: 5px; cursor: pointer; width: 24px; height: 24px;}
                .accloader {padding-right: 20px;}
                .accthumb {display: block; width: 300px; float: left; margin-right: 25px;}
                .accinfo {width: 300px; float: left;}
                .accvidtitle {font-weight: bold; font-size: 16px;}
                .accthumb img {width: 300px; height: auto; display: block;}
                .clearboth {clear: both;}
                .pad20 {padding: 20px;}
                .center {text-align: center;}
            </style>
            <script type="text/javascript">
                function accclose(ele)
                {
                    jQuery(ele).parent('.accbox').hide(400);
                }

                (function ($j)
                {
                    $j(document).ready(function ()
                    {


                        $j('.acctitle').click(function ()
                        {
                            var $acctitle = $j(this);
                            var $accbox = $j(this).parent().children('.accbox');
                            var pid = $accbox.attr("data-postid");
                            $acctitle.prepend('<img alt="loading" class="accloader" src="<?php echo plugins_url('images/ajax-loader.gif', __FILE__) ?>" />');
                            jQuery.ajax({
                                type: "post",
                                dataType: "json",
                                timeout: 30000,
                                url: window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl,
                                data: {action: 'my_embedplus_glance_vids', postid: pid},
                                success: function (response)
                                {
                                    if (response.type === "success")
                                    {
                                        $accbox.html(response.data),
                                                $accbox.show(400);
                                    }
                                    else
                                    {
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError)
                                {

                                },
                                complete: function ()
                                {
                                    $acctitle.children('.accloader').remove();
                                }

                            });
                        });
                    });
                })(jQuery);</script>
            <?php
            global $wpdb;
            $query_sql = "
                SELECT SQL_CALC_FOUND_ROWS *
                FROM $wpdb->posts
                WHERE (post_content LIKE '%youtube.com/%' OR post_content LIKE '%youtu.be/%')
                AND post_status = 'publish'
                order by post_date DESC LIMIT 0, 10";

            $query_result = $wpdb->get_results($query_sql, OBJECT);

            if ($query_result !== null)
            {
                $total = $wpdb->get_var("SELECT FOUND_ROWS();");
                global $post;
                echo '<h2><img alt="YouTube Plugin Icon" src="' . plugins_url('images/youtubeicon16.png', __FILE__) . '" /> 10 Latest Posts/Pages with YouTube Videos (' . intval($total) . ' Total)</h2>';
                ?>

                We recommend using this page as an easy way to check the results of the global default settings you make (e.g. hide annotations) on your recent embeds. Or, simply use it as an index to jump right to your posts that contain YouTube embeds.

                <?php
                if ($total > 0)
                {
                    echo '<ul class="accord">';
                    foreach ($query_result as $post)
                    {
                        echo '<li>';
                        setup_postdata($post);
                        the_title('<div class="acctitle">', ' &raquo;</div>');
                        echo '<div class="accbox" data-postid="' . $post->ID . '"></div><div class="clearboth"></div></li>';
                    }
                    echo '</ul>';
                }
                else
                {
                    echo '<p class="center bold orange">You currently do not have any YouTube embeds yet.</p>';
                }
            }

            wp_reset_postdata();
            ?>
            To remove this feature from your dashboard, simply uncheck <i>Show "At a Glance" Embed Links</i> in the <a target="_blank" href="<?php echo admin_url('admin.php?page=youtube-my-preferences#jumpdefaults') ?>">plugin settings page &raquo;</a>.

        </div>
        <?php
    }

    public static function is_ajax()
    {
        $is_ajax = (function_exists('wp_doing_ajax') && wp_doing_ajax() || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'));
        if ($is_ajax)
        {
            header('HTTP/1.1 200 OK');
        }
        return $is_ajax;
    }

    public static function my_embedplus_glance_vids()
    {
        $result = array();
        if (self::is_ajax())
        {
            $postid = intval($_REQUEST['postid']);
            $currpost = get_post($postid);

            $thehtml = '<img alt="close" class="accclose" onclick="accclose(this)" src="' . plugins_url('images/accclose.png', __FILE__) . '" />';

            $matches = array();
            $ismatch = preg_match_all(self::$justurlregex, $currpost->post_content, $matches);

            if ($ismatch)
            {
                foreach ($matches[0] as $match)
                {
                    $link = trim(preg_replace('/&amp;/i', '&', $match));
                    $link = preg_replace('/\s/', '', $link);
                    $link = trim(str_replace(self::$badentities, self::$goodliterals, $link));

                    $linkparamstemp = explode('?', $link);

                    $linkparams = array();
                    if (count($linkparamstemp) > 1)
                    {
                        $linkparams = self::keyvalue($linkparamstemp[1], true);
                    }
                    if (strpos($linkparamstemp[0], 'youtu.be') !== false && !isset($linkparams['v']))
                    {
                        $vtemp = explode('/', $linkparamstemp[0]);
                        $linkparams['v'] = array_pop($vtemp);
                    }

                    $vidid = $linkparams['v'];

                    if ($vidid != null)
                    {
                        try
                        {
                            $odata = self::get_oembed('https://youtube.com/watch?v=' . $vidid, 1920, 1280);
                            $postlink = get_permalink($postid);
                            if ($odata != null && !is_wp_error($odata))
                            {
                                $_name = esc_attr(sanitize_text_field($odata->title));
                                $_description = esc_attr(sanitize_text_field($odata->author_name));
                                $_thumbnailUrl = esc_url("https://i.ytimg.com/vi/" . $vidid . "/0.jpg");

                                $thehtml .= '<a target="_blank" href="' . $postlink . '" class="accthumb"><img alt="YouTube Video" src="' . $_thumbnailUrl . '" /></a>';
                                $thehtml .= '<div class="accinfo">';
                                $thehtml .= '<a target="_blank" href="' . $postlink . '" class="accvidtitle">' . $_name . '</a>';
                                $thehtml .= '<div class="accdesc">' . (strlen($_description) > 400 ? substr($_description, 0, 400) . "..." : $_description) . '</div>';
                                $thehtml .= '</div>';
                                $thehtml .= '<div class="clearboth pad20"></div>';
                            }
                            else
                            {
                                $thehtml .= '<p class="center bold orange">This <a target="_blank" href="' . $postlink . '">post/page</a> contains a video that has been removed from YouTube.';
                                $thehtml .= '<br><a target="_blank" href="https://www.embedplus.com/dashboard/pro-easy-video-analytics.aspx?ref=glancevids">Activate delete video tracking to catch these cases &raquo;</a>';
                                $thehtml .= '</strong>';
                            }
                        }
                        catch (Exception $ex)
                        {
                            
                        }
                    }
                    else if (isset($linkparams['list']))
                    {
                        // if playlist
                        try
                        {
                            $odata = self::get_oembed('https://youtube.com/playlist?list=' . $linkparams['list'], 1920, 1280);
                            $postlink = get_permalink($postid);
                            if ($odata != null && !is_wp_error($odata))
                            {
                                $_name = esc_attr(sanitize_text_field($odata->title));
                                $_description = esc_attr(sanitize_text_field($odata->author_name));
                                $_thumbnailUrl = esc_url($odata->thumbnail_url);

                                $thehtml .= '<a target="_blank" href="' . $postlink . '" class="accthumb"><img alt="YouTube Video" src="' . $_thumbnailUrl . '" /></a>';
                                $thehtml .= '<div class="accinfo">';
                                $thehtml .= '<a target="_blank" href="' . $postlink . '" class="accvidtitle">' . $_name . '</a>';
                                $thehtml .= '<div class="accdesc">' . (strlen($_description) > 400 ? substr($_description, 0, 400) . "..." : $_description) . '</div>';
                                $thehtml .= '</div>';
                                $thehtml .= '<div class="clearboth pad20"></div>';
                            }
                            else
                            {
                                $thehtml .= '<p class="center bold orange">This <a target="_blank" href="' . $postlink . '">post/page</a> contains a video that has been removed from YouTube.';
                                $thehtml .= '<br><a target="_blank" href="https://www.embedplus.com/dashboard/pro-easy-video-analytics.aspx?ref=glancevids">Activate delete video tracking to catch these cases &raquo;</a>';
                                $thehtml .= '</strong>';
                            }
                        }
                        catch (Exception $ex)
                        {
                            
                        }
                    }
                }
            }



            if ($currpost != null)
            {
                $result['type'] = 'success';
                $result['data'] = $thehtml;
            }
            else
            {
                $result['type'] = 'error';
            }
            echo json_encode($result);
        }
        else
        {
            $result['type'] = 'error';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        die();
    }

    public static function my_embedplus_glance_count()
    {
        $result = array();
        if (self::is_ajax())
        {
            $thehtml = '';

            try
            {
                if (version_compare(get_bloginfo('version'), '3.8', '>='))
                {
                    $result['container'] = '#dashboard_right_now ul';
                    $thehtml .= self::show_glance_list();
                }
                else
                {
                    $result['container'] = '#dashboard_right_now .table_content table tbody';
                    $thehtml .= self::show_glance_table();
                }
                $result['type'] = 'success';
                $result['data'] = $thehtml;
            }
            catch (Exception $e)
            {
                $result['type'] = 'error';
            }

            echo json_encode($result);
        }
        else
        {
            $result['type'] = 'error';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        die();
    }

    public static function try_get_ytid($url)
    {
        $theytid = null;
        if (strpos($url, 'v=') !== false)
        {
            $url_params = explode('?', $url);
            $kvp = self::keyvalue($url_params[1], true);
            $theytid = $kvp['v'];
        }
        else if (strpos($url, "youtu.be") !== false)
        {
            $shortpath = explode('/', parse_url($url, PHP_URL_PATH));
            $theytid = $shortpath[1];
        }
        return $theytid;
    }

    public static function wizard()
    {
        ?>
        <div class="wrap" id="epyt_wiz_wrap">
            <div class="smallnote center"> Please periodically check the YouTube plugin tab on your admin panel to review the latest options. </div>

            <?php
            $form_valid = true;
            $acc_expand = '';
            $get_pro_link = self::$epbase . '/dashboard/pro-easy-video-analytics.aspx?ref=wizard';



            $step1_api_error_msg = ' Please confirm that the link works in your browser, and that <em>the owner of the video allowed embed sharing permissions (otherwise, contact the owner of the video to allow embedding)</em>. Then copy that full link in your address bar to paste here. If you are sure your link is correct, then (1) your API key may be too restrictive (<a target="_blank" href="https://console.developers.google.com/apis/credentials">check here</a>) or (2) you have reached your Google quota (<a href="https://console.developers.google.com/apis/dashboard" target="_blank">check here</a>). You can apply to Google for a <a href="https://services.google.com/fb/forms/ytapiquotarequest/" target="_blank">quota increase here</a>.';
            $step1_video_errors = '';
            $step1_video_error_invalid = 'Sorry, that does not seem to be a link to an existing video. Please confirm that the link works in your browser, and that <em>the owner of the video allowed embed sharing permissions (otherwise, contact the owner of the video to allow embedding)</em>. Then copy that full link in your address bar to paste here.';
            $step1_playlist_errors = '';
            $step1_playlist_error_invalid = 'Sorry, that does not seem to be a link to an existing playlist. Please confirm that the link works in your browser, and that <em>the owner of the playlist allowed embed sharing permissions (otherwise, contact the owner of the video to allow embedding)</em>. Then copy that full link in your address bar to paste here.';
            $step1_channel_errors = '';
            $step1_channel_error_invalid = 'Sorry, that does not seem to be a link to an existing video. ' . $step1_api_error_msg;
            $step1_live_errors = '';
            $step1_live_error_invalid = 'Sorry, that does not seem to be a valid link to an existing live video. ' . $step1_api_error_msg;
            $if_live_preview = false;

            $theytid = null;
            $theplaylistid = null;
            $submit_type = null;

            if (isset($_POST['wizform_submit']))
            {
                check_admin_referer('_epyt_wiz', '_epyt_nonce');

                $submit_type = sanitize_text_field($_POST['wizform_submit']);
                if ($submit_type === 'step1_video')
                {
                    // validate
                    $search = sanitize_text_field(trim($_POST['txtUrl']));

                    try
                    {
                        if (empty($search))
                        {
                            throw new Exception();
                        }
                        if (preg_match(self::$justurlregex, $search))
                        {
                            //$search = esc_url($search);

                            try
                            {
                                $theytid = self::try_get_ytid($search);

                                if ($theytid == null)
                                {
                                    $form_valid = false;
                                    $step1_video_errors = $step1_video_error_invalid;
                                    $acc_expand = 'h3_video';
                                }
                                else
                                {

                                    $odata = self::get_oembed('http://youtube.com/watch?v=' . $theytid, 1920, 1280);
                                    if (is_object($odata))
                                    {
                                        ?>

                                        <div id="step2_video" class="center">

                                            <h2>
                                                <?php
                                                if (isset($odata->title))
                                                {
                                                    echo sanitize_text_field($odata->title);
                                                }
                                                ?>
                                            </h2>
                                            <p class="center">
                                                <a class="ui-button ui-widget ui-corner-all" href="<?php echo $get_pro_link; ?>" target="_blank"><span class="ui-icon ui-icon-gear"></span> Customize (PRO)</a>
                                                &nbsp; <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] https://www.youtube.com/watch?v=<?php echo esc_attr($theytid) ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert Into Editor</a>
                                            </p>
                                            &nbsp; Or Copy Code:
                                            <span class="copycode">[embedyt] https://www.youtube.com/watch?v=<?php echo esc_attr($theytid) ?>[/embedyt]</span>
                                            <div class="clearboth" style="height: 10px;">
                                            </div>
                                            <div class="center relative">
                                                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($theytid) ?>?rel=0" allowfullscreen="" width="854" height="480" frameborder="0"></iframe>
                                            </div>

                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        $form_valid = false;
                                        $step1_video_errors = $step1_video_error_invalid;
                                        $acc_expand = 'h3_video';
                                    }
                                }
                            }
                            catch (Exception $ex)
                            {
                                $form_valid = false;
                                $step1_video_errors = $step1_video_error_invalid;
                                $acc_expand = 'h3_video';
                            }
                        }
                        else
                        {
                            $search_options = new stdClass();
                            $search_options->q = $search;
                            $search_options->pageToken = null;
                            ?>
                            <div id="step2_video_search" class="center">
                                <h2>You searched for: <em class="orange"><?php echo sanitize_text_field($search); ?></em> </h2>

                                <?php
                                $search_page = self::get_search_page($search_options);
                                echo $search_page->html;
                                ?>
                            </div>
                            <?php
                        }

                        // // if valid, set and display next step
                        // if not,form_valid = false and  set accordion expander and error messages
                    }
                    catch (Exception $ex)
                    {
                        $form_valid = false;
                        $step1_video_errors = $step1_video_error_invalid;
                        $acc_expand = 'h3_video';
                    }
                }
                else if ($submit_type === 'step1_playlist')
                {
                    $search = sanitize_text_field(trim($_POST['txtUrlPlaylist']));
                    try
                    {
                        if (empty($search))
                        {
                            throw new Exception();
                        }
                        if (preg_match(self::$justurlregex, $search))
                        {
                            try
                            {
                                $theytid = null;
                                try
                                {
                                    $theytid = self::try_get_ytid($search);
                                }
                                catch (Exception $ex)
                                {
                                    
                                }

                                $urlparams = explode('?', $search);
                                $qvars = array();
                                parse_str($urlparams[1], $qvars);
                                $theplaylistid = $qvars["list"];

                                $odata = self::get_oembed('https://youtube.com/playlist?list=' . $theplaylistid, 1920, 1280);

                                if (is_object($odata))
                                {
                                    $rel = 'https://www.youtube.com/embed?listType=playlist&list=' . (esc_attr($theplaylistid) . (empty($theytid) ? '' : '&v=' . esc_attr($theytid)));
                                    ?>

                                    <div id="step2_playlist" class="center">

                                        <h2>
                                            <?php
                                            if (isset($odata->title))
                                            {
                                                echo 'Playlist: ' . sanitize_text_field($odata->title);
                                            }
                                            ?>
                                        </h2>
                                        <p class="center">
                                            <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] <?php echo $rel; ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert as Playlist</a>
                                            &nbsp; <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] <?php echo $rel . '&layout=gallery'; ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert as Gallery</a>
                                            &nbsp; <a class="ui-button ui-widget ui-corner-all" href="<?php echo $get_pro_link; ?>" target="_blank"><span class="ui-icon ui-icon-gear"></span> Customize (PRO)</a>
                                        </p>
                                        <p>
                                            Or Copy Code:
                                        </p>
                                        <p>
                                            Playlist Layout: <span class="copycode">[embedyt] <?php echo $rel; ?>[/embedyt]</span>
                                        </p>
                                        <p>
                                            Gallery Layout: <span class="copycode">[embedyt] <?php echo $rel . '&layout=gallery'; ?>[/embedyt]</span>
                                        </p>
                                        <div class="clearboth" style="height: 10px;">
                                        </div>
                                        <div class="center relative">
                                            <iframe src="<?php echo $rel; ?>" allowfullscreen="" width="854" height="480" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    $form_valid = false;
                                    $step1_playlist_errors = $step1_playlist_error_invalid;
                                    $acc_expand = 'h3_playlist';
                                }
                            }
                            catch (Exception $ex)
                            {
                                $form_valid = false;
                                $step1_playlist_errors = $step1_playlist_error_invalid;
                                $acc_expand = 'h3_playlist';
                            }
                        }
                    }
                    catch (Exception $ex)
                    {
                        $form_valid = false;
                        $step1_playlist_errors = $step1_playlist_error_invalid;
                        $acc_expand = 'h3_playlist';
                    }
                }
                else if ($submit_type === 'step1_channel')
                {
                    $search = sanitize_text_field(trim($_POST['txtUrlChannel']));
                    try
                    {
                        if (empty($search))
                        {
                            throw new Exception();
                        }
                        if (preg_match(self::$justurlregex, $search) || preg_match('@/channel/(.+)@', $search))
                        {
                            try
                            {
                                $thechannel = null;
                                if (preg_match(self::$justurlregex, $search))
                                {
                                    // single id
                                    $theytid = null;
                                    try
                                    {
                                        $theytid = self::try_get_ytid($search);
                                    }
                                    catch (Exception $ex)
                                    {
                                        
                                    }
                                    $chanvid = null;
                                    if ($theytid)
                                    {
                                        $chanvid = self::get_video_snippet($theytid);
                                    }
                                    if ($chanvid)
                                    {
                                        $thechannel = self::get_channel_snippet($chanvid->snippet->channelId);
                                    }
                                }
                                else
                                {
                                    // channel id
                                    $chanmatch = array();
                                    preg_match('@/channel/(.+)@', $search, $chanmatch);
                                    if (!empty($chanmatch))
                                    {
                                        $thechannel = self::get_channel_snippet($chanmatch[1]);
                                    }
                                }
                                if ($thechannel)
                                {
                                    $theplaylistid = $thechannel->contentDetails->relatedPlaylists->uploads;
                                    $rel = 'https://www.youtube.com/embed?listType=playlist&list=' . (esc_attr($theplaylistid));
                                    ?>

                                    <div id="step2_channel" class="center">

                                        <h2>
                                            <?php
                                            echo 'Channel: ' . sanitize_text_field($thechannel->snippet->title);
                                            ?>
                                        </h2>
                                        <p class="center">
                                            <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] <?php echo $rel; ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert as Playlist</a>
                                            &nbsp; <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] <?php echo $rel . '&layout=gallery'; ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert as Gallery</a>
                                            &nbsp; <a class="ui-button ui-widget ui-corner-all" href="<?php echo $get_pro_link; ?>" target="_blank"><span class="ui-icon ui-icon-gear"></span> Customize (PRO)</a>
                                        </p>
                                        <p>
                                            Or Copy Code:
                                        </p>
                                        <p>
                                            Playlist Layout: <span class="copycode">[embedyt] <?php echo $rel; ?>[/embedyt]</span>
                                        </p>
                                        <p>
                                            Gallery Layout: <span class="copycode">[embedyt] <?php echo $rel . '&layout=gallery'; ?>[/embedyt]</span>
                                        </p>
                                        <div class="clearboth" style="height: 10px;">
                                        </div>
                                        <div class="center relative">
                                            <iframe src="<?php echo $rel; ?>" allowfullscreen="" width="854" height="480" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    $form_valid = false;
                                    $step1_channel_errors = $step1_channel_error_invalid;
                                    $acc_expand = 'h3_channel';
                                }
                            }
                            catch (Exception $ex)
                            {
                                $form_valid = false;
                                $step1_channel_errors = $step1_channel_error_invalid;
                                $acc_expand = 'h3_channel';
                            }
                        }
                    }
                    catch (Exception $ex)
                    {
                        $form_valid = false;
                        $step1_channel_errors = $step1_channel_error_invalid;
                        $acc_expand = 'h3_channel';
                    }
                }
                else if ($submit_type === 'step1_live')
                {
                    $search = sanitize_text_field(trim($_POST['txtUrlLive']));
                    try
                    {
                        if (empty($search))
                        {
                            throw new Exception();
                        }

                        try
                        {
                            $theytid = null;
                            try
                            {
                                $theytid = self::try_get_ytid($search);
                            }
                            catch (Exception $ex)
                            {
                                
                            }
                            $live_attempt = self::get_video_snippet($theytid);
                            if ($live_attempt)
                            {
                                $if_live_preview = $live_attempt->id;
                                $final_title = sanitize_text_field($live_attempt->snippet->title);
                                $final_title_prefix = 'Live Stream';
                            }
                            $rel = 'https://www.youtube.com/watch?v=' . (esc_attr($theytid)) . '&live=1';
                            $doing_live = true;
                            ?>
                            <div id="step2_live" class="center">

                                <h2>
                                    <?php
                                    echo 'Live Stream: ' . sanitize_text_field($live_attempt->snippet->title);
                                    ?>
                                </h2>
                                <p class="center">
                                    <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] <?php echo $rel; ?>[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert Into Editor</a>
                                    &nbsp; <a class="ui-button ui-widget ui-corner-all" href="<?php echo $get_pro_link; ?>" target="_blank"><span class="ui-icon ui-icon-gear"></span> Customize (PRO)</a>
                                </p>
                                <p>
                                    Or Copy Code:
                                </p>
                                <p>
                                    <span class="copycode">[embedyt] <?php echo $rel; ?>[/embedyt]</span>
                                </p>
                                <div class="clearboth" style="height: 10px;">
                                </div>
                                <?php
                                if ($if_live_preview)
                                {
                                    ?>
                                    <div class="center relative">
                                        <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($if_live_preview) ?>?rel=0" allowfullscreen="" width="854" height="480" frameborder="0"></iframe>
                                    </div>
                                    <?php
                                }
                                ?>
                                <p>
                                    <strong>Is your live stream not working?</strong>  According to Google/YouTube rules, there must be an active AdSense account that's connected to the live 
                                    stream's channel (for monetization) in order embed the stream. If you own the channel, we suggest that you attach an AdSense account. Otherwise, you will 
                                    likely just see a blank screen when you embed your stream, even if it is visible on YouTube.com.
                                    Read more here: <a href="https://support.google.com/youtube/answer/2474026?hl=en" target="_blank">https://support.google.com/youtube/answer/2474026?hl=en</a>
                                </p>
                            </div>
                            <?php
                        }
                        catch (Exception $ex)
                        {
                            $form_valid = false;
                            $step1_live_errors = $step1_live_error_invalid;
                            $acc_expand = 'h3_live';
                        }
                    }
                    catch (Exception $ex)
                    {
                        $form_valid = false;
                        $step1_live_errors = $step1_live_error_invalid;
                        $acc_expand = 'h3_live';
                    }
                }
                else
                {
                    $form_valid = false;
                    $acc_expand = 'h3none';
                }
            }

            if (!isset($_POST['wizform_submit']) || ($form_valid === false))
            {
                if ($form_valid === false)
                {
                    ?>
                    <script type="text/javascript">
                        var _EPYTWIZ_ = _EPYTWIZ_ || {};
                        _EPYTWIZ_.acc_expand = '<?php echo sanitize_key($acc_expand) ?>';</script>
                    <?php
                }
                ?>

                <div class="wiz-accordion">
                    <h3 class="header-go"> <a href="<?php echo admin_url('admin.php?page=youtube-my-preferences#jumpdefaults'); ?>">Check my general YouTube embedding instructions and settings. </a></h3>
                    <div class="header-go-content"></div>
                    <h3 id="h3_video"> <a href="#">Embed a single video.</a></h3>
                    <div>
                        <h4 class="center">Single video directions</h4>
                        <p>
                            Search YouTube videos by title below (example: <em>TED talks</em>). Or, if you already have the URL for the video, you can paste it below (example: <em>https://www.youtube.com/watch?v=YVvn8dpSAt0</em> )
                        </p>
                        <form name="wizform_video" method="post" action="" class="wizform" id="wizform_video">
                            <?php wp_nonce_field('_epyt_wiz', '_epyt_nonce', true); ?>
                            <div class="center txt-button-align">
                                <input name="txtUrl" maxlength="200" id="txtUrl" class="txturlpastecustom ui-widget ui-widget-content ui-corner-all" placeholder="Search by title or paste URL here" type="text"> <button name="wizform_submit" class="ui-button ui-widget ui-corner-all" type="submit" value="step1_video">Submit</button>
                            </div>
                            <p class="badpaste orange bold" style="display: none;">
                                Please do not paste full embedcode above, only simple links to the YouTube video.
                                <br />
                                We have attempted to correct it above, but please doublecheck!
                            </p>
                        </form>
                        <?php echo $step1_video_errors ? '<p class="orange bold">' . $step1_video_errors . '</p>' : ''; ?>
                    </div>
                    <h3 id="h3_playlist"> <a href="#">Embed a playlist. </a></h3>
                    <div>
                        <h4 class="center">Playlist directions</h4>
                        <div class="playlist-tabs">
                            <ul>
                                <li><a href="#ptabs-1">Self-contained layout directions</a></li>
                                <li><a href="#ptabs-2">Gallery layout directions</a></li>
                            </ul>
                            <div id="ptabs-1">
                                <img src="<?php echo plugins_url('/images/icon-playlist-self.jpg', __FILE__) ?>" class="icon-playlist" />
                                <ol>
                                    <li>Go to the page for the playlist that lists all of its videos (<a href="https://www.youtube.com/playlist?list=PL70DEC2B0568B5469" target="_blank">Example &raquo;</a>). </li>
                                    <li>You may then click on the video that you want the playlist to start with (this step only applies to self-contained playlists. You cannot pick a starter for gallery layout directions).</li>
                                    <li>Copy the URL in your browser and paste it in the textbox below. You'll notice that a playlist URL contains the playlist ID (e.g. "PL...")</li>
                                    <li>Click "Get Playlist" to continue.</li>
                                </ol>
                                <div class="clearboth">
                                </div>
                            </div>
                            <div id="ptabs-2">
                                <img src="<?php echo plugins_url('/images/icon-playlist-gallery.jpg', __FILE__) ?>" class="icon-playlist" />
                                <ol>
                                    <li>Go to the page for the playlist that lists all of its videos (<a href="https://www.youtube.com/playlist?list=PL70DEC2B0568B5469" target="_blank">Example &raquo;</a>). </li>
                                    <li>Copy the URL in your browser and paste it in the textbox below. You'll notice that a playlist URL contains the playlist ID (e.g. "PL...")</li>
                                    <li>Click "Get Playlist" to continue.</li>
                                </ol>
                                <div class="clearboth">
                                </div>
                            </div>
                        </div>

                        <form name="wizform_playlist" method="post" action="" class="wizform" id="wizform_playlist">
                            <?php wp_nonce_field('_epyt_wiz', '_epyt_nonce', true); ?>
                            <div class="center txt-button-align">
                                <input name="txtUrlPlaylist" maxlength="200" id="txtUrlPlaylist" class="txturlpastecustom ui-widget ui-widget-content ui-corner-all" placeholder="Paste the playlist link here" type="text">
                                <button name="wizform_submit" class="ui-button ui-widget ui-corner-all" type="submit" value="step1_playlist">Get Playlist</button>
                            </div>
                        </form>
                        <?php echo $step1_playlist_errors ? '<p class="orange bold">' . $step1_playlist_errors . '</p>' : ''; ?>
                    </div>
                    <h3 id="h3_channel"> <a href="#">Embed a channel.  </a></h3>
                    <div>
                        <h4 class="center">Channel directions</h4>
                        <?php
                        if (!self::has_api_key())
                        {
                            echo str_replace('###', '"search for channel"', self::$get_api_key_msg);
                        }
                        else
                        {
                            ?>
                            <p>
                                If you already know the direct link to the channel, enter it below.<br>Example: https://www.youtube.com/<strong>channel</strong>/UCnM5iMGiKsZg-iOlIO2ZkdQ
                            </p>
                            <p>
                                Or, simply enter a link to any single video that belongs to the user's channel, and the plugin will find the channel for you.<br>Example: https://www.youtube.com/watch?v=YVvn8dpSAt0
                            </p>
                            <form name="wizform_channel" method="post" action="" class="wizform" id="wizform_channel">
                                <?php wp_nonce_field('_epyt_wiz', '_epyt_nonce', true); ?>
                                <div class="center txt-button-align">
                                    <input name="txtUrlChannel" maxlength="200" id="txtUrlChannel" class="txturlpastecustom ui-widget ui-widget-content ui-corner-all" placeholder="Paste YouTube link here" type="text"> <button name="wizform_submit" class="ui-button ui-widget ui-corner-all" type="submit" value="step1_channel">Get Channel</button>
                                </div>
                                <p class="badpaste orange bold" style="display: none;">
                                    Please do not paste full embedcode above, only simple links to the YouTube video.
                                    <br />
                                    We have attempted to correct it above, but please doublecheck!
                                </p>
                            </form>
                            <?php echo $step1_channel_errors ? '<p class="orange bold">' . $step1_channel_errors . '</p>' : ''; ?>
                            <?php
                        }
                        ?>
                    </div>
                    <h3 id="h3_live"> <a href="#">Embed a live stream. </a></h3>
                    <div>
                        <h4 class="center">Live stream directions</h4>
                        <?php
                        if (!self::has_api_key())
                        {
                            echo str_replace('###', 'live stream', self::$get_api_key_msg);
                        }
                        else
                        {
                            ?>
                            <p>
                                Important: You can embed any public livestreams from any channel that YouTube/Google has approved to be <strong>Eligible</strong> and <strong>Enabled</strong>.
                                If you're trying to embed a livestream from your own channel, you can check make sure it is <strong>Eligible</strong> and <strong>Enabled</strong> by <a href="https://www.youtube.com/features" target="_blank">visiting here.</a>
                                You are verified if you see the word "Enabled" at the bottom of the box that is labeled "Embed live streams." Note that verification can only be done directly through YouTube/Google with the link above, and this plugin cannot automatically do that.
                            </p>
                            <p>
                                Once you have the link for a live stream, follow the steps below.
                            </p>
                            <ol>
                                <li>
                                    Paste in the direct URL of the live stream below and click Submit. Example: https://www.youtube.com/watch?v=<strong>hHW1oY26kxQ</strong>
                                </li>
                                <li>
                                    On the next screen, customize or insert your video.
                                </li>
                            </ol>
                            <form name="wizform_live" method="post" action="" class="wizform" id="wizform_live">
                                <?php wp_nonce_field('_epyt_wiz', '_epyt_nonce', true); ?>
                                <div class="center txt-button-align">
                                    <input name="txtUrlLive" maxlength="200" id="txtUrlLive" class="ui-widget ui-widget-content ui-corner-all" placeholder="Paste YouTube link here" type="text"> <button name="wizform_submit" class="ui-button ui-widget ui-corner-all" type="submit" value="step1_live">Submit</button>
                                </div>
                            </form>
                            <?php echo $step1_live_errors ? '<p class="orange bold">' . $step1_live_errors . '</p>' : ''; ?>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (current_user_can('manage_options') && !self::vi_logged_in() && !(bool) (self::$alloptions[self::$opt_vi_hide_monetize_tab]))
                    {
                        ?>
                        <h3 id="h3_vi_monetize"> <a href="#"> Earn money embedding videos. <sup class="orange">new</sup> </a></h3>
                        <div class="h3_vi_monetize-content">
                            <div class="vi-registration-box">
                                <?php
                                include_once(EPYTVI_INCLUDES_PATH . 'vi_registration_form.php');
                                include_once(EPYTVI_INCLUDES_PATH . 'vi_login_success.php');
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <h3 class="header-go"> <a href="<?php echo self::$epbase . '/dashboard/pro-easy-video-analytics.aspx?ref=wizardacc'; ?>">Check my performance, blocked countries, deleted videos, etc. (PRO) </a></h3>
                    <div class="header-go-content"></div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    public static function has_api_key()
    {
        if (isset(self::$alloptions[self::$opt_apikey]) && strlen(trim(self::$alloptions[self::$opt_apikey])) > 0)
        {
            return true;
        }

        return false;
    }

    public static function get_live_snippet($channel)
    {
        $apiEndpoint = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&maxResults=1&type=video&eventType=live&safeSearch=none&videoEmbeddable=true&key=' . self::$alloptions[self::$opt_apikey]
                . '&channelId=' . urlencode($channel);
        $apiResult = wp_remote_get($apiEndpoint, array('timeout' => self::$curltimeout));

        if (is_wp_error($apiResult))
        {
            return false;
        }

        $jsonResult = json_decode($apiResult['body']);

        if (isset($jsonResult->error))
        {
            return false;
        }

        if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items) && count($jsonResult->items))
        {
            return $jsonResult->items[0];
        }

        return false;
    }

    public static function get_video_snippet($vid)
    {
        $apiEndpoint = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&maxResults=1&key=' . self::$alloptions[self::$opt_apikey]
                . '&id=' . urlencode($vid);
        $apiResult = wp_remote_get($apiEndpoint, array('timeout' => self::$curltimeout));

        if (is_wp_error($apiResult))
        {
            return false;
        }

        $jsonResult = json_decode($apiResult['body']);

        if (isset($jsonResult->error))
        {
            return false;
        }

        if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items) && count($jsonResult->items))
        {
            return $jsonResult->items[0];
        }

        return false;
    }

    public static function get_channel_snippet($channid)
    {
        $apiEndpoint = 'https://www.googleapis.com/youtube/v3/channels?part=contentDetails,snippet&key=' . self::$alloptions[self::$opt_apikey]
                . '&id=' . urlencode($channid);
        $apiResult = wp_remote_get($apiEndpoint, array('timeout' => self::$curltimeout));

        if (is_wp_error($apiResult))
        {
            return false;
        }

        $jsonResult = json_decode($apiResult['body']);

        if (isset($jsonResult->error))
        {
            return false;
        }

        if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items) && count($jsonResult->items))
        {
            return $jsonResult->items[0];
        }

        return false;
    }

    public static function get_search_page($options)
    {
        $gallobj = new stdClass();
        $pageSize = 30;

        if (!self::has_api_key())
        {
            $gallobj->html = '<div>' . str_replace('###', 'search', self::$get_api_key_msg) . '</div>';
            return $gallobj;
        }

        $apiEndpoint = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=' . $pageSize . '&type=video&safeSearch=none&videoEmbeddable=true&key=' . self::$alloptions[self::$opt_apikey]
                . '&q=' . urlencode($options->q);
        if (!empty($options->pageToken))
        {
            $apiEndpoint .= '&pageToken=' . $options->pageToken;
        }

        $code = '';
        $apiResult = wp_remote_get($apiEndpoint, array('timeout' => self::$curltimeout));

        if (is_wp_error($apiResult))
        {
            $gallobj->html = '<div>Sorry, there was a YouTube API error: <em>' . htmlspecialchars(strip_tags($apiResult->get_error_message())) . '</em>' .
                    ' Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.' .
                    '</div>';
            return $gallobj;
        }

        $jsonResult = json_decode($apiResult['body']);

        if (isset($jsonResult->error))
        {
            if (isset($jsonResult->error->message))
            {
                $gallobj->html = '<div>Sorry, there was a YouTube API error: <em>' . htmlspecialchars(strip_tags($jsonResult->error->message)) . '</em>' .
                        ' Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.' .
                        '</div>';
                return $gallobj;
            }
            $gallobj->html = '<div>Sorry, there may be an issue with your YouTube API key. Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.</div>';
            return $gallobj;
        }

        $totalResults = $jsonResult->pageInfo->totalResults;

        $nextPageToken = '';
        $prevPageToken = '';
        if (isset($jsonResult->nextPageToken))
        {
            $nextPageToken = $jsonResult->nextPageToken;
        }

        if (isset($jsonResult->prevPageToken))
        {
            $prevPageToken = $jsonResult->prevPageToken;
        }

        $cnt = 0;

        $code .= '<div class="epyt-search-results">';

        if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items))
        {
            foreach ($jsonResult->items as $item)
            {

                $thumb = new stdClass();

                $thumb->id = isset($item->snippet->resourceId->videoId) ? $item->snippet->resourceId->videoId : null;
                $thumb->id = $thumb->id ? $thumb->id : (isset($item->id->videoId) ? $item->id->videoId : null);

                if ($thumb->id)
                {
                    $thumb->title = $item->snippet->title;

                    if (isset($item->snippet->thumbnails->high->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->high->url;
                        $thumb->quality = 'high';
                    }
                    elseif (isset($item->snippet->thumbnails->default->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->default->url;
                        $thumb->quality = 'default';
                    }
                    elseif (isset($item->snippet->thumbnails->medium->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->medium->url;
                        $thumb->quality = 'medium';
                    }
                    else
                    {
                        $thumb->img = plugins_url('/images/deleted-video-thumb.png', __FILE__);
                        $thumb->quality = 'medium';
                    }

                    $code .= self::get_search_result_html($thumb, $options);
                    $cnt++;
                    $code .= '<div class="clear-both"></div>';
                }
            }
        }

        $code .= '<div class="clear-both"></div></div>';

        $totalPages = ceil($totalResults / $pageSize);
        $pagination = '<div class="epyt-pagination">';

        $txtprev = self::$alloptions[self::$opt_gallery_customarrows] ? self::$alloptions[self::$opt_gallery_customprev] : _('Prev');
        $pagination .= '<div tabindex="0" role="button" class="epyt-pagebutton epyt-prev ' . (empty($prevPageToken) ? ' hide ' : '') . '" data-q="' . esc_attr($options->q)
                . '" data-pagetoken="' . esc_attr($prevPageToken)
                . '"><div class="epyt-arrow">&laquo;</div> <div>' . $txtprev . '</div></div>';


        $pagination .= '<div class="epyt-pagenumbers ' . ($totalPages > 1 ? '' : 'hide') . '">';
        $pagination .= '<div class="epyt-current">1</div><div class="epyt-pageseparator"> / </div><div class="epyt-totalpages">' . $totalPages . '</div>';
        $pagination .= '</div>';

        $txtnext = self::$alloptions[self::$opt_gallery_customarrows] ? self::$alloptions[self::$opt_gallery_customnext] : _('Next');
        $pagination .= '<div tabindex="0" role="button" class="epyt-pagebutton epyt-next' . (empty($nextPageToken) ? ' hide ' : '') . '" data-q="' . esc_attr($options->q)
                . '" data-pagetoken="' . esc_attr($nextPageToken)
                . '"><div>' . $txtnext . '</div> <div class="epyt-arrow">&raquo;</div></div>';

        $pagination .= '<div class="epyt-loader"><img alt="loading" width="16" height="11" src="' . plugins_url('images/gallery-page-loader.gif', __FILE__) . '"></div>';
        $pagination .= '</div>';

        $code = $pagination . $code . $pagination;
        $gallobj->html = $code;
        return $gallobj;
    }

    public static function get_search_result_html($thumb, $options)
    {
        $get_pro_link = self::$epbase . '/dashboard/pro-easy-video-analytics.aspx?ref=searchresult';
        $escId = esc_attr($thumb->id);
        $code = '';

        $code .= '<div class="resultdiv" data-vid="' . $escId . '">
            <div class="resultinfo">
                <a class="pointer thumb load-movie" style="background-image: url(' . esc_url($thumb->img) . ')"></a>
                <a class="resulttitle pointer load-movie"><span class="ui-icon ui-icon-circle-triangle-e"></span> ' . sanitize_text_field($thumb->title) . '</a>
                <br>
                <span style="display: block;" id="scrollwatch' . $escId . '"></span>
                <div class="resultsubinfo">
                    <p>
                        <a class="ui-button ui-widget ui-corner-all" href="' . $get_pro_link . '" target="_blank"><span class="ui-icon ui-icon-gear"></span> Customize (PRO)</a>
                        &nbsp; <a class="ui-button ui-widget ui-corner-all inserttopost" rel="[embedyt] https://www.youtube.com/watch?v=' . $escId . '[/embedyt]"><span class="ui-icon ui-icon-arrowthickstop-1-s"></span> Insert Into Editor</a>
                    </p>
                    &nbsp; Or Copy Code:
                    <span class="copycode">[embedyt] https://www.youtube.com/watch?v=' . $escId . '[/embedyt]</span>
                </div>
            </div>
            <div class="clearboth"></div>
        </div>
        <div id="moviecontainer' . $escId . '" class="center moviecontainer relative" style="display: none;">
            Preview: <a id="closeme' . $escId . '" class="closeme" data-vid="' . $escId . '">
                &times;
            </a>
            <div id="watch' . $escId . '">
            </div>
        </div>';

        return $code;
    }

    public static function user_in_roles_any($user, $roles)
    {
        foreach ($user->roles as $idx => $r)
        {
            if (in_array($r, $roles))
            {
                return true;
            }
        }
        return false;
    }

    public static function is_restrict_wizard()
    {
        $curr_user = wp_get_current_user();
        if (
                $curr_user->ID // logged in
                && isset(self::$alloptions[self::$opt_restrict_wizard]) && self::$alloptions[self::$opt_restrict_wizard] == 1 // restricting
                && is_array(self::$alloptions[self::$opt_restrict_wizard_roles]) && !self::user_in_roles_any($curr_user, self::$alloptions[self::$opt_restrict_wizard_roles])
        )
        {
            return true;
        }
        return false;
    }

    public static function media_button_wizard()
    {
        if (self::is_restrict_wizard())
        {
            return;
        }

        add_thickbox();

        $wizhref = admin_url('admin.php?page=youtube-ep-wizard') .
                '&random=' . rand(1, 1000) .
                '&TB_iframe=true&width=950&height=800';
        ?>
        <a href="<?php echo esc_attr($wizhref); ?>" class="thickbox button ytprefs_media_link" id="ytprefs_wiz_button" title="Visual YouTube Search Tool and Wizard - For easier embedding"><span></span> YouTube</a>
        <?php
        if (current_user_can('manage_options') && self::vi_logged_in())
        {
            ?>
            <a class="button ytprefs_vi_embed_shortcode" id="ytprefs_wiz_button_vi" title="Embed vi video ad"><span></span> Video Ad</a>
            <?php
        }
    }

    public static function check_double_plugin_warning()
    {
        if (is_plugin_active('embedplus-for-wordpress/embedplus.php'))
        {
            add_action('admin_notices', array(get_class(), "double_plugin_warning"));
        }
    }

    public static function double_plugin_warning()
    {
        global $pagenow;
        $user_id = get_current_user_id();
        if ($pagenow != 'plugins.php' || get_user_meta($user_id, 'embedplus_double_plugin_warning', true) != 1)
        {
            //echo '<div class="error">' . $_SERVER['QUERY_STRING'] .'</div>';
            if ($pagenow == 'plugins.php' || strpos($_SERVER['QUERY_STRING'], 'youtube-my-preferences') !== false ||
                    strpos($_SERVER['QUERY_STRING'], 'embedplus-video-analytics-dashboard') !== false ||
                    strpos($_SERVER['QUERY_STRING'], 'youtube-ep-analytics-dashboard') !== false ||
                    strpos($_SERVER['QUERY_STRING'], 'embedplus-official-options') !== false)
            {
                ?>
                <style type="text/css">
                    .embedpluswarning img
                    {
                        vertical-align: text-bottom;
                    }
                    div.bgyellow {background-color: #FCFC94; position: relative;}
                    a.epxout, a.epxout:hover {font-weight: bold; color: #ffffff; background-color: #ff8888; text-decoration: none;
                                              border-radius: 20px; font-size: 15px; position: absolute; top: 3px; right: 3px;
                                              line-height: 20px; text-align: center; width: 20px; height: 20px; display: block; cursor: pointer;}
                    </style>
                    <div class="error bgyellow embedpluswarningbox">
                    <p class="embedpluswarning">
                        <?php
                        if ($pagenow == 'plugins.php')
                        {
                            echo '<a class="epxout">&times;</a>';
                        }
                        ?>
                        Seems like you have two different YouTube plugins by the EmbedPlus Team installed: <b><img alt="YouTube Icon" src="<?php echo plugins_url('images/youtubeicon16.png', __FILE__) ?>" /> YouTube</b> and <b><img alt="YouTube Icon" src="<?php echo plugins_url('images/btn_embedpluswiz.png', __FILE__) ?>" /> Advanced YouTube Embed.</b> We strongly suggest keeping only the one you prefer, so that they don't conflict with each other while trying to create your embeds.</p>
                </div>

                <script type="text/javascript">
                    (function ($)
                    {
                        $(document).ready(function ()
                        {
                            $('.epxout').click(function ()
                            {
                                $.ajax({
                                    type: "post",
                                    dataType: "json",
                                    timeout: 30000,
                                    url: window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl,
                                    data: {action: 'my_embedplus_dismiss_double_plugin_warning'},
                                    success: function (response)
                                    {
                                        if (response.type === "success")
                                        {
                                            $(".embedpluswarningbox").hide();
                                        }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError)
                                    {
                                    },
                                    complete: function ()
                                    {
                                    }
                                });
                            });
                        });
                    })(jQuery);</script>
                <?php
            }
        }
    }

    public static function my_embedplus_dismiss_double_plugin_warning()
    {
        $result = array();
        if (self::is_ajax())
        {
            $user_id = get_current_user_id();
            update_user_meta($user_id, 'embedplus_double_plugin_warning', 1);
            $result['type'] = 'success';
            echo json_encode($result);
        }
        else
        {
            $result['type'] = 'error';
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
        die();
    }

    public static function jsvars()
    {
        $loggedin = current_user_can('edit_posts');
        if (!($loggedin && self::$alloptions[self::$opt_admin_off_scripts]))
        {
            ?>
            <script data-cfasync="false">
                window._EPYT_ = window._EPYT_ || {
                    ajaxurl: "<?php echo admin_url('admin-ajax.php'); ?>",
                    security: "<?php echo wp_create_nonce('embedplus-nonce'); ?>",
                    gallery_scrolloffset: <?php echo intval(self::$alloptions[self::$opt_gallery_scrolloffset]) ?>,
                    eppathtoscripts: "<?php echo plugins_url('scripts/', __FILE__); ?>",
                    eppath: "<?php echo plugins_url('/', __FILE__); ?>",
                    epresponsiveselector: <?php echo self::get_responsiveselector(); ?>,
                    version: "<?php echo esc_attr(self::$alloptions[self::$opt_version]) ?>",
                    epdovol: true,
                    evselector: '<?php echo self::get_evselector(); ?>',
                    ajax_compat: <?php echo self::$alloptions[self::$opt_ajax_compat] == '1' ? 'true' : 'false' ?>,
                    ytapi_load: '<?php echo esc_attr(self::$alloptions[self::$opt_ytapi_load]) ?>',
                    stopMobileBuffer: <?php echo self::$alloptions[self::$opt_stop_mobile_buffer] == '1' ? 'true' : 'false' ?>
                };</script>
            <?php
        }
    }

    public static function fitvids()
    {
        $loggedin = current_user_can('edit_posts');
        if (!($loggedin && self::$alloptions[self::$opt_admin_off_scripts]))
        {
            wp_enqueue_script('__ytprefsfitvids__', plugins_url('scripts/fitvids' . self::$min . '.js', __FILE__), array('__ytprefs__'), self::$version, true);
        }
    }

    public static function initoptions()
    {
        $arroptions = get_option(self::$opt_alloptions);
        if ($arroptions !== false)
        {
            $bak = str_replace('.', '_', $arroptions[self::$opt_version]);
            add_option(self::$opt_alloptions . '_backup_' . $bak, $arroptions);
        }

        // backup settings for migration
        if (isset($arroptions[self::$opt_pro]) && strlen(trim($arroptions[self::$opt_pro])) > 10)
        {
            add_option(self::$opt_alloptions . '_migrate', $arroptions);
        }

        //vanilla defaults
        $_center = 0;
        $_glance = 0;
        $_autoplay = 0;
        $_cc_load_policy = 0;
        $_iv_load_policy = 1;
        $_loop = 0;
        $_modestbranding = 0;
        $_rel = 1;
        $_showinfo = 1;
        $_fs = 1;
        $_theme = 'dark';
        $_color = 'red';
        $_autohide = 2;
        $_pro = '';
        $_nocookie = 0;
        $_gdpr_consent = 0;
        $_gdpr_consent_message = self::$dft_gdpr_consent_message;
        $_gdpr_consent_button = 'Accept YouTube Content';
        $_playlistorder = 0;
        $_acctitle = 0;
        $_migrate = 0;
        $_migrate_youtube = 0;
        $_migrate_embedplusvideo = 0;
        $_controls = 2;
        $_oldspacing = 1;
        $_frontend_only = 1;
        $_responsive = 0;
        $_responsive_all = 1;
        $_widgetfit = 1;
        $_evselector_light = 0;
        $_stop_mobile_buffer = 1;
        $_restrict_wizard = 0;
        $_restrict_wizard_roles = self::$dft_roles;
        $_ajax_compat = 0;
        $_ytapi_load = 'light';
        $_defaultdims = 0;
        $_defaultwidth = '';
        $_defaultheight = '';
        $_playsinline = 0;
        $_origin = 0;
        $_defaultvol = 0;
        $_vol = '';
        $_apikey = '';
        $_hl = '';
        $_dohl = 0;
        $_gallery_columns = 3;
        $_gallery_collapse_grid = 0;
        $_gallery_collapse_grid_breaks = self::$dft_bpts;
        $_gallery_scrolloffset = 20;
        $_gallery_hideprivate = 1;
        $_gallery_showtitle = 1;
        $_gallery_showpaging = 1;
        $_gallery_autonext = 0;
        $_gallery_thumbplay = 1;
        $_gallery_channelsub = 0;
        $_gallery_channelsublink = '';
        $_gallery_channelsubtext = 'Subscribe to my channel';
        $_gallery_customarrows = 0;
        $_gallery_customprev = 'Prev';
        $_gallery_customnext = 'Next';
        $_gallery_pagesize = 15;
        $_not_live_content = '';
        $_debugmode = 0;
        $_admin_off_scripts = 0;
        $_onboarded = 0;
        $_old_script_method = 0;

        $_vi_active = 0;
        $_vi_hide_monetize_tab = 0;
        $_vi_endpoints = '';
        $_vi_token = '';
        $_vi_last_login = date('Y-m-d H:i:s', strtotime('2000-01-01'));
        $_vi_last_category_update = date('Y-m-d H:i:s', strtotime('2000-01-01'));
        $_vi_adstxt = '';
        $_vi_js_settings = self::$vi_dft_js_settings;
        $_vi_js_script = '';
        $_vi_js_posttypes = array();
        $_vi_js_position = 'top';
        $_vi_show_gdpr_authorization = 1;
        $_vi_show_privacy_button = 0;


        //update vanilla to previous settings if exists
        if ($arroptions !== false)
        {
            $_center = self::tryget($arroptions, self::$opt_center, 0);
            $_glance = self::tryget($arroptions, self::$opt_glance, $_glance);
            $_autoplay = self::tryget($arroptions, self::$opt_autoplay, 0);
            $_debugmode = self::tryget($arroptions, self::$opt_debugmode, 0);
            $_old_script_method = self::tryget($arroptions, self::$opt_old_script_method, 0);
            $_cc_load_policy = self::tryget($arroptions, self::$opt_cc_load_policy, 0);
            $_iv_load_policy = self::tryget($arroptions, self::$opt_iv_load_policy, 1);
            $_loop = self::tryget($arroptions, self::$opt_loop, 0);
            $_modestbranding = self::tryget($arroptions, self::$opt_modestbranding, 0);
            $_rel = self::tryget($arroptions, self::$opt_rel, 1);
            $_showinfo = self::tryget($arroptions, self::$opt_showinfo, 1);
            $_fs = self::tryget($arroptions, self::$opt_fs, 1);
            $_playsinline = self::tryget($arroptions, self::$opt_playsinline, 0);
            $_origin = self::tryget($arroptions, self::$opt_origin, 0);
            $_hl = self::tryget($arroptions, self::$opt_hl, '');
            $_dohl = self::tryget($arroptions, self::$opt_dohl, 0);
            $_theme = self::tryget($arroptions, self::$opt_theme, 'dark');
            $_color = self::tryget($arroptions, self::$opt_color, 'red');
            $_autohide = self::tryget($arroptions, self::$opt_autohide, 2);
            $_pro = self::tryget($arroptions, self::$opt_pro, '');
            $_nocookie = self::tryget($arroptions, self::$opt_nocookie, 0);
            $_gdpr_consent = self::tryget($arroptions, self::$opt_gdpr_consent, $_gdpr_consent);
            $_gdpr_consent_message = self::tryget($arroptions, self::$opt_gdpr_consent_message, $_gdpr_consent_message);
            $_gdpr_consent_button = self::tryget($arroptions, self::$opt_gdpr_consent_button, $_gdpr_consent_button);
            $_playlistorder = self::tryget($arroptions, self::$opt_playlistorder, 0);
            $_acctitle = self::tryget($arroptions, self::$opt_acctitle, 0);
            $_migrate = self::tryget($arroptions, self::$opt_migrate, 0);
            $_migrate_youtube = self::tryget($arroptions, self::$opt_migrate_youtube, 0);
            $_migrate_embedplusvideo = self::tryget($arroptions, self::$opt_migrate_embedplusvideo, 0);
            $_controls = self::tryget($arroptions, self::$opt_controls, 2);
            $_oldspacing = self::tryget($arroptions, self::$opt_oldspacing, 1);
            $_frontend_only = self::tryget($arroptions, self::$opt_frontend_only, $_frontend_only);
            $_responsive = self::tryget($arroptions, self::$opt_responsive, 0);
            $_responsive_all = self::tryget($arroptions, self::$opt_responsive_all, 1);
            $_widgetfit = self::tryget($arroptions, self::$opt_widgetfit, 1);
            $_evselector_light = self::tryget($arroptions, self::$opt_evselector_light, 0);
            $_stop_mobile_buffer = self::tryget($arroptions, self::$opt_stop_mobile_buffer, 1);
            $_restrict_wizard = self::tryget($arroptions, self::$opt_restrict_wizard, 0);
            $_restrict_wizard_roles = self::tryget($arroptions, self::$opt_restrict_wizard_roles, self::$dft_roles);
            $_ajax_compat = self::tryget($arroptions, self::$opt_ajax_compat, 0);
            $_ytapi_load = self::tryget($arroptions, self::$opt_ytapi_load, $_ytapi_load);
            $_defaultdims = self::tryget($arroptions, self::$opt_defaultdims, 0);
            $_defaultwidth = self::tryget($arroptions, self::$opt_defaultwidth, '');
            $_defaultheight = self::tryget($arroptions, self::$opt_defaultheight, '');
            $_defaultvol = self::tryget($arroptions, self::$opt_defaultvol, 0);
            $_vol = self::tryget($arroptions, self::$opt_vol, '');
            $_apikey = self::tryget($arroptions, self::$opt_apikey, '');
            $_gallery_pagesize = self::tryget($arroptions, self::$opt_gallery_pagesize, 15);
            $_gallery_columns = self::tryget($arroptions, self::$opt_gallery_columns, 3);
            $_gallery_collapse_grid = self::tryget($arroptions, self::$opt_gallery_collapse_grid, 0);
            $_gallery_collapse_grid_breaks = self::tryget($arroptions, self::$opt_gallery_collapse_grid_breaks, self::$dft_bpts);
            $_gallery_scrolloffset = self::tryget($arroptions, self::$opt_gallery_scrolloffset, 20);
            $_gallery_hideprivate = self::tryget($arroptions, self::$opt_gallery_hideprivate, $_gallery_hideprivate);
            $_gallery_showtitle = self::tryget($arroptions, self::$opt_gallery_showtitle, 1);
            $_gallery_showpaging = self::tryget($arroptions, self::$opt_gallery_showpaging, 1);
            $_gallery_autonext = self::tryget($arroptions, self::$opt_gallery_autonext, 0);
            $_gallery_thumbplay = self::tryget($arroptions, self::$opt_gallery_thumbplay, 1);
            $_gallery_channelsub = self::tryget($arroptions, self::$opt_gallery_channelsub, $_gallery_channelsub);
            $_gallery_channelsublink = self::tryget($arroptions, self::$opt_gallery_channelsublink, $_gallery_channelsublink);
            $_gallery_channelsubtext = self::tryget($arroptions, self::$opt_gallery_channelsubtext, $_gallery_channelsubtext);
            $_gallery_customarrows = self::tryget($arroptions, self::$opt_gallery_customarrows, $_gallery_customarrows);
            $_gallery_customnext = self::tryget($arroptions, self::$opt_gallery_customnext, $_gallery_customnext);
            $_gallery_customprev = self::tryget($arroptions, self::$opt_gallery_customprev, $_gallery_customprev);
            $_not_live_content = self::tryget($arroptions, self::$opt_not_live_content, $_not_live_content);
            $_admin_off_scripts = self::tryget($arroptions, self::$opt_admin_off_scripts, $_admin_off_scripts);
            $_onboarded = 0; // self::tryget($arroptions, self::$opt_onboarded, $_onboarded);

            $_vi_active = self::tryget($arroptions, self::$opt_vi_active, $_vi_active);
            $_vi_hide_monetize_tab = self::tryget($arroptions, self::$opt_vi_hide_monetize_tab, $_vi_hide_monetize_tab);
            $_vi_endpoints = self::tryget($arroptions, self::$opt_vi_endpoints, $_vi_endpoints);
            $_vi_token = self::tryget($arroptions, self::$opt_vi_token, $_vi_token);
            $_vi_last_login = self::tryget($arroptions, self::$opt_vi_last_login, $_vi_last_login);
            $_vi_last_category_update = self::tryget($arroptions, self::$opt_vi_last_category_update, $_vi_last_category_update);
            $_vi_adstxt = self::tryget($arroptions, self::$opt_vi_adstxt, $_vi_adstxt);
            $_vi_js_settings = self::tryget($arroptions, self::$opt_vi_js_settings, self::$vi_dft_js_settings);
            $_vi_js_script = self::tryget($arroptions, self::$opt_vi_js_script, $_vi_js_script);
            $_vi_js_posttypes = self::tryget($arroptions, self::$opt_vi_js_posttypes, $_vi_js_posttypes);
            $_vi_js_position = self::tryget($arroptions, self::$opt_vi_js_position, $_vi_js_position);
            $_vi_show_gdpr_authorization = self::tryget($arroptions, self::$opt_vi_show_gdpr_authorization, $_vi_show_gdpr_authorization);
            $_vi_show_privacy_button = self::tryget($arroptions, self::$opt_vi_show_privacy_button, $_vi_show_privacy_button);
        }
        else
        {
            $_oldspacing = 0;
        }

        $all = array(
            self::$opt_version => self::$version,
            self::$opt_center => $_center,
            self::$opt_glance => $_glance,
            self::$opt_autoplay => $_autoplay,
            self::$opt_cc_load_policy => $_cc_load_policy,
            self::$opt_iv_load_policy => $_iv_load_policy,
            self::$opt_loop => $_loop,
            self::$opt_modestbranding => $_modestbranding,
            self::$opt_rel => $_rel,
            self::$opt_showinfo => $_showinfo,
            self::$opt_fs => $_fs,
            self::$opt_playsinline => $_playsinline,
            self::$opt_origin => $_origin,
            self::$opt_autohide => $_autohide,
            self::$opt_hl => $_hl,
            self::$opt_dohl => $_dohl,
            self::$opt_theme => $_theme,
            self::$opt_color => $_color,
            self::$opt_pro => $_pro,
            self::$opt_nocookie => $_nocookie,
            self::$opt_gdpr_consent => $_gdpr_consent,
            self::$opt_gdpr_consent_message => $_gdpr_consent_message,
            self::$opt_gdpr_consent_button => $_gdpr_consent_button,
            self::$opt_playlistorder => $_playlistorder,
            self::$opt_acctitle => $_acctitle,
            self::$opt_migrate => $_migrate,
            self::$opt_migrate_youtube => $_migrate_youtube,
            self::$opt_migrate_embedplusvideo => $_migrate_embedplusvideo,
            self::$opt_controls => $_controls,
            self::$opt_oldspacing => $_oldspacing,
            self::$opt_frontend_only => $_frontend_only,
            self::$opt_responsive => $_responsive,
            self::$opt_responsive_all => $_responsive_all,
            self::$opt_widgetfit => $_widgetfit,
            self::$opt_evselector_light => $_evselector_light,
            self::$opt_stop_mobile_buffer => $_stop_mobile_buffer,
            self::$opt_restrict_wizard => $_restrict_wizard,
            self::$opt_restrict_wizard_roles => $_restrict_wizard_roles,
            self::$opt_ajax_compat => $_ajax_compat,
            self::$opt_ytapi_load => $_ytapi_load,
            self::$opt_defaultdims => $_defaultdims,
            self::$opt_defaultwidth => $_defaultwidth,
            self::$opt_defaultheight => $_defaultheight,
            self::$opt_defaultvol => $_defaultvol,
            self::$opt_vol => $_vol,
            self::$opt_apikey => $_apikey,
            self::$opt_gallery_columns => $_gallery_columns,
            self::$opt_gallery_collapse_grid => $_gallery_collapse_grid,
            self::$opt_gallery_collapse_grid_breaks => $_gallery_collapse_grid_breaks,
            self::$opt_gallery_scrolloffset => $_gallery_scrolloffset,
            self::$opt_gallery_hideprivate => $_gallery_hideprivate,
            self::$opt_gallery_showtitle => $_gallery_showtitle,
            self::$opt_gallery_showpaging => $_gallery_showpaging,
            self::$opt_gallery_autonext => $_gallery_autonext,
            self::$opt_gallery_thumbplay => $_gallery_thumbplay,
            self::$opt_gallery_channelsub => $_gallery_channelsub,
            self::$opt_gallery_channelsublink => $_gallery_channelsublink,
            self::$opt_gallery_channelsubtext => $_gallery_channelsubtext,
            self::$opt_gallery_customarrows => $_gallery_customarrows,
            self::$opt_gallery_customnext => $_gallery_customnext,
            self::$opt_gallery_customprev => $_gallery_customprev,
            self::$opt_gallery_pagesize => $_gallery_pagesize,
            self::$opt_not_live_content => $_not_live_content,
            self::$opt_debugmode => $_debugmode,
            self::$opt_admin_off_scripts => $_admin_off_scripts,
            self::$opt_onboarded => $_onboarded,
            self::$opt_old_script_method => $_old_script_method,
            self::$opt_vi_active => $_vi_active,
            self::$opt_vi_hide_monetize_tab => $_vi_hide_monetize_tab,
            self::$opt_vi_endpoints => $_vi_endpoints,
            self::$opt_vi_token => $_vi_token,
            self::$opt_vi_last_login => $_vi_last_login,
            self::$opt_vi_last_category_update => $_vi_last_category_update,
            self::$opt_vi_adstxt => $_vi_adstxt,
            self::$opt_vi_js_settings => $_vi_js_settings,
            self::$opt_vi_js_script => $_vi_js_script,
            self::$opt_vi_js_posttypes => $_vi_js_posttypes,
            self::$opt_vi_js_position => $_vi_js_position,
            self::$opt_vi_show_gdpr_authorization => $_vi_show_gdpr_authorization,
            self::$opt_vi_show_privacy_button => $_vi_show_privacy_button
        );

        update_option(self::$opt_alloptions, $all);
        update_option('embed_autourls', 1);
        self::$alloptions = get_option(self::$opt_alloptions);
    }

    public static function tryget($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    public static function wp_above_version($ver)
    {
        global $wp_version;
        if (version_compare($wp_version, $ver, '>='))
        {
            return true;
        }
        return false;
    }

    public static function do_ytprefs()
    {
        //add_filter('autoptimize_filter_js_exclude', array(get_class(), 'ao_override_jsexclude'), 10, 1);
        if (!is_admin() || (self::$alloptions[self::$opt_frontend_only] != 1))
        {
            add_filter('the_content', array(get_class(), 'apply_prefs_content'), 1);
            add_filter('widget_text', array(get_class(), 'apply_prefs_widget'), 1);
            //add_filter('bjll/skip_classes', array(get_class(), 'bjll_skip_classes'), 10, 2);

            add_shortcode('embedyt', array(get_class(), 'apply_prefs_shortcode'));
            if (self::$alloptions[self::$opt_migrate] == 1)
            {
                if (self::$alloptions[self::$opt_migrate_youtube] == 1)
                {
                    add_shortcode('youtube', array(get_class(), 'apply_prefs_shortcode_youtube'));
                    add_shortcode('youtube_video', array(get_class(), 'apply_prefs_shortcode_youtube'));
                }
                if (self::$alloptions[self::$opt_migrate_embedplusvideo] == 1)
                {
                    add_shortcode('embedplusvideo', array(get_class(), 'apply_prefs_shortcode_embedplusvideo'));
                }
            }
        }
    }

    public static function ao_override_jsexclude($exclude)
    {
        if (strpos($exclude, 'ytprefs' . self::$min . '.js') === false)
        {
            return $exclude . ',ytprefs' . self::$min . '.js,__ytprefs__';
        }
        return $exclude;
    }

    public static function apply_prefs_shortcode($atts, $content = null)
    {
        $content = trim($content);
        $currfilter = current_filter();
        if (preg_match(self::$justurlregex, $content))
        {
            return self::get_html(array($content), strpos($currfilter, 'widget_text') === 0 ? false : true);
        }
        return '';
    }

    public static function apply_prefs_shortcode_youtube($atts, $content = null)
    {
        $content = 'https://www.youtube.com/watch?v=' . trim($content);
        $currfilter = current_filter();
        if (preg_match(self::$justurlregex, $content))
        {
            return self::get_html(array($content), $currfilter == 'widget_text' ? false : true);
        }
        return '';
    }

    public static function apply_prefs_shortcode_embedplusvideo($atts, $content = null)
    {
        $atts = shortcode_atts(array(
            "height" => self::$defaultheight,
            "width" => self::$defaultwidth,
            "vars" => "",
            "standard" => "",
            "id" => "ep" . rand(10000, 99999)
                ), $atts);

        $epvars = $atts['vars'];
        $epvars = preg_replace('/\s/', '', $epvars);
        $epvars = preg_replace('/¬/', '&not', $epvars);
        $epvars = str_replace('&amp;', '&', $epvars);

        $epparams = self::keyvalue($epvars, true);

        if (isset($epparams) && isset($epparams['ytid']))
        {
            $start = isset($epparams['start']) && is_numeric($epparams['start']) ? '&start=' . intval($epparams['start']) : '';
            $end = isset($epparams['end']) && is_numeric($epparams['end']) ? '&end=' . intval($epparams['end']) : '';
            $end = isset($epparams['stop']) && is_numeric($epparams['stop']) ? '&end=' . intval($epparams['stop']) : '';

            $url = 'https://www.youtube.com/watch?v=' . trim($epparams['ytid']) . $start . $end;

            $currfilter = current_filter();
            if (preg_match(self::$justurlregex, $url))
            {
                return self::get_html(array($url), $currfilter == 'widget_text' ? false : true);
            }
        }
        return '';
    }

    public static function apply_prefs_content($content)
    {
        $content = preg_replace_callback(self::$ytregex, array(get_class(), "get_html_content"), $content);
        return $content;
    }

    public static function apply_prefs_widget($content)
    {
        $content = preg_replace_callback(self::$ytregex, array(get_class(), "get_html_widget"), $content);
        return $content;
    }

    public static function get_html_content($m)
    {
        return self::get_html($m, true);
    }

    public static function get_html_widget($m)
    {
        return self::get_html($m, false);
    }

    public static function get_gallery_page($options)
    {
        $gallobj = new stdClass();

        $options->pageSize = min(intval($options->pageSize), 50);
        $options->columns = intval($options->columns);
        $options->showTitle = intval($options->showTitle);
        $options->showPaging = intval($options->showPaging);
        $options->autonext = intval($options->autonext);
        $options->thumbplay = intval($options->thumbplay);

        if (empty($options->apiKey))
        {
            $gallobj->html = '<div>Please enter your YouTube API key to embed galleries.</div>';
            return $gallobj;
        }

        $apiEndpoint = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,status&playlistId=' . $options->playlistId
                . '&maxResults=' . $options->pageSize
                . '&key=' . $options->apiKey;
        if ($options->pageToken != null)
        {
            $apiEndpoint .= '&pageToken=' . $options->pageToken;
        }

        $code = '';
        $init_id = null;

        $apiResult = wp_remote_get($apiEndpoint, array('timeout' => self::$curltimeout));

        if (is_wp_error($apiResult))
        {
            $gallobj->html = '<div>Sorry, there was a YouTube API error: <em>' . htmlspecialchars(strip_tags($apiResult->get_error_message())) . '</em>' .
                    ' Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.' .
                    '</div>';
            return $gallobj;
        }

        if (self::$alloptions[self::$opt_debugmode] == 1 && current_user_can('manage_options'))
        {
            $redactedEndpoint = preg_replace('@&key=[^&]+@i', '&key=PRIVATE', $apiEndpoint);
            $active_plugins = get_option('active_plugins');
            $gallobj->html = '<pre onclick="_EPADashboard_.selectText(this);" class="epyt-debug">CLICK this debug text to auto-select all. Then, COPY the selection.' . "\n\n" .
                    'THIS IS DEBUG MODE OUTPUT. UNCHECK THE OPTION IN THE SETTINGS PAGE ONCE YOU ARE DONE DEBUGGING TO PUT THINGS BACK TO NORMAL.' . "\n\n" . $redactedEndpoint . "\n\n" . print_r($apiResult, true) . "\n\nActive Plugins\n\n" . print_r($active_plugins, true) . '</pre>';
            return $gallobj;
        }

        $jsonResult = json_decode($apiResult['body']);

        if (isset($jsonResult->error))
        {
            if (isset($jsonResult->error->message))
            {
                $gallobj->html = '<div>Sorry, there was a YouTube API error: <em>' . htmlspecialchars(strip_tags($jsonResult->error->message)) . '</em>' .
                        ' Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.' .
                        '</div>';
                return $gallobj;
            }
            $gallobj->html = '<div>Sorry, there may be an issue with your YouTube API key. Please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.</div>';
            return $gallobj;
        }



        $resultsPerPage = $options->pageSize; // $jsonResult->pageInfo->resultsPerPage;
        $totalResults = $jsonResult->pageInfo->totalResults;

        $nextPageToken = '';
        $prevPageToken = '';
        if (isset($jsonResult->nextPageToken))
        {
            $nextPageToken = $jsonResult->nextPageToken;
        }

        if (isset($jsonResult->prevPageToken))
        {
            $prevPageToken = $jsonResult->prevPageToken;
        }

        $cnt = 0;
        $colclass = ' epyt-cols-' . $options->columns . ' ';
        $code .= '<div class="epyt-gallery-allthumbs ' . $colclass . '">';

        if (isset($jsonResult->items) && $jsonResult->items != null && is_array($jsonResult->items))
        {
            if (strpos($options->playlistId, 'UU') === 0)
            {
                // sort only channels
                usort($jsonResult->items, array(get_class(), 'compare_vid_date')); // sorts in place                
            }

            foreach ($jsonResult->items as $item)
            {

                $thumb = new stdClass();

                $thumb->id = isset($item->snippet->resourceId->videoId) ? $item->snippet->resourceId->videoId : null;
                $thumb->id = $thumb->id ? $thumb->id : $item->id->videoId;
                $thumb->title = $options->showTitle ? $item->snippet->title : '';
                $thumb->privacyStatus = isset($item->status->privacyStatus) ? $item->status->privacyStatus : null;

                if ($thumb->privacyStatus == 'private' && self::$alloptions[self::$opt_gallery_hideprivate] == 1)
                {
                    continue;
                }

                if ($cnt == 0 && $options->pageToken == null)
                {
                    $init_id = $thumb->id;
                }

                if ($thumb->privacyStatus == 'private')
                {
                    $thumb->img = plugins_url('/images/private.png', __FILE__);
                    $thumb->quality = 'medium';
                }
                else
                {
                    if (isset($item->snippet->thumbnails->high->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->high->url;
                        $thumb->quality = 'high';
                    }
                    elseif (isset($item->snippet->thumbnails->default->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->default->url;
                        $thumb->quality = 'default';
                    }
                    elseif (isset($item->snippet->thumbnails->medium->url))
                    {
                        $thumb->img = $item->snippet->thumbnails->medium->url;
                        $thumb->quality = 'medium';
                    }
                    else
                    {
                        $thumb->img = plugins_url('/images/deleted-video-thumb.png', __FILE__);
                        $thumb->quality = 'medium';
                    }
                }

                $code .= self::get_thumbnail_html($thumb, $options);
                $cnt++;

                if ($cnt % $options->columns === 0)
                {
                    $code .= '<div class="epyt-gallery-rowbreak"></div>';
                }
            }
        }

        $code .= '<div class="epyt-gallery-clear"></div></div>';

        $totalPages = ceil($totalResults / $resultsPerPage);
        $pagination = '<div class="epyt-pagination ' . ($options->showPaging == 0 ? 'epyt-hide-pagination' : '') . '">';

        $txtprev = self::$alloptions[self::$opt_gallery_customarrows] ? self::$alloptions[self::$opt_gallery_customprev] : _('Prev');
        $pagination .= '<div tabindex="0" role="button" class="epyt-pagebutton epyt-prev ' . (empty($prevPageToken) ? ' hide ' : '') . '" data-playlistid="' . esc_attr($options->playlistId)
                . '" data-pagesize="' . intval($options->pageSize)
                . '" data-pagetoken="' . esc_attr($prevPageToken)
                . '" data-epcolumns="' . intval($options->columns)
                . '" data-showtitle="' . intval($options->showTitle)
                . '" data-showpaging="' . intval($options->showPaging)
                . '" data-autonext="' . intval($options->autonext)
                . '" data-thumbplay="' . intval($options->thumbplay)
                . '"><div class="epyt-arrow">&laquo;</div> <div>' . $txtprev . '</div></div>';


        $pagination .= '<div class="epyt-pagenumbers ' . ($totalPages > 1 ? '' : 'hide') . '">';
        $pagination .= '<div class="epyt-current">1</div><div class="epyt-pageseparator"> / </div><div class="epyt-totalpages">' . $totalPages . '</div>';
        $pagination .= '</div>';

        $txtnext = self::$alloptions[self::$opt_gallery_customarrows] ? self::$alloptions[self::$opt_gallery_customnext] : _('Next');
        $pagination .= '<div tabindex="0" role="button" class="epyt-pagebutton epyt-next' . (empty($nextPageToken) ? ' hide ' : '') . '" data-playlistid="' . esc_attr($options->playlistId)
                . '" data-pagesize="' . intval($options->pageSize)
                . '" data-pagetoken="' . esc_attr($nextPageToken)
                . '" data-epcolumns="' . intval($options->columns)
                . '" data-showtitle="' . intval($options->showTitle)
                . '" data-showpaging="' . intval($options->showPaging)
                . '" data-autonext="' . intval($options->autonext)
                . '" data-thumbplay="' . intval($options->thumbplay)
                . '"><div>' . $txtnext . '</div> <div class="epyt-arrow">&raquo;</div></div>';

        $pagination .= '<div class="epyt-loader"><img alt="loading" width="16" height="11" src="' . plugins_url('images/gallery-page-loader.gif', __FILE__) . '"></div>';
        $pagination .= '</div>';

//        if ($options->showPaging == 0)
//        {
//            $pagination = '<div class="epyt-pagination"></div>';
//        }
        $code = $pagination . $code . $pagination;
        $gallobj->html = $code;
        $gallobj->init_id = $init_id;
        return $gallobj;
    }

    public static function compare_vid_date($a, $b)
    {
        if ($a->snippet->publishedAt == $b->snippet->publishedAt)
        {
            return 0;
        }
        return ($a->snippet->publishedAt > $b->snippet->publishedAt) ? -1 : 1;
    }

    public static function get_thumbnail_html($thumb, $options)
    {
        $escId = esc_attr($thumb->id);
        $code = '';
        $code .= '<div tabindex="0" role="button" data-videoid="' . $escId . '" class="epyt-gallery-thumb">';

        $code .= (self::gdpr_mode() ? '<div class="epyt-gallery-img-box"><div class="epyt-gallery-img epyt-gallery-img-gdpr">' :
                        '<div class="epyt-gallery-img-box"><div class="epyt-gallery-img" style="background-image: url(' . esc_attr($thumb->img) . ')">') .
                '<div class="epyt-gallery-playhover"><img alt="play" class="epyt-play-img" width="30" height="23" src="' . plugins_url('images/playhover.png', __FILE__) . '" data-no-lazy="1" data-skipgform_ajax_framebjll="" /><div class="epyt-gallery-playcrutch"></div></div>' .
                '</div></div>';


        if (!empty($thumb->title))
        {
            $code .= '<div class="epyt-gallery-title">' . esc_html($thumb->title) . '</div>';
        }
        else
        {
            $code .= '<div class="epyt-gallery-notitle"><span>' . esc_html($thumb->title) . '</span></div>';
        }
        $code .= '</div>';
        return $code;
    }

    public static function my_embedplus_gallery_page()
    {
        if (self::is_ajax())
        {
            //check_ajax_referer('embedplus-nonce', 'security');
            $options = (object) $_POST['options'];
            $options->apiKey = self::$alloptions[self::$opt_apikey];
            echo self::get_gallery_page($options)->html;
            die();
        }
    }

    public static function get_html($m, $iscontent)
    {
        //$time_start = microtime(true);

        $link = trim(str_replace(self::$badentities, self::$goodliterals, $m[0]));

        $link = preg_replace('/\s/', '', $link);
        $linkparamstemp = explode('?', $link);

        $linkparams = array();
        if (count($linkparamstemp) > 1)
        {
            $linkparams = self::keyvalue($linkparamstemp[1], true);
        }
        if (strpos($linkparamstemp[0], 'youtu.be') !== false && !isset($linkparams['v']))
        {
            $vtemp = explode('/', $linkparamstemp[0]);
            $linkparams['v'] = array_pop($vtemp);
        }

        if (isset($linkparams['live']) && $linkparams['live'] == '1')
        {
            $live_error_msg = ' To embed live videos, please make sure you performed the <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">steps in this video</a> to create and save a proper server API key.';
            if (isset(self::$alloptions[self::$opt_apikey]))
            {
                if (isset($linkparams['channel']))
                {
                    try
                    {
                        $ytapilink_live = 'https://www.googleapis.com/youtube/v3/search?order=date&maxResults=1&type=video&eventType=live&safeSearch=none&videoEmbeddable=true&channelId=' . $linkparams['channel'] . '&part=snippet&key=' . self::$alloptions[self::$opt_apikey];
                        $apidata_live = wp_remote_get($ytapilink_live, array('timeout' => self::$curltimeout));
                        if (!is_wp_error($apidata_live))
                        {
                            $raw = wp_remote_retrieve_body($apidata_live);
                            if (!empty($raw))
                            {
                                $json = json_decode($raw, true);
                                if (!isset($json['error']) && is_array($json) && count($json['items']))
                                {
                                    $linkparams['v'] = $json['items'][0]['id']['videoId'];
                                }
                                else if (isset($json['error']))
                                {
                                    return $live_error_msg; // . ' <em>(Error code ' . $json['error']->code . ': ' . $json['error']->message . ')</em>';
                                }
                            }
                        }
                    }
                    catch (Exception $ex)
                    {
                        return $live_error_msg;
                    }
                }
                else if (isset($linkparams['v']))
                {
                    ////////////////////// process single video live stream
                    try
                    {
                        // if not_live_content isn't being used, just process as a normal single video. otherwise: if not currently live (nor upcoming?), unset $linkparams['v']
                        $not_live_content = trim(htmlspecialchars_decode(wp_strip_all_tags(self::$alloptions[self::$opt_not_live_content], true)));
                        if (!empty($not_live_content))
                        {
                            $ytapilink_live = 'https://www.googleapis.com/youtube/v3/videos?id=' . $linkparams['v'] . '&part=snippet&key=' . self::$alloptions[self::$opt_apikey];
                            $apidata_live = wp_remote_get($ytapilink_live, array('timeout' => self::$curltimeout));
                            if (!is_wp_error($apidata_live))
                            {
                                $raw = wp_remote_retrieve_body($apidata_live);
                                if (!empty($raw))
                                {
                                    $json = json_decode($raw, true);
                                    if (!isset($json['error']) && is_array($json) && count($json['items']))
                                    {
                                        if (isset($json['items'][0]['snippet']['liveBroadcastContent']) && $json['items'][0]['snippet']['liveBroadcastContent'] != 'live')
                                        {
                                            unset($linkparams['v']);
                                        }
                                    }
                                    else if (isset($json['error']))
                                    {
                                        return $live_error_msg; // . ' <em>(Error code ' . $json['error']->code . ': ' . $json['error']->message . ')</em>';
                                    }
                                }
                            }
                        }
                    }
                    catch (Exception $ex)
                    {
                        return $live_error_msg;
                    }
                }
            }
            else
            {
                return $live_error_msg;
            }

            if (!isset($linkparams['v']))
            {
                return apply_filters('the_content', wp_kses_post(self::$alloptions[self::$opt_not_live_content]));
            }
        }

        $youtubebaseurl = 'youtube';
        $voloutput = '';
        $acctitle = '';
        $relstop = '';

        $finalparams = $linkparams + self::$alloptions;

        self::init_dimensions($link, $linkparams, $finalparams);

        if (self::$alloptions[self::$opt_nocookie] == 1)
        {
            $youtubebaseurl = 'youtube-nocookie';
        }

        if (self::$alloptions[self::$opt_defaultvol] == 1)
        {
            $voloutput = ' data-vol="' . self::$alloptions[self::$opt_vol] . '" ';
        }

        if (is_numeric(self::$alloptions[self::$opt_rel]) && intval(self::$alloptions[self::$opt_rel]) === -1)
        {
            $relstop = ' data-relstop="1" ';
        }

        if (self::$alloptions[self::$opt_dohl] == 1)
        {
            $locale = get_locale();
            $finalparams[self::$opt_hl] = $locale;
        }
        else
        {
            unset($finalparams[self::$opt_hl]);
        }

        $centercode = '';
        if ($finalparams[self::$opt_center] == 1)
        {
            $centercode = ' style="display: block; margin: 0px auto;" ';
        }

        if (self::$alloptions[self::$opt_acctitle] == 1)
        {
            try
            {
                //attr escape
                if (self::$oembeddata)
                {
                    $acctitle = self::$oembeddata->title;
                }
                else
                {

                    if (isset($linkparams['list']))
                    {
                        $odata = self::get_oembed('https://youtube.com/playlist?list=' . $linkparams['list'], 1920, 1280);
                        if (is_object($odata) && isset($odata->title))
                        {
                            $acctitle = $odata->title;
                        }
                    }
                    else
                    {
                        $odata = self::get_oembed('https://youtube.com/watch?v=' . $linkparams['v'], 1920, 1280);
                        if (is_object($odata) && isset($odata->title))
                        {
                            $acctitle = $odata->title;
                        }
                    }
                }

                if ($acctitle)
                {
                    $acctitle = ' title="' . esc_attr($acctitle) . '" ';
                }
            }
            catch (Exception $e)
            {
                
            }
        }
        else
        {
            $acctitle = ' title="YouTube player" ';
        }

        // playlist cleanup
        $videoidoutput = isset($linkparams['v']) ? $linkparams['v'] : '';

        if ((self::$alloptions[self::$opt_playlistorder] == 1 || isset($finalparams['plindex'])) && isset($finalparams['list']))
        {
            try
            {
                $videoidoutput = '';
                if (isset($finalparams['plindex']))
                {
                    $finalparams['index'] = intval($finalparams['plindex']);
                }
            }
            catch (Exception $ex)
            {
                
            }
        }

        $galleryWrapper1 = '';
        $galleryWrapper2 = '';
        $galleryCode = '';
        $galleryid_ifm_data = '';
        if (isset($finalparams['layout']) && strtolower($finalparams['layout']) == 'gallery' && isset($finalparams['list']))
        {
            $gallery_options = new stdClass();
            $gallery_options->playlistId = $finalparams['list'];
            $gallery_options->pageToken = null;
            $gallery_options->pageSize = $finalparams[self::$opt_gallery_pagesize];
            $gallery_options->columns = intval($finalparams[self::$opt_gallery_columns]);
            $gallery_options->showTitle = intval($finalparams[self::$opt_gallery_showtitle]);
            $gallery_options->showPaging = intval($finalparams[self::$opt_gallery_showpaging]);
            $gallery_options->autonext = intval($finalparams[self::$opt_gallery_autonext]);
            $gallery_options->thumbplay = intval($finalparams[self::$opt_gallery_thumbplay]);
            $gallery_options->apiKey = self::$alloptions[self::$opt_apikey];

            $galleryid = 'epyt_gallery_' . rand(10000, 99999);
            $galleryid_ifm_data = ' data-epytgalleryid="' . $galleryid . '" ';

            $subbutton = '';
            if (self::$alloptions[self::$opt_gallery_channelsub] == 1)
            {
                $subbutton = '<div class="epyt-gallery-subscribe"><a target="_blank" class="epyt-gallery-subbutton" href="' .
                        esc_url(self::$alloptions[self::$opt_gallery_channelsublink]) . '?sub_confirmation=1"><img alt="subscribe" src="' . plugins_url('images/play-subscribe.png', __FILE__) . '" />' .
                        htmlspecialchars(self::$alloptions[self::$opt_gallery_channelsubtext], ENT_QUOTES) . '</a></div>';
            }

            $gallery_page_obj = self::get_gallery_page($gallery_options);

            $galleryWrapper1 = '<div class="epyt-gallery" data-currpage="1" id="' . $galleryid . '">';
            $galleryWrapper2 = '</div>';
            $galleryCode = $subbutton . '<div class="epyt-gallery-list">' . $gallery_page_obj->html . '</div>';
            $videoidoutput = isset($gallery_page_obj->init_id) ? $gallery_page_obj->init_id : '';
        }

        if (!empty($voloutput) && isset($finalparams['autoplay']) && $finalparams['autoplay'] == 1)
        {
            $voloutput .= ' data-epautoplay="1" ';
            $finalparams['autoplay'] = 0;
        }

        if (!empty($relstop) && isset($finalparams['rel']) && intval($finalparams['rel']) === -1)
        {
            $finalparams['rel'] = 0;
        }

        $code1 = '<iframe ' . $centercode . ' id="_ytid_' . rand(10000, 99999) . '" width="' . self::$defaultwidth . '" height="' . self::$defaultheight . '" ' .
                ' data-origwidth="' . self::$defaultwidth . '" data-origheight="' . self::$defaultheight . '" ' . $relstop .
                ' src="https://www.' . $youtubebaseurl . '.com/embed/' . $videoidoutput . '?';
        $code2 = '" class="__youtube_prefs__' . ($iscontent ? '' : ' __youtube_prefs_widget__') .
                '"' . $voloutput . $acctitle . $galleryid_ifm_data . ' allow="autoplay; encrypted-media" allowfullscreen data-no-lazy="1" data-skipgform_ajax_framebjll=""></iframe>';

        $origin = '';

        try
        {
            if (self::$alloptions[self::$opt_origin] == 1)
            {
                $url_parts = parse_url(site_url());
                $origin = 'origin=' . $url_parts['scheme'] . '://' . $url_parts['host'] . '&';
            }
        }
        catch (Exception $e)
        {
            $origin = '';
        }
        $finalsrc = (self::$alloptions[self::$opt_ytapi_load] == 'never' ? '' : 'enablejsapi=1&') . $origin;

        if (count($finalparams) > 1)
        {
            foreach ($finalparams as $key => $value)
            {
                if (in_array($key, self::$yt_options))
                {
                    if (!empty($galleryCode) && ($key == 'listType' || $key == 'list'))
                    {
                        
                    }
                    else
                    {
                        if (!(isset($finalparams['live']) && $key == 'loop'))
                        {
                            $finalsrc .= htmlspecialchars($key) . '=' . htmlspecialchars($value) . '&';
                            if ($key == 'loop' && $value == 1 && !isset($finalparams['list']))
                            {
                                $finalsrc .= 'playlist=' . $finalparams['v'] . '&';
                            }
                        }
                    }
                }
            }
        }

        if (self::gdpr_mode())
        {
            $code1 = '<div ' . $centercode . ' id="_ytid_' . rand(10000, 99999) . '" width="' . self::$defaultwidth . '" height="' . self::$defaultheight . '" ';
            $code2 = ' class="__youtube_prefs__  __youtube_prefs_gdpr__ ' . ($iscontent ? '' : ' __youtube_prefs_widget__') . '" allowfullscreen data-no-lazy="1" data-skipgform_ajax_framebjll="">' .
                    apply_filters('ytprefs_gdpr_consent_message', wp_kses_post(self::$alloptions[self::$opt_gdpr_consent_message])) .
                    //apply_filters('the_content', wp_kses_post(self::$alloptions[self::$opt_gdpr_consent_message])) .
                    '<button type="button" class="__youtube_prefs_gdpr__">' . trim(sanitize_text_field(self::$alloptions[self::$opt_gdpr_consent_button])) .
                    '<img src="' . plugins_url('images/icon-check.png', __FILE__) . '" alt="accept" data-no-lazy="1" data-skipgform_ajax_framebjll="" /></button>' .
                    '</div>';
            $finalsrc = '';
        }

        $code = $galleryWrapper1 . $code1 . $finalsrc . $code2 . $galleryCode . $galleryWrapper2;
        //. '<!--' . $m[0] . '-->';
        self::$defaultheight = null;
        self::$defaultwidth = null;
        self::$oembeddata = null;

        return $code;
    }

    public static function gdpr_mode()
    {
        return (bool) self::$alloptions[self::$opt_gdpr_consent] && filter_input(INPUT_COOKIE, self::$gdpr_cookie_name, FILTER_SANITIZE_NUMBER_INT) != 1;
    }

    public static function filter_gdpr_consent_message($content)
    {
        //global $wp_filter;
        //$the_content_filters_current = $wp_filter['the_content']->callbacks;

        $the_content_filters = array(
            'wptexturize',
            'wpautop',
            'shortcode_unautop',
            'prepend_attachment',
            'wp_make_content_images_responsive',
            'do_shortcode',
            'convert_smilies'
        );

        for ($i = 0; $i < count($the_content_filters); $i++)
        {
            if (function_exists($the_content_filters[$i]))
            {
                $content = call_user_func($the_content_filters[$i], $content);
            }
        }
        return $content;
    }

    public static function debuglog($str)
    {
        $handle = fopen(__DIR__ . "\\debug.txt", "a+");
        fwrite($handle, $str);
        fclose($handle);
    }

    public static function keyvalue($qry, $includev)
    {
        $ytvars = explode('&', $qry);
        $ytkvp = array();
        foreach ($ytvars as $k => $v)
        {
            $kvp = explode('=', $v);
            if (count($kvp) == 2 && ($includev || strtolower($kvp[0]) != 'v'))
            {
                $ytkvp[$kvp[0]] = $kvp[1];
            }
        }

        return $ytkvp;
    }

    public static function secondsToDuration($seconds)
    {
        $remaining = $seconds;
        $parts = array();
        $multipliers = array(
            'hours' => 3600,
            'minutes' => 60,
            'seconds' => 1
        );

        foreach ($multipliers as $type => $m)
        {
            $parts[$type] = (int) ($remaining / $m);
            $remaining -= ($parts[$type] * $m);
        }

        return $parts;
    }

    public static function formatDuration($parts)
    {
        $default = array(
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0
        );

        extract(array_merge($default, $parts));

        return "T{$hours}H{$minutes}M{$seconds}S";
    }

    public static function init_dimensions($url, $urlkvp, $finalparams)
    {
        // get default dimensions; try embed size in settings, then try theme's content width, then just 480px
        if (self::$defaultwidth == null)
        {
            global $content_width;
            if (empty($content_width))
            {
                $content_width = $GLOBALS['content_width'];
            }

            if (isset($urlkvp['width']) && is_numeric($urlkvp['width']))
            {
                self::$defaultwidth = $urlkvp['width'];
            }
            else if (self::$alloptions[self::$opt_defaultdims] == 1 && (isset(self::$alloptions[self::$opt_defaultwidth]) && is_numeric(self::$alloptions[self::$opt_defaultwidth])))
            {
                self::$defaultwidth = self::$alloptions[self::$opt_defaultwidth];
            }
            else if (self::$optembedwidth)
            {
                self::$defaultwidth = self::$optembedwidth;
            }
            else if ($content_width)
            {
                self::$defaultwidth = $content_width;
            }
            else
            {
                self::$defaultwidth = 480;
            }



            if (isset($urlkvp['height']) && is_numeric($urlkvp['height']))
            {
                self::$defaultheight = $urlkvp['height'];
            }
            else if (self::$alloptions[self::$opt_defaultdims] == 1 && (isset(self::$alloptions[self::$opt_defaultheight]) && is_numeric(self::$alloptions[self::$opt_defaultheight])))
            {
                self::$defaultheight = self::$alloptions[self::$opt_defaultheight];
            }
            else
            {
                self::$defaultheight = self::get_aspect_height($url, self::$defaultwidth);
            }
        }
    }

    public static function get_oembed($url, $height, $width)
    {
        if (stripos($url, 'listType=playlist') !== false && stripos($url, '/embed') !== false)
        {
            $url = str_replace('/embed', '/playlist', $url);
        }
        require_once(ABSPATH . WPINC . '/class-oembed.php');
        $oembed = _wp_oembed_get_object();
        $args = array();
        $args['width'] = $width;
        $args['height'] = $height;
        $args['discover'] = false;
        self::$oembeddata = $oembed->fetch('https://www.youtube.com/oembed', $url, $args);
        return self::$oembeddata;
    }

    public static function get_aspect_height($url, $widthbox)
    {
        // attempt to get aspect ratio correct height from oEmbed
        $aspectheight = round(($widthbox * 9) / 16, 0);

        if ($url)
        {
            $odata = self::get_oembed($url, $widthbox, $widthbox);

            if ($odata)
            {
                $aspectheight = $odata->height;
            }
        }

        return $aspectheight;
    }

    public static function ytprefs_plugin_menu()
    {
        self::$admin_page_hooks[] = add_menu_page('YouTube Settings', 'YouTube Free', 'manage_options', 'youtube-my-preferences', array(get_class(), 'ytprefs_show_options'), plugins_url('images/youtubeicon16.png', __FILE__), '10.000392854349');
        self::$admin_page_hooks[] = add_submenu_page('youtube-my-preferences', '', '', 'manage_options', 'youtube-my-preferences', array(get_class(), 'ytprefs_show_options'));

        include_once(EPYTVI_INCLUDES_PATH . 'vi_admin_menu.php');
        self::$admin_page_hooks[] = add_submenu_page(null, 'YouTube Posts', 'YouTube Posts', 'manage_options', 'youtube-ep-glance', array(get_class(), 'glance_page'));
        self::$admin_page_hooks[] = self::$wizard_hook = add_submenu_page(null, 'YouTube Wizard', 'YouTube Wizard', 'edit_posts', 'youtube-ep-wizard', array(get_class(), 'wizard'));
        self::$admin_page_hooks[] = self::$onboarding_hook = add_submenu_page(null, 'YouTube Setup', 'YouTube Setup', 'manage_options', 'youtube-ep-onboarding', array(get_class(), 'ytprefs_show_onboarding'));
    }

    public static function custom_admin_pointers_check()
    {
        //return false; // ooopointer shut all off;
        $admin_pointers = self::custom_admin_pointers();
        foreach ($admin_pointers as $pointer => $array)
        {
            if ($array['active'])
            {
                return true;
            }
        }
    }

    public static function glance_script()
    {
        add_thickbox();
        ?>
        <script type="text/javascript">
            function widen_ytprefs_glance()
            {
                setTimeout(function ()
                {
                    jQuery("#TB_window").animate({marginLeft: '-' + parseInt((780 / 2), 10) + 'px', width: '780px'}, 300);
                    jQuery("#TB_window iframe").animate({width: '780px'}, 300);
                }, 15);
            }

            (function ($j)
            {
                $j(document).ready(function ()
                {

                    $j.ajax({
                        type: "post",
                        dataType: "json",
                        timeout: 30000,
                        url: window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl,
                        data: {action: 'my_embedplus_glance_count'},
                        success: function (response)
                        {
                            if (response.type === "success")
                            {
                                $j(response.container).append(response.data);
                                $j(".ytprefs_glance_button").click(widen_ytprefs_glance);
                                $j(window).resize(widen_ytprefs_glance);
                                if (typeof ep_do_pointers === 'function')
                                {
                                    //ep_do_pointers($j);
                                }
                            }
                            else
                            {
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError)
                        {

                        },
                        complete: function ()
                        {
                        }
                    });
                });
            })(jQuery);</script>
        <?php
    }

    public static function custom_admin_pointers_footer()
    {
        $admin_pointers = self::custom_admin_pointers();
        ?>
        <script type="text/javascript">
            /* <![CDATA[ */
            function ep_do_pointers($)
            {
        <?php
        foreach ($admin_pointers as $pointer => $array)
        {
            if ($array['active'])
            {
                ?>
                        $('<?php echo $array['anchor_id']; ?>').pointer({
                            content: '<?php echo $array['content']; ?>',
                            position: {
                                edge: '<?php echo $array['edge']; ?>',
                                align: '<?php echo $array['align']; ?>'
                            },
                            close: function ()
                            {
                                $.post(window._EPYTA_ ? window._EPYTA_.wpajaxurl : ajaxurl, {
                                    pointer: '<?php echo $pointer; ?>',
                                    action: 'dismiss-wp-pointer'
                                });
                            }
                        }).pointer('open');
                <?php
            }
        }
        ?>
            }

            ep_do_pointers(jQuery); // switch off all pointers via js ooopointer
            /* ]]> */
        </script>
        <?php
    }

    public static function custom_admin_pointers()
    {
        $dismissed = explode(',', (string) get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
        $version = str_replace('.', '_', self::$version); // replace all periods in version with an underscore
        $prefix = 'custom_admin_pointers' . $version . '_';

        $new_pointer_content = '<h3>' . __('New Update') . '</h3>'; // ooopointer

        $new_pointer_content .= '<p>'; // ooopointer
        //$new_pointer_content .= "This version provides clearer instructions for many options across the plugin&apos;s settings and wizard pages in both Free and <a target=_blank href=" . self::$epbase . '/dashboard/pro-easy-video-analytics.aspx?ref=frompointer' . ">Pro versions &raquo;</a>";
        $new_pointer_content .= "This version brings back the ability to hide related/suggested videos that show up at the end of YouTube embeds. It also allows monetized sites that are embedding video intelligence (vi) ads to select multiple IAB categories to get more content variety. "
                . (self::vi_logged_in() ? "<a href=\"" . admin_url('admin.php?page=youtube-ep-vi') . "\">Login here to see &raquo;</a>" : "<a rel=\"#jumpmonetize\" class=\"epyt-jumptab\" href=\"" . admin_url('admin.php?page=youtube-my-preferences#jumpmonetize') . "\">Login here to see &raquo;</a>");

        if (!empty(self::$alloptions[self::$opt_pro]) && strlen(trim(self::$alloptions[self::$opt_pro])) > 0)
        {
            $new_pointer_content .= ' <strong>Important message to YouTube Pro users</strong>: From version 11.7 onward, you must <a href="https://www.embedplus.com/youtube-pro/download/?prokey=' . esc_attr(self::$alloptions[self::$opt_pro]) . '" target="_blank">download the separate plugin here</a> to regain your Pro features. All your settings will automatically migrate after installing the separate Pro download. Thank you for your support and patience during this transition.';
        }

        $new_pointer_content .= '</p>';

        return array(
            $prefix . 'new_items' => array(
                'content' => $new_pointer_content,
                'anchor_id' => 'a.toplevel_page_youtube-my-preferences', //'#ytprefs_glance_button', 
                'edge' => 'top',
                'align' => 'left',
                'active' => (!in_array($prefix . 'new_items', $dismissed))
            ),
        );
    }

    public static function postchecked($idx)
    {
        return isset($_POST[$idx]) && $_POST[$idx] == (true || 'on');
    }

    public static function settings_nav()
    {
        ?>

        <h3 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active" href="#jumpdefaults">Defaults</a>
            <a class="nav-tab" href="#jumpapikey">API Key</a>
            <a class="nav-tab" href="#jumpwiz">Wizard</a>
            <a class="nav-tab" href="#jumpgallery">Galleries</a>
            <a class="nav-tab href-link" style="background-color: #daebf1;" rel="#jumpupgrade" target="_blank" href="<?php echo self::$epbase . "/dashboard/pro-easy-video-analytics.aspx?ref=protab" ?>">Upgrade?</a>
            <?php
            if (!(bool) (self::$alloptions[self::$opt_vi_hide_monetize_tab]))
            {
                if (self::vi_logged_in())
                {
                    ?>
                    <a class="nav-tab href-link" href="<?php echo admin_url('admin.php?page=youtube-ep-vi') ?>">Monetize <sup class="orange">new</sup></a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="nav-tab" href="#jumpmonetize">Monetize? <sup class="orange">new</sup></a>
                    <?php
                }
            }
            ?>
            <a class="nav-tab" href="#jumpcompat">Compatibility</a>
            <a class="nav-tab" href="#jumpprivacy">Privacy</a>
            <a class="nav-tab" href="#jumphowto">Embed Manually</a>
            <a class="nav-tab" href="#jumpsupport">Support</a>
        </h3>
        <?php
    }

    public static function ytprefs_show_options()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        if (self::$double_plugin)
        {
            self::double_plugin_warning();
        }

        $ytprefs_submitted = 'ytprefs_submitted';

        // Read in existing option values from database

        $all = get_option(self::$opt_alloptions);

        // See if the user has posted us some information
        // If they did, this hidden field will be set to 'Y'
        if (isset($_POST[$ytprefs_submitted]) && $_POST[$ytprefs_submitted] == 'Y')
        {
            check_admin_referer('_epyt_save', '_epyt_nonce');
            // Read their posted values

            $new_options = array();
            $new_options[self::$opt_center] = self::postchecked(self::$opt_center) ? 1 : 0;
            $new_options[self::$opt_glance] = self::postchecked(self::$opt_glance) ? 1 : 0;
            $new_options[self::$opt_autoplay] = self::postchecked(self::$opt_autoplay) ? 1 : 0;
            $new_options[self::$opt_debugmode] = self::postchecked(self::$opt_debugmode) ? 1 : 0;
            $new_options[self::$opt_admin_off_scripts] = self::postchecked(self::$opt_admin_off_scripts) ? 1 : 0;
            $new_options[self::$opt_old_script_method] = self::postchecked(self::$opt_old_script_method) ? 1 : 0;
            $new_options[self::$opt_cc_load_policy] = self::postchecked(self::$opt_cc_load_policy) ? 1 : 0;
            $new_options[self::$opt_iv_load_policy] = self::postchecked(self::$opt_iv_load_policy) ? 1 : 3;
            $new_options[self::$opt_loop] = self::postchecked(self::$opt_loop) ? 1 : 0;
            $new_options[self::$opt_modestbranding] = self::postchecked(self::$opt_modestbranding) ? 1 : 0;
            //$new_options[self::$opt_rel] = self::postchecked(self::$opt_rel) ? 1 : 0;
            $new_options[self::$opt_showinfo] = self::postchecked(self::$opt_showinfo) ? 1 : 0;
            $new_options[self::$opt_fs] = self::postchecked(self::$opt_fs) ? 1 : 0;
            $new_options[self::$opt_playsinline] = self::postchecked(self::$opt_playsinline) ? 1 : 0;
            $new_options[self::$opt_origin] = self::postchecked(self::$opt_origin) ? 1 : 0;
            $new_options[self::$opt_controls] = self::postchecked(self::$opt_controls) ? 2 : 0;
            $new_options[self::$opt_color] = self::postchecked(self::$opt_color) ? 'red' : 'white';
            $new_options[self::$opt_nocookie] = self::postchecked(self::$opt_nocookie) ? 1 : 0;
            $new_options[self::$opt_gdpr_consent] = self::postchecked(self::$opt_gdpr_consent) ? 1 : 0;
            $new_options[self::$opt_playlistorder] = self::postchecked(self::$opt_playlistorder) ? 1 : 0;
            $new_options[self::$opt_acctitle] = self::postchecked(self::$opt_acctitle) ? 1 : 0;
            $new_options[self::$opt_migrate] = self::postchecked(self::$opt_migrate) ? 1 : 0;
            $new_options[self::$opt_migrate_youtube] = self::postchecked(self::$opt_migrate_youtube) ? 1 : 0;
            $new_options[self::$opt_migrate_embedplusvideo] = self::postchecked(self::$opt_migrate_embedplusvideo) ? 1 : 0;
            $new_options[self::$opt_oldspacing] = self::postchecked(self::$opt_oldspacing) ? 1 : 0;
            $new_options[self::$opt_frontend_only] = self::postchecked(self::$opt_frontend_only) ? 1 : 0;
            $new_options[self::$opt_responsive] = self::postchecked(self::$opt_responsive) ? 1 : 0;
            $new_options[self::$opt_widgetfit] = self::postchecked(self::$opt_widgetfit) ? 1 : 0;
            $new_options[self::$opt_evselector_light] = self::postchecked(self::$opt_evselector_light) ? 1 : 0;
            $new_options[self::$opt_stop_mobile_buffer] = self::postchecked(self::$opt_stop_mobile_buffer) ? 1 : 0;
            $new_options[self::$opt_restrict_wizard] = self::postchecked(self::$opt_restrict_wizard) ? 1 : 0;
            $new_options[self::$opt_ajax_compat] = self::postchecked(self::$opt_ajax_compat) ? 1 : 0;
            $new_options[self::$opt_defaultdims] = self::postchecked(self::$opt_defaultdims) ? 1 : 0;
            $new_options[self::$opt_defaultvol] = self::postchecked(self::$opt_defaultvol) ? 1 : 0;
            $new_options[self::$opt_dohl] = self::postchecked(self::$opt_dohl) ? 1 : 0;
            $new_options[self::$opt_onboarded] = self::postchecked(self::$opt_onboarded) ? 1 : 0;
            $new_options[self::$opt_gallery_hideprivate] = self::postchecked(self::$opt_gallery_hideprivate) ? 1 : 0;
            $new_options[self::$opt_gallery_showtitle] = self::postchecked(self::$opt_gallery_showtitle) ? 1 : 0;
            $new_options[self::$opt_gallery_showpaging] = self::postchecked(self::$opt_gallery_showpaging) ? 1 : 0;
            $new_options[self::$opt_gallery_autonext] = self::postchecked(self::$opt_gallery_autonext) ? 1 : 0;
            $new_options[self::$opt_gallery_thumbplay] = self::postchecked(self::$opt_gallery_thumbplay) ? 1 : 0;
            $new_options[self::$opt_gallery_channelsub] = self::postchecked(self::$opt_gallery_channelsub) ? 1 : 0;
            $new_options[self::$opt_gallery_customarrows] = self::postchecked(self::$opt_gallery_customarrows) ? 1 : 0;
            $new_options[self::$opt_gallery_collapse_grid] = self::postchecked(self::$opt_gallery_collapse_grid) ? 1 : 0;
            $new_options[self::$opt_vi_hide_monetize_tab] = self::postchecked(self::$opt_vi_hide_monetize_tab) ? 1 : 0;

            $_rel = 0;
            try
            {
                $_rel = is_numeric(trim($_POST[self::$opt_rel])) ? intval(trim($_POST[self::$opt_rel])) : $_rel;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_rel] = $_rel;


            $_gdpr_consent_message = '';
            try
            {
                $_gdpr_consent_message = wp_kses_post(stripslashes($_POST[self::$opt_gdpr_consent_message]));
            }
            catch (Exception $ex)
            {
                $_gdpr_consent_message = '';
            }
            $new_options[self::$opt_gdpr_consent_message] = $_gdpr_consent_message;

            $_gdpr_consent_button = '';
            try
            {
                $_gdpr_consent_button = wp_kses_post(stripslashes($_POST[self::$opt_gdpr_consent_button]));
            }
            catch (Exception $ex)
            {
                $_gdpr_consent_button = '';
            }
            $new_options[self::$opt_gdpr_consent_button] = $_gdpr_consent_button;

            $_ytapi_load = 'light';
            try
            {
                $_ytapi_load_temp = $_POST[self::$opt_ytapi_load];
                if (in_array($_ytapi_load_temp, array('always', 'light', 'never')))
                {
                    $_ytapi_load = $_ytapi_load_temp;
                }
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_ytapi_load] = $_ytapi_load;

            $_restrict_wizard_roles = self::$dft_roles;
            try
            {
                $_restrict_wizard_roles = is_array($_POST[self::$opt_restrict_wizard_roles]) ? $_POST[self::$opt_restrict_wizard_roles] : $_restrict_wizard_roles;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_restrict_wizard_roles] = $_restrict_wizard_roles;


            $_defaultwidth = '';
            try
            {
                $_defaultwidth = is_numeric(trim($_POST[self::$opt_defaultwidth])) ? intval(trim($_POST[self::$opt_defaultwidth])) : $_defaultwidth;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_defaultwidth] = $_defaultwidth;

            $_defaultheight = '';
            try
            {
                $_defaultheight = is_numeric(trim($_POST[self::$opt_defaultheight])) ? intval(trim($_POST[self::$opt_defaultheight])) : $_defaultheight;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_defaultheight] = $_defaultheight;

            $_responsive_all = 1;
            try
            {
                $_responsive_all = is_numeric(trim($_POST[self::$opt_responsive_all])) ? intval(trim($_POST[self::$opt_responsive_all])) : $_responsive_all;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_responsive_all] = $_responsive_all;

            $_vol = '';
            try
            {
                $_vol = is_numeric(trim($_POST[self::$opt_vol])) ? intval(trim($_POST[self::$opt_vol])) : $_vol;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_vol] = $_vol;

            $_gallery_pagesize = 15;
            try
            {
                $_gallery_pagesize = is_numeric(trim($_POST[self::$opt_gallery_pagesize])) ? intval(trim($_POST[self::$opt_gallery_pagesize])) : $_gallery_pagesize;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_gallery_pagesize] = $_gallery_pagesize;


            $_gallery_columns = 3;
            try
            {
                $_gallery_columns = is_numeric(trim($_POST[self::$opt_gallery_columns])) ? intval(trim($_POST[self::$opt_gallery_columns])) : $_gallery_columns;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_gallery_columns] = $_gallery_columns;


            $_gallery_collapse_grid_breaks = self::$dft_bpts;
            try
            {
                $_gallery_collapse_grid_breaks = is_array($_POST[self::$opt_gallery_collapse_grid_breaks]) ? $_POST[self::$opt_gallery_collapse_grid_breaks] : $_gallery_collapse_grid_breaks;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_gallery_collapse_grid_breaks] = $_gallery_collapse_grid_breaks;



            $_gallery_scrolloffset = 20;
            try
            {
                $_gallery_scrolloffset = is_numeric(trim($_POST[self::$opt_gallery_scrolloffset])) ? intval(trim($_POST[self::$opt_gallery_scrolloffset])) : $_gallery_scrolloffset;
            }
            catch (Exception $ex)
            {
                
            }
            $new_options[self::$opt_gallery_scrolloffset] = $_gallery_scrolloffset;

            $_gallery_channelsublink = '';
            try
            {
                $_gallery_channelsublink = trim(strip_tags($_POST[self::$opt_gallery_channelsublink]));
                $pieces = explode('?', $_gallery_channelsublink);
                $_gallery_channelsublink = trim($pieces[0]);
            }
            catch (Exception $ex)
            {
                $_gallery_channelsublink = '';
            }
            $new_options[self::$opt_gallery_channelsublink] = $_gallery_channelsublink;


            $_gallery_channelsubtext = '';
            try
            {
                $_gallery_channelsubtext = stripslashes(trim($_POST[self::$opt_gallery_channelsubtext]));
            }
            catch (Exception $ex)
            {
                $_gallery_channelsubtext = '';
            }
            $new_options[self::$opt_gallery_channelsubtext] = $_gallery_channelsubtext;


            $_gallery_custom_prev = 'Prev';
            try
            {
                $_gallery_custom_prev = trim(strip_tags($_POST[self::$opt_gallery_customprev]));
            }
            catch (Exception $ex)
            {
                $_gallery_custom_prev = 'Prev';
            }
            $new_options[self::$opt_gallery_customprev] = $_gallery_custom_prev;


            $_gallery_custom_next = 'Next';
            try
            {
                $_gallery_custom_next = trim(strip_tags($_POST[self::$opt_gallery_customnext]));
            }
            catch (Exception $ex)
            {
                $_gallery_custom_next = 'Next';
            }
            $new_options[self::$opt_gallery_customnext] = $_gallery_custom_next;


            $_not_live_content = '';
            try
            {
                $_not_live_content = wp_kses_post(stripslashes($_POST[self::$opt_not_live_content]));
            }
            catch (Exception $ex)
            {
                $_not_live_content = '';
            }
            $new_options[self::$opt_not_live_content] = $_not_live_content;


            $_apikey = '';
            try
            {
                $_apikey = trim(str_replace(array(' ', "'", '"'), array('', '', ''), strip_tags($_POST[self::$opt_apikey])));
            }
            catch (Exception $ex)
            {
                $_apikey = '';
            }
            $new_options[self::$opt_apikey] = $_apikey;


            $all = $new_options + $all;

            update_option(self::$opt_alloptions, $all);
            ?>
            <div class="updated"><p><strong><?php _e('Changes saved.'); ?> <em>If you're using a separate caching plugin and you do not see your changes after saving, <strong class="orange">you need to reset your cache.</strong></em></strong></p></div>
            <?php
        }
        ?>

        <style type="text/css">
            .wrap {font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",Arial,sans-serif; color: #000000;}
            .wrap-ytprefs {max-width: 1064px;}
            #ytform p { line-height: 20px; margin: 18px 0; }
            .ytindent {padding: 0px 0px 0px 20px; font-size: 13px; margin-bottom: 100px;}
            .ytindent ul, .ytindent p {font-size: 13px;}
            .shadow {-webkit-box-shadow: 0px 0px 20px 0px #000000; box-shadow: 0px 0px 20px 0px #000000;}
            .gopro {margin: 0px;}
            .gopro img {vertical-align: middle;
                        width: 19px;
                        height: 19px;
                        padding-bottom: 4px;}
            .gopro li {margin-bottom: 0px;}
            .orange {color: #f85d00;}
            .bold {font-weight: bold;}
            .grey{color: #888888;}
            #goprobox {border-radius: 15px; padding: 10px 15px 15px 15px; border: 3px solid #CCE5EC; position: relative;}
            .pronon {font-weight: bold; color: #f85d00;}
            ul.reglist li {margin-left: 30px; list-style: disc outside none;}
            .procol {width: 475px; float: left;}
            .ytindent .procol ul {font-size: 12px;}
            .smallnote, .ytindent .smallnote {font-style: italic; font-size: 11px;}
            .italic {font-style: italic;}
            .ytindent h3 {font-size: 16px; line-height: 22px; margin: 5px 0px 10px 0px;}
            #wizleftlink {float: left; display: block; width: 240px; font-style: italic; text-align: center; text-decoration: none;}
            .button-primary {white-space: nowrap;}
            p.submit {margin: 10px 0 0 0; padding: 10px 0 5px 0;}
            .wp-core-ui p.submit .button-primary {
                font-weight: bold;
                font-size: 21px; height: 50px; padding: 0 20px 1px;
                background: #2ea2cc; /* Old browsers */
                background: -moz-linear-gradient(top,  #2ea2cc 0%, #007396 98%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#2ea2cc), color-stop(98%,#007396)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  #2ea2cc 0%,#007396 98%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  #2ea2cc 0%,#007396 98%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  #2ea2cc 0%,#007396 98%); /* IE10+ */
                background: linear-gradient(to bottom,  #2ea2cc 0%,#007396 98%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2ea2cc', endColorstr='#007396',GradientType=0 ); /* IE6-9 */
            }
            p.submit em {display: inline-block; padding-left: 20px; vertical-align: middle; width: 240px; margin-top: -6px;}
            #opt_pro {box-shadow: 0px 0px 5px 0px #1870D5; width: 320px;vertical-align: top;}
            #goprobox h3 {font-size: 14px;}
            .chx {border-left: 5px solid rgba(100, 100, 100,.1); margin-bottom: 20px;}
            .chx p {margin: 0px 0px 5px 0px;}
            .cuz {background-image: linear-gradient(to bottom,#4983FF,#0C5597) !important; color: #ffffff;}
            .brightpro {background-image: linear-gradient(to bottom,#ff5500,#cc2200) !important; color: #ffffff;}
            #boxdefaultdims {font-weight: bold; padding: 0px 10px; <?php echo $all[self::$opt_defaultdims] ? '' : 'display: none;' ?>}
            #boxcustomarrows {font-weight: bold; padding: 0px 10px; <?php echo $all[self::$opt_gallery_customarrows] ? 'display: block;' : 'display: none;' ?>}
            #boxchannelsub {font-weight: bold; padding: 0px 10px; <?php echo $all[self::$opt_gallery_channelsub] ? 'display: block;' : 'display: none;' ?>}
            #box_collapse_grid {font-weight: bold; padding: 0px 10px; <?php echo isset($all[self::$opt_gallery_collapse_grid]) && $all[self::$opt_gallery_collapse_grid] ? 'display: block;' : 'display: none;' ?>}
            #box_restrict_wizard {padding: 0px 10px; <?php echo isset($all[self::$opt_restrict_wizard]) && $all[self::$opt_restrict_wizard] ? 'display: block;' : 'display: none;' ?>}
            #box_restrict_wizard label {display: block; margin: 5px 10px;}
            .textinput {border-width: 2px !important;}
            input[type=text]::placeholder {font-weight: normal;}
            h3.sect {border-radius: 10px; background-color: #D9E9F7; padding: 5px 5px 5px 10px; position: relative; font-weight: bold;}
            h3.sect a {text-decoration: none; color: #E20000;}
            h3.sect a.button-primary {color: #ffffff;} 
            h4.sect {border-radius: 10px; background-color: #D9E9F7; padding: 5px 5px 5px 10px; position: relative; font-weight: bold;}

            .nav-tab-wrapper sup {line-height: 0;}
            .ytnav {margin-bottom: 15px;}
            .ytnav a {font-weight: bold; display: inline-block; padding: 5px 10px; margin: 0px 15px 0px 0px; border: 1px solid #cccccc; border-radius: 6px;
                      text-decoration: none; background-color: #ffffff;}
            .ytnav a:last-child {margin-right: 0;}
            .jumper {height: 25px;}
            .ssschema {float: right; width: 350px; height: auto; margin-right: 10px;}
            .ssfb {float: right; height: auto; margin-right: 10px; margin-left: 15px; margin-bottom: 10px;}
            .totop {position: absolute; right: 20px; top: 5px; color: #444444; font-size: 11px;}
            input[type=checkbox] {border: 1px solid #000000;}
            .chktitle {display: inline-block; padding: 1px 5px 1px 5px; border-radius: 3px; background-color: #ffffff; border: 1px solid #dddddd;}
            b, strong {font-weight: bold;}
            input.checkbox[disabled], input[type=radio][disabled] {border: 1px dashed #444444;}
            .pad10 {padding: 10px;}
            #boxdohl {font-weight: bold; padding: 0px 10px;  <?php echo $all[self::$opt_dohl] ? '' : 'display: none;' ?>}
            #boxdefaultvol {font-weight: bold; padding: 0px 10px;  <?php echo $all[self::$opt_defaultvol] ? '' : 'display: none;' ?>}
            .vol-output {display: none; width: 30px; color: #008800;}
            .vol-range {background-color: #dddddd; border-radius: 3px; cursor: pointer;}
            input#vol {vertical-align: middle;}
            .vol-seeslider {display: none;}
            .indent-option {margin-left: 25px;}
            #boxmigratelist { <?php echo $all[self::$opt_migrate] ? '' : 'display: none;' ?>}
            #boxresponsive_all { <?php echo $all[self::$opt_responsive] ? '' : 'display: none;' ?> padding-left: 25px; border-left: 5px solid rgba(100, 100, 100,.1); margin-left: 5px;}
            .apikey-video{margin-left: 3%; display: inline-block; width: 50%; position: relative; padding-top: 29%}
            .apikey-video iframe{display: block; width: 100%; height: 100%; position: absolute; top: 0; left: 0;}
            #boxnocookie {display: inline-block; border-radius: 3px; padding: 2px 4px 2px 4px; color: red;  <?php echo $all[self::$opt_nocookie] ? '' : 'display: none;' ?>}
            #box_gdpr_consent { color: red; <?php echo (bool) $all[self::$opt_gdpr_consent] ? 'display: block;' : 'display: none;' ?>}
            .strike {text-decoration: line-through;}
            .upgchecks { padding: 20px; border-radius: 15px; border: 1px dotted #777777; background-color: #fcfcfc; }
            .clearboth {clear: both;}
            div.hr {clear: both; border-bottom: 1px dotted #A8BDD8; margin: 20px 0 20px 0;}
            .wp-pointer-buttons a.close {margin-top: 0 !important;}
            .pad20{padding: 20px 0 20px 0;}
            .ssgallery {float: right; width: 130px; height: auto; margin-left: 15px; border: 3px solid #ffffff;}
            .sssubscribe{display: block; width: 400px; height: auto;}
            .ssaltgallery {float: right; height: auto; margin-right: 10px; margin-left: 15px; margin-bottom: 10px; width: 350px;}
            .sspopupplayer {float: right; height: auto; margin-right: 10px; margin-left: 15px; margin-bottom: 10px; width: 350px;}
            .sshidethumbimg {float: right; height: auto; margin-right: 10px; margin-left: 40px; margin-bottom: 10px; width: 315px;}
            .sswizardbutton {    max-width: 70%; height: auto;}
            .save-changes-follow {position: fixed; z-index: 10000; bottom: 0; right: 0; background-color: #ffffff; padding: 0 20px; border-top-left-radius: 20px; border: 2px solid #aaaaaa; border-right-width: 0; border-bottom-width: 0;
                                  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
                                  -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
                                  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75); }
            .alertify .ajs-body .ajs-content {line-height: 2.5em;}
            #jumpmonetize h2:first-child {margin-bottom: 0;}

            .wrap-ytprefs h2.nav-tab-wrapper {
                margin:22px 0 0 0;
            }

            .wrap-ytprefs h3 .nav-tab {
                padding: 5px 10px;
            }

            .wrap-ytprefs section {
                display:none;
                padding-top:15px;
            }
            .wrap-ytprefs section#jumpdefaults {
                display:block;
            }
            .wrap-ytprefs .no-js section {
                display: block;
            }

            .gdpr-options-left {
                width: 65%;
                float: left;
                clear: left;
            }

            .gdpr-options-right {
                width: 33%;
                float: right;
                margin-top: 20px;
            }

            .gdpr-options-right .img-gdpr-message {
                width: 100%;
                height: auto;
            }

            iframe#gdpr_consent_message_ifr {
                min-height: 250px !important;
            }

            section#jumpwiz hr {
                margin: 20px 0 20px 0;
            }
            .wiztab-screenshots {
                float: right;
                max-width: 50%;
                height: auto;
                clear: right;
                margin-left: 30px;
                margin-bottom: 15px;
                display: block;
                border: 5px solid #dddddd;
            }

            .epyt-deprecated {
                color: #aaaaaa;
            }
        </style>
        <div class="wrap wrap-ytprefs">
            <h1><img alt="YouTube Plugin Icon" src="<?php echo plugins_url('images/youtubeicon16.png', __FILE__) ?>" /> <?php echo __('YouTube Settings') ?></h1>
            <?php
            self::settings_nav();
            ?>

            <div class="ytindent">
                <form name="form1" method="post" action="" id="ytform">
                    <input type="hidden" name="<?php echo $ytprefs_submitted; ?>" value="Y">
                    <?php wp_nonce_field('_epyt_save', '_epyt_nonce', true); ?>
                    <section class="pattern" id="jumpapikey">
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/apikey-server.png', __FILE__) ?>">
                        <h2>
                            YouTube API Key
                        </h2>
                        <p>
                            Some features (such as galleries, and some wizard features) now require you to create a free YouTube API <strong>Server</strong> key from Google.
                            Make sure it's a YouTube Data API v3 "Web Server" key as shown in the screenshot (i.e. not web browser or anything else). <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">Click this link &raquo;</a> and follow the video to get your API key. Don't worry, it's an easy process.
                        </p>
                        <p>
                            <b class="chktitle">YouTube API Key:</b> 
                            <input type="text" name="<?php echo self::$opt_apikey; ?>" id="<?php echo self::$opt_apikey; ?>" value="<?php echo esc_attr(trim($all[self::$opt_apikey])); ?>" class="textinput" style="width: 250px;">
                        </p>
                    </section>

                    <section class="pattern" id="jumpdefaults">
                        <h2>
                            <?php _e("Default YouTube Options") ?>
                        </h2>
                        <p>
                            <?php _e("One of the benefits of using this plugin is that you can set site-wide default options for all your videos (click \"Save Changes\" when finished). However, you can also override them (and more) on a per-video basis. Directions on how to do that are in the next section.") ?>
                        </p>

                        <div class="ytindent chx">
                            <p>
                                <input name="<?php echo self::$opt_restrict_wizard; ?>" id="<?php echo self::$opt_restrict_wizard; ?>" <?php checked($all[self::$opt_restrict_wizard], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_restrict_wizard; ?>">
                                    <b class="chktitle">Restrict Wizard Button:</b> Select which roles can use the YouTube wizard button. For example, you may wish to hide the button from contributors submitting content on the front end.
                                </label>
                                <br>
                                <span id="box_restrict_wizard" class="chx">
                                    <?php
                                    foreach (self::$dft_roles as $idx => $role)
                                    {
                                        ?>
                                        <label>
                                            <input type="checkbox" name="<?php echo self::$opt_restrict_wizard_roles . '[]' ?>" value="<?php echo esc_attr($role) ?>" <?php echo in_array($role, $all[self::$opt_restrict_wizard_roles]) ? 'checked' : '' ?>>
                                            <?php echo esc_html(ucfirst($role)); ?>s
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </span>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_glance; ?>" id="<?php echo self::$opt_glance; ?>" <?php checked($all[self::$opt_glance], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_glance; ?>"><?php _e('<b class="chktitle">At a glance:</b> Show "At a Glance" Embed Links on the dashboard homepage.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_center; ?>" id="<?php echo self::$opt_center; ?>" <?php checked($all[self::$opt_center], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_center; ?>"><?php _e('<b class="chktitle">Centering:</b> Automatically center all your videos (not necessary if all your videos span the whole width of your blog).') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_autoplay; ?>" id="<?php echo self::$opt_autoplay; ?>" <?php checked($all[self::$opt_autoplay], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_autoplay; ?>">
                                    <?php _e('<b class="chktitle">Autoplay:</b>  Automatically start playing your videos.') ?>
                                    <strong>Note:</strong> If you're embedding videos from your own monetized YouTube channel, we advise you to read YouTube's resource page on ads on embedded videos:
                                    <a href="https://support.google.com/youtube/answer/132596?hl=en" target="_blank">https://support.google.com/youtube/answer/132596?hl=en</a>
                                    You'll see that videos that you want to monetize "should be embedded using the standard click-to-play embed and NOT a scripted play."
                                    Unchecking this option guarantees standard click-to-play gallery embedding.
                                    (Another Note: Desktop browsers like Chrome and Safari are moving towards preventing autoplay for any video. So this general feature may be deprecated by most browsers in the near future)
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_iv_load_policy; ?>" id="<?php echo self::$opt_iv_load_policy; ?>" <?php checked($all[self::$opt_iv_load_policy], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_iv_load_policy; ?>"><?php _e('<b class="chktitle">Annotations:</b> Show annotations by default.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_loop; ?>" id="<?php echo self::$opt_loop; ?>" <?php checked($all[self::$opt_loop], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_loop; ?>"><?php _e('<b class="chktitle">Looping:</b> Loop all your videos.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_modestbranding; ?>" id="<?php echo self::$opt_modestbranding; ?>" <?php checked($all[self::$opt_modestbranding], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_modestbranding; ?>"><?php _e('<b class="chktitle">Modest Branding:</b> No YouTube logo will be shown on the control bar.  Instead, as required by YouTube, the logo will only show as a watermark when the video is paused/stopped.') ?></label>
                            </p>
                            <p>
                                <label>
                                    <b class="chktitle">Related Videos:</b>
                                    Show or hide related and recommended videos at the end of playback.
                                    <br>
                                </label>
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>-1" value="-1" <?php checked($all[self::$opt_rel], -1); ?>>
                                <label for="<?php echo self::$opt_rel; ?>-1">Hide related videos at the end of playback <sup class="orange">new</sup></label> &nbsp;&nbsp;
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>0" value="0" <?php checked($all[self::$opt_rel], 0); ?>>
                                <label for="<?php echo self::$opt_rel; ?>0">Show related videos only from the video's channel</label> &nbsp;&nbsp;
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>1" value="1" <?php checked($all[self::$opt_rel], 1); ?>>
                                <label for="<?php echo self::$opt_rel; ?>1">Show related videos</label> &nbsp;&nbsp;
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_showinfo; ?>" id="<?php echo self::$opt_showinfo; ?>" <?php checked($all[self::$opt_showinfo], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_showinfo; ?>">
                                    <b class="chktitle">Show Title:</b>
                                    <strong>Google/YouTube no longer allows tools to control this feature. Learn more about the <a target="_blank" href="https://developers.google.com/youtube/player_parameters#Revision_History">deprecation of this feature here</a>.</strong>
                                    <span class="epyt-deprecated">Show the video title and other info.</span>
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_fs; ?>" id="<?php echo self::$opt_fs; ?>" <?php checked($all[self::$opt_fs], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_fs; ?>"><?php _e('<b class="chktitle">Show Fullscreen Button:</b> Show the fullscreen button.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_acctitle; ?>" id="<?php echo self::$opt_acctitle; ?>" <?php checked($all[self::$opt_acctitle], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_acctitle; ?>"><b class="chktitle">Accessible Title Attributes: </b> Improve accessibility by using title attributes for screen reader support. It should help your site pass functional accessibility evaluations (FAE). </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_color; ?>" id="<?php echo self::$opt_color; ?>" <?php checked($all[self::$opt_color], 'red'); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_color; ?>"><?php _e('<b class="chktitle">Red Progress Bar:</b> Use the red progress bar (uncheck to use a white progress bar). Note: Using white will disable the modestbranding option.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_defaultdims; ?>" id="<?php echo self::$opt_defaultdims; ?>" <?php checked($all[self::$opt_defaultdims], 1); ?> type="checkbox" class="checkbox">                        
                                <span id="boxdefaultdims">
                                    Width: <input type="text" name="<?php echo self::$opt_defaultwidth; ?>" id="<?php echo self::$opt_defaultwidth; ?>" value="<?php echo esc_attr(trim($all[self::$opt_defaultwidth])); ?>" class="textinput" style="width: 50px;"> &nbsp;
                                    Height: <input type="text" name="<?php echo self::$opt_defaultheight; ?>" id="<?php echo self::$opt_defaultheight; ?>" value="<?php echo esc_attr(trim($all[self::$opt_defaultheight])); ?>" class="textinput" style="width: 50px;">
                                </span>

                                <label for="<?php echo self::$opt_defaultdims; ?>"><?php _e('<b class="chktitle">Default Dimensions:</b> Make your videos have a default size. (NOTE: Checking the responsive option will override this size setting) ') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_responsive; ?>" id="<?php echo self::$opt_responsive; ?>" <?php checked($all[self::$opt_responsive], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_responsive; ?>"><?php _e('<b class="chktitle">Responsive Video Sizing:</b> Make your videos responsive so that they dynamically fit in all screen sizes (smart phone, PC and tablet). NOTE: While this is checked, any custom hardcoded widths and heights you may have set will dynamically change too. <b>Do not check this if your theme already handles responsive video sizing.</b>') ?></label>
                            <div id="boxresponsive_all">
                                <input type="radio" name="<?php echo self::$opt_responsive_all; ?>" id="<?php echo self::$opt_responsive_all; ?>1" value="1" <?php checked($all[self::$opt_responsive_all], 1); ?> >
                                <label for="<?php echo self::$opt_responsive_all; ?>1">Responsive for all YouTube videos</label> &nbsp;&nbsp;
                                <input type="radio" name="<?php echo self::$opt_responsive_all; ?>" id="<?php echo self::$opt_responsive_all; ?>0" value="0" <?php checked($all[self::$opt_responsive_all], 0); ?> >
                                <label for="<?php echo self::$opt_responsive_all; ?>0">Responsive for only videos embedded via this plugin</label>
                            </div>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_widgetfit; ?>" id="<?php echo self::$opt_widgetfit; ?>" <?php checked($all[self::$opt_widgetfit], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_widgetfit; ?>"><?php _e('<b class="chktitle">Autofit Widget Videos:</b> Make each video that you embed in a widget area automatically fit the width of its container.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_playsinline; ?>" id="<?php echo self::$opt_playsinline; ?>" <?php checked($all[self::$opt_playsinline], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_playsinline; ?>">
                                    <b class="chktitle">iOS Playback:</b> Check this to allow your embeds to play inline within your page when viewed on iOS (iPhone and iPad) browsers. Uncheck it to have iOS launch your embeds in fullscreen instead.
                                    <em>Disclaimer: YouTube/Google has issues with this iOS related parameter, but we are providing it here in the event that they support it consistently.</em>
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_origin; ?>" id="<?php echo self::$opt_origin; ?>" <?php checked($all[self::$opt_origin], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_origin; ?>"><b class="chktitle">Extra Player Security: </b>
                                    Add site origin information with each embed code as an extra security measure. In YouTube's/Google's own words, checking this option "protects against malicious third-party JavaScript being injected into your page and hijacking control of your YouTube player." We especially recommend checking it as it adds higher security than the built-in YouTube embedding method that comes with the current version of WordPress (i.e. oembed).
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_controls; ?>" id="<?php echo self::$opt_controls; ?>" <?php checked($all[self::$opt_controls], 2); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_controls; ?>"><b class="chktitle">Show Controls:</b> Show the player's control bar. Unchecking this option creates a cleaner look but limits what your viewers can control (play position, volume, etc.).</label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_defaultvol; ?>" id="<?php echo self::$opt_defaultvol; ?>" <?php checked($all[self::$opt_defaultvol], 1); ?> type="checkbox" class="checkbox">                        
                                <label for="<?php echo self::$opt_defaultvol; ?>">
                                    <b class="chktitle">Volume Initialization: </b>
                                    Set an initial volume level for all of your embedded videos.  Check this and you'll see a <span class="vol-seeslider">slider</span> <span class="vol-seetextbox">textbox</span> for setting the start volume to a value between 0 (mute) and 100 (max) percent.  Leaving it unchecked means you want the visitor's default behavior.  This feature is experimental and is less predictable on a page with more than one embed. Read more about why you might want to <a href="<?php echo self::$epbase ?>/mute-volume-youtube-wordpress.aspx" target="_blank">initialize YouTube embed volume here &raquo;</a>
                                </label>
                                <span id="boxdefaultvol">
                                    Volume: <span class="vol-output"></span> <input min="0" max="100" step="1" type="text" name="<?php echo self::$opt_vol; ?>" id="<?php echo self::$opt_vol; ?>" value="<?php echo esc_attr(trim($all[self::$opt_vol])); ?>" >
                                </span>
                            </p>

                            <p>
                                <input name="<?php echo self::$opt_cc_load_policy; ?>" id="<?php echo self::$opt_cc_load_policy; ?>" <?php checked($all[self::$opt_cc_load_policy], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_cc_load_policy; ?>"><?php _e('<b class="chktitle">Closed Captions:</b> Turn on closed captions by default.') ?></label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_dohl; ?>" id="<?php echo self::$opt_dohl; ?>" <?php checked($all[self::$opt_dohl], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_dohl; ?>"><b class="chktitle">Player Localization / Internationalization: </b>
                                    Automatically detect your site's default language (using get_locale) and set your YouTube embeds interface language so that it matches. Specifically, this will set the player's tooltips and caption track if your language is natively supported by YouTube. We suggest checking this if English is not your site's default language.  <a href="<?php echo self::$epbase ?>/youtube-iso-639-1-language-codes.aspx" target="_blank">See here for more details &raquo;</a></label>
                            </p>                    
                            <p>
                                <input name="<?php echo self::$opt_playlistorder; ?>" id="<?php echo self::$opt_playlistorder; ?>" <?php checked($all[self::$opt_playlistorder], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_playlistorder; ?>">
                                    <b class="chktitle">Self-contained Playlist Ordering:</b> 
                                    Note: This option does <strong class="orange">NOT</strong> apply to galleries. It applies only to these kinds of <em>self-contained playlists</em> (Example: <a target="_blank" href="https://www.youtube.com/watch?v=J50PlRZHH9I&t=3m20s">https://www.youtube.com/watch?v=J50PlRZHH9I&t=3m20s</a>).
                                    If you're trying to control the order of a <em>gallery</em> instead, then you must be the owner of the playlist, go to YouTube.com, and reorder it there. This plugin can only order a <em>gallery</em> the way the owner ordered the source playlist.
                                    Check this option if you just want your <em>self-contained playlists</em> to begin with the latest added video by default. (Unchecking this will force playlists to always start with your selected specific video, even if you add videos to the playlist later).
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_onboarded; ?>" id="<?php echo self::$opt_onboarded; ?>" <?php checked($all[self::$opt_onboarded], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_onboarded; ?>">
                                    <b class="chktitle">Hide Quick Setup Guide:</b>
                                    Check this to hide the installation setup wizard when this page loads.
                                </label>
                            </p>
                            <p class="<?php echo self::vi_logged_in() || !empty($all[self::$opt_vi_active]) ? 'hidden' : '' ?>">
                                <input name="<?php echo self::$opt_vi_hide_monetize_tab; ?>" id="<?php echo self::$opt_vi_hide_monetize_tab; ?>" <?php checked($all[self::$opt_vi_hide_monetize_tab], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_vi_hide_monetize_tab; ?>"><b class="chktitle">Hide "Monetize" Feature:</b> Hide the tab(s) that allow you earn money embedding videos from video intelligence (after saving this option, please refresh this page again).</label>
                            </p>
                            <p id="not_live_content_scroll">
                                <label for="<?php echo self::$opt_not_live_content; ?>">
                                    <b class="chktitle">Default "Not Live" Content:</b>
                                    When your channel is not streaming live, the YouTube live player will be inactive.
                                    Instead of showing that player, you can display some "coming soon" content in that space for your visitors to see until your channel begins to live stream. 
                                    The plugin will automatically switch to your channel's live stream once it's active.
                                    Below, enter what you would like to appear until then. <strong><span class="orange">NOTE:</span> Do not put another live stream embed below.</strong>
                                    <?php
                                    if (self::vi_logged_in())
                                    {
                                        ?>
                                        One new option is to embed a quality video advertisement so that you can get gain revenue during times when your live stream is not active.  Simply click the "$ Video Ad" button below to enter the proper shortcode and the plugin will manage the rest.
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        One new option is to earn money from that inactive space by embedding a quality video advertisement containing content that matches your site's topics. <a href="#jumpmonetize" class="epyt-jumptab">Learn more and activate it here &raquo;</a>
                                        <?php
                                    }
                                    ?>
                                    If you just want to show the standard countdown player that YouTube provides, just leave the below empty and save.
                                </label>
                                <?php
                                wp_editor(wp_kses_post($all[self::$opt_not_live_content]), self::$opt_not_live_content, array('textarea_rows' => 7));
                                ?> 
                            </p>


                        </div>

                    </section>
                    <section class="pattern" id="jumpprivacy">                            
                        <h2>Privacy Options</h2>
                        <p>These options may help with privacy restrictions such as GDPR and the EU Cookie Law.</p>
                        <div class="ytindent chx">
                            <p>
                                <b class="chktitle">YouTube API Loading:</b> Choose when to load the YouTube API. The "Restricted" or "Never" options will help with GDPR compliance:
                            <ul class="indent-option">
                                <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="light" <?php checked($all[self::$opt_ytapi_load], 'light'); ?> /> <em>Restricted</em> - (Recommended) Only load the API on pages that have a YouTube video.</label></li>
                                <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="never" <?php checked($all[self::$opt_ytapi_load], 'never'); ?> /> <em>Never</em> - Do not load the YouTube API. Note: The "Never" choice may break a few features such as Volume Initialization and Gallery Continuous/Auto Play.</label></li>
                                <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="always" <?php checked($all[self::$opt_ytapi_load], 'always'); ?> /> <em>Always</em> - Load the API on all pages. In most cases, the "Always" choice is not necessary.</label></li>
                            </ul>
                            </p>


                            <p>
                                <input name="<?php echo self::$opt_gdpr_consent; ?>" id="<?php echo self::$opt_gdpr_consent; ?>" <?php checked($all[self::$opt_gdpr_consent], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gdpr_consent; ?>">
                                    <b class="chktitle">Privacy/GDPR - Show Consent Message:</b> Ask for consent before loading YouTube content. A message will be displayed in place of the YouTube video, as shown in the screenshot below. Once the visitor approves consent, the YouTube content will load. You can customize the message text and the button text in the next 2 options.
                                    See this feature demonstrated in <a href="https://www.youtube.com/watch?v=lm_HIic6obw" target="_blank">this video</a>.
                                </label>
                                <span id="box_gdpr_consent">
                                    Note: If your visitors click a red accept button but your site doesn't reveal the video, you probably have a caching plugin. There should be a setting in your caching plugin to prevent caching the consent cookie. The name of the consent cookie is: <code>ytprefs_gdpr_consent</code>
                                </span>
                            </p>

                            <p>
                                <label for="<?php echo self::$opt_gdpr_consent_message; ?>">
                                    <b class="chktitle">Privacy/GDPR - Consent Message Text:</b>
                                    Below you can customize the message that will appear to visitors before they accept YouTube content:
                                </label>
                            <div class="clearboth"></div>
                            <div class="gdpr-options-left">
                                <?php
                                wp_editor(wp_kses_post($all[self::$opt_gdpr_consent_message]), self::$opt_gdpr_consent_message, array(
                                    'textarea_rows' => 22,
                                    'media_buttons' => false,
                                    'teeny' => true
                                ));
                                ?> 
                            </div>
                            <div class="gdpr-options-right">
                                <p><em>Example of message and button:</em></p>

                                <img src="<?php echo plugins_url('images/ss-gdpr-message.png', __FILE__) ?>" alt="GDPR Consent Message Example" class="img-gdpr-message" />
                            </div>

                            </p>
                            <div class="clearboth"></div>
                            <p>
                                <label for="<?php echo self::$opt_gdpr_consent_button; ?>">
                                    <b class="chktitle">Privacy/GDPR - Consent Button Text:</b>
                                    This is the text for the red "Accept" button that appears with the above privacy/GDPR message:
                                </label>
                                <br>
                                <input type="text" placeholder="Example: Accept YouTube Content" name="<?php echo self::$opt_gdpr_consent_button; ?>" id="<?php echo self::$opt_gdpr_consent_button; ?>" value="<?php echo esc_attr(trim($all[self::$opt_gdpr_consent_button])); ?>" class="textinput regular-text"/>
                            </p>

                            <p>
                                <input name="<?php echo self::$opt_nocookie; ?>" id="<?php echo self::$opt_nocookie; ?>" <?php checked($all[self::$opt_nocookie], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_nocookie; ?>">
                                    <b class="chktitle">No Cookies:</b> Prevent YouTube from leaving tracking cookies on your visitors browsers unless they actual play the videos. This is coded to apply this behavior on links in your past post as well.
                                    <span id="boxnocookie">
                                        Checking this option may break some features such as galleries and playlists. Furthermore, videos on mobile devices may have problems if you leave this checked.
                                    </span>
                                </label>
                            </p>
                        </div>
                    </section>

                    <section class="pattern" id="jumpwiz">
                        <h2>Visual YouTube Wizard Directions</h2>
                        <p>
                            While you're writing your post or page, you have the ability to search YouTube and insert videos, playlists, and even galleries right from your editor. Below are directions for each type of WordPress editor.
                        </p>
                        <h3>Classic Editor</h3>
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/ss-wiz-classic.png', __FILE__) ?>">
                        <p>
                            Simply click the YouTube wizard button found above 
                            your post editor to start the wizard (see image to the right to locate this button).  There, you'll have several options for different types of embeds.
                            Each embed code will have an "Insert Into Editor" button that you can click to directly embed the desired video link to your post without having to copy and paste.
                        </p>
                        <hr class="clearboth">
                        <h3>Widgets</h3>
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/ss-wiz-widget.png', __FILE__) ?>">
                        <p>
                            To insert a video in a widget area, use the Text widget that comes with WordPress. Simply click the YouTube wizard button found above 
                            the widget textbox to start the wizard (see image to the right to locate this button).  There, you'll have several options for different types of embeds.
                            Each embed code will have an "Insert Into Editor" button that you can click to directly embed the desired video link to your post without having to copy and paste.
                        </p>
                        <hr class="clearboth"/>
                        <h3>Gutenberg Block Editor</h3>
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/ss-wiz-gbblock.png', __FILE__) ?>">
                        <p>
                            Click on the (+) sign for the block editor list. The YouTube Wizard block is located under the "Embeds" category (make sure you choose "YouTube <strong>Wizard</strong>" not "YouTube").
                            Then your page will show a placeholder where you can launch the wizard. In the wizard, you'll have several options for different types of embeds.
                            Each embed code will have an "Insert Into Editor" button that you can click to directly embed the desired video link to your post without having to copy and paste.
                            You'll also be able to preview and interact with your embed without having to view the page on the front end.
                        </p>
                        <hr class="clearboth"/>
                        <h3>Gutenberg Classic Block</h3>
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/ss-wiz-gbclassicblock.png', __FILE__) ?>">
                        <p>
                            Are you using Gutenberg but not quite ready to start using all the blocks? Well, you can still access our wizard if you wish to continue using Gutenberg's Classic block.
                            The Classic block brings back the former editor you used before WordPress, and so we've added a button to it you can use to launch the wizard (see example on the right).
                            Simply click the  wizard button to start the wizard. There, you'll have several options for different types of embeds.
                            Each embed code will have an "Insert Into Editor" button that you can click to directly embed the desired video link to your post without having to copy and paste.
                        </p>
                        <hr class="clearboth"/>
                        <h3>Pro Customization</h3>
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/ssprowizard.png', __FILE__) ?>">
                        <p>
                            <a href="<?php echo self::$epbase ?>/dashboard/pro-easy-video-analytics.aspx?ref=wizdirections" target="_blank"><b>Even more options are available to PRO users, no matter which editor you choose!</b></a>
                            Simply click the "Customize" button in the wizard to further personalize each of your embeds without having to manually add special codes yourself. 
                            The customize button will allow you to easily override most of the above default options for that embed.
                        </p>
                    </section>

                    <section class="pattern" id="jumpgallery">
                        <h2>Gallery Settings and Directions</h2>
                        <img class="ssgallery" src="<?php echo plugins_url('images/ssgallery.png', __FILE__) ?>">
                        <p>
                            <a target="_blank" href="<?php echo self::$epbase ?>/responsive-youtube-playlist-channel-gallery-for-wordpress.aspx">You can now make playlist embeds (and channel-playlist embeds) have a gallery layout &raquo;</a>. <strong>First, you must obtain your YouTube API key</strong>. 
                            Don't worry, it's an easy process. Just <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">click this link &raquo;</a> and follow the video on that page to get your server API key. Since Google updates their API Key generation directions frequently, follow the general steps shown in the video.
                            Then paste your API key in the "API Key" tab, and click the "Save Changes" button.
                        </p>

                        <p>
                            Below are the global settings for galleries. If you want each of your galleries to have custom settings, <a href="<?php echo self::$epbase ?>/dashboard/pro-easy-video-analytics.aspx?ref=galleryglobal" target="_blank">go PRO</a> for more options:
                        </p>
                        <div class="ytindent chx">

                            <p>
                                <label for="<?php echo self::$opt_gallery_pagesize; ?>"><b class="chktitle">Gallery Page Size:</b></label>
                                <select name="<?php echo self::$opt_gallery_pagesize; ?>" id="<?php echo self::$opt_gallery_pagesize; ?>" style="width: 60px;">
                                    <?php
                                    $gps_val = intval(trim($all[self::$opt_gallery_pagesize]));
                                    $gps_val = min($gps_val, 50);
                                    for ($gps = 1; $gps <= 50; $gps++)
                                    {
                                        ?><option <?php echo $gps_val == $gps ? 'selected' : '' ?> value="<?php echo $gps ?>"><?php echo $gps ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                Enter how many thumbnails per page should be shown at once (YouTube allows a maximum of 50 per page).
                            </p>
                            <p>
                                <label for="<?php echo self::$opt_gallery_columns; ?>"><b class="chktitle">Number of Columns:</b></label>
                                <input name="<?php echo self::$opt_gallery_columns; ?>" id="<?php echo self::$opt_gallery_columns; ?>" type="number" class="textinput" style="width: 60px;" value="<?php echo esc_attr(trim($all[self::$opt_gallery_columns])); ?>">                        
                                Enter how many thumbnails can fit per row.
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_collapse_grid; ?>" id="<?php echo self::$opt_gallery_collapse_grid; ?>" <?php checked($all[self::$opt_gallery_collapse_grid], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_collapse_grid; ?>">
                                    <b class="chktitle">Stack Thumbnails for Mobile:</b> Check this option to responsively stack thumbnails on smaller screens, for the grid layout.
                                </label>
                                <span id="box_collapse_grid">
                                    <?php
                                    foreach ($all[self::$opt_gallery_collapse_grid_breaks] as $idx => $bpts)
                                    {
                                        ?>
                                        On screens up to
                                        <input type="number" name="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][bp][max]'; ?>"
                                               id="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][bp][max]'; ?>" 
                                               value="<?php echo intval(trim($bpts['bp']['max'])); ?>" class="textinput" style="width: 70px;">px wide, stack thumbnails to 1 column.
                                        <input type="hidden" name="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][cols]'; ?>"
                                               id="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][cols]'; ?>"
                                               value="<?php echo intval(trim($bpts['cols'])); ?>">
                                        <input type="hidden" name="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][bp][min]'; ?>"
                                               id="<?php echo self::$opt_gallery_collapse_grid_breaks . '[' . $idx . '][bp][min]'; ?>"
                                               value="<?php echo intval(trim($bpts['bp']['min'])); ?>">
                                               <?php
                                           }
                                           ?>
                                    <span class="smallnote grey pad20"><br>Note: a common mobile screen width is 767 pixels.</span>
                                </span>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_showpaging; ?>" id="<?php echo self::$opt_gallery_showpaging; ?>" <?php checked($all[self::$opt_gallery_showpaging], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_showpaging; ?>"><b class="chktitle">Show Pagination:</b> Show the Next/Previous buttons and page numbering.
                                    It might be useful to hide pagination if you want your gallery to display just a subset of videos from a playlist or channel.  That is, only the first page of videos (defined by your page size) will be visible to your visitors if these buttons are hidden.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_customarrows; ?>" id="<?php echo self::$opt_gallery_customarrows; ?>" <?php checked($all[self::$opt_gallery_customarrows], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_customarrows; ?>">
                                    <b class="chktitle">Custom Next/Previous Text:</b> If you want your gallery viewers to see something besides "Next" and "Prev" when browsing through thumbnails, enter your replacement text here. This feature can be quite useful for non-English sites.  For example, a French site might replace Prev with Pr&eacute;c&eacute;dent  and Next with Suivant.
                                </label>
                                <span id="boxcustomarrows">
                                    Previous Page: <input type="text" name="<?php echo self::$opt_gallery_customprev; ?>" id="<?php echo self::$opt_gallery_customprev; ?>" value="<?php echo esc_attr(trim($all[self::$opt_gallery_customprev])); ?>" class="textinput" style="width: 100px;"> &nbsp;
                                    Next Page: <input type="text" name="<?php echo self::$opt_gallery_customnext; ?>" id="<?php echo self::$opt_gallery_customnext; ?>" value="<?php echo esc_attr(trim($all[self::$opt_gallery_customnext])); ?>" class="textinput" style="width: 100px;">
                                </span>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_channelsub; ?>" id="<?php echo self::$opt_gallery_channelsub; ?>" <?php checked($all[self::$opt_gallery_channelsub], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_channelsub; ?>">
                                    <b class="chktitle">Show Subscribe Button: </b> Are you the channel owner for all your galleries? Check this box to add a "Subscribe" button to all your galleries as shown below.  This might help you convert your site's visitors to YouTube subscribers of your channel.
                                </label>
                                <span id="boxchannelsub">
                                    Paste Channel URL: <input type="text" placeholder="Example: https://www.youtube.com/user/YourChannel" name="<?php echo self::$opt_gallery_channelsublink; ?>" id="<?php echo self::$opt_gallery_channelsublink; ?>" value="<?php echo esc_url(trim($all[self::$opt_gallery_channelsublink])); ?>" class="textinput regular-text"> &nbsp;
                                    Button text: <input type="text" name="<?php echo self::$opt_gallery_channelsubtext; ?>" id="<?php echo self::$opt_gallery_channelsubtext; ?>" value="<?php echo esc_attr(trim($all[self::$opt_gallery_channelsubtext])); ?>" class="textinput" style="width: 200px;">
                                </span>
                            </p>
                            <p><img class="sssubscribe" src="<?php echo plugins_url('images/sssubscribe.png', __FILE__) ?>"></p>

                            <p>
                                <label for="<?php echo self::$opt_gallery_scrolloffset; ?>"><b class="chktitle">Scroll Offset:</b></label>
                                <input name="<?php echo self::$opt_gallery_scrolloffset; ?>" id="<?php echo self::$opt_gallery_scrolloffset; ?>" type="number" class="textinput" style="width: 60px;" value="<?php echo esc_attr(trim($all[self::$opt_gallery_scrolloffset])); ?>">
                                After you click on a thumbnail, the gallery will automatically smooth scroll up to the actual player. If you need it to scroll a few pixels further, increase this number.
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_showtitle; ?>" id="<?php echo self::$opt_gallery_showtitle; ?>" <?php checked($all[self::$opt_gallery_showtitle], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_showtitle; ?>"><b class="chktitle">Show Thumbnail Title:</b> Show titles with each thumbnail.</label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_hideprivate; ?>" id="<?php echo self::$opt_gallery_hideprivate; ?>" <?php checked($all[self::$opt_gallery_hideprivate], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_hideprivate; ?>"><b class="chktitle">Hide Private Thumbnails:</b> Hide thumbnails for videos in a playlist that cannot be embedded yet. Note: This may make some page sizes look uneven.</label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_autonext; ?>" id="<?php echo self::$opt_gallery_autonext; ?>" <?php checked($all[self::$opt_gallery_autonext], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_autonext; ?>"><b class="chktitle">Automatic Continuous Play:</b>  Automatically play the next video in the gallery as soon as the current video finished.
                                    <strong>Note:</strong> If you're embedding videos from your own monetized YouTube channel, we advise you to read YouTube's resource page on ads on embedded videos:
                                    <a href="https://support.google.com/youtube/answer/132596?hl=en" target="_blank">https://support.google.com/youtube/answer/132596?hl=en</a>
                                    You'll see that videos that you want to monetize "should be embedded using the standard click-to-play embed and NOT a scripted play."
                                    Unchecking this option guarantees standard click-to-play gallery embedding.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_gallery_thumbplay; ?>" id="<?php echo self::$opt_gallery_thumbplay; ?>" <?php checked($all[self::$opt_gallery_thumbplay], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gallery_thumbplay; ?>"><b class="chktitle">Thumbnail Click Plays Video:</b>
                                    Clicking on a gallery thumbnail autoplays the video. Uncheck this and visitors must also click the video's play button after clicking the thumbnail
                                    (uncheck this option for standard click-to-play gallery embedding).
                                </label>
                            </p>
                            <div class="pad20">
                                <p>
                                    Ready to get started with an actual gallery?  Just click the plugin wizard button and pick your desired gallery embedding choice.
                                </p>
                                <p><img class="sswizardbutton" src="<?php echo plugins_url('images/sswizardbutton.jpg', __FILE__) ?>"></p>
                            </div>
                        </div>
                    </section>
                    <?php
                    if (!(bool) (self::$alloptions[self::$opt_vi_hide_monetize_tab]))
                    {
                        ?>
                        <section class="pattern" id="jumpmonetize">

                            <?php
                            //self::vi_monetize_title();
                            if (self::vi_script_setup_done())
                            {
                                echo '<h2>';
                                self::vi_print_toggle_button();
                                echo '</h2>';
                            }
                            ?>

                            <?php
                            if (!self::vi_logged_in())
                            {
                                echo '<div class="vi-registration-box">';
                                include_once(EPYTVI_INCLUDES_PATH . 'vi_registration_form.php');
                                include_once(EPYTVI_INCLUDES_PATH . 'vi_login_success.php');
                                echo '</div>';
                            }
                            else
                            {
                                include_once(EPYTVI_INCLUDES_PATH . 'vi_login_complete.php');
                            }
                            ?>
                        </section>
                    <?php } ?>
                    <section class="pattern" id="jumpcompat">
                        <h2>Compatibility Settings</h2>
                        <p>
                            With tens of thousands of active users, our plugin may not work with every plugin out there. Below are some settings you may wish to try out. 
                        </p>
                        <div class="ytindent chx">
                            <p>
                                <input name="<?php echo self::$opt_old_script_method; ?>" id="<?php echo self::$opt_old_script_method; ?>" <?php checked($all[self::$opt_old_script_method], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_old_script_method; ?>">
                                    <b class="chktitle">Use Legacy Scripts: </b>
                                    This is a legacy option for users with theme issues that require backwards compatibility (v.10.5 or earlier). It may also help with caching plugin or CDN plugin issues.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_admin_off_scripts; ?>" id="<?php echo self::$opt_admin_off_scripts; ?>" <?php checked($all[self::$opt_admin_off_scripts], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_admin_off_scripts; ?>">
                                    <b class="chktitle">Turn Off Scripts While Editing: </b>
                                    Front-end editors and visual pagebuilders often run Javascript while you're in edit mode. Check this to turn off this plugin's Javascript during edit mode, if you see conflicts.
                                    Don't worry, all other visitors to your site will still view your site normally.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_migrate; ?>" id="<?php echo self::$opt_migrate; ?>" <?php checked($all[self::$opt_migrate], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_migrate; ?>">
                                    <b class="chktitle">Migrate Shortcodes: </b> Inherit shortcodes from other plugins. This is useful for when a plugin becomes deprecated, or you simply prefer this plugin's features.
                                </label>
                            <div id="boxmigratelist">
                                <ul>
                                    <li><input name="<?php echo self::$opt_migrate_embedplusvideo; ?>" id="<?php echo self::$opt_migrate_embedplusvideo; ?>" <?php checked($all[self::$opt_migrate_embedplusvideo], 1); ?> type="checkbox" class="checkbox"><label for="<?php echo self::$opt_migrate_embedplusvideo; ?>"><b>"YouTube Advanced Embed":</b>   <code>[embedplusvideo]</code> shortcode</label></li>
                                    <li><input name="<?php echo self::$opt_migrate_youtube; ?>" id="<?php echo self::$opt_migrate_youtube; ?>" <?php checked($all[self::$opt_migrate_youtube], 1); ?> type="checkbox" class="checkbox"><label for="<?php echo self::$opt_migrate_youtube; ?>"><b>"YouTube Embed":</b> <code>[youtube]</code> and <code>[youtube_video]</code> shortcodes</label></li>
                                    <li class="smallnote orange" style="list-style: none;">This feature is beta. More shortcodes coming.</li>
                                </ul>

                            </div>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_oldspacing; ?>" id="<?php echo self::$opt_oldspacing; ?>" <?php checked($all[self::$opt_oldspacing], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_oldspacing; ?>">
                                    <b class="chktitle">Legacy Spacing:</b> Continue the spacing style from version 4.0 and older. Those versions required you to manually add spacing above and below your video. Unchecking this will automatically add the spacing.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_frontend_only; ?>" id="<?php echo self::$opt_frontend_only; ?>" <?php checked($all[self::$opt_frontend_only], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_frontend_only; ?>">
                                    <b class="chktitle">Don't Run Shortcode In Admin:</b> <sup class="orange">new</sup> 
                                    Checking this will only allow the shortcode to run on the front-end of your website, and not in the admin area.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_evselector_light; ?>" id="<?php echo self::$opt_evselector_light; ?>" <?php checked($all[self::$opt_evselector_light], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_evselector_light; ?>">
                                    <b class="chktitle">Theme Video Problems: </b> 
                                    Check this option if you're having issues with autoplayed videos or background videos etc. that have been generated by your theme.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_stop_mobile_buffer; ?>" id="<?php echo self::$opt_stop_mobile_buffer; ?>" <?php checked($all[self::$opt_stop_mobile_buffer], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_stop_mobile_buffer; ?>">
                                    <b class="chktitle">Mobile Autoplay Problems: </b> 
                                    Autoplay works for desktop, but mobile devices don't allow autoplay due to network carrier data charges. For mobile devices, this option may help the player to properly display the video for the visitor to click on.
                                    (<strong>Note:</strong> Desktop browsers like Chrome and Safari are moving towards preventing autoplay for any video. So this general feature may be deprecated by most browsers in the near future)
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_ajax_compat; ?>" id="<?php echo self::$opt_ajax_compat; ?>" <?php checked($all[self::$opt_ajax_compat], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_ajax_compat; ?>">
                                    <b class="chktitle">Ajax Theme:</b>
                                    If you have a theme that loads pages with AJAX transitions, try checking this option.
                                </label>
                            </p>
                            <p>
                                <input name="<?php echo self::$opt_debugmode; ?>" id="<?php echo self::$opt_debugmode; ?>" <?php checked($all[self::$opt_debugmode], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_debugmode; ?>">
                                    <b class="chktitle">Debug Mode: </b> If you ask for support, we may ask you to turn on debug mode here.
                                    It may print out some diagnostic info so that we can help you solve your issue. 
                                </label>
                            </p>

                        </div>


                    </section>
                    <section class="pattern" id="jumphowto">
                        <h2>Manual Embedding</h2>
                        <p>
                            <strong>We recommend using the wizard in your editor to embed.</strong> However, if you choose to manually embed code, follow the instructions below.
                        </p>
                        <h3>
                            Manually Embed a YouTube Video or Playlist &nbsp; <a class="smallnote" href="#jumpgallery">(For gallery directions, go here &raquo;)</a>
                        </h3>
                        <p>
                            <b>For videos:</b> <i>Method 1 - </i> Do you already have a URL to the video you want to embed in a post, page, or even a widget? All you have to do is paste it on its own line, as shown below (including the https:// part). Easy, eh?<br>
                            <i>Method 2 - </i> If you want to do some formatting (e.g. add HTML to center a video) or have two or more videos next to each other on the same line, wrap each link with the <code>[embedyt]...[/embedyt]</code> shortcode. <b>Tip for embedding videos on the same line:</b> As shown in the example image below, decrease the size of each video so that they fit together on the same line (See the "How To Override Defaults" section for height and width instructions).
                        </p>
                        <p>
                            <b>For galleries:</b> <a href="#jumpgallery">Click here</a> to scroll down to gallery settings and directions.
                        </p>
                        <p>
                            <b>For self-contained playlists:</b> Go to the page for the playlist that lists all of its videos (<a target="_blank" href="http://www.youtube.com/playlist?list=PL70DEC2B0568B5469">Example &raquo;</a>). Click on the video that you want the playlist to start with. Copy and paste that browser URL into your blog on its own line. If you want the first video to always be the latest video in your playlist, check the option "Playlist Ordering" in the settings down below (you will also see this option available if you use the Pro Wizard). If you want to have two or more playlists next to each other on the same line, wrap each link with the <code>[embedyt]...[/embedyt]</code> shortcode.
                        </p>                
                        <p>
                            <b>For self-contained channel playlists:</b> At your editor, click on the <img style="vertical-align: text-bottom;" src="<?php echo plugins_url('images/wizbuttonbig.png', __FILE__) ?>"> wizard button and choose the option <i>Search for a video or channel to insert in my editor.</i> Then, click on the <i>channel playlist</i> option there (instead of <i>single video</i>). Search for the channel username and follow the rest of the directions there.
                        </p>
                        <p>
                            <strong>For directly embedding in your theme with PHP:</strong>
                            If you need to use PHP directly, we still recommend using the wizard to create the shortcode--but instead of pressing the "Insert" button, just copy the shortcode the wizard gives you. Then use the <code>do_shortcode()</code> function in your theme, like this:
                            <br>
                            <code>&lt;?php echo do_shortcode('[embedyt]....[/embedyt]'); ?&gt;</code>
                        </p>
                        <p>
                            <b>For video ads:</b> First sign up with <a target="_blank" href="<?php echo admin_url('admin.php?page=youtube-ep-vi') ?>">video intelligence</a>.  Once you're approved and logged in, you can use the following short code to display revenue-generating video ads on your site: <code>[embed-vi-ad]</code>.
                        </p>
                        <p>
                            <b>Examples:</b><br><br>
                            <img style="width: 900px; height: auto;" class="shadow" src="<?php echo plugins_url('images/sshowto.png', __FILE__) ?>" />
                        </p>
                        <p>
                            Always follow these rules for any URL:
                        </p>
                        <ul class="reglist">
                            <li>Make sure the URL is really on its own line by itself. Or, if you need multiple videos on the same line, make sure each URL is wrapped properly with the shortcode (Example:  <code>[embedyt]http://www.youtube.com/watch?v=ABCDEFGHIJK&width=400&height=250[/embedyt]</code>)</li>
                            <li>Make sure the URL is <strong>not</strong> an active hyperlink (i.e., it should just be plain text). Otherwise, highlight the URL and click the "unlink" button in your editor: <img src="<?php echo plugins_url('images/unlink.png', __FILE__) ?>"/></li>
                            <li>Make sure you did <strong>not</strong> format or align the URL in any way. If your URL still appears in your actual post instead of a video, highlight it and click the "remove formatting" button (formatting can be invisible sometimes): <img src="<?php echo plugins_url('images/erase.png', __FILE__) ?>"/></li>
                            <li>If you really want to align the video, try wrapping the link with the shortcode first. For example: <code>[embedyt]http://www.youtube.com/watch?v=ABCDEFGHIJK[/embedyt]</code> Using the shortcode also allows you to have two or more videos next to each other on the same line.  Just put the shortcoded links together on the same line. For example:<br>
                                <code>[embedyt]http://www.youtube.com/watch?v=ABCDEF[/embedyt] [embedyt]http://www.youtube.com/watch?v=GHIJK[/embedyt]</code>
                            </li>
                        </ul>       


                        <h3>
                            <?php _e("How To Manually Override Defaults / Other Options") ?>
                        </h3>
                        <p>
                            Suppose you have a few videos that need to be different from the above defaults. You can add options to the end of a link as displayed below to override the above defaults. Each option should begin with '&'.
                            <br><span class="orange">PRO users: You can use the big <a href="<?php echo self::$epbase . '/dashboard/pro-easy-video-analytics.aspx?ref=manual' ?>" target="_blank">customize</a> buttons that you will see inside the wizard, instead of memorizing the following codes.</span>
                        </p>
                        <?php
                        _e('<ul class="reglist">');
                        _e("<li><strong>width</strong> - Sets the width of your player. If omitted, the default width will be the width of your theme's content.<em> Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&width=500</strong>&height=350</em></li>");
                        _e("<li><strong>height</strong> - Sets the height of your player. <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA&width=500<strong>&height=350</strong></em> </li>");
                        _e("<li><strong>autoplay</strong> - Set this to 1 to autoplay the video (or 0 to play the video once). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&autoplay=1</strong></em> (Note: Desktop browsers like Chrome and Safari are moving towards preventing autoplay for any video. So this general feature may be deprecated by most browsers in the near future) </li>");
                        _e("<li><strong>cc_load_policy</strong> - Set this to 1 to turn on closed captioning (or 0 to leave them off). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&cc_load_policy=1</strong></em> </li>");
                        _e("<li><strong>iv_load_policy</strong> - Set this to 3 to turn off annotations (or 1 to show them). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&iv_load_policy=3</strong></em> </li>");
                        _e("<li><strong>loop</strong> - Set this to 1 to loop the video (or 0 to not loop). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&loop=1</strong></em> </li>");
                        _e("<li><strong>modestbranding</strong> - Set this to 1 to remove the YouTube logo while playing (or 0 to show the logo). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&modestbranding=1</strong></em> </li>");
                        _e("<li><strong>rel</strong> - Set this to 0 to not show related videos at the end of playing (or 1 to show them). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&rel=0</strong></em> </li>");
                        _e("<li><strong>showinfo</strong> - Set this to 0 to hide the video title and other info (or 1 to show it). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&showinfo=0</strong></em> </li>");
                        _e("<li><strong>fs</strong> - Set this to 0 to hide the fullscreen button (or 1 to show it). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&fs=0</strong></em> </li>");
                        _e("<li><strong>color</strong> - Set this to 'white' to make the player have a white progress bar (or 'red' for a red progress bar). Note: Using white will disable the modestbranding option. <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&color=white</strong></em> </li>");
                        _e("<li><strong>controls</strong> - Set this to 0 to completely hide the video controls (or 2 to show it). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&controls=0</strong></em> </li>");
                        _e("<li><strong>playsinline</strong> - Set this to 1 to allow videos play inline with the page on iOS browsers. (Set to 0 to have iOS launch videos in fullscreen instead). <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&playsinline=1</strong></em> </li>");
                        _e("<li><strong>origin</strong> - Set this to 1 to add the 'origin' parameter for extra JavaScript security. <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA<strong>&origin=1</strong></em> </li>");
                        _e('</ul>');

                        _e("<p>You can also start and end each individual video at particular times. Like the above, each option should begin with '&'</p>");
                        _e('<ul class="reglist">');
                        _e("<li><strong>start</strong> - Sets the time (in seconds) to start the video. <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA&width=500&height=350<strong>&start=20</strong></em> </li>");
                        _e("<li><strong>end</strong> - Sets the time (in seconds) to stop the video. <em>Example: http://www.youtube.com/watch?v=quwebVjAEJA&width=500&height=350<strong>&end=100</strong></em> </li>");
                        _e('</ul>');
                        ?>
                    </section>
                    <div class="save-changes-follow"> <?php self::save_changes_button(isset($_POST[$ytprefs_submitted]) && $_POST[$ytprefs_submitted] == 'Y'); ?> </div>
                </form>

                <section class="pattern" id="jumpupgrade">
                    <div class="upgchecks">
                        <h3 class="sect">Want the PRO Features?</h3>
                        <p>
                            Below are descriptions for some of our PRO features for more gallery customization options, faster page loading, enhanced SEO, and more. Simply purchase and install our separate PRO plugin (the PRO plugin automatically works for all your past embed links).
                        </p>
                        <p>
                            <img class="ssaltgallery" src="<?php echo plugins_url('images/ssaltgalleryall.jpg', __FILE__) ?>" />
                            <select disabled>
                                <option value="">Gallery Style</option>
                            </select>
                            <label>
                                <b class="chktitle">Advanced Gallery Customization Options: </b> <span class="pronon">(PRO Users)</span> 
                                Switch from the grid style of the free version to another gallery style. Right now, we provide a vertical (single column) and horizontal (single row) list style as alternatives to the grid, with more designs coming. These current alternatives were inspired by the standard YouTube playlist player's "table of contents," except our gallery's video lists are always visible and shown under the playing video.
                                <a target="_blank" href="<?php echo self::$epbase ?>/responsive-youtube-playlist-channel-gallery-for-wordpress.aspx">Read more here &raquo;</a>
                            </label>
                        </p>

                        <div class="hr"></div>
                        <p>
                            <img class="ssaltgallery" src="<?php echo plugins_url('images/ssverticallayout.png', __FILE__) ?>" />
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Show Gallery Descriptions (for vertical list styling): </b>  <span class="pronon">(PRO Users)</span> 
                                For the vertical list layout, this option will show full video descriptions (taken directly from YouTube.com) with each thumbnail. Note: these descriptions only apply the vertical list layout; other layouts don't have enough room.
                            </label>
                        </p>
                        <div class="hr"></div>
                        <p>
                            <img class="ssaltgallery" src="<?php echo plugins_url('images/ssaltgallerycircles.jpg', __FILE__) ?>" />
                            <select disabled>
                                <option value="">Select Thumbnail Shape</option>
                            </select>
                            <label>
                                <b class="chktitle">Gallery Thumbnail Shape: </b> <span class="pronon">(PRO Users)</span> 
                                Differentiate your gallery by showing different thumbnail shapes.  We currently offer rectangle and circle shapes.
                                <a target="_blank" href="<?php echo self::$epbase ?>/responsive-youtube-playlist-channel-gallery-for-wordpress.aspx">Read more here &raquo;</a>
                            </label>
                        </p>

                        <div class="hr"></div>
                        <p>
                            <img class="sspopupplayer" src="<?php echo plugins_url('images/sspopupplayer.jpg', __FILE__) ?>" />
                            <label>
                                <b class="chktitle">Gallery Video Display Mode: </b> <span class="pronon">(PRO Users)</span>
                                Display your gallery videos simply above the thumbnails (default), or as a popup lightbox. Choosing "popup lightbox" will make your videos lazy-loaded, which will provide some performance benefits since the YouTube player is not initially loaded with your page. It's loaded with a popup only when a user clicks a thumbnail.
                            </label>
                            <br>
                            <input type="radio" disabled> Default &nbsp; <input type="radio" disabled> Popup lightbox
                        </p>

                        <div class="hr"></div>

                        <p>
                            <img class="sshidethumbimg" src="<?php echo plugins_url('images/sshidethumbimg.jpg', __FILE__) ?>" />
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Hide Thumbnail Images:</b> <span class="pronon">(PRO Users)</span> 
                                (For "Grid" and "Vertical List" gallery layouts only) Hide the image for each thumbnail, leaving just the text. This can improve performance when imagery is not important.
                                <a href="<?php echo self::$epbase ?>/responsive-youtube-playlist-channel-gallery-for-wordpress.aspx" target="_blank">See an example here &raquo;</a>
                            </label>
                        </p>

                        <div class="hr"></div>
                        <p>
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Faster Page Loads (Caching): </b>  <span class="pronon">(PRO Users)</span> 
                                Use embed caching to speed up your page loads. By default, WordPress needs to request information from YouTube.com's servers for every video you embed, every time a page is loaded. These data requests can add time to your total page load time. Turn on this feature to cache that data (instead of having to request for the same information every time you load a page). This should then make your pages that have videos load faster.  It's been noted that even small speed ups in page load can help increase visitor engagement, retention, and conversions. Caching also makes galleries run faster.
                            </label>
                        <div class="indent-option">
                            <label>
                                <b class="chktitle">Cache Lifetime (hours): </b> 
                                <input disabled value="24" type="number">
                                Tip: If your pages rarely change, you may wish to set this to a much higher value than 24 hours.
                            </label>
                        </div>
                        </p>
                        <div class="hr"></div>

                        <p>
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Video SEO Tags:</b>  <span class="pronon">(PRO Users)</span> Update your YouTube embeds with Google, Bing, and Yahoo friendly schema markup for videos.
                            </label>
                        </p>
                        <div class="hr"></div>
                        <p>
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Special Lazy-Loading Effects:</b>  <span class="pronon">(PRO Users)</span> 
                                Add eye-catching special effects that will make your YouTube embeds fade in, bounce, flip, pulse, or slide as they lazy load on the screen. Lazy loading can also speed up your page load time. Check this box to select your desired effect. <a target="_blank" href="<?php echo self::$epbase ?>/add-special-effects-to-youtube-embeds-in-wordpress.aspx">Read more here &raquo;</a>
                            </label>
                        </p>
                        <div class="hr"></div>
                        <p>
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Facebook Open Graph Markup:</b> <span class="pronon">(PRO Users)</span>   Include Facebook Open Graph markup with the videos you embed with this plugin.  We follow the guidelines for videos as described here: <a href="https://developers.facebook.com/docs/sharing/webmasters#media" target="_blank">https://developers.facebook.com/docs/sharing/webmasters#media</a>
                            </label>
                        </p>
                        <div class="hr"></div>
                        <p>
                            <img class="ssfb" src="<?php echo plugins_url('images/youtube_thumbnail_sample.jpg', __FILE__) ?>" />
                            <input disabled type="checkbox" class="checkbox">
                            <label>
                                <b class="chktitle">Featured Thumbnail Images:</b>  <span class="pronon">(PRO Users)</span> 
                                Automatically grab the thumbnail image of the first video embedded in each post or page, and use it as the featured image. 
                                All you have to do is click Update on a post or page and the plugin does the rest! 
                                (Example shown on the right) <a target="_blank" href="<?php echo self::$epbase ?>/add-youtube-video-thumbnails-featured-image-wordpress.aspx">Read more here &raquo;</a>
                            </label>
                        </p>
                        <div class="hr"></div>
                        <p>
                            <a href="<?php echo self::$epbase ?>/dashboard/pro-easy-video-analytics.aspx?ref=protabfooter" target="_blank">Purchase and download the PRO plugin to get the above and several other features &raquo;</a>
                        </p>                    
                        <div class="clearboth"></div>
                    </div>

                </section>

                <section class="pattern" id="jumpsupport">
                    <h2>Plugin Support</h2>

                    <div id="nonprosupport">
                        We've found that a common support request has been from users that are pasting video links on single lines, as required, but are not seeing the video embed show up. One of these suggestions is usually the fix:
                        <ul class="reglist">
                            <li>Make sure the URL is really on its own line by itself. Or, if you need multiple videos on the same line, make sure each URL is wrapped properly with the shortcode (Example:  <code>[embedyt]http://www.youtube.com/watch?v=ABCDEFGHIJK&width=400&height=250[/embedyt]</code>)</li>
                            <li>Make sure the URL is not an active hyperlink (i.e., it should just be plain text). Otherwise, highlight the URL and click the "unlink" button in your editor: <img src="<?php echo plugins_url('images/unlink.png', __FILE__) ?>"/>.</li>
                            <li>Make sure you did <strong>not</strong> format or align the URL in any way. If your URL still appears in your actual post instead of a video, highlight it and click the "remove formatting" button (formatting can be invisible sometimes): <img src="<?php echo plugins_url('images/erase.png', __FILE__) ?>"/></li>
                            <li>Try wrapping the URL with the <code>[embedyt]...[/embedyt]</code> shortcode. For example: <code>[embedyt]http://www.youtube.com/watch?v=ABCDEFGHIJK[/embedyt]</code> Using the shortcode also allows you to have two or more videos next to each other on the same line.  Just put the shortcoded links together on the same line. For example:<br>
                                <code>[embedyt]http://www.youtube.com/watch?v=ABCDEF&width=400&height=250[/embedyt] [embedyt]http://www.youtube.com/watch?v=GHIJK&width=400&height=250[/embedyt]</code>
                                <br> TIP: As shown above, decrease the size of each video so that they fit together on the same line (See the "How To Override Defaults" section for height and width instructions)
                            </li>
                            <li>If you upload a new video to a playlist or channel and that video is not yet showing up on a gallery you embedded, you should clear/reset any caching plugins you have. This will force your site to retrieve the freshest version of your playlist and/or channel video listing.  If you don't reset you cache, then you'll have to wait until cache lifetime expires.</li>
                            <li>Finally, there's a slight chance your custom theme is the issue, if you have one. To know for sure, we suggest temporarily switching to one of the default WordPress themes (e.g., "Twenty Fourteen") just to see if your video does appear. If it suddenly works, then your custom theme is the issue. You can switch back when done testing.</li>
                            <li>If your videos always appear full size, try turning off "Responsive video sizing."</li>
                            <li>If none of the above work, you can contact us here if you still have issues: ext@embedplus.com. We'll try to respond within a week.</li>
                        </ul>
                        <p>
                            Deactivating the No Cookies option has also been proven to solve player errors.
                        </p>
                        <p>
                            We also have a YouTube channel. We use it to provide users with some helper videos and a way to keep updated on new features as they are introduced. <a href="https://www.youtube.com/subscription_center?add_user=EmbedPlus" target="_blank">Subscribe for tips and updates here &raquo;</a>
                        </p>
                    </div>
                    <br>
                </section>
            </div>
        </div>
        <script type="text/javascript">
            (function ($)
            {
                window.savevalidate = function ()
                {
                    var valid = true;
                    var $tabFocus = '';
                    var alertmessage = '';
                    if (jQuery("#<?php echo self::$opt_defaultdims; ?>").is(":checked"))
                    {
                        if (!(jQuery.isNumeric(jQuery.trim(jQuery("#<?php echo self::$opt_defaultwidth; ?>").val())) &&
                                jQuery.isNumeric(jQuery.trim(jQuery("#<?php echo self::$opt_defaultheight; ?>").val()))))
                        {
                            alertmessage += "Please enter valid numbers for default height and width, or uncheck the option.";
                            jQuery("#boxdefaultdims input").css("background-color", "#ffcccc").css("border", "2px solid #000000");
                            valid = false;
                            $tabFocus = $("#<?php echo self::$opt_defaultdims; ?>").closest('section');
                        }
                    }

                    if (jQuery("#<?php echo self::$opt_gallery_customarrows; ?>").is(":checked"))
                    {
                        if (!jQuery.trim(jQuery("#<?php echo self::$opt_gallery_customprev; ?>").val()) ||
                                !jQuery.trim(jQuery("#<?php echo self::$opt_gallery_customnext; ?>").val()))
                        {
                            alertmessage += "Please enter valid text for both the custom gallery Prev and Next buttons, or uncheck the option.";
                            jQuery("#boxcustomarrows input").css("background-color", "#ffcccc").css("border", "2px solid #000000");
                            valid = false;
                            $tabFocus = $("#<?php echo self::$opt_gallery_customarrows; ?>").closest('section');
                        }
                    }


                    if (jQuery("#<?php echo self::$opt_gallery_channelsub; ?>").is(":checked"))
                    {
                        if (!jQuery.trim(jQuery("#<?php echo self::$opt_gallery_channelsublink; ?>").val()) ||
                                !jQuery.trim(jQuery("#<?php echo self::$opt_gallery_channelsubtext; ?>").val()))
                        {
                            alertmessage += "Please enter valid text for both the subscribe text and subscribe URL, or uncheck the option.";
                            jQuery("#boxchannelsub input").css("background-color", "#ffcccc").css("border", "2px solid #000000");
                            valid = false;
                            $tabFocus = $("#<?php echo self::$opt_gallery_channelsub; ?>").closest('section');
                        }
                    }


                    if (jQuery("#<?php echo self::$opt_gallery_collapse_grid; ?>").is(":checked"))
                    {
                        var emptyStacks = [];
                        jQuery("#box_collapse_grid input").each(function ()
                        {
                            var val = jQuery(this).val();
                            if (jQuery.trim(val) === '' || !jQuery.isNumeric(val))
                            {
                                emptyStacks.push(this);
                                jQuery(this).css("background-color", "#ffcccc").css("outline", "2px solid #000000");
                            }
                        });
                        if (emptyStacks.length)
                        {
                            alertmessage += "Please enter a valid number for the gallery stacking screen width.";
                            valid = false;
                            $tabFocus = $("#<?php echo self::$opt_gallery_collapse_grid; ?>").closest('section');
                        }
                    }



                    if (jQuery("#<?php echo self::$opt_defaultvol; ?>").is(":checked"))
                    {
                        if (!(jQuery.isNumeric(jQuery.trim(jQuery("#<?php echo self::$opt_vol; ?>").val()))))
                        {
                            alertmessage += "Please enter a number between 0 and 100 for the default volume, or uncheck the option.";
                            jQuery("#boxdefaultvol input").css("background-color", "#ffcccc").css("border", "2px solid #000000");
                            valid = false;
                            $tabFocus = $("#<?php echo self::$opt_defaultvol; ?>").closest('section');
                        }
                    }

                    if (!valid)
                    {
                        alertify.alert(alertmessage);
                        var tabSelector = '.wrap-ytprefs .nav-tab-wrapper .nav-tab[href=#' + $tabFocus.attr('id') + ']';
                        $(tabSelector).click();
                    }
                    return valid;
                };

                var mydomain = escape("http://" + window.location.host.toString());
                jQuery(document).ready(function ($)
                {
                    $(document).on('click', '.wrap-ytprefs .nav-tab-wrapper a, .epyt-jumptab', function ()
                    {
                        $a = $(this);
                        $('.wrap-ytprefs .nav-tab-wrapper a').removeClass('nav-tab-active');
                        $a.addClass('nav-tab-active');
                        $('.wrap-ytprefs section').hide();
                        $('.wrap-ytprefs section').filter($a.attr('rel') ? $a.attr('rel') : $a.attr('href')).fadeIn(200);
                        if (!$a.hasClass('href-link'))
                        {
                            return false;
                        }

                    });

                    if (window.location.hash && window.location.hash == '#jumpmonetize')
                    {
                        setTimeout(function ()
                        {
                            window.scrollTo(0, 0);
                        }, 1);
                        $('.wrap-ytprefs .nav-tab-wrapper a[href="' + window.location.hash + '"]').click();
                    }

                    $('#ytform').on('submit', function ()
                    {
                        return window.savevalidate();
                    });

                    jQuery('#<?php echo self::$opt_defaultdims; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxdefaultdims").show(500);
                        }
                        else
                        {
                            jQuery("#boxdefaultdims").hide(500);
                        }

                    });
                    jQuery('#<?php echo self::$opt_gallery_customarrows; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxcustomarrows").show(500);
                        }
                        else
                        {
                            jQuery("#boxcustomarrows").hide(500);
                        }

                    });
                    jQuery('#<?php echo self::$opt_gallery_collapse_grid; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#box_collapse_grid").show(500);
                        }
                        else
                        {
                            jQuery("#box_collapse_grid").hide(500);
                        }
                    });
                    jQuery('#<?php echo self::$opt_restrict_wizard; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#box_restrict_wizard").show(500);
                        }
                        else
                        {
                            jQuery("#box_restrict_wizard").hide(500);
                        }
                    });

                    jQuery('#<?php echo self::$opt_gallery_channelsub; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxchannelsub").show(500);
                        }
                        else
                        {
                            jQuery("#boxchannelsub").hide(500);
                        }

                    });
                    jQuery('#<?php echo self::$opt_responsive; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxresponsive_all").show(500);
                        }
                        else
                        {
                            jQuery("#boxresponsive_all").hide(500);
                        }
                    });
                    jQuery('#<?php echo self::$opt_migrate; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxmigratelist").show(500);
                        }
                        else
                        {
                            jQuery("#boxmigratelist").hide(500);
                        }
                    });
                    jQuery('#<?php echo self::$opt_nocookie; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxnocookie").show(500);
                        }
                        else
                        {
                            jQuery("#boxnocookie").hide(500);
                        }

                    });
                    jQuery('#<?php echo self::$opt_gdpr_consent; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#box_gdpr_consent").show(500);
                        }
                        else
                        {
                            jQuery("#box_gdpr_consent").hide(500);
                        }

                    });
                    jQuery('.vi-not-interested').on('click', function (e)
                    {
                        //e.preventDefault();
                        jQuery('a.nav-tab[href="#jumpdefaults"]').click();
                        setTimeout(function ()
                        {
                            var scrollNext = jQuery('#vi_hide_monetize_tab').offset().top - 20;
                            $('html, body').animate({
                                scrollTop: scrollNext
                            }, 500, function ()
                            {
                            });
                        }, 500);
                    });

                    jQuery('#<?php echo self::$opt_defaultvol; ?>').change(function ()
                    {
                        if (jQuery(this).is(":checked"))
                        {
                            jQuery("#boxdefaultvol").show(500);
                        }
                        else
                        {
                            jQuery("#boxdefaultvol").hide(500);
                        }

                    });
                    var rangedetect = document.createElement("input");
                    rangedetect.setAttribute("type", "range");
                    var canrange = rangedetect.type !== "text";
                    //canrange = false;
                    if (canrange)
                    {
                        $("input#vol").prop("type", "range").addClass("vol-range").on("input change", function ()
                        {
                            $('.vol-output').text($(this).val() > 0 ? $(this).val() + '%' : 'Mute');
                        });
                        $('.vol-output').css("display", "inline-block").text($("input#vol").val() > 0 ? $("input#vol").val() + '%' : 'Mute');
                        $('.vol-seeslider').show();
                        $('.vol-seetextbox').hide();
                    }
                    else
                    {
                        $("input#vol").width(40);
                    }

                });
            })(jQuery);
        </script>

        <a href="<?php echo esc_attr(admin_url('admin.php?page=youtube-ep-onboarding') . '&random=' . rand(1, 1000) . '&TB_iframe=true&width=950&height=800'); ?>" class="thickbox ytprefs-onboarding-launch" id="ytprefs-onboarding-launch" title="YouTube Setup Guide"></a>

        <?php
        if (function_exists('add_thickbox'))
        {
            add_thickbox();
        }
    }

    public static function onboarding_save_valid(&$input)
    {
        $messages = array();
        try
        {
            $input[self::$opt_modestbranding] = intval($input[self::$opt_modestbranding]);
            $input[self::$opt_responsive] = intval($input[self::$opt_responsive]);
            $input[self::$opt_responsive_all] = intval($input[self::$opt_responsive_all]);

            $input[self::$opt_gallery_pagesize] = intval($input[self::$opt_gallery_pagesize]);
            $input[self::$opt_gallery_columns] = intval($input[self::$opt_gallery_columns]);
            $input[self::$opt_not_live_content] = wp_kses_post(stripslashes($input[self::$opt_not_live_content]));

            if (!in_array($input[self::$opt_ytapi_load], array('always', 'light', 'never')))
            {
                $input[self::$opt_ytapi_load] = 'light';
            }
            $input[self::$opt_gdpr_consent] = intval($input[self::$opt_gdpr_consent]);
            $input[self::$opt_gdpr_consent_message] = wp_kses_post(stripslashes($input[self::$opt_gdpr_consent_message]));
            $input[self::$opt_gdpr_consent_button] = wp_kses_post(stripslashes($input[self::$opt_gdpr_consent_button]));
            $input[self::$opt_nocookie] = intval($input[self::$opt_nocookie]);
        }
        catch (Exception $ex)
        {
            $messages[] = 'Please enter valid data.';
        }

        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    public static function onboarding_save()
    {
        $result = array();
        $default = array(
            self::$opt_rel => 1,
            self::$opt_modestbranding => 0,
            self::$opt_responsive => 0,
            self::$opt_responsive_all => 0,
            self::$opt_gallery_pagesize => 15,
            self::$opt_gallery_columns => 3,
            self::$opt_not_live_content => '',
            self::$opt_ytapi_load => 'light',
            self::$opt_gdpr_consent => 0,
            self::$opt_gdpr_consent_message => self::$dft_gdpr_consent_message,
            self::$opt_gdpr_consent_button => 'Accept YouTube Content',
            self::$opt_nocookie => 0
        );


        $input = shortcode_atts($default, stripslashes_deep($_POST));
        $valid = self::onboarding_save_valid($input);
        if ($valid === true)
        {
            self::update_option_set($input);
            $result['type'] = 'success';
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = implode('<br/>', $valid);
        }

        return $result;
    }

    public static function onboarding_save_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $result = self::onboarding_save();
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem saving the data.';
        }
        echo json_encode($result);
        die();
    }

    public static function onboarding_save_apikey_valid(&$input)
    {
        $messages = array();
        try
        {
            $input[self::$opt_apikey] = trim(str_replace(array(' ', "'", '"'), array('', '', ''), strip_tags($input[self::$opt_apikey])));
        }
        catch (Exception $ex)
        {
            $messages[] = 'Please enter a valid API key.';
        }

        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    public static function onboarding_save_apikey()
    {
        $result = array();
        $default = array(
            self::$opt_apikey => '',
        );

        $input = shortcode_atts($default, stripslashes_deep($_POST));
        $valid = self::onboarding_save_apikey_valid($input);
        if ($valid === true)
        {
            self::update_option_set($input);
            $result['type'] = 'success';
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = implode('<br/>', $valid);
        }

        return $result;
    }

    public static function onboarding_save_apikey_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $result = self::onboarding_save_apikey();
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem saving the data.';
        }
        echo json_encode($result);
        die();
    }

    public static function ytprefs_show_onboarding()
    {

        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        if (self::$double_plugin)
        {
            self::double_plugin_warning();
        }
        $all = get_option(self::$opt_alloptions);

        $do_once = array(
            self::$opt_onboarded => 1
        );
        self::update_option_set($do_once);
        ?>
        <div class="wrap wrap-ytprefs-onboarding">
            <div class="ytprefs-ob-title">
                YouTube Setup Guide
            </div>
            <div class="relative">
                <div class="ytprefs-ob-step ytprefs-ob-step1 active-step">
                    <div class="ytprefs-ob-content">
                        <div class="ytprefs-ob-block">
                            <p>
                                With so many options available in this plugin, we created this easy setup guide to help you  quickly learn about its <strong>most common settings and newest features</strong>. We hope it will get you embedding videos, galleries, and/or live streams sooner.
                            </p>
                            <p>
                                You'll have an opportunity to see and set many other options after completing this setup guide.
                            </p>
                        </div>
                    </div>

                    <div class="ytprefs-ob-content ytprefs-ob-content1">
                        <h2>
                            Below, check all that apply:<br><em>I'm interested in embedding...</em>
                        </h2>
                        <div class="ytprefs-hover-icons">
                            <img class="yob-single-icon" src="<?php echo plugins_url('images/icon-player-single.png', __FILE__) ?>"/>
                            <img class="yob-gallery-icon" src="<?php echo plugins_url('images/icon-playlist-gallery.png', __FILE__) ?>"/>
                            <img class="yob-standalone-icon" src="<?php echo plugins_url('images/icon-playlist-self.png', __FILE__) ?>"/>
                            <img class="yob-live-icon" src="<?php echo plugins_url('images/icon-player-live.png', __FILE__) ?>"/>
                            <img class="yob-privacy-icon" src="<?php echo plugins_url('images/icon-player-privacy.png', __FILE__) ?>"/>
                            <img class="yob-monetize-icon" src="<?php echo plugins_url('images/icon-player-money.png', __FILE__) ?>"/>
                        </div>
                        <ul class="ytprefs-ob-filter">
                            <li><label><input type="checkbox" data-obfilter="yob-single" /> Single videos.</label></li>
                            <li><label><input type="checkbox" data-obfilter="yob-gallery" /> Galleries of playlists or channels (displays thumbnails and a player).</label></li>
                            <li><label><input type="checkbox" data-obfilter="yob-standalone" /> Self-contained playlists or channels (no thumbnails, just YouTube's standard playlist player).</label></li>
                            <li><label><input type="checkbox" data-obfilter="yob-live" /> Live streams.</label></li>
                            <li style="display:none;"><label><input type="checkbox" data-obfilter="yob-privacy" /> With GDPR / privacy features.</label></li>
                            <li><label><input type="checkbox" data-obfilter="yob-monetize" /> Relevant video ads that earn me up to 10x higher CPMs (revenue) than display advertising.</label></li>
                        </ul>
                        <div class="ytprefs-ob-nav">
                            <button type="button" class="button-secondary ytprefs-ob-nav-close">Cancel</button>
                            <button type="button" disabled class="button-primary ytprefs-ob-nav-next">Next &raquo;</button>
                        </div>
                    </div>
                </div>
                <div class="ytprefs-ob-step ytprefs-ob-step2">
                    <div class="ytprefs-ob-content">
                        <h2>
                            You're interested in:
                        </h2>

                        <form id="form-onboarding">
                            <input type="hidden" name="action" value="my_embedplus_onboarding_save_ajax"/>

                            <div class="ytprefs-ob-setting yob-single yob-gallery yob-standalone yob-live">
                                <label>
                                    <b class="chktitle">Related Videos:</b>
                                    Show or hide related and recommended videos at the end of playback.
                                    <br>
                                </label>
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>-1" value="-1" <?php checked($all[self::$opt_rel], -1); ?>>
                                <label for="<?php echo self::$opt_rel; ?>-1">Hide related videos at the end of playback <sup class="orange">new</sup></label> &nbsp;&nbsp;
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>0" value="0" <?php checked($all[self::$opt_rel], 0); ?>>
                                <label for="<?php echo self::$opt_rel; ?>0">Show related videos only from the video's channel</label> &nbsp;&nbsp;
                                <input type="radio" name="<?php echo self::$opt_rel; ?>" id="<?php echo self::$opt_rel; ?>1" value="1" <?php checked($all[self::$opt_rel], 1); ?>>
                                <label for="<?php echo self::$opt_rel; ?>1">Show related videos</label> &nbsp;&nbsp;
                            </div>
                            <div class="ytprefs-ob-setting yob-single yob-gallery yob-standalone yob-live">
                                <input value="1" name="<?php echo self::$opt_modestbranding; ?>" id="<?php echo self::$opt_modestbranding; ?>" <?php checked($all[self::$opt_modestbranding], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_modestbranding; ?>"><?php _e('<b class="chktitle">Modest Branding:</b> No YouTube logo will be shown on the control bar.  Instead, as required by YouTube, the logo will only show as a watermark when the video is paused/stopped.') ?></label>
                            </div>
                            <div class="ytprefs-ob-setting yob-single yob-gallery yob-standalone yob-live">
                                <input value="1" name="<?php echo self::$opt_responsive; ?>" id="<?php echo self::$opt_responsive; ?>" <?php checked($all[self::$opt_responsive], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_responsive; ?>"><?php _e('<b class="chktitle">Responsive Video Sizing:</b> Make your videos responsive so that they dynamically fit in all screen sizes (smart phone, PC and tablet). NOTE: While this is checked, any custom hardcoded widths and heights you may have set will dynamically change too. <b>Do not check this if your theme already handles responsive video sizing.</b>') ?></label>
                                <p id="boxresponsive_all">
                                    <input type="radio" name="<?php echo self::$opt_responsive_all; ?>" id="<?php echo self::$opt_responsive_all; ?>1" value="1" <?php checked($all[self::$opt_responsive_all], 1); ?> >
                                    <label for="<?php echo self::$opt_responsive_all; ?>1">Responsive for all YouTube videos</label> &nbsp;&nbsp;
                                    <input type="radio" name="<?php echo self::$opt_responsive_all; ?>" id="<?php echo self::$opt_responsive_all; ?>0" value="0" <?php checked($all[self::$opt_responsive_all], 0); ?> >
                                    <label for="<?php echo self::$opt_responsive_all; ?>0">Responsive for only videos embedded via this plugin</label>
                                </p>
                            </div>
                            <div class="ytprefs-ob-setting yob-gallery">
                                <label for="<?php echo self::$opt_gallery_pagesize; ?>"><b class="chktitle">Default Gallery Page Size:</b></label>
                                <select name="<?php echo self::$opt_gallery_pagesize; ?>" id="<?php echo self::$opt_gallery_pagesize; ?>" style="width: 60px;">
                                    <?php
                                    $gps_val = intval(trim($all[self::$opt_gallery_pagesize]));
                                    $gps_val = min($gps_val, 50);
                                    for ($gps = 1; $gps <= 50; $gps++)
                                    {
                                        ?><option <?php echo $gps_val == $gps ? 'selected' : '' ?> value="<?php echo $gps ?>"><?php echo $gps ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                Enter how many thumbnails per page should be shown at once (YouTube allows a maximum of 50 per page). You can later use the embedding wizard to customize this for specific galleries.
                            </div>

                            <div class="ytprefs-ob-setting yob-gallery">
                                <label for="<?php echo self::$opt_gallery_columns; ?>"><b class="chktitle">Default Gallery Number of Columns:</b></label>
                                <input name="<?php echo self::$opt_gallery_columns; ?>" id="<?php echo self::$opt_gallery_columns; ?>" type="number" class="textinput" style="width: 60px;" value="<?php echo esc_attr(trim($all[self::$opt_gallery_columns])); ?>">                        
                                Enter how many thumbnails can fit per row.  You can later use the embedding wizard to customize this for specific galleries.
                            </div>
                            <div class="ytprefs-ob-setting yob-live">
                                <p>
                                    <label for="<?php echo self::$opt_not_live_content; ?>">
                                        <b class="chktitle">Default "Not Live" Content:</b>
                                        When your channel is not streaming live, the YouTube live player will be inactive.
                                        Instead of showing that player, you can display some "coming soon" content in that space for your visitors to see until your channel begins to live stream. 
                                        The plugin will automatically switch to your channel's live stream once it's active.
                                        Below, enter what you would like to appear until then. <strong><span class="orange">NOTE:</span> Do not put another live stream embed below.</strong>
                                        <?php
                                        if (self::vi_logged_in())
                                        {
                                            ?>
                                            One new option is to embed a quality video advertisement so that you can gain revenue during times when your live stream is not active.  Simply click the "$ Video Ad" button below to enter the proper shortcode and the plugin with manage the rest.
                                            <?php
                                        }
                                        ?>
                                        If you just want to show the standard countdown player that YouTube provides, just leave the below empty.
                                    </label>
                                </p>
                                <?php
                                wp_editor(wp_kses_post($all[self::$opt_not_live_content]), self::$opt_not_live_content, array('textarea_rows' => 7));
                                ?> 
                            </div>

                            <div class="ytprefs-ob-setting yob-privacy">
                                <b class="chktitle">YouTube API Loading:</b> Choose when to load the YouTube API. The "Restricted" or "Never" options will help with GDPR compliance:
                                <ul class="indent-option">
                                    <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="light" <?php checked($all[self::$opt_ytapi_load], 'light'); ?> /> <em>Restricted</em> - (Recommended) Only load the API on pages that have a YouTube video.</label></li>
                                    <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="never" <?php checked($all[self::$opt_ytapi_load], 'never'); ?> /> <em>Never</em> - Do not load the YouTube API. Note: The "Never" choice may break a few features such as Volume Initialization and Gallery Continuous/Auto Play.</label></li>
                                    <li><label><input type="radio" name="<?php echo self::$opt_ytapi_load ?>" value="always" <?php checked($all[self::$opt_ytapi_load], 'always'); ?> /> <em>Always</em> - Load the API on all pages. In most cases, the "Always" choice is not necessary.</label></li>
                                </ul>
                            </div>


                            <div class="ytprefs-ob-setting yob-privacy">
                                <input value="1" name="<?php echo self::$opt_gdpr_consent; ?>" id="<?php echo self::$opt_gdpr_consent; ?>" <?php checked($all[self::$opt_gdpr_consent], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_gdpr_consent; ?>">
                                    <b class="chktitle">Privacy/GDPR - Show Consent Message:</b> Ask for consent before loading YouTube content. A message will be displayed in place of the YouTube video, as shown in the screenshot below. Once the visitor approves consent, the YouTube content will load. You can customize the message text and the button text in the next 2 options.
                                </label>
                            </div>


                            <div class="ytprefs-ob-setting yob-privacy">                                
                                <label for="<?php echo self::$opt_gdpr_consent_message; ?>">
                                    <b class="chktitle">Privacy/GDPR - Consent Message Text:</b>
                                    Below you can customize the message that will appear to visitors before they accept YouTube content:
                                </label>
                                <div class="clearboth"></div>
                                <div class="gdpr-options-left">
                                    <?php
                                    wp_editor(wp_kses_post($all[self::$opt_gdpr_consent_message]), self::$opt_gdpr_consent_message, array(
                                        'textarea_rows' => 22,
                                        'media_buttons' => false,
                                        'teeny' => true
                                    ));
                                    ?> 
                                </div>
                                <div class="gdpr-options-right">
                                    <p><em>Example of message and button:</em></p>

                                    <img src="<?php echo plugins_url('images/ss-gdpr-message.png', __FILE__) ?>" alt="GDPR Consent Message Example" class="img-gdpr-message" />
                                </div>

                            </div>

                            <div class="clearboth"></div>
                            <div class="ytprefs-ob-setting yob-privacy">
                                <label for="<?php echo self::$opt_gdpr_consent_button; ?>">
                                    <b class="chktitle">Privacy/GDPR - Consent Button Text:</b>
                                    This is the text for the red "Accept" button that appears with the above privacy/GDPR message:
                                </label>
                                <br>
                                <input type="text" placeholder="Example: Accept YouTube Content" name="<?php echo self::$opt_gdpr_consent_button; ?>" id="<?php echo self::$opt_gdpr_consent_button; ?>" value="<?php echo esc_attr(trim($all[self::$opt_gdpr_consent_button])); ?>" class="textinput regular-text"/>
                            </div>

                            <div class="ytprefs-ob-setting yob-privacy">
                                <input value="1" name="<?php echo self::$opt_nocookie; ?>" id="<?php echo self::$opt_nocookie; ?>" <?php checked($all[self::$opt_nocookie], 1); ?> type="checkbox" class="checkbox">
                                <label for="<?php echo self::$opt_nocookie; ?>">
                                    <b class="chktitle">No Cookies:</b> Prevent YouTube from leaving tracking cookies on your visitors browsers unless they actual play the videos. This is coded to apply this behavior on links in your past post as well.
                                    <span id="boxnocookie">
                                        Checking this option may break some features such as galleries and playlists. Furthermore, videos on mobile devices may have problems if you leave this checked.
                                    </span>
                                </label>
                            </div>

                            <div class="ytprefs-ob-nav">
                                <button type="button" class="button-secondary ytprefs-ob-nav-prev">&laquo; Previous</button>
                                <button type="submit" class="button-primary ytprefs-ob-nav-next">Save & Next &raquo;</button>
                            </div>                    
                        </form>
                    </div>
                </div>
                <div class="ytprefs-ob-step ytprefs-ob-step3">
                    <div class="ytprefs-ob-content">
                        <img class="wiztab-screenshots" src="<?php echo plugins_url('images/apikey-server.png', __FILE__) ?>">
                        <h2>
                            YouTube API Key
                        </h2>
                        <form id="form-onboarding-apikey">
                            <input type="hidden" name="action" value="my_embedplus_onboarding_save_apikey_ajax"/>
                            <p>
                                Some features (such as galleries, and some wizard features) now require you to create a free YouTube API <strong>Server</strong> key from Google.
                                Make sure it's a YouTube Data API v3 "Web Server" key as shown in the screenshot (i.e. not web browser or anything else).
                            </p>
                            <?php
                            if (!empty($all[self::$opt_apikey]) && strlen($all[self::$opt_apikey]) > 0)
                            {
                                ?>
                                <p class="ytprefs-ob-success">
                                    Great! You already have an API key.
                                </p>
                                <?php
                            }
                            else
                            {
                                ?>
                                <p>
                                    <a href="https://www.youtube.com/watch?v=6gD0X76-v_g" target="_blank">Click this link &raquo;</a> and follow the video to get your API key. Don't worry, it's an easy process.
                                </p>                            
                                <?php
                            }
                            ?>
                            <p>
                                <input type="text" placeholder="Paste your YouTube API key here" name="<?php echo self::$opt_apikey; ?>" id="<?php echo self::$opt_apikey; ?>" value="<?php echo esc_attr(trim($all[self::$opt_apikey])); ?>" class="regular-text" style='max-width: 40%;'>
                            </p>                                

                            <div class="ytprefs-ob-nav">
                                <div class="ytprefs-ob-nav-ultimate">
                                    <button type="button" class="button-secondary ytprefs-ob-nav-prev">&laquo; Previous</button>                                
                                    <button type="button" class="button-secondary ytprefs-ob-nav-close">I'll do this later.</button>
                                    <button type="submit" class="button-primary ytprefs-ob-nav-next">Save & Finish</button>                                    
                                </div>
                                <div class="ytprefs-ob-nav-penultimate ytprefs-ob-nav-hide">
                                    <button type="button" class="button-secondary ytprefs-ob-nav-prev">&laquo; Previous</button>                                
                                    <button type="button" class="button-secondary ytprefs-ob-nav-skip">I'll do this later &raquo;</button>
                                    <button type="submit" class="button-primary ytprefs-ob-nav-next">Save & Next &raquo;</button>                                    
                                </div>
                            </div>                    
                        </form>
                    </div>
                </div>
                <div class="ytprefs-ob-step ytprefs-ob-step4">
                    <div class="ytprefs-ob-content">
                        <?php
                        if (!self::vi_logged_in() && !self::vi_script_setup_done())
                        {
                            echo '<div class="vi-registration-box">';
                            include_once(EPYTVI_INCLUDES_PATH . 'vi_registration_form.php');
                            include_once(EPYTVI_INCLUDES_PATH . 'vi_login_success.php');
                            echo '</div>';
                        }
                        else
                        {
                            ?>
                            <h2>Monetization</h2>
                            <p class="ytprefs-ob-success">
                                Hooray! You have already signed up for the <a href="<?php echo admin_url('admin.php?page=youtube-ep-vi') ?>" target="_blank">video ad monetization feature</a>.
                            </p>
                            <?php
                        }
                        ?>

                        <div class="ytprefs-ob-nav">
                            <button type="button" class="button-secondary ytprefs-ob-nav-prev">&laquo; Previous</button>
                            <button type="button" class="button-primary ytprefs-ob-nav-close">Finish</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

    public static function save_changes_button($submitted)
    {
        $button_label = 'Save Changes';
        if ($submitted)
        {
            $button_label = 'Changes Saved';
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ()
                {
                    setTimeout(function ()
                    {
                        jQuery('input.ytprefs-submit').val('Save Changes');
                    }, 3000);
                });</script>
            <?php
        }
        ?>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary ytprefs-submit" value="<?php _e($button_label) ?>" />
            <em>If you're using a separate caching plugin and you do not see your changes after saving, <strong class="orange">you need to reset your cache.</strong></em>
        </p>
        <?php
    }

    public static function ytprefsscript()
    {
        $loggedin = current_user_can('edit_posts');
        if (!($loggedin && self::$alloptions[self::$opt_admin_off_scripts]))
        {
            wp_enqueue_style(
                    '__EPYT__style', plugins_url('styles/ytprefs' . self::$min . '.css', __FILE__), array(), self::$version
            );
            $cols = floatval(self::$alloptions[self::$opt_gallery_columns]);
            $cols = $cols == 0 ? 3.0 : $cols;
            $colwidth = 100.0 / $cols;
            $custom_css = "
                .epyt-gallery-thumb {
                        width: " . round($colwidth, 3) . "%;
                }
                ";

            if (self::$alloptions[self::$opt_gallery_collapse_grid] == 1)
            {
                foreach (self::$alloptions[self::$opt_gallery_collapse_grid_breaks] as $idx => $bpts)
                {
                    $custom_css .= "
                         @media (min-width:" . $bpts['bp']['min'] . "px) and (max-width: " . $bpts['bp']['max'] . "px) {
                            .epyt-gallery-rowbreak {
                                display: none;
                            }
                            .epyt-gallery-allthumbs[class*=\"epyt-cols\"] .epyt-gallery-thumb {
                                width: " . round(100.0 / intval($bpts['cols']), 3) . "% !important;
                            }
                          }";
                }
            }

            wp_add_inline_style('__EPYT__style', $custom_css);

            wp_enqueue_script('__ytprefs__', plugins_url('scripts/ytprefs' . self::$min . '.js', __FILE__), array('jquery'), self::$version);

            if (self::$alloptions[self::$opt_old_script_method] != 1)
            {
                $my_script_vars = array(
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'security' => wp_create_nonce('embedplus-nonce'),
                    'gallery_scrolloffset' => intval(self::$alloptions[self::$opt_gallery_scrolloffset]),
                    'eppathtoscripts' => plugins_url('scripts/', __FILE__),
                    'eppath' => plugins_url('/', __FILE__),
                    'epresponsiveselector' => self::get_responsiveselector(),
                    'epdovol' => true,
                    'version' => self::$alloptions[self::$opt_version],
                    'evselector' => self::get_evselector(),
                    'ajax_compat' => self::$alloptions[self::$opt_ajax_compat] == '1' ? true : false,
                    'ytapi_load' => self::$alloptions[self::$opt_ytapi_load],
                    'stopMobileBuffer' => self::$alloptions[self::$opt_stop_mobile_buffer] == '1' ? true : false,
                    'vi_active' => self::$alloptions[self::$opt_vi_active] == '1' ? true : false,
                    'vi_js_posttypes' => self::$alloptions[self::$opt_vi_js_posttypes]
                );

                wp_localize_script('__ytprefs__', '_EPYT_', $my_script_vars);
            }

            if ((bool) self::$alloptions[self::$opt_gdpr_consent])
            {
                wp_enqueue_script('__jquery_cookie__', plugins_url('scripts/jquery.cookie' . self::$min . '.js', __FILE__), array('jquery'), self::$version);
            }


            ////////////////////// cloudflare accomodation
            //add_filter('script_loader_tag', array(get_class(), 'set_cfasync'), 10, 3);
        }
    }

    public static function set_cfasync($tag, $handle, $src)
    {
        if ('__ytprefs__' !== $handle)
        {
            return $tag;
        }
        return str_replace('<script', '<script data-cfasync="false" ', $tag);
    }

    public static function get_evselector()
    {
        $evselector = 'iframe.__youtube_prefs__[src], iframe[src*="youtube.com/embed/"], iframe[src*="youtube-nocookie.com/embed/"]';

        if (self::$alloptions[self::$opt_evselector_light] == 1)
        {
            $evselector = 'iframe.__youtube_prefs__[src]';
        }

        return $evselector;
    }

    public static function get_responsiveselector()
    {
        $responsiveselector = '[]';
        if (self::$alloptions[self::$opt_widgetfit] == 1)
        {
            $responsiveselector = '["iframe.__youtube_prefs_widget__"]';
        }
        if (self::$alloptions[self::$opt_responsive] == 1)
        {
            if (self::$alloptions[self::$opt_responsive_all] == 1)
            {
                $responsiveselector = '["iframe[src*=\'youtube.com\']","iframe[src*=\'youtube-nocookie.com\']","iframe[data-ep-src*=\'youtube.com\']","iframe[data-ep-src*=\'youtube-nocookie.com\']","iframe[data-ep-gallerysrc*=\'youtube.com\']"]';
            }
            else
            {
                $responsiveselector = '["iframe.__youtube_prefs__"]';
            }
        }
        return $responsiveselector;
    }

    public static function admin_enqueue_scripts($hook)
    {
        if (in_array($hook, self::$admin_page_hooks))
        {
            wp_enqueue_style('__ytprefs_admin__alertify_css', plugins_url('styles/alertify/alertify' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_style('__ytprefs_admin__alertify_theme_css', plugins_url('styles/alertify/themes/default' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_style('__ytprefs_admin__vi_css', plugins_url('styles/ytvi-admin' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_script('__ytprefs_admin__alertify_js', plugins_url('scripts/alertify/alertify' . self::$min . '.js', __FILE__), array(), self::$version);
            wp_enqueue_script('__ytprefs_admin__alertify_defaults_js', plugins_url('scripts/alertify/alertify-defaults' . self::$min . '.js', __FILE__), array(), self::$version);
            wp_enqueue_script('__ytprefs_admin__moment_js', plugins_url('scripts/chartjs/moment' . self::$min . '.js', __FILE__), array(), self::$version);
            wp_enqueue_script('__ytprefs_admin__chart_js', plugins_url('scripts/chartjs/chart' . self::$min . '.js', __FILE__), array('__ytprefs_admin__moment_js'), self::$version);
            wp_enqueue_script('__ytprefs_admin__chart_deferred_js', plugins_url('scripts/chartjs/chartjs-plugin-deferred' . self::$min . '.js', __FILE__), array('__ytprefs_admin__chart_js'), self::$version);
        }

        wp_enqueue_style('embedplusyoutube', plugins_url('scripts/embedplus_mce' . self::$min . '.css', __FILE__), array(), self::$version);
        wp_enqueue_script('__ytprefs_admin__', plugins_url('scripts/ytprefs-admin' . self::$min . '.js', __FILE__), array('jquery', 'jquery-effects-fade', 'wp-color-picker'), self::$version, false);
        $admin_script_vars = array(
            'wpajaxurl' => admin_url('admin-ajax.php'),
            'wizhref' => admin_url('admin.php?page=youtube-ep-wizard') . '&random=' . rand(1, 1000) . '&TB_iframe=true&width=950&height=800',
            'manage_options' => current_user_can('manage_options'),
            'security' => wp_create_nonce('embedplus-nonce'),
            'onboarded' => self::$alloptions[self::$opt_onboarded],
            'vi_logged_in' => self::vi_logged_in(),
            'epbase' => self::$epbase,
            'admin_url' => admin_url(),
            'vi_js_settings' => self::$alloptions[self::$opt_vi_js_settings],
            'admin_url_ytprefs' => admin_url('admin.php?page=youtube-my-preferences'),
            'admin_url_vi' => admin_url('admin.php?page=youtube-ep-vi')
                //'epblogwidth' => self::get_blogwidth(),
                //'epprokey' => self::$alloptions[self::$opt_pro],
                //'epbasesite' => self::$epbase,
                //'epversion' => self::$version,
                //'myytdefaults' => http_build_query(self::$alloptions),
                //'eppluginadminurl' => admin_url('admin.php?page=youtube-my-preferences')
        );
        wp_localize_script('__ytprefs_admin__', '_EPYTA_', $admin_script_vars);

        if (function_exists('add_thickbox'))
        {
            add_thickbox();
        }


        if ((get_bloginfo('version') >= '3.3') && self::custom_admin_pointers_check())
        {
            add_action('admin_print_footer_scripts', array(get_class(), 'custom_admin_pointers_footer'));
            wp_enqueue_script('wp-pointer');
            wp_enqueue_style('wp-pointer');
        }

        if (self::$alloptions['glance'] == 1)
        {
            add_action('admin_print_footer_scripts', array(get_class(), 'glance_script'));
        }

        if ($hook == self::$wizard_hook)
        {
            wp_enqueue_style('__ytprefs_admin__wizard_ui', plugins_url('styles/jquery-ui' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_style('__ytprefs_admin__wizard', plugins_url('styles/ytprefs-wizard' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_script('__ytprefs_admin__wizard_script', plugins_url('scripts/ytprefs-wizard' . self::$min . '.js', __FILE__), array('jquery', 'jquery-ui-accordion', 'jquery-ui-tabs'), self::$version);
        }

        if ($hook == self::$onboarding_hook)
        {
            wp_enqueue_style('__ytprefs_admin__onboarding_animate', plugins_url('scripts/embdyn' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_style('__ytprefs_admin__onboarding_ui', plugins_url('styles/jquery-ui' . self::$min . '.css', __FILE__), array(), self::$version);
            wp_enqueue_style('__ytprefs_admin__onboarding', plugins_url('styles/ytprefs-onboarding' . self::$min . '.css', __FILE__), array(), self::$version);
        }
    }

    public static function get_blogwidth()
    {
        $blogwidth = null;
        try
        {
            $embed_size_w = intval(get_option('embed_size_w'));

            global $content_width;
            if (empty($content_width))
            {
                $content_width = $GLOBALS['content_width'];
            }

            $blogwidth = $embed_size_w ? $embed_size_w : ($content_width ? $content_width : 450);
        }
        catch (Exception $ex)
        {
            
        }

        $blogwidth = preg_replace('/\D/', '', $blogwidth); //may have px

        return $blogwidth;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private static function ajax_referer()
    {
        return check_ajax_referer('embedplus-nonce', 'security', false);
    }

    public static function base_url()
    {
        $parsed = parse_url(site_url());
        return $parsed['scheme'] . '://' . $parsed['host'];
    }

    public static function on_deactivation()
    {
        self::vi_cron_stop();
    }

    private static function update_option_set($new_options)
    {
        $all = get_option(self::$opt_alloptions);
        $all = $new_options + $all;
        update_option(self::$opt_alloptions, $all);
        self::$alloptions = get_option(self::$opt_alloptions);
    }

    private static function vi_remote_get($endpoint, $options = array())
    {
        $params = $options + array(
            'headers' => array('Authorization' => self::$alloptions[self::$opt_vi_token]),
            'timeout' => self::$curltimeout
        );
        return wp_remote_get($endpoint, $params);
    }

    private static function vi_remote_post($endpoint, $options = array())
    {
        $params = $options + array(
            'headers' => array('Content-Type' => 'application/json', 'Authorization' => self::$alloptions[self::$opt_vi_token]),
            'timeout' => self::$curltimeout
        );
//        if (self::$alloptions[self::$opt_debugmode])
//        {
//            echo $endpoint . '<br>' . self::vi_debug_json($params);
//        }
        return wp_remote_post($endpoint, $params);
    }

    private static function vi_remote_post_anon($endpoint, $options = array())
    {
        $params = $options + array(
            'headers' => array('Content-Type' => 'application/json'),
            'timeout' => self::$curltimeout
        );
        return wp_remote_post($endpoint, $params);
    }

    private static function vi_cache_endpoints_valid(&$apiResult)
    {
        $messages = array();


        if (is_wp_error($apiResult))
        {
            $messages[] = $apiResult->get_error_message();
        }
        else
        {
            $jsonResult = json_decode($apiResult['body']);

            if (!empty($jsonResult->error))
            {
                $messages[] = $jsonResult->error;
            }

            if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
            {
                $messages[] = "Please enter a valid email address.";
            }

            if (isset($jsonResult->status) && strcasecmp($jsonResult->status, 'ok') == 0 && isset($jsonResult->data) && is_object($jsonResult->data))
            {
                $apiResult = $jsonResult;
            }
        }
        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    public static function vi_cache_endpoints()
    {
        $result = array();
        $apiResult = wp_remote_get(EPYTVI_ENDPOINTS_URL, array('timeout' => self::$curltimeout));
        $valid = self::vi_cache_endpoints_valid($apiResult);
        if ($valid === true)
        {
            $new_options = array(
                self::$opt_vi_endpoints => $apiResult->data
            );

            self::update_option_set($new_options);

            $post_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            if (!empty($post_email))
            {
                $result['type'] = 'success';
                $result['data'] = $apiResult->data;
                $result['signupURLParams'] = $apiResult->data->signupURL . '?aid=WP_embedplus&email=' . filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) . '&domain=' . site_url();
            }
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = implode('<br/>', $valid);
        }

        return $result;
    }

    public static function vi_cache_endpoints_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $result = self::vi_cache_endpoints();
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem submitting the data.';
        }

        $result['message'] = wp_kses_post($result['message']);
        echo json_encode($result);
        die();
    }

    public static function vi_notice_login_reminder()
    {
        if (filter_has_var(INPUT_COOKIE, 'vi_signup_attempt'))
        {
            $screen = get_current_screen();
            $date_string = filter_input(INPUT_COOKIE, 'vi_signup_attempt', FILTER_SANITIZE_STRING);
            $date_attempt = strtotime($date_string);
            $date_wait = strtotime($date_string . ' + 7 days');

            if (time() > $date_wait &&
                    !self::vi_logged_in() &&
                    in_array($screen->id, array('toplevel_page_youtube-my-preferences'))
            )
            {
                ?>
                <div class="notice notice-warning is-dismissible vi_notice_login_reminder">
                    <p>
                        It looks like you may have signed up for the vi monetization feature, but haven't completed the settings to receive revenue. Click the "Monetize" tab below to login and continue.
                    </p>
                </div>
                <script>
                    (function ($)
                    {
                        $(document).ready(function ()
                        {
                            $('.vi_notice_login_reminder').on('click', '.notice-dismiss', function ()
                            {
                                document.cookie = 'vi_signup_attempt=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                            });
                        });
                    })(jQuery);
                </script>
                <?php
            }
        }
    }

    private static function vi_login_valid(&$input)
    {
        $messages = array();
        if (empty($input['email']))
        {
            $messages[] = 'Please enter your email.';
        }
        if (empty($input['password']))
        {
            $messages[] = 'Please enter your vi password.';
        }

        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    private static function vi_login_api_valid(&$apiResult)
    {
        $messages = array();
        if (is_wp_error($apiResult))
        {
            $messages[] = $apiResult->get_error_message();
        }
        else
        {
            $jsonResult = json_decode($apiResult['body']);

            if (!empty($jsonResult->error))
            {
                $messages[] = $jsonResult->error->message . ": " . (is_string($jsonResult->error->description) ? $jsonResult->error->description : json_encode($jsonResult->error->description));
            }

            if (isset($jsonResult->status) && strcasecmp($jsonResult->status, 'ok') == 0 && isset($jsonResult->data) && strlen($jsonResult->data) > 0)
            {
                $apiResult = $jsonResult;
            }
        }
        if (empty($messages))
        {
            return true;
        }

        return $messages;
    }

    private static function vi_adstxt_api_valid(&$apiResult)
    {
        $messages = array();
        if (is_wp_error($apiResult))
        {
            $messages[] = $apiResult->get_error_message();
        }
        else
        {
            $jsonResult = json_decode($apiResult['body']);

            if (!empty($jsonResult->error))
            {
                $messages[] = implode(': ', array($jsonResult->error->message, $jsonResult->error->description));
            }

            if (isset($jsonResult->status) && strcasecmp($jsonResult->status, 'ok') == 0 && isset($jsonResult->data) && strlen($jsonResult->data) > 0)
            {
                $apiResult = $jsonResult;
            }
        }
        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    public static function vi_login()
    {
        $result = array();
        $default = array(
            'email' => '',
            'password' => ''
        );
        $input = shortcode_atts($default, stripslashes_deep($_POST));
        $valid = self::vi_login_valid($input);
        if ($valid === true)
        {
            self::vi_cache_endpoints();
            $loginAPI = self::$alloptions[self::$opt_vi_endpoints]->loginAPI . '?affiliateId=WP_embedplus';
            $inputAuth = array(
                'email' => $input['email'],
                'password' => $input['password']
            );
            $apiResult = self::vi_remote_post_anon($loginAPI, array(
                        'body' => json_encode($inputAuth)
            ));
            $valid = self::vi_login_api_valid($apiResult);

            if ($valid === true)
            {
                $result['type'] = 'success';

                $new_options = array(
                    self::$opt_vi_token => $apiResult->data,
                    self::$opt_vi_last_login => date('Y-m-d H:i:s')
                );

                self::update_option_set($new_options);
            }
            else
            {
                $result['type'] = 'error';
                $result['message'] = implode('<br/>', $valid);
            }
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = implode('<br/>', $valid);
        }

        if ($result['type'] === 'success')
        {
            self::vi_db_init_schema();
        }
        return $result;
    }

    public static function vi_login_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $result = self::vi_login();
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem submitting the data.';
        }

        $result['message'] = wp_kses_post($result['message']);
        echo json_encode($result);
        die();
    }

    public static function vi_logout_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            self::vi_cron_stop();

            $new_options = array(
                self::$opt_vi_token => ''
            );

            self::update_option_set($new_options);
            $result['type'] = 'success';
            $result['url'] = admin_url('admin.php?page=youtube-my-preferences');
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem submitting the data.';
        }
        echo json_encode($result);
        die();
    }

    public static function vi_toggle_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $new_options = array(
                self::$opt_vi_active => self::$alloptions[self::$opt_vi_active] ? 0 : 1
            );

            self::update_option_set($new_options);
            $result['type'] = 'success';
            $result['button_text'] = self::$alloptions[self::$opt_vi_active] ? 'On' : 'Off';
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem submitting the data.';
        }
        echo json_encode($result);
        die();
    }

    public static function vi_hide_feature_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $new_options = array(
                self::$opt_vi_hide_monetize_tab => 1
            );

            self::update_option_set($new_options);
            $result['type'] = 'success';
            $result['url'] = admin_url('admin.php?page=youtube-my-preferences');
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a network error. Please try again, or turn off this feature using the "Hide Monetize Feature" checkbox on the "Defaults" tab of the YouTube settings. If the issue persists, please contact ext@embedplus.com';
        }
        echo json_encode($result);
        die();
    }

    public static function vi_cover_prompt_yes()
    {
        return filter_input(INPUT_COOKIE, 'vi_cover_prompt_yes', FILTER_SANITIZE_NUMBER_INT) == 1;
    }

    public static function vi_cron_stop()
    {
        $timestamp = wp_next_scheduled('ytvi_cron_cache_js_hook');
        if ($timestamp !== false)
        {
            wp_unschedule_event($timestamp, 'ytvi_cron_cache_js_hook');
        }
    }

    private static function vi_reports_valid(&$apiResult)
    {
        $messages = array();
        if (is_wp_error($apiResult))
        {
            $messages[] = $apiResult->get_error_message();
        }
        else
        {
            $jsonResult = json_decode($apiResult['body']);

            //$messages[] = $apiResult['body']; // COMMENT

            if (!empty($jsonResult->error))
            {
                $messages[] = $jsonResult->error->message . ": " . $jsonResult->error->description;
            }

            if (isset($jsonResult->status) && strcasecmp($jsonResult->status, 'ok') == 0 && isset($jsonResult->data))
            {
                $apiResult = $jsonResult;
            }
        }
        if (empty($messages))
        {
            return true;
        }

        return $messages;
    }

    public static function vi_reports_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $revenueResult = self::vi_remote_get(self::$alloptions[self::$opt_vi_endpoints]->revenueAPI);
            $revenue_valid = self::vi_reports_valid($revenueResult);
            if ($revenue_valid === true)
            {
                $result['data'] = $revenueResult->data;
                $result['type'] = 'success';
            }
            else
            {
                $result['type'] = 'error';
                $result['message'] = wp_kses_post(implode('<br/>', $revenue_valid));
            }
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem retrieving the data.';
        }
        echo json_encode($result);
        die();
    }

    private static function vi_cache_user_adstxt()
    {
        $adsTxtAPI = self::$alloptions[self::$opt_vi_endpoints]->adsTxtAPI;
        $iabResult = self::vi_remote_get($adsTxtAPI);
        $iab_valid = self::vi_adstxt_api_valid($iabResult);
        if ($iab_valid === true)
        {
            $new_options = array(
                self::$opt_vi_adstxt => $iabResult->data
            );

            self::update_option_set($new_options);
            return $iabResult->data;
        }
        return false;
    }

    private static function vi_adstxt_status()
    {
        $user_adstxt = self::vi_cache_user_adstxt();
        $current_adstxt = false;
        if ($user_adstxt === false)
        {
            return array(
                'code' => -1,
                'message' => 'Sorry, your publisher ads.txt info could not be retrieved. Please wait a few minutes and try again. Your ads.txt verification file will enable you to make money through vi. <a href="https://www.vi.ai/publisherfaq/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">FAQ &raquo;</a>'
            );
        }
        else
        {
            $user_adstxt = preg_replace('~\R~u', PHP_EOL, $user_adstxt);
        }

        $adstxt_file = self::vi_get_home_path() . 'ads.txt';
        $adstxt_url = self::base_url() . '/ads.txt';

        $adstxt_http = wp_remote_get($adstxt_url, array('timeout' => self::$curltimeout));
        if (!is_wp_error($adstxt_http) && in_array(wp_remote_retrieve_response_code($adstxt_http), array(200, 301, 302, 304)))
        {
            $current_adstxt = wp_remote_retrieve_body($adstxt_http);
        }
        if (empty($current_adstxt))
        {
            $current_adstxt = file_get_contents($adstxt_file);
        }

        if (!empty($current_adstxt))
        {
            $current_adstxt = preg_replace('~\R~u', PHP_EOL, $current_adstxt);
            // append
            if (is_writable($adstxt_file))
            {
                if (stripos($current_adstxt, '# 41b5eef6') === false)
                {
                    $to_write = PHP_EOL . $user_adstxt;
                    file_put_contents($adstxt_file, $to_write, FILE_APPEND);
                    return array(
                        'code' => 1,
                        'before_adstxt' => $current_adstxt,
                        'after_adstxt' => $current_adstxt . $to_write,
                        'message' => 'You successfully validated your account. Your <a target="_blank" href="' . site_url() . '/ads.txt">ads.txt</a> file has been updated, which enables you to make money through vi. <a href="' . esc_url(admin_url('admin.php?page=youtube-ep-vi#jumpfaq')) . '" target="_blank">FAQ &raquo;</a>'
                    );
                }
                else if ($current_adstxt !== $user_adstxt)
                {
                    $current_adstxt_lines = preg_split('/\r\n|\r|\n/', $current_adstxt);
                    $current_adstxt_lines = array_filter($current_adstxt_lines, array(get_class(), 'vi_not_vi_adstxt_line'));
                    $former_adstxt = implode(PHP_EOL, $current_adstxt_lines);

                    $new_adstxt = $former_adstxt . (strlen($former_adstxt) > 0 ? PHP_EOL : '') . $user_adstxt;
                    if ($current_adstxt === $new_adstxt)
                    {
                        return array(
                            'code' => 2,
                            'message' => 'You successfully validated your account.'
                        );
                    }
                    else
                    {
                        file_put_contents($adstxt_file, $new_adstxt);

                        return array(
                            'code' => 1,
                            'before_adstxt' => $current_adstxt,
                            'after_adstxt' => $new_adstxt,
                            'message' => 'You successfully validated your account. Your <a target="_blank" href="' . site_url() . '/ads.txt">ads.txt</a> file has been updated, which enables you to make money through vi. <a href="' . esc_url(admin_url('admin.php?page=youtube-ep-vi#jumpfaq')) . '" target="_blank">FAQ &raquo;</a>'
                        );
                    }
                }
                else
                {
                    return array(
                        'code' => 2,
                        'message' => 'You successfully validated your account.'
                    );
                }
            }
            else
            {
                if (stripos($current_adstxt, $user_adstxt) === false) // $user_adstxt
                {
                    return array(
                        'code' => 0,
                        'message' => 'Sorry, your current ads.txt file could not be automatically be updated. Please first <a class="button-secondary" href="' .
                        admin_url('admin.php') . '?ytvi_adstxt_download=1&key=' . urlencode(self::$alloptions[self::$opt_vi_token]) . '">download this updated ads.txt</a> file and upload it to your site root, then try logging in again. Your ads.txt verification file will enable you to make money through vi. <a href="https://www.vi.ai/publisherfaq/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">FAQ &raquo;</a>'
                    );
                }
                else
                {
                    return array(
                        'code' => 2,
                        'message' => 'You successfully validated your account.'
                    );
                }
            }
        }
        else
        {
            // create
            if ((!file_exists($adstxt_file) && is_writable(self::vi_get_home_path())) || (file_exists($adstxt_file) && is_writable($adstxt_file)))
            {
                file_put_contents($adstxt_file, self::$alloptions[self::$opt_vi_adstxt], FILE_APPEND);

                return array(
                    'code' => 1,
                    'before_adstxt' => $current_adstxt,
                    'after_adstxt' => self::$alloptions[self::$opt_vi_adstxt],
                    'message' => 'You successfully validated your account. Your <a target="_blank" href="' . site_url() . '/ads.txt">ads.txt</a> file has been created, which enables you to make money through vi. <a href="' . esc_url(admin_url('admin.php?page=youtube-ep-vi#jumpfaq')) . '" target="_blank">FAQ &raquo;</a>'
                );
            }
            else
            {
                return array(
                    'code' => 0,
                    'message' => 'Sorry, your ads.txt verification file could not automatically be created. Please first <a class="button-secondary" href="' .
                    admin_url('admin.php') . '?ytvi_adstxt_download=1&key=' . urlencode(self::$alloptions[self::$opt_vi_token]) . '">download this ads.txt</a> file and upload it to your site root, then try logging in again. Your ads.txt verification file will enable you to make money through vi. <a href="https://www.vi.ai/publisherfaq/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">FAQ &raquo;</a>'
                );
            }
        }
    }

    public static function vi_adstxt_status_soft_ajax()
    {
        $result = array();
        if (self::is_ajax() && self::ajax_referer() && current_user_can('manage_options'))
        {
            $default = array(
                'current_adstxt' => ''
            );
            $input = shortcode_atts($default, stripslashes_deep($_POST));
            $result = self::vi_adstxt_status_soft($input['current_adstxt']);

            if (isset($result['code']) && intval($result['code']) < 0)
            {
                $result['token'] = self::$alloptions[self::$opt_vi_token];
            }
        }
        else
        {
            $result['type'] = 'error';
            $result['message'] = 'Sorry, there was a problem verifying your ads.txt file. Please try again.';
        }

        $result['message'] = wp_kses_post($result['message']);
        echo json_encode($result);
        die();
    }

    private static function vi_adstxt_status_soft($current_adstxt)
    {
        $adstxt_url = self::base_url() . '/ads.txt';
        $adstxt_note = ' <strong>Note:</strong> If you already have an ads.txt file at ' . $adstxt_url . ', you will just need to add in the additional lines found in the download.';
        $user_adstxt = self::vi_cache_user_adstxt();
        $current_adstxt = empty($current_adstxt) ? false : $current_adstxt;
        if ($user_adstxt === false)
        {
            return array(
                'code' => -1,
                'message' => 'For your security, a quick reauthentication is needed to begin setting up your ads.txt file. First, log out of this Ads Settings page with the "Logout" button right above and then log back in with your vi login and password. Then come back to this tab for next steps. Your ads.txt verification file will enable you to make money through vi. <a href="https://www.vi.ai/publisherfaq/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">FAQ &raquo;</a>'
            );
        }
        else
        {
            $user_adstxt = preg_replace('~\R~u', PHP_EOL, $user_adstxt);
        }

        if (!empty($current_adstxt))
        {
            $current_adstxt = preg_replace('~\R~u', PHP_EOL, $current_adstxt);

            // append / update manually
            if (stripos($current_adstxt, $user_adstxt) === false)
            {
                if (stripos($current_adstxt, '# 41b5eef6') !== false) // update
                {
                    return array(
                        'code' => 0,
                        'message' => 'Looks like video intelligence has just updated its ad delivery partners. To get the most revenue out of your ads, open up your '
                        . ' <a href="' . self::base_url() . '/ads.txt" target="_blank">ads.txt</a> file and replace the vi lines (ending in # 41b5eef6) with the new lines you see below. Then, refresh this page. '
                        . ' Please do not reorder or double space the below lines. '
                        . ' <strong>If we helped you with your ads.txt in the past, feel free to contact us to help out again with this update.</strong> '
                        . '<code># video intelligence (vi.ai) ads.txt lines begin here:' . PHP_EOL . $user_adstxt . PHP_EOL . '# video intelligence (vi.ai) ads.txt lines end</code>'
                    );
                }
                else // add
                {
                    return array(
                        'code' => 0,
                        'message' => 'In your current <a href="' . self::base_url() . '/ads.txt" target="_blank">ads.txt</a> file, just add in the additional lines you see below. Then, refresh this page.'
                        . ' Please do not reorder or double space the below lines. '
                        . '<code># video intelligence (vi.ai) ads.txt lines begin here:' . PHP_EOL . $user_adstxt . PHP_EOL . '# video intelligence (vi.ai) ads.txt lines end</code>'
                    );
                }
            }
            else
            {
                return array(
                    'code' => 2,
                    'message' => '<p class="adstxt-verify-message-valid">You successfully validated your ads.txt file.</p>'
                );
            }
        }
        else
        {
            // create manually
            return array(
                'code' => 0,
                'message' => 'You can <a class="button button-small" href="' . admin_url('admin.php') . '?ytvi_adstxt_download=1&key=' . urlencode(self::$alloptions[self::$opt_vi_token]) . '">download this ads.txt</a> file and upload it to your site root (or copy the same text below). Then, refresh this page to verify.'
                . ' Please do not reorder or double space the below lines. '
                . '<code># video intelligence (vi.ai) ads.txt lines begin here:' . PHP_EOL . $user_adstxt . PHP_EOL . '# video intelligence (vi.ai) ads.txt lines end</code>'
            );
        }
    }

    private static function vi_not_vi_adstxt_line($line)
    {
        return stripos($line, '# 41b5eef6') === false;
    }

    public static function vi_get_home_path()
    {
        $abs_root = get_home_path();
        if (strlen($abs_root) <= 1)
        {
            $abs_root = trailingslashit(str_replace('\\', '/', ABSPATH));
            $url_path = parse_url(site_url());
            if (isset($url_path['path']))
            {
                $relpath = trailingslashit($url_path['path']);
                $relpath_length = strlen($relpath);
                $path_intersect = substr($abs_root, -$relpath_length);
                if ($path_intersect === $relpath)
                {
                    $abs_root = trailingslashit(substr($abs_root, 0, strlen($abs_root) - $relpath_length));
                }
            }
        }
        return $abs_root;
    }

    public static function vi_adstxt_lookup()
    {
        $request = esc_url_raw(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if ('/ads.txt' === $request)
        {
            if (function_exists('tenup_display_ads_txt'))
            {
                $post_id = get_option('adstxt_post');
                if (!empty($post_id))
                {
                    $post = get_post($post_id);
                    header('Content-Type: text/plain');
                    echo esc_html($post->post_content);
                    die();
                }
            }
        }
    }

    public static function vi_adstxt_download()
    {
        $inp_key = filter_input(INPUT_GET, 'key');
        if (filter_input(INPUT_GET, 'ytvi_adstxt_download') == 1 && !empty($inp_key))
        {
            $key = urldecode(filter_input(INPUT_GET, 'key', FILTER_DEFAULT));
            self::$alloptions[self::$opt_vi_token] = $key;
            $user_adstxt = self::vi_cache_user_adstxt();
            $adstxt_file = self::vi_get_home_path() . 'ads.txt';
            $current_adstxt = file_exists($adstxt_file) ? file_get_contents($adstxt_file) : '';

            $current_adstxt_lines = preg_split('/\r\n|\r|\n/', $current_adstxt);
            $current_adstxt_lines = array_filter($current_adstxt_lines, array(get_class(), 'vi_not_vi_adstxt_line'));
            $former_adstxt = implode(PHP_EOL, $current_adstxt_lines);

            $new_adstxt = $former_adstxt . (strlen($former_adstxt) > 0 ? PHP_EOL : '') . ($user_adstxt === false ? '' : $user_adstxt);

            $new_adstxt = '# video intelligence (vi.ai) ads.txt lines begin here:' . PHP_EOL . $new_adstxt . PHP_EOL . '# video intelligence (vi.ai) ads.txt lines end';

            header("Expires: 0");
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header('Cache-Control: pre-check=0, post-check=0, max-age=0', false);
            header("Pragma: no-cache");
            header("Content-Disposition:attachment; filename=ads.txt");
            header("Content-Type: application/force-download");

            echo $new_adstxt;

            exit();
        }
    }

    public static function vi_logged_in()
    {
        return !empty(self::$alloptions[self::$opt_vi_token]);
    }

    public static function vi_settings_nav()
    {
        ?>
        <h3 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active" href="#jumphowitworks">How It Works</a>
            <a class="nav-tab" href="#jumpdescription">Video Categories</a>
            <a class="nav-tab" href="#jumpappearance">Appearance</a>
            <a class="nav-tab" href="#jumpplacement">Placement</a>
            <a class="nav-tab nav-tab-adstxt" href="#jumpadstxt">Ads.txt Verification &nbsp;</a>
            <a class="nav-tab" href="#jumpperformance">Revenue Reporting</a>
            <a class="nav-tab" href="#jumprevenue">Profile Settings</a>
            <a class="nav-tab" href="#jumpviprivacy">Privacy</a>
            <a class="nav-tab" href="#jumpfaq">FAQs</a>
            <a class="nav-tab" href="#jumpsupport">Support</a>
        </h3>
        <?php
    }

    private static function vi_cache_js_valid(&$apiResult)
    {
        $messages = array();
        //$messages[] = implode(': ', array('vi API - ' . htmlspecialchars(self::vi_debug_json($apiResult))));
        if (is_wp_error($apiResult))
        {
            $messages[] = $apiResult->get_error_message();
        }
        else
        {
            $jsonResult = json_decode($apiResult['body']);

            if (!empty($jsonResult->error))
            {
                //$messages[] = implode(': ', array('vi API - ' . self::vi_debug_json($apiResult)));
                $messages[] = 'If the issue is not resolved, please contact support at ext@embedplus.com and we will get you going. (Error code ' . wp_remote_retrieve_response_code($apiResult) . ', v' . self::$version .
                        ' - <em>' . implode(': ', array($jsonResult->error->message, is_string($jsonResult->error->description) ? $jsonResult->error->description : json_encode($jsonResult->error->description))) . '</em>)';
            }

            if (isset($jsonResult->status) && strcasecmp($jsonResult->status, 'ok') == 0 && isset($jsonResult->data) && strlen($jsonResult->data) > 0)
            {
                $apiResult = $jsonResult;
            }
        }
        if (empty($messages))
        {
            return true;
        }
        return $messages;
    }

    private static function vi_cache_js($options)
    {
        $readonly = array(
            'domain' => parse_url(site_url(), PHP_URL_HOST),
            'adUnitType' => 'NATIVE_VIDEO_UNIT',
            'logoUrl' => 'https://example.com/logo.jpg'
        );
        $options = $readonly + $options;

        $jsTagAPI = self::$alloptions[self::$opt_vi_endpoints]->jsTagAPI;

        $iabCategoryList = explode(',', $options['iabCategory']);

        $matches = array();
        if (isset(self::$alloptions[self::$opt_vi_js_script]) && preg_match('/IAB_Category[ ]*:([^,]+),/i', self::$alloptions[self::$opt_vi_js_script], $matches))
        {
            $currCategory = array(trim($matches[1]));
            $iabCategoryList = array_diff($iabCategoryList, $currCategory);
        }

        $options['iabCategory'] = $iabCategoryList[array_rand($iabCategoryList)];

        $apiResult = self::vi_remote_post($jsTagAPI, array(
                    'body' => json_encode($options)
        ));
        //$js_valid = array(self::vi_debug_json($options));
        $js_valid = self::vi_cache_js_valid($apiResult);
        if ($js_valid === true)
        {
            $mod_data = $apiResult->data;

            $new_options = array(
                self::$opt_vi_js_script => $mod_data,
                self::$opt_vi_last_category_update => date('Y-m-d H:i:s')
            );

            self::update_option_set($new_options);
        }

        return $js_valid;
    }

    public static function vi_debug_json($json)
    {
        return '<pre>' . json_encode($json, JSON_PRETTY_PRINT) . '</pre>';
    }

    public static function vi_script_setup_done()
    {
        if (empty(self::$alloptions[self::$opt_vi_js_script]))
        {
            return false;
        }
        return true;
    }

    public static function vi_admin_dashboard_valid(&$item)
    {
        $messages = array();

        $all_post_types = get_post_types(array('public' => true), 'names');

        foreach ($item[self::$opt_vi_js_posttypes] as $pt)
        {
            if (!in_array($pt, $all_post_types))
            {
                $messages[] = 'Please choose only valid post types for your ad to appear in.';
            }
        }

        if (!in_array($item[self::$opt_vi_js_position], array('top', 'bottom')))
        {
            $messages[] = 'Please choose a valid placement position.';
        }

        $item[self::$opt_vi_js_settings]['keywords'] = substr(sanitize_text_field(str_replace(array('\'', '"'), '', $item[self::$opt_vi_js_settings]['keywords'])), 0, 200);

        $item[self::$opt_vi_js_settings]['iabCategory'] = sanitize_text_field($item[self::$opt_vi_js_settings]['iabCategory']);
        if (empty($item[self::$opt_vi_js_settings]['iabCategory']))
        {
            $messages[] = 'Please choose at least one IAB category under Video Categories.';
        }
        $item[self::$opt_vi_js_settings]['language'] = sanitize_text_field($item[self::$opt_vi_js_settings]['language']);
        if (empty($item[self::$opt_vi_js_settings]['language']))
        {
            $item[self::$opt_vi_js_settings]['language'] = 'en-us';
        }

        $item[self::$opt_vi_js_settings]['backgroundColor'] = sanitize_hex_color($item[self::$opt_vi_js_settings]['backgroundColor']);
        if (empty($item[self::$opt_vi_js_settings]['backgroundColor']))
        {
            $item[self::$opt_vi_js_settings]['backgroundColor'] = '#ffffff';
        }

        $item[self::$opt_vi_js_settings]['textColor'] = sanitize_hex_color($item[self::$opt_vi_js_settings]['textColor']);
        if (empty($item[self::$opt_vi_js_settings]['textColor']))
        {
            $item[self::$opt_vi_js_settings]['textColor'] = '#000000';
        }

        $item[self::$opt_vi_js_settings]['font'] = sanitize_text_field($item[self::$opt_vi_js_settings]['font']);
        if (empty($item[self::$opt_vi_js_settings]['font']))
        {
            $item[self::$opt_vi_js_settings]['font'] = 'Arial';
        }

        if (!is_numeric($item[self::$opt_vi_js_settings]['fontSize']) || intval($item[self::$opt_vi_js_settings]['fontSize']) < 0)
        {
            $item[self::$opt_vi_js_settings]['fontSize'] = 12;
        }

        if (empty($messages))
        {
            $js = self::vi_cache_js($item[self::$opt_vi_js_settings]);
            if ($js === true)
            {
                $item[self::$opt_vi_js_script] = self::$alloptions[self::$opt_vi_js_script];
            }
            else
            {
                $messages[] = 'For your security, a quick re-authentication is required to save your most recent customizations. Simply log out of this Ads Settings page with the "Logout" button right above and then log back in with your vi login and password. ';
                $messages = array_merge($messages, $js);
            }
        }

        if (empty($messages))
        {
            return true;
        }

        return $messages;
    }

    public static function vi_print_toggle_button()
    {
        ?>
        <button <?php echo self::vi_script_setup_done() ? '' : ' disabled '; ?> class="button-primary ytvi-btn-toggle <?php echo self::$alloptions[self::$opt_vi_active] ? 'ytvi-btn-active' : 'ytvi-btn-inactive' ?>">
            vi ads are: <strong><?php echo self::$alloptions[self::$opt_vi_active] ? 'On' : 'Off' ?></strong>
            <?php
            if (!self::vi_script_setup_done())
            {
                ?>
                <div class="ytvi-notyet">
                    <h3>Before you can turn on your ads:</h3>
                    <ol class="list-ol">
                        <li>Complete the <em>Video Categories, Appearance, and Placement</em> tabs.</li>
                        <li>Then click on the <strong>Save Changes</strong> button in the bottom right of this screen.</li>
                        <li>Then click the top right button to turn vi ads on.</li>
                    </ol>
                    <p>
                        Once your ads are on, complete the <em>Ads.txt</em> tab to have your ads start earning revenue. Then the <em>Profile</em> tab shows you how to receive payments.
                    </p>
                </div>
                <?php
            }
            ?>
        </button>
        <?php
    }

    public static function vi_admin_dashboard()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $message = '';
        $notice = '';

        $item = array(
            self::$opt_vi_js_settings => self::$alloptions[self::$opt_vi_js_settings],
            self::$opt_vi_js_script => self::$alloptions[self::$opt_vi_js_script],
            self::$opt_vi_js_posttypes => self::$alloptions[self::$opt_vi_js_posttypes],
            self::$opt_vi_js_position => self::$alloptions[self::$opt_vi_js_position],
            self::$opt_vi_show_gdpr_authorization => self::$alloptions[self::$opt_vi_show_gdpr_authorization],
            self::$opt_vi_show_privacy_button => self::$alloptions[self::$opt_vi_show_privacy_button]
        );

        if (wp_verify_nonce(filter_input(INPUT_POST, 'nonce'), basename(__FILE__)))
        {
            $post_vars = stripslashes_deep($_POST);
            if (!array_key_exists(self::$opt_vi_js_posttypes, $post_vars))
            {
                $post_vars[self::$opt_vi_js_posttypes] = array();
            }
            $post_vars = shortcode_atts($item, $post_vars);

            $item[self::$opt_vi_js_settings] = $post_vars[self::$opt_vi_js_settings] + $item[self::$opt_vi_js_settings];
            $item[self::$opt_vi_js_posttypes] = $post_vars[self::$opt_vi_js_posttypes];
            $item[self::$opt_vi_js_position] = $post_vars[self::$opt_vi_js_position];
            $item[self::$opt_vi_show_gdpr_authorization] = self::postchecked(self::$opt_vi_show_gdpr_authorization) ? 1 : 0;
            $item[self::$opt_vi_show_privacy_button] = self::postchecked(self::$opt_vi_show_privacy_button) ? 1 : 0;


            $item_valid = self::vi_admin_dashboard_valid($item);

            //$item_valid = array('<pre>_post: ' . print_r(stripslashes_deep($_POST), true) . '</pre>', '<pre>item: ' . print_r($item, true) . '</pre>');

            if ($item_valid === true)
            {
                self::update_option_set($item);

                $message = 'Settings were successfully saved. Now you can turn on vi ads above. Note: changes may take a few minutes to appear on your website. If you are using a separate caching plugin, <strong>you need to reset your cache</strong> to see any changes.';
            }
            else
            {
                $notice = wp_kses_post(implode('<br/>', $item_valid));
            }
        }
        ?>
        <div class="wrap wrap-vi wrap-vi-settings">
            <h1><img class="yt-admin-icon" src="<?php echo plugins_url(self::$folder_name . '/images/icon-monetize-dark.svg') ?>" />
                Video Ad Settings
                <a class="button-secondary ytvi-btn-logout">Logout of vi settings</a>
                <?php self::vi_print_toggle_button(); ?>
            </h1>
            <br>
            <div class="updated ytvi-msg-congrats">
                <p>
                    Congrats! Ads are now on. Here are some tips to maximize your fill rate and therefore revenue:   
                </p>
                <ul class="list-ul">
                    <li>Visibility - The higher the player is placed, the greater the demand and fill rate. Inserting it near the top or middle of your pages are best.</li>
                    <li>Ad Unit Size - The recommended minimum width for the player is 336px </li>
                    <li>Give vi.ai about 2-3 weeks to optimize their inventory for your site</li>
                    <li>Contact us for help if you have any questions: ext@embedplus.com</li>
                </ul>
            </div>
            <?php
            if (!empty($notice))
            {
                ?>
                <div id="notice" class="error"><p><?php echo wp_kses_post($notice) ?></p></div>
                <?php
            }
            if (!empty($message))
            {
                ?>
                <div id="message" class="updated"><p><?php echo wp_kses_post($message) ?></p></div>
                <?php
            }

            self::vi_settings_nav();

//            echo '<pre>';
//            print_r(_get_cron_array());
//            echo '</pre>';
            ?>

            <form id="form" method="POST">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__)) ?>"/>
                <section class="pattern" id="jumphowitworks">
                    <h2>How It Works</h2>
                    <p>Before you begin, please turn off any ad blocker extensions you may have, so that you will see how your ads look. Then follow the steps below:</p>
                    <br>
                    <div class="vi-how-works" data-jump="#jumpdescription">
                        <div class="vi-num">1</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-description.png') ?>"/>
                        <h3>Video Categories</h3>
                        <p>
                            Categorize your site to help match with the right ads.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#jumpappearance">
                        <div class="vi-num">2</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-appearance.png') ?>"/>
                        <h3>Appearance</h3>
                        <p>
                            Customize how the ad player should look.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#jumpplacement">
                        <div class="vi-num">3</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-placement.png') ?>"/>
                        <h3>Placement</h3>
                        <p>
                            Decide where the ad player should be placed.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#nojump">
                        <div class="vi-num">4</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-turnon.png') ?>"/>
                        <h3>Turn It On</h3>
                        <p>
                            Click the colored button at the top right of this page to make the ad player visible.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#jumpadstxt">
                        <div class="vi-num">5</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-adstxt.png') ?>"/>
                        <h3>Ads.txt Verification</h3>
                        <p>
                            Verify your ads.txt file to start earning revenue.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#jumpperformance">
                        <div class="vi-num">6</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-performance.png') ?>"/>
                        <h3>Revenue Reporting</h3>
                        <p>
                            View reports on your CPM, revenue, and more.
                        </p>
                    </div>
                    <div class="vi-how-works" data-jump="#jumprevenue">
                        <div class="vi-num">7</div>
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/icon-hw-revenue.png') ?>"/>
                        <h3>Profile Settings</h3>
                        <p>
                            Collect your earnings in a few days via PayPal or bank transfer.
                        </p>
                    </div>
                </section>

                <section class="pattern" id="jumpdescription">
                    <div class="adstxt-help">
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/adstxt-help.png') . '?ver=' . self::$version; ?>"/>
                        Trouble getting content that fits your site, even with the proper settings above/below? Contact support at <strong><a href="mailto:ext@embedplus.com">ext@embedplus.com</a></strong>
                    </div>
                    <h2><span class="vi-num">1</span> Video Categories (Multiple Allowed) <sup class="orange">new</sup></h2>
                    <p>
                        Your video ad will be optimized to relate to your site's content and the one or more categories you select below. Note that the quality of the matches improves over time. 
                    </p>
                    <p>
                        <strong>Tip:</strong> select more than one category to add variety to your video ads.
                        If you select more than one, you must stay logged in to this settings page for your categories to automatically add variety to your ads.
                    </p>
                    <table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
                        <tbody>
                            <tr class="form-field">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[iabCategory]">IAB Categories</label>
                                    <small>Select the categories that most fit your website. You can select up to 4. </small>
                                </th>
                                <td>
                                    <strong>Filter by:</strong>
                                    <select class="iab-cat-parent">
                                        <option value="">Choose Filter</option>
                                        <option value="IAB1">Arts & Entertainment</option>
                                        <option value="IAB2">Automotive</option>
                                        <option value="IAB3">Business</option>
                                        <!--                                        <option value="IAB4">Careers</option>-->
                                        <!--                                        <option value="IAB5">Education</option>-->
                                        <!--                                        <option value="IAB6">Family & Parenting</option>-->
                                        <option value="IAB7">Health & Fitness</option>
                                        <option value="IAB8">Food & Drink</option>
                                        <option value="IAB9">Hobbies & Interests</option>
                                        <option value="IAB10">Home & Garden</option>
                                        <option value="IAB11">Law, Gov't & Politics</option>
                                        <option value="IAB12">News</option>
                                        <!--                                        <option value="IAB13">Personal Finance</option>-->
                                        <!--                                        <option value="IAB14">Society</option>-->
                                        <option value="IAB15">Science</option>
                                        <option value="IAB16">Pets</option>
                                        <option value="IAB17">Sports</option>
                                        <option value="IAB18">Style & Fashion</option>
                                        <option value="IAB19">Technology & Computing</option>
                                        <option value="IAB20">Travel</option>
                                        <!--                                        <option value="IAB21">Real Estate</option>-->
                                        <option value="IAB22">Shopping</option>
                                        <!--                                        <option value="IAB23">Religion & Spirituality</option>-->
                                        <option value="IAB24">Uncategorized</option>
                                        <option value="IAB25">Non-Standard Content</option>
                                    </select>
                                    <div class="iab-cat-child-box hidden">
                                        <strong>Then choose category:</strong>
                                        <select class="iab-cat-child" disabled>
                                            <option value="">Select Category:</option>
                                            <option value="IAB1">Arts & Entertainment (All)</option>
                                            <option value="IAB1-1">Books & Literature</option>
                                            <option value="IAB1-2">Celebrity Fan/Gossip</option>
                                            <option value="IAB1-3">Fine Art</option>
                                            <option value="IAB1-4">Humor</option>
                                            <option value="IAB1-5">Movies</option>
                                            <option value="IAB1-6">Music</option>
                                            <option value="IAB1-7">Television</option>
                                            <option value="IAB2">Automotive (All)</option>
                                            <option value="IAB2-1">Auto Parts</option>
                                            <option value="IAB2-2">Auto Repair</option>
                                            <option value="IAB2-3">Buying/Selling Cars</option>
                                            <option value="IAB2-4">Car Culture</option>
                                            <option value="IAB2-5">Certified Pre-Owned</option>
                                            <option value="IAB2-6">Convertible</option>
                                            <option value="IAB2-7">Coupe</option>
                                            <option value="IAB2-8">Crossover</option>
                                            <option value="IAB2-9">Diesel</option>
                                            <option value="IAB2-10">Electric Vehicle</option>
                                            <option value="IAB2-11">Hatchback</option>
                                            <option value="IAB2-12">Hybrid</option>
                                            <option value="IAB2-13">Luxury</option>
                                            <option value="IAB2-14">MiniVan</option>
                                            <option value="IAB2-15">Mororcycles</option>
                                            <option value="IAB2-16">Off-Road Vehicles</option>
                                            <option value="IAB2-17">Performance Vehicles</option>
                                            <option value="IAB2-18">Pickup</option>
                                            <option value="IAB2-19">Road-Side Assistance</option>
                                            <option value="IAB2-20">Sedan</option>
                                            <option value="IAB2-21">Trucks & Accessories</option>
                                            <option value="IAB2-22">Vintage Cars</option>
                                            <option value="IAB2-23">Wagon</option>
                                            <option value="IAB3">Business (All)</option>
                                            <option value="IAB3-1">Advertising</option>
                                            <option value="IAB3-2">Agriculture</option>
                                            <option value="IAB3-3">Biotech/Biomedical</option>
                                            <option value="IAB3-4">Business Software</option>
                                            <option value="IAB3-5">Construction</option>
                                            <option value="IAB3-6">Forestry</option>
                                            <option value="IAB3-7">Government</option>
                                            <option value="IAB3-8">Green Solutions</option>
                                            <option value="IAB3-9">Human Resources</option>
                                            <option value="IAB3-10">Logistics</option>
                                            <option value="IAB3-11">Marketing</option>
                                            <option value="IAB3-12">Metals</option>
                                            <option value="IAB4">Careers (All)</option>
                                            <option value="IAB4-1">Career Planning</option>
                                            <option value="IAB4-2">College</option>
                                            <option value="IAB4-3">Financial Aid</option>
                                            <option value="IAB4-4">Job Fairs</option>
                                            <option value="IAB4-5">Job Search</option>
                                            <option value="IAB4-6">Resume Writing/Advice</option>
                                            <option value="IAB4-7">Nursing</option>
                                            <option value="IAB4-8">Scholarships</option>
                                            <option value="IAB4-9">Telecommuting</option>
                                            <option value="IAB4-10">U.S. Military</option>
                                            <option value="IAB4-11">Career Advice</option>
                                            <option value="IAB5">Education (All)</option>
                                            <option value="IAB5-1">7-12 Education</option>
                                            <option value="IAB5-2">Adult Education</option>
                                            <option value="IAB5-3">Art History</option>
                                            <option value="IAB5-4">Colledge Administration</option>
                                            <option value="IAB5-5">College Life</option>
                                            <option value="IAB5-6">Distance Learning</option>
                                            <option value="IAB5-7">English as a 2nd Language</option>
                                            <option value="IAB5-8">Language Learning</option>
                                            <option value="IAB5-9">Graduate School</option>
                                            <option value="IAB5-10">Homeschooling</option>
                                            <option value="IAB5-11">Homework/Study Tips</option>
                                            <option value="IAB5-12">K-6 Educators</option>
                                            <option value="IAB5-13">Private School</option>
                                            <option value="IAB5-14">Special Education</option>
                                            <option value="IAB5-15">Studying Business</option>
                                            <option value="IAB6">Family & Parenting (All)</option>
                                            <option value="IAB6-1">Adoption</option>
                                            <option value="IAB6-2">Babies & Toddlers</option>
                                            <option value="IAB6-3">Daycare/Pre School</option>
                                            <option value="IAB6-4">Family Internet</option>
                                            <option value="IAB6-5">Parenting – K-6 Kids</option>
                                            <option value="IAB6-6">Parenting teens</option>
                                            <option value="IAB6-7">Pregnancy</option>
                                            <option value="IAB6-8">Special Needs Kids</option>
                                            <option value="IAB6-9">Eldercare</option>
                                            <option value="IAB7">Health & Fitness (All)</option>
                                            <option value="IAB7-1">Exercise</option>
                                            <option value="IAB7-2">A.D.D.</option>
                                            <option value="IAB7-3">AIDS/HIV</option>
                                            <option value="IAB7-4">Allergies</option>
                                            <option value="IAB7-5">Alternative Medicine</option>
                                            <option value="IAB7-6">Arthritis</option>
                                            <option value="IAB7-7">Asthma</option>
                                            <option value="IAB7-8">Autism/PDD</option>
                                            <option value="IAB7-9">Bipolar Disorder</option>
                                            <option value="IAB7-10">Brain Tumor</option>
                                            <option value="IAB7-11">Cancer</option>
                                            <option value="IAB7-12">Cholesterol</option>
                                            <option value="IAB7-13">Chronic Fatigue Syndrome</option>
                                            <option value="IAB7-14">Chronic Pain</option>
                                            <option value="IAB7-15">Cold & Flu</option>
                                            <option value="IAB7-16">Deafness</option>
                                            <option value="IAB7-17">Dental Care</option>
                                            <option value="IAB7-18">Depression</option>
                                            <option value="IAB7-19">Dermatology</option>
                                            <option value="IAB7-20">Diabetes</option>
                                            <option value="IAB7-21">Epilepsy</option>
                                            <option value="IAB7-22">GERD/Acid Reflux</option>
                                            <option value="IAB7-23">Headaches/Migraines</option>
                                            <option value="IAB7-24">Heart Disease</option>
                                            <option value="IAB7-25">Herbs for Health</option>
                                            <option value="IAB7-26">Holistic Healing</option>
                                            <option value="IAB7-27">IBS/Crohn's Disease</option>
                                            <option value="IAB7-28">Incest/Abuse Support</option>
                                            <option value="IAB7-29">Incontinence</option>
                                            <option value="IAB7-30">Infertility</option>
                                            <option value="IAB7-31">Men's Health</option>
                                            <option value="IAB7-32">Nutrition</option>
                                            <option value="IAB7-33">Orthopedics</option>
                                            <option value="IAB7-34">Panic/Anxiety Disorders</option>
                                            <option value="IAB7-35">Pediatrics</option>
                                            <option value="IAB7-36">Physical Therapy</option>
                                            <option value="IAB7-37">Psychology/Psychiatry</option>
                                            <option value="IAB7-38">Senor Health</option>
                                            <option value="IAB7-39">Sexuality</option>
                                            <option value="IAB7-40">Sleep Disorders</option>
                                            <option value="IAB7-41">Smoking Cessation</option>
                                            <option value="IAB7-42">Substance Abuse</option>
                                            <option value="IAB7-43">Thyroid Disease</option>
                                            <option value="IAB7-44">Weight Loss</option>
                                            <option value="IAB7-45">Women's Health</option>
                                            <option value="IAB8">Food & Drink (All)</option>
                                            <option value="IAB8-1">American Cuisine</option>
                                            <option value="IAB8-2">Barbecues & Grilling</option>
                                            <option value="IAB8-3">Cajun/Creole</option>
                                            <option value="IAB8-4">Chinese Cuisine</option>
                                            <option value="IAB8-5">Cocktails/Beer</option>
                                            <option value="IAB8-6">Coffee/Tea</option>
                                            <option value="IAB8-7">Cuisine-Specific</option>
                                            <option value="IAB8-8">Desserts & Baking</option>
                                            <option value="IAB8-9">Dining Out</option>
                                            <option value="IAB8-10">Food Allergies</option>
                                            <option value="IAB8-11">French Cuisine</option>
                                            <option value="IAB8-12">Health/Lowfat Cooking</option>
                                            <option value="IAB8-13">Italian Cuisine</option>
                                            <option value="IAB8-14">Japanese Cuisine</option>
                                            <option value="IAB8-15">Mexican Cuisine</option>
                                            <option value="IAB8-16">Vegan</option>
                                            <option value="IAB8-17">Vegetarian</option>
                                            <option value="IAB8-18">Wine</option>
                                            <option value="IAB9">Hobbies & Interests (All)</option>
                                            <option value="IAB9-1">Art/Technology</option>
                                            <option value="IAB9-2">Arts & Crafts</option>
                                            <option value="IAB9-3">Beadwork</option>
                                            <option value="IAB9-4">Birdwatching</option>
                                            <option value="IAB9-5">Board Games/Puzzles</option>
                                            <option value="IAB9-6">Candle & Soap Making</option>
                                            <option value="IAB9-7">Card Games</option>
                                            <option value="IAB9-8">Chess</option>
                                            <option value="IAB9-9">Cigars</option>
                                            <option value="IAB9-10">Collecting</option>
                                            <option value="IAB9-11">Comic Books</option>
                                            <option value="IAB9-12">Drawing/Sketching</option>
                                            <option value="IAB9-13">Freelance Writing</option>
                                            <option value="IAB9-14">Genealogy</option>
                                            <option value="IAB9-15">Getting Published</option>
                                            <option value="IAB9-16">Guitar</option>
                                            <option value="IAB9-17">Home Recording</option>
                                            <option value="IAB9-18">Investors & Patents</option>
                                            <option value="IAB9-19">Jewelry Making</option>
                                            <option value="IAB9-20">Magic & Illusion</option>
                                            <option value="IAB9-21">Needlework</option>
                                            <option value="IAB9-22">Painting</option>
                                            <option value="IAB9-23">Photography</option>
                                            <option value="IAB9-24">Radio</option>
                                            <option value="IAB9-25">Roleplaying Games</option>
                                            <option value="IAB9-26">Sci-Fi & Fantasy</option>
                                            <option value="IAB9-27">Scrapbooking</option>
                                            <option value="IAB9-28">Screenwriting</option>
                                            <option value="IAB9-29">Stamps & Coins</option>
                                            <option value="IAB9-30">Video & Computer Games</option>
                                            <option value="IAB9-31">Woodworking</option>
                                            <option value="IAB10">Home & Garden (All)</option>
                                            <option value="IAB10-1">Appliances</option>
                                            <option value="IAB10-2">Entertaining</option>
                                            <option value="IAB10-3">Environmental Safety</option>
                                            <option value="IAB10-4">Gardening</option>
                                            <option value="IAB10-5">Home Repair</option>
                                            <option value="IAB10-6">Home Theater</option>
                                            <option value="IAB10-7">Interior Decorating</option>
                                            <option value="IAB10-8">Landscaping</option>
                                            <option value="IAB10-9">Remodeling & Construction</option>
                                            <option value="IAB11">Law, Gov't & Politics (All)</option>
                                            <option value="IAB11-1">Immigration</option>
                                            <option value="IAB11-2">Legal Issues</option>
                                            <option value="IAB11-3">U.S. Government Resources</option>
                                            <option value="IAB11-4">Politics</option>
                                            <option value="IAB11-5">Commentary</option>
                                            <option value="IAB12">News (All)</option>
                                            <option value="IAB12-1">International News</option>
                                            <option value="IAB12-2">National News</option>
                                            <option value="IAB12-3">Local News</option>
                                            <option value="IAB13">Personal Finance (All)</option>
                                            <option value="IAB13-1">Beginning Investing</option>
                                            <option value="IAB13-2">Credit/Debt & Loans</option>
                                            <option value="IAB13-3">Financial News</option>
                                            <option value="IAB13-4">Financial Planning</option>
                                            <option value="IAB13-5">Hedge Fund</option>
                                            <option value="IAB13-6">Insurance</option>
                                            <option value="IAB13-7">Investing</option>
                                            <option value="IAB13-8">Mutual Funds</option>
                                            <option value="IAB13-9">Options</option>
                                            <option value="IAB13-10">Retirement Planning</option>
                                            <option value="IAB13-11">Stocks</option>
                                            <option value="IAB13-12">Tax Planning</option>
                                            <option value="IAB14">Society (All)</option>
                                            <option value="IAB14-1">Dating</option>
                                            <option value="IAB14-2">Divorce Support</option>
                                            <option value="IAB14-3">Gay Life</option>
                                            <option value="IAB14-4">Marriage</option>
                                            <option value="IAB14-5">Senior Living</option>
                                            <option value="IAB14-6">Teens</option>
                                            <option value="IAB14-7">Weddings</option>
                                            <option value="IAB14-8">Ethnic Specific</option>
                                            <option value="IAB15">Science (All)</option>
                                            <option value="IAB15-1">Astrology</option>
                                            <option value="IAB15-2">Biology</option>
                                            <option value="IAB15-3">Chemistry</option>
                                            <option value="IAB15-4">Geology</option>
                                            <option value="IAB15-5">Paranormal Phenomena</option>
                                            <option value="IAB15-6">Physics</option>
                                            <option value="IAB15-7">Space/Astronomy</option>
                                            <option value="IAB15-8">Geography</option>
                                            <option value="IAB15-9">Botany</option>
                                            <option value="IAB15-10">Weather</option>
                                            <option value="IAB16">Pets (All)</option>
                                            <option value="IAB16-1">Aquariums</option>
                                            <option value="IAB16-2">Birds</option>
                                            <option value="IAB16-3">Cats</option>
                                            <option value="IAB16-4">Dogs</option>
                                            <option value="IAB16-5">Large Animals</option>
                                            <option value="IAB16-6">Reptiles</option>
                                            <option value="IAB16-7">Veterinary Medicine</option>
                                            <option value="IAB17">Sports (All)</option>
                                            <option value="IAB17-1">Auto Racing</option>
                                            <option value="IAB17-2">Baseball</option>
                                            <option value="IAB17-3">Bicycling</option>
                                            <option value="IAB17-4">Bodybuilding</option>
                                            <option value="IAB17-5">Boxing</option>
                                            <option value="IAB17-6">Canoeing/Kayaking</option>
                                            <option value="IAB17-7">Cheerleading</option>
                                            <option value="IAB17-8">Climbing</option>
                                            <option value="IAB17-9">Cricket</option>
                                            <option value="IAB17-10">Figure Skating</option>
                                            <option value="IAB17-11">Fly Fishing</option>
                                            <option value="IAB17-12">Football</option>
                                            <option value="IAB17-13">Freshwater Fishing</option>
                                            <option value="IAB17-14">Game & Fish</option>
                                            <option value="IAB17-15">Golf</option>
                                            <option value="IAB17-16">Horse Racing</option>
                                            <option value="IAB17-17">Horses</option>
                                            <option value="IAB17-18">Hunting/Shooting</option>
                                            <option value="IAB17-19">Inline Skating</option>
                                            <option value="IAB17-20">Martial Arts</option>
                                            <option value="IAB17-21">Mountain Biking</option>
                                            <option value="IAB17-22">NASCAR Racing</option>
                                            <option value="IAB17-23">Olympics</option>
                                            <option value="IAB17-24">Paintball</option>
                                            <option value="IAB17-25">Power & Motorcycles</option>
                                            <option value="IAB17-26">Pro Basketball</option>
                                            <option value="IAB17-27">Pro Ice Hockey</option>
                                            <option value="IAB17-28">Rodeo</option>
                                            <option value="IAB17-29">Rugby</option>
                                            <option value="IAB17-30">Running/Jogging</option>
                                            <option value="IAB17-31">Sailing</option>
                                            <option value="IAB17-32">Saltwater Fishing</option>
                                            <option value="IAB17-33">Scuba Diving</option>
                                            <option value="IAB17-34">Skateboarding</option>
                                            <option value="IAB17-35">Skiing</option>
                                            <option value="IAB17-36">Snowboarding</option>
                                            <option value="IAB17-37">Surfing/Bodyboarding</option>
                                            <option value="IAB17-38">Swimming</option>
                                            <option value="IAB17-39">Table Tennis/Ping-Pong</option>
                                            <option value="IAB17-40">Tennis</option>
                                            <option value="IAB17-41">Volleyball</option>
                                            <option value="IAB17-42">Walking</option>
                                            <option value="IAB17-43">Waterski/Wakeboard</option>
                                            <option value="IAB17-44">World Soccer</option>
                                            <option value="IAB18">Style & Fashion (All)</option>
                                            <option value="IAB18-1">Beauty</option>
                                            <option value="IAB18-2">Body Art</option>
                                            <option value="IAB18-3">Fashion</option>
                                            <option value="IAB18-4">Jewelry</option>
                                            <option value="IAB18-5">Clothing</option>
                                            <option value="IAB18-6">Accessories</option>
                                            <option value="IAB19">Technology & Computing (All)</option>
                                            <option value="IAB19-1">3-D Graphics</option>
                                            <option value="IAB19-2">Animation</option>
                                            <option value="IAB19-3">Antivirus Software</option>
                                            <option value="IAB19-4">C/C++</option>
                                            <option value="IAB19-5">Cameras & Camcorders</option>
                                            <option value="IAB19-6">Cell Phones</option>
                                            <option value="IAB19-7">Computer Certification</option>
                                            <option value="IAB19-8">Computer Networking</option>
                                            <option value="IAB19-9">Computer Peripherals</option>
                                            <option value="IAB19-10">Computer Reviews</option>
                                            <option value="IAB19-11">Data Centers</option>
                                            <option value="IAB19-12">Databases</option>
                                            <option value="IAB19-13">Desktop Publishing</option>
                                            <option value="IAB19-14">Desktop Video</option>
                                            <option value="IAB19-15">Email</option>
                                            <option value="IAB19-16">Graphics Software</option>
                                            <option value="IAB19-17">Home Video/DVD</option>
                                            <option value="IAB19-18">Internet Technology</option>
                                            <option value="IAB19-19">Java</option>
                                            <option value="IAB19-20">JavaScript</option>
                                            <option value="IAB19-21">Mac Support</option>
                                            <option value="IAB19-22">MP3/MIDI</option>
                                            <option value="IAB19-23">Net Conferencing</option>
                                            <option value="IAB19-24">Net for Beginners</option>
                                            <option value="IAB19-25">Network Security</option>
                                            <option value="IAB19-26">Palmtops/PDAs</option>
                                            <option value="IAB19-27">PC Support</option>
                                            <option value="IAB19-28">Portable</option>
                                            <option value="IAB19-29">Entertainment</option>
                                            <option value="IAB19-30">Shareware/Freeware</option>
                                            <option value="IAB19-31">Unix</option>
                                            <option value="IAB19-32">Visual Basic</option>
                                            <option value="IAB19-33">Web Clip Art</option>
                                            <option value="IAB19-34">Web Design/HTML</option>
                                            <option value="IAB19-35">Web Search</option>
                                            <option value="IAB19-36">Windows</option>
                                            <option value="IAB20">Travel (All)</option>
                                            <option value="IAB20-1">Adventure Travel</option>
                                            <option value="IAB20-2">Africa</option>
                                            <option value="IAB20-3">Air Travel</option>
                                            <option value="IAB20-4">Australia & New Zealand</option>
                                            <option value="IAB20-5">Bed & Breakfasts</option>
                                            <option value="IAB20-6">Budget Travel</option>
                                            <option value="IAB20-7">Business Travel</option>
                                            <option value="IAB20-8">By US Locale</option>
                                            <option value="IAB20-9">Camping</option>
                                            <option value="IAB20-10">Canada</option>
                                            <option value="IAB20-11">Caribbean</option>
                                            <option value="IAB20-12">Cruises</option>
                                            <option value="IAB20-13">Eastern Europe</option>
                                            <option value="IAB20-14">Europe</option>
                                            <option value="IAB20-15">France</option>
                                            <option value="IAB20-16">Greece</option>
                                            <option value="IAB20-17">Honeymoons/Getaways</option>
                                            <option value="IAB20-18">Hotels</option>
                                            <option value="IAB20-19">Italy</option>
                                            <option value="IAB20-20">Japan</option>
                                            <option value="IAB20-21">Mexico & Central America</option>
                                            <option value="IAB20-22">National Parks</option>
                                            <option value="IAB20-23">South America</option>
                                            <option value="IAB20-24">Spas</option>
                                            <option value="IAB20-25">Theme Parks</option>
                                            <option value="IAB20-26">Traveling with Kids</option>
                                            <option value="IAB20-27">United Kingdom</option>
                                            <option value="IAB21">Real Estate (All)</option>
                                            <option value="IAB21-1">Apartments</option>
                                            <option value="IAB21-2">Architects</option>
                                            <option value="IAB21-3">Buying/Selling Homes</option>
                                            <option value="IAB22">Shopping (All)</option>
                                            <option value="IAB22-1">Contests & Freebies</option>
                                            <option value="IAB22-2">Couponing</option>
                                            <option value="IAB22-3">Comparison</option>
                                            <option value="IAB22-4">Engines</option>
                                            <option value="IAB23">Religion & Spirituality (All)</option>
                                            <option value="IAB23-1">Alternative Religions</option>
                                            <option value="IAB23-2">Atheism/Agnosticism</option>
                                            <option value="IAB23-3">Buddhism</option>
                                            <option value="IAB23-4">Catholicism</option>
                                            <option value="IAB23-5">Christianity</option>
                                            <option value="IAB23-6">Hinduism</option>
                                            <option value="IAB23-7">Islam</option>
                                            <option value="IAB23-8">Judaism</option>
                                            <option value="IAB23-9">Latter-Day Saints</option>
                                            <option value="IAB23-10">Pagan/Wiccan</option>
                                            <option value="IAB24">Uncategorized (All)</option>
                                            <option value="IAB25">Non-Standard Content (All)</option>
                                            <option value="IAB25-1">Unmoderated UGC</option>
                                            <option value="IAB25-2">Extreme Graphic/Explicit Violence</option>
                                            <option value="IAB25-3">Pornography</option>
                                            <option value="IAB25-4">Profane Content</option>
                                            <option value="IAB25-5">Hate Content</option>
                                            <option value="IAB25-6">Under Construction</option>
                                            <option value="IAB25-7">Incentivized</option>
                                        </select>
                                    </div>
                                    <input class="iab-cat-tags" type="hidden" name="<?php echo self::$opt_vi_js_settings ?>[iabCategory]" id="<?php echo self::$opt_vi_js_settings ?>[iabCategory]" value="<?php echo esc_attr($item[self::$opt_vi_js_settings]['iabCategory']) ?>" />
                                    <br>
                                    <br>
                                    <p><strong>Your Selected Categories:</strong></p>
                                    <div class="iab-cat-tags-display"></div>
                                </td>
                            </tr>
                            <tr class="form-field <?php echo empty($item[self::$opt_vi_js_settings]['keywords']) ? ' hidden ' : '' ?>">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[keywords]">Keywords</label>
                                    <small>Enter a few keywords that describe topics your visitors are likely to be interested in. <strong>Separate by commas.</strong>
                                        Tip: Try to avoid terms that have multiple meanings; e.g., just the word "record" can refer to music records and even sports records.</small>
                                </th>
                                <td>
                                    <input id="<?php echo self::$opt_vi_js_settings ?>[keywords]" name="<?php echo self::$opt_vi_js_settings ?>[keywords]" value="<?php echo esc_attr($item[self::$opt_vi_js_settings]['keywords']) ?>"
                                           type="text" maxlength="200" placeholder="Example: cooking, baking, food, recipes, kitchen">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>


                <section class="pattern" id="jumpappearance">
                    <h2><span class="vi-num">2</span> Appearance</h2>

                    <p>Customize your ad unit's visual appearance below.</p>
                    <div class="vi-story-demo">

                        <h3>
                            Appearance Demo
                        </h3>
                        <div class="vi-story-demo--box">
                            <div class="vi-story-demo--screen">
                                <span>AD + CONTENT</span>
                            </div>
                            <div class="vi-story-demo--info">
                                <div class="vi-story-demo--title">
                                    Example vi Story Title Text
                                </div>
                                <div class="vi-story-demo--featured">
                                    <span>featured by</span> <img src="<?php echo plugins_url(self::$folder_name . '/images/vi_logo.svg') ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table cellspacing="2" cellpadding="5" class="form-table form-table--vi-appearance">
                        <tbody>


                            <tr class="form-field">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[backgroundColor]">Background Color</label>
                                    <small>Select a background color that will enable the ad to blend in with your site's theme.</small>
                                </th>
                                <td>
                                    <input id="<?php echo self::$opt_vi_js_settings ?>[backgroundColor]" name="<?php echo self::$opt_vi_js_settings ?>[backgroundColor]" value="<?php echo esc_attr($item[self::$opt_vi_js_settings]['backgroundColor']) ?>"
                                           type="text" maxlength="7" class="ytvi-color-field">
                                </td>
                            </tr>
                            <tr class="form-field">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[textColor]">Text Color</label>
                                    <small>Select a text color that will enable the ad to blend in with your site's theme.</small>
                                </th>
                                <td>
                                    <input id="<?php echo self::$opt_vi_js_settings ?>[textColor]" name="<?php echo self::$opt_vi_js_settings ?>[textColor]" value="<?php echo esc_attr($item[self::$opt_vi_js_settings]['textColor']) ?>"
                                           type="text" maxlength="7" class="ytvi-color-field">
                                </td>
                            </tr>
                            <tr class="form-field">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[font]">Font Family</label>
                                    <small>Select the font that matches your site's theme the most.</small>
                                </th>
                                <td>
                                    <select name="<?php echo self::$opt_vi_js_settings ?>[font]" id="<?php echo self::$opt_vi_js_settings ?>[font]" required>
                                        <?php
                                        $all_fonts = array(
                                            'Arial',
                                            'Arial Black',
                                            'Comic Sans MS',
                                            'Courier New',
                                            'Georgia',
                                            'Impact',
                                            'Lucida Console',
                                            'Lucida Sans Unicode',
                                            'Palatino Linotype',
                                            'Tahoma',
                                            'Times New Roman',
                                            'Trebuchet MS',
                                            'Verdana'
                                        );
                                        foreach ($all_fonts as $font)
                                        {
                                            ?>
                                            <option <?php selected($item[self::$opt_vi_js_settings]['font'], $font) ?> value="<?php echo esc_attr($font) ?>"><?php echo esc_attr($font) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="form-field">
                                <th valign="top" scope="row">
                                    <label for="<?php echo self::$opt_vi_js_settings ?>[fontSize]">Font Size</label>
                                    <small>Select the font size for your ad.</small>
                                </th>
                                <td>
                                    <select name="<?php echo self::$opt_vi_js_settings ?>[fontSize]" id="<?php echo self::$opt_vi_js_settings ?>[fontSize]" required>
                                        <?php
                                        $all_font_sizes = array(
                                            8, 9, 10, 11, 12, 14, 16, 18, 20, 22, 24, 26, 28, 36
                                        );
                                        foreach ($all_font_sizes as $fsize)
                                        {
                                            ?>
                                            <option <?php selected($item[self::$opt_vi_js_settings]['fontSize'], $fsize) ?> value="<?php echo esc_attr($fsize) ?>"><?php echo esc_attr($fsize . 'px') ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <?php
                            if (!empty(self::$alloptions[self::$opt_vi_endpoints]->languages))
                            {
                                ?>
                                <tr class="form-field">
                                    <th valign="top" scope="row">
                                        <label for="<?php echo self::$opt_vi_js_settings ?>[language]">Language</label>
                                        <small>Select from the available list of languages.</small>
                                    </th>
                                    <td>
                                        <select name="<?php echo self::$opt_vi_js_settings ?>[language]" id="<?php echo self::$opt_vi_js_settings ?>[language]" required>
                                            <?php
                                            $all_languages = array();
                                            foreach (self::$alloptions[self::$opt_vi_endpoints]->languages as $lang)
                                            {
                                                $l = get_object_vars($lang);
                                                $all_languages = $l + $all_languages;
                                            }
                                            foreach ($all_languages as $lang_key => $lang_val)
                                            {
                                                ?>
                                                <option <?php selected($item[self::$opt_vi_js_settings]['language'], $lang_key) ?> value="<?php echo esc_attr($lang_key) ?>"><?php echo esc_attr($lang_val) ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="clearboth"></div>
                    <h3>Sizing Tips</h3>
                    <p>The video ad's player will be as large as the container it’s in. If you’d like to change the default size to something smaller, you’ll just need to add some CSS to your website's theme as follows:</p>
                    <ol class="list-ol">
                        <li>
                            You'll be using your site's theme customizer. In the WordPress admin menu on the left, go to <em>Appearance > <a target="_blank" href="<?php echo admin_url('customize.php?return=') . urlencode(admin_url()) ?>">Customize</a></em>.
                        </li>
                        <li>
                            On the customizer page, scroll down in the left menu to "Additional CSS" and click on it.
                        </li>
                        <li>
                            You'll have a textbox to paste in the following CSS (change 480 to your desired max width in pixels):
                            <br><br>
                            <div class="code pre"><?php echo ".ytvi-story-container {
max-width: 480px;
margin: 0 auto;
}" ?></div>
                        </li>
                        <li>
                            When done, click on the "Publish" button at the top to save your change, and then the X to close the theme customizer.
                        </li>                        
                    </ol>
                </section>


                <section class="pattern" id="jumpplacement">
                    <h2><span class="vi-num">3</span> Placement</h2>
                    <p>
                        You can choose to place your ad <strong>automatically</strong>, or <strong>manually</strong> using a shortcode, or in a specific spot in your <strong>theme</strong> code. Each method is explained below.
                    </p>
                    <p>
                        After you finish choosing your placement preferences below, 1) Click on "Save Changes", and 2) <strong class="vi-red">turn on</strong> the ads using the button at the top of this screen.
                    </p>
                    <p>
                        <strong>Note: The ad player will auto-fit to its container when loaded.</strong>
                    </p>

                    <h3>Automatic: Top or Bottom</h3>
                    <p>
                        You can have your ad automatically placed at the top or bottom of your post content--right above your first paragraph (top), or right under your last paragraph (bottom).
                        For optimal revenue, we recommend using the "Top" option:
                    </p>
                    <ul>
                        <li><label><input type="radio" name="<?php echo self::$opt_vi_js_position ?>" value="top" <?php checked($item[self::$opt_vi_js_position] == 'top') ?> /> Top (recommended for highest fill rate)</label></li>
                        <li><label><input type="radio" name="<?php echo self::$opt_vi_js_position ?>" value="bottom" <?php checked($item[self::$opt_vi_js_position] == 'bottom') ?> /> Bottom</label></li>
                    </ul>
                    <p>
                        Next, just check which types of posts you desire to have the ad appear, and the plugin will take care of the rest. 
                        You'll start seeing the ads on your pages after pressing the "Save Changes" button on the bottom right, and turning "ON" vi ads with the top right button.
                    </p>

                    <ul>
                        <?php
                        $all_post_types = get_post_types(array('public' => true), 'objects');
                        foreach ($all_post_types as $pt)
                        {
                            ?>
                            <li><label><input type="checkbox" name="<?php echo self::$opt_vi_js_posttypes ?>[]" value="<?php echo esc_attr($pt->name); ?>" <?php checked(in_array($pt->name, $item[self::$opt_vi_js_posttypes])) ?> /> <?php echo esc_html($pt->label); ?></label></li>
                            <?php
                        }
                        ?>                    
                    </ul>
                    <p>
                        Note that only one ad can appear on a page, but if you'd like more control of exactly <em>where</em> it's placed, see the "Manual" or "Theme Code" directions in the next sections.
                    </p>
                    <h3>Manual: Shortcode or Gutenberg Block</h3>
                    <p>
                        If you didn't select any of the automatic options above, you can manually insert your ad in text widgets, and in specific posts or pages. 
                        See the below screenshot to find the button you can use to manually embed the ad code.
                        (or, use this shortcode directly: <code>[embed-vi-ad]</code>).
                        <strong>We're quite happy to help you if you aren't sure what to do</strong>, especially due the newness of the new Gutenberg editor.  <strong>Just email us at ext@embedplus.com</strong>
                    </p>
                    <p>
                        By the way, if you did make an automatic selection above, do not make any manual insertions. Skip the remaining options on this page, since only one ad code/script is allowed per page and the above has got you covered. 
                    </p>
                    <img class="ss-vi-wizbutton" src="<?php echo plugins_url(self::$folder_name . '/images/ss-vi-wizbutton.png') . '?ver=' . self::$version; ?>"/>                    

                    <h3>Theme Code (advanced)</h3>
                    <p>You can also position the ad directly in your theme code. Copy the PHP code below and paste it where you would like it to appear in your theme.</p>
                    <p><code>echo do_shortcode("[embed-vi-ad]");</code></p>
                </section>


                <section class="pattern" id="jumpadstxt">
                    <div class="adstxt-help">
                        <img src="<?php echo plugins_url(self::$folder_name . '/images/adstxt-help.png') . '?ver=' . self::$version; ?>"/>
                        <p>
                            Trouble with your ads.txt verification? Contact support at <strong><a href="mailto:ext@embedplus.com">ext@embedplus.com</a></strong>
                        </p>                        
                    </div>
                    <h2><span class="vi-num">5</span> Ads.txt Verification</h2>
                    <p>
                        In order for your ads to start generating revenue, verify your ads.txt file.
                    </p>
                    <div class="adstxt-verify-message">

                    </div>

                    <p>
                        Are you also running Google Adsense ads on your site?  If so, also add the following line which is <a href="https://support.google.com/adsense/answer/7532444?hl=en" target="_blank">recommended by Google</a> for ads.txt files (replace the <code>0000000000000000</code> with your actual publisher ID as provided by Google).
                    </p>
                    <p>
                        <code class="adstxt-block">google.com, pub-0000000000000000, DIRECT, f08c47fec0942fa0</code>
                    </p>                    
                </section>


                <section class="pattern" id="jumpperformance">
                    <h2><span class="vi-num">6</span> Revenue Reporting</h2>
                    <div class="vi-report">
                        <div class="vi-total-earnings">
                            <h3>Total Earnings</h3>
                            <div class="vi-total-earnings-num"></div>
                        </div>
                        <div class="vi-report-graph">
                            <div class="vi-report-canvas-box">
                                <canvas id="vi-report-canvas"></canvas>
                            </div>
                        </div>
                        <div class="clearboth"></div>
                        <p>
                            To view more detailed reports on your ad's performance and stats,
                            <a class="button-secondary align-middle" target="_blank" href="<?php echo esc_url(trailingslashit(self::$alloptions[self::$opt_vi_endpoints]->dashboardURL) . 'scar/' . self::$alloptions[self::$opt_vi_token]); ?>">click here</a> 
                            to automatically login to your vi account. Then click on the "Reports" tab as shown below.
                        </p>
                        <p>
                            <img class="ss-vi-img" src="<?php echo plugins_url(self::$folder_name . '/images/ss-vi-dashreports.png'); ?>"/>
                        </p>

                    </div>
                    <div class="vi-report-error hide">
                        <div class="vi-total-earnings-error">
                            <h3>Total Earnings</h3>
                            <div class="vi-total-earnings-num-error">No Data</div>
                        </div>
                        <div class="vi-report-graph-error">
                            <h3>Monthly Earnings Graph</h3>
                            <div class="vi-report-canvas-box-error">
                                <br>
                                <br>
                                No Data
                            </div>
                        </div>
                        <div class="clearboth"></div>
                        <p>
                            Trouble showing the reports? Please try again later, or contact support at <strong><a href="mailto:ext@embedplus.com">ext@embedplus.com</a></strong>
                        </p>
                    </div>

                </section>

                <section class="pattern" id="jumprevenue">
                    <h2><span class="vi-num">7</span> Profile Settings</h2>
                    <p>
                        To enter where you would like to receive your payments,
                        <a class="button-secondary align-middle" target="_blank" href="<?php echo esc_url(trailingslashit(self::$alloptions[self::$opt_vi_endpoints]->dashboardURL) . 'scar/' . self::$alloptions[self::$opt_vi_token]); ?>">click here</a> 
                        to automatically login to your dashboard on vi.ai. Your deposit options, which include bank transfer or PayPal, are found in the "Settings" tab:
                    </p>
                    <p>
                        <img class="ss-vi-img" src="<?php echo plugins_url(self::$folder_name . '/images/ss-vi-dashrevenue.png'); ?>"/>
                    </p>
                    <p>
                        Trouble automatically logging in? <a target="_blank" href="<?php echo esc_url(self::$alloptions[self::$opt_vi_endpoints]->dashboardURL); ?>">Manually login here</a> using the email you signed up with.
                    </p>
                </section>

                <section class="pattern" id="jumpviprivacy">
                    <h2>Privacy</h2>
                    <p>
                        <label>
                            <input type="checkbox" id="<?php echo self::$opt_vi_show_gdpr_authorization ?>" name="<?php echo self::$opt_vi_show_gdpr_authorization ?>" value="1" <?php checked($item[self::$opt_vi_show_gdpr_authorization] == 1) ?> />
                            <strong>Show Privacy/GDPR Popup</strong> - Use the <a href="https://advertisingconsent.eu/" target="_blank">IAB approved</a> method to gain consent from your EU visitors before video intelligence cookies or ad content is loaded.
                        </label>
                    </p>
                    <p class="opt_<?php echo self::$opt_vi_show_privacy_button ?>" style="<?php echo $item[self::$opt_vi_show_gdpr_authorization] == 1 ? '' : 'display: none;' ?>">
                        <label>
                            <input type="checkbox" name="<?php echo self::$opt_vi_show_privacy_button ?>" value="1" <?php checked($item[self::$opt_vi_show_privacy_button] == 1) ?> />
                            <strong>Show Privacy Settings Button</strong> - Checking this will also display a floating button ("vi Privacy Settings") on pages where vi ads are shown. Users can click on it to reevaluate consent without to having to manually manage cookies from their browser settings.
                        </label>
                    </p>
                </section>

                <section class="pattern" id="jumpfaq">
                    <h2>FAQs</h2>

                    <ul class="list-ul">
                        <li>
                            <h3>What kind of video ad unit am I embedding?</h3>
                            <p>It's a unique type of ad unit called a "vi story," which is essentially a video ad wrapped with engaging content related to your website. <a target="_blank" href="<?php echo esc_url(self::$alloptions[self::$opt_vi_endpoints]->demoPageURL); ?>">View a demo here</a> (be sure to turn off ad-blocker to preview the demo).</p>
                            <p>Your ad unit will display content from quality sources like:</p>
                            <p class="vi-ad-source-row">
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-billboard.png') ?>"/>
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-nowthis.png') ?>"/>
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-bonnier.png') ?>"/>
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-cbc.png') ?>"/>
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-thetelegraph.png') ?>"/>
                                <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-itn.png') ?>"/>
                            </p>
                        </li>
                        <li>
                            <h3>Why embed an ad unit that also includes a story, rather than just an ad?</h3>
                            <p>Simply put, advertisers pay more for video advertising when it's matched with video content. With both, you'll increase your visitors' time-on-site and even command up to 10x higher CPM than regular display advertising.</p>
                        </li>
                        <li>
                            <h3>What is my ads.txt file for?</h3>
                            <p>
                                This is an industry standard (IAB-approved) text file that aims to prevent unauthorized inventory sales. 
                                Basically, it helps increase your revenue by verifying to ad buyers that you have a valid site that they are buying ad space for.
                            </p>
                        </li>
                        <li>
                            <h3>What is the best place to put my ad?</h3>
                            <p>
                                To optimize your revenue, we strongly recommend embedding the ad "above the fold" when possible (lower placements tend to yield much less revenue). In general, the higher the placement, the better engagement and revenue.
                                The automatic placement options place the ad at the top of your content area for you, but keep this tip in mind whenever you manually embed the ad.
                            </p>
                        </li>
                        <li>
                            <h3>Why are there no ads, even though I added the code (manually or automatically)?</h3>
                            <p>
                                It's likely that you've added more than one ad script/code to your pages.
                                Perhaps you selected the automatic placement on a post/page but also inserted a separate piece of code/script manually.
                                At this time, only one ad is allowed per page. If you insert more, then no ads might be visible.
                            </p>
                        </li>
                        <li>
                            <h3>Is this video intelligence (vi) monetization feature compatible with Google Adsense?</h3>
                            <p>
                                Yes.  Many publishers are in fact running both Adsense and vi at the same time.  Like vi, Google Adsense recommends that you have an  <a href="https://support.google.com/adsense/answer/7532444?hl=en" target="_blank">ads.txt in your root folder</a>.
                                Therefore, you should also include the following line in your ads.txt -- either before or after the lines you inserted for vi (replace the <code>0000000000000000</code> with the actual publisher ID provided by Google):
                            </p>
                            <p>
                                <code>google.com, pub-0000000000000000, DIRECT, f08c47fec0942fa0</code>
                            </p>
                        </li>
                        <li>
                            <h3>How do I resize the ad?</h3>
                            <p>The video ad's player will be as large as the container it’s in. If you’d like to change the default size to something smaller, you’ll just need to add some CSS to your website's theme as follows:</p>
                            <ol class="list-ol">
                                <li>
                                    You'll be using your site's theme customizer. In the WordPress admin menu on the left, go to <em>Appearance > <a target="_blank" href="<?php echo admin_url('customize.php?return=') . urlencode(admin_url()) ?>">Customize</a></em>.
                                </li>
                                <li>
                                    On the customizer page, scroll down in the left menu to "Additional CSS" and click on it.
                                </li>
                                <li>
                                    You'll have a textbox to paste in the following CSS (change 480 to your desired max width in pixels):
                                    <br><br>
                                    <div class="code pre"><?php echo ".ytvi-story-container {
max-width: 480px;
margin: 0 auto;
}" ?></div>
                                </li>
                                <li>
                                    When done, click on the "Publish" button at the top to save your change, and then the X to close the theme customizer.
                                </li>                        
                            </ol>
                        </li>
                        <li>
                            <h3>I don't want my ad to follow me as I scroll.</h3>
                            <p>
                                This is a feature that greatly increases your rate of revenue. If you would like to turn if off, please <a href="#jumpsupport">contact support</a>.
                            </p>
                        </li>
                        <li>
                            <h3>When will I start seeing ads within the vi story?</h3>
                            <p>
                                It can vary depending on which countries the bulk of your traffic is coming from. For most countries it takes about 1 to 2 days.  If you have questions, email us at ext@embedplus.com
                            </p>
                        </li>
                        <li>
                            <h3>How do I change the number of ads that are shown for each vi story I embed?</h3>
                            <p>
                                vi manages the maximum number of ads and time between them based on each publisher. This is to optimize the fill rates and monetization.  If you would like some custom settings, please <a href="#jumpsupport">contact support</a>.
                            </p>
                        </li>
                        <li>
                            <h3>Why am I seeing ads that do not match my site's topics?</h3>
                            <ol>
                                <li>Wait for 24 hours to give the video intelligence service time to learn more about your site.</li>
                                <li>Check each category and its subcategories to see if there is a better fit for your site’s topics than your initial selections.</li>
                                <li>If you're still not seeing well-matched ads, it's likely that your site's topics are very specific or they are based on categories in which vi.ai is still building inventory.  In the meantime, try and find other categories that you think will be of interest to your audience.</li>
                                <li>If all else fails, please <a href="#jumpsupport">contact support</a>.</li>
                            </ol>
                        </li>
                    </ul>
                    <p><strong>To see a comprehensive list of FAQs, <a target="_blank" href="https://www.vi.ai/publisherfaq/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus">please visit vi FAQs</a>.</strong></p>
                </section>

                <section class="pattern" id="jumpsupport">

                    <h2>Earnings & Payment Support</h2>
                    <p>
                        For issues on the advertising program, your earnings, and <img class="vi-logo-text" alt="vi: video intelligence" src="<?php echo plugins_url(self::$folder_name . '/images/vi_logo.svg') ?>"/>: please contact <strong><a href="mailto:ext@embedplus.com">ext@embedplus.com</a></strong>.
                    </p>
                </section>


                <div class="save-changes-follow"> <?php self::vi_save_changes_button(!empty($message)); ?> </div>
            </form>
        </div>
        <?php
    }

    public static function vi_monetize_title()
    {
        ?>
        Join over 40,000 publishers making money embedding high quality video ads
        <?php
    }

    public static function vi_admin_dashboard_pre()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        ?>

        <div class="wrap wrap-vi wrap-vi-settings-pre">
            <?php
            //self::vi_monetize_title();
            if (self::vi_script_setup_done())
            {
                echo '<h1>';
                self::vi_print_toggle_button();
                echo '</h1>';
            }
            ?>
            <div class="vi-registration-box">
                <?php
                include_once(EPYTVI_INCLUDES_PATH . 'vi_registration_form.php');
                include_once(EPYTVI_INCLUDES_PATH . 'vi_login_success.php');
                ?>
            </div>
        </div>
        <?php
    }

    public static function vi_save_changes_button($submitted)
    {
        $button_label = 'Save Changes';
        if ($submitted)
        {
            $button_label = 'Changes Saved';
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ()
                {
                    setTimeout(function ()
                    {
                        jQuery('input.ytvi-admin-submit').val('Save Changes');
                    }, 3000);
                });

            </script>
            <?php
        }
        ?>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary ytvi-admin-submit" value="<?php _e($button_label) ?>" />
            <em>If you're using a separate caching plugin and you do not see your changes after saving, <strong class="orange">you need to reset your cache.</strong></em>
        </p>
        <?php
    }

    public static function vi_script_tag()
    {
        if (!self::$vi_script_tag_done && self::$alloptions[self::$opt_vi_active] && self::vi_script_setup_done())
        {
            if (stripos(self::$alloptions[self::$opt_vi_js_settings]['iabCategory'], ',') > 0 && self::vi_logged_in())
            {
                $last_category_update = strtotime(self::$alloptions[self::$opt_vi_last_category_update]);
                $last_category_update_plus = strtotime(self::$alloptions[self::$opt_vi_last_category_update] . ' + ' . self::$vi_last_category_update_interval);
                if ($last_category_update_plus < time())
                {
                    $success = self::vi_cache_js(self::$alloptions[self::$opt_vi_js_settings]);
                    if ($success !== true)
                    {
                        self::vi_token_expire();
                    }
                }
            }

            self::$vi_script_tag_done = true;
            $scriptTag = '<div class="ytvi-story-container" id="ytvi_story_container"><script class="ytvi-story-script" type="text/javascript">' .
                    self::$alloptions[self::$opt_vi_js_script] .
                    '</script></div>';
            return $scriptTag;
        }
        return '';
    }

    public static function vi_js_placement($content)
    {
        //$mainquery = is_main_query();

        if (!self::$vi_script_tag_done && self::$alloptions[self::$opt_vi_active] && self::vi_script_setup_done())
        {
            if (!empty(self::$alloptions[self::$opt_vi_js_posttypes]))
            {
                $singular = is_singular(self::$alloptions[self::$opt_vi_js_posttypes]);
                if ($singular && in_the_loop())
                {
                    return self::$alloptions[self::$opt_vi_js_position] == 'top' ? self::vi_script_tag() . $content : $content . self::vi_script_tag();
                }
            }
        }

        return $content;
    }

    public static function vi_js_shortcode($atts, $content = null)
    {
        return self::vi_script_tag();
    }

    public static function wp_insert_vi_api_is_eu()
    {
        $userIp = $_SERVER["REMOTE_ADDR"];
        if (defined('VI_EU_TEST'))
        {
            $userIp = '185.216.33.82'; // force EU for testing
        }
        $isEU = get_transient('wp_insert_vi_api_is_eu_' . $userIp);
        if ($isEU === false)
        {
            try
            {
                $response = wp_remote_get(
                        'http://gdpr-check.net/gdpr/is-eu?ip=' . $userIp, array('timeout' => 15)
                );
                if (!is_wp_error($response))
                {
                    if (200 == wp_remote_retrieve_response_code($response))
                    {
                        $responseBody = json_decode($response['body']);
                        if ((json_last_error() == JSON_ERROR_NONE))
                        {
                            if ((isset($responseBody->is_eu)) && ($responseBody->is_eu == '1'))
                            {
                                delete_transient('wp_insert_vi_api_is_eu_' . $userIp);
                                set_transient('wp_insert_vi_api_is_eu_' . $userIp, '1', WEEK_IN_SECONDS);
                                return true;
                            }
                            else
                            {
                                delete_transient('wp_insert_vi_api_is_eu_' . $userIp);
                                set_transient('wp_insert_vi_api_is_eu_' . $userIp, '0', WEEK_IN_SECONDS);
                                return false;
                            }
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            catch (Exception $ex)
            {
                return false;
            }
        }
        else
        {
            if ($isEU == '1')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    public static function wp_insert_vi_gdpr_popup_init()
    {
        if ((bool) self::$alloptions[self::$opt_vi_show_gdpr_authorization] || defined('VI_EU_TEST'))
        {
            add_action('init', array(get_class(), 'wp_insert_vi_gdpr_data_init'));
            add_action('wp_enqueue_scripts', array(get_class(), 'wp_insert_vi_gdpr_popup_wp_enqueue'));
            add_action('wp_footer', array(get_class(), 'wp_insert_vi_gdpr_popup_wp_footer'));
        }
    }

    public static function wp_insert_vi_gdpr_popup_wp_enqueue()
    {
        wp_enqueue_style('wp_insert_vi_gdpr_css', plugins_url('styles/ytvi-gdpr' . self::$min . '.css', __FILE__), array(), self::$version);
        wp_enqueue_script('wp_insert_vi_gdpr_js', plugins_url('scripts/ytvi-gdpr' . self::$min . '.js', __FILE__), array('jquery'), self::$version, true);
    }

    public static function wp_insert_vi_gdpr_popup_wp_footer()
    {
        $showViConsent = true;
        $isEU = self::wp_insert_vi_api_is_eu();

        if (isset($_COOKIE['Viconsent']))
        {
            $showViConsent = false;
        }

        $labels = array();

        $viConsentPopupContent = isset(self::$alloptions[self::$opt_vi_endpoints]->consentPopupContent) ? self::$alloptions[self::$opt_vi_endpoints]->consentPopupContent : false;
        if ($viConsentPopupContent != false)
        {
            $lang = isset(self::$alloptions[self::$opt_vi_js_settings]['language']) ? self::$alloptions[self::$opt_vi_js_settings]['language'] : 'en-us';
            switch ($lang)
            {
                case 'de-de':
                    $labels['popupContent'] = $viConsentPopupContent->es;
                    $labels['accept'] = 'acepto';
                    $labels['donotaccept'] = 'no acepto';
                    $labels['showPurposes'] = 'Mostrar propósitos';
                    $labels['showVendors'] = 'Mostrar vendedores';

                    break;
                case 'fr-fr':
                    $labels['popupContent'] = $viConsentPopupContent->fr;
                    $labels['accept'] = 'J’accepte';
                    $labels['donotaccept'] = 'Je n’accepte pas';
                    $labels['showPurposes'] = 'Plus de details';
                    $labels['showVendors'] = 'Montrez les vendeurs';
                    break;
                case 'en-us':
                default:
                    $labels['popupContent'] = $viConsentPopupContent->en;
                    $labels['accept'] = 'I accept';
                    $labels['donotaccept'] = 'I do not accept';
                    $labels['showPurposes'] = 'View purposes';
                    $labels['showVendors'] = 'View vendors';
                    break;
            }
        }
        ?>

        <div id="wp_insert_vi_consent_popup_wrapper" style="display: none;">
            <div id="wp_insert_vi_consent_popup_wrapper2">
                <div id="wp_insert_vi_consent_popup_message">
                    <?php echo wp_kses_post($labels['popupContent']); ?>
                </div>
                <div id="wp_insert_vi_consent_popup_actions_wrapper">
                    <input id="wp_insert_vi_consent_popup_disagree_btn" type="button" value="<?php echo $labels['donotaccept'] ?>" onclick="wp_insert_vi_consent_popup_disagree()" />
                    <input id="wp_insert_vi_consent_popup_agree_btn"  type="button" value="<?php echo $labels['accept'] ?>" onclick="wp_insert_vi_consent_popup_agree()" />
                </div>
                <!--            <div id="wp_insert_vi_consent_popup_links_wrapper">-->                
                <!--            </div>-->
                <input id="wp_insert_vi_consent_popup_is_eu" type="hidden" value="<?php echo $isEU ?>" />
                <input id="wp_insert_vi_consent_popup_url" type="hidden" value="<?php echo esc_attr(trailingslashit(get_bloginfo('url'))) ?>" />
                <input id="wp_insert_vi_consent_popup_auth" type="hidden" value="<?php echo wp_create_nonce('wp_insert_vi_consent') ?>" />
                <input id="wp_insert_vi_consent_popup_vendor_list_version" type="hidden" value="<?php echo esc_attr(self::$alloptions[self::$opt_vi_endpoints]->vendorListVersion) ?>" />
                <?php
                $purposesBinary = '000000000000000000000000';
                $purposes = self::$alloptions[self::$opt_vi_endpoints]->purposes;
                if (isset($purposes) && (count($purposes) > 0))
                {
                    foreach ($purposes as $purpose)
                    {
                        $purposesBinary = substr_replace($purposesBinary, '1', ((24 - (int) $purpose->id) + 1), 1);
                    }
                }
                ?>
                <input id="wp_insert_vi_consent_popup_vendor_list_purposes" type="hidden" value="<?php echo esc_attr($purposesBinary) ?>" />
            </div>
        </div>
        <!--        <div id="wp_insert_vi_consent_popup_overlay" style="display: none;"></div>-->
        <?php
        if ((bool) self::$alloptions[self::$opt_vi_show_privacy_button])
        {
            ?>
            <span id="wp_insert_vi_consent_popup_settings_button" onclick="wp_insert_vi_consent_popup_settings()" unselectable="on" style="display: none;">vi Privacy settings</span>
            <?php
        }
    }

    public static function wp_insert_vi_gdpr_data_init()
    {
        if (isset($_GET['wp_insert_vi_consent']) && ($_GET['wp_insert_vi_consent'] != ''))
        {
            check_ajax_referer('wp_insert_vi_consent', 'wp_insert_vi_consent');

            global $wpdb;
            $table_name = $wpdb->prefix . 'vi_consent_logs';
            $query = $wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->esc_like($table_name));
            if ($wpdb->get_var($query) != $table_name)
            {
                self::vi_db_init_schema();
            }

            $viconsent = array(
                'id' => 0,
                'viconsent' => (isset($_COOKIE['Viconsent']) ? $_COOKIE['Viconsent'] : ''),
                'date_created' => date('Y-m-d H:i:s')
            );

            $result = $wpdb->insert($table_name, $viconsent);
            die();
        }
    }

    public static function vi_db_init_schema()
    {
        try
        {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE " . $wpdb->prefix . 'vi_consent_logs' . " (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  viconsent varchar(1000) NOT NULL DEFAULT '',
  date_created datetime NOT NULL,
  PRIMARY KEY  (id)
) $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($sql);
        }
        catch (Exception $ex)
        {
            
        }
    }

    public static function vi_cron_interval($schedules)
    {
        $schedules['ytvi_fifteen_days'] = array(
            'interval' => 1296000,
            'display' => esc_html__('Every 15 Days'),
        );

        $schedules['ytvi_two_minutes'] = array(
            'interval' => 120,
            'display' => esc_html__('Every 2 Minutes'),
        );

        return $schedules;
    }

    public static function vi_cron_cache_js()
    {
        
    }

    public static function vi_last_login_valid()
    {
        $last_login = strtotime(self::$alloptions[self::$opt_vi_last_login]);
        $last_login_plus = strtotime(self::$alloptions[self::$opt_vi_last_login] . ' + 29 days');
        //$last_login_plus = strtotime(self::$alloptions[self::$opt_vi_last_login] . ' + 2 minutes');
        if ($last_login_plus < time())
        {
            return false;
        }
        return true;
    }

    public static function vi_token_expire()
    {
        try
        {
            self::vi_cron_stop();
            if (self::vi_logged_in() && !self::vi_last_login_valid())
            {
                self::update_option_set(array(
                    self::$opt_vi_token => ''
                ));
            }
            else if (self::vi_logged_in() && filter_input(INPUT_SERVER, 'REQUEST_METHOD') != 'POST' && ((is_admin() && filter_input(INPUT_GET, 'page') == 'youtube-ep-vi') || !is_admin())
            ) // (&& not $_POSTing anything, && on monetize page) || NOT admin page...e.g. category randomization
            {
                $adsTxtAPI = self::$alloptions[self::$opt_vi_endpoints]->adsTxtAPI;
                $tokenCheck = self::vi_remote_get($adsTxtAPI);
                $tokenCheck_valid = self::vi_adstxt_api_valid($tokenCheck);
                if ($tokenCheck_valid !== true) // do a token check. if invalid, then:
                {
                    self::update_option_set(array(
                        self::$opt_vi_token => false
                    ));

                    if (is_admin())
                    {
                        wp_safe_redirect(admin_url('admin.php?page=youtube-ep-vi'));
                        exit;
                    }
                }
            }
        }
        catch (Exception $ex)
        {
            
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////


    public static function gb_block_assets()
    {
        // frontend+backend styles.
        wp_enqueue_style('epytgb-style-css', plugins_url('dist/blocks.style.build.css', __FILE__), array('wp-blocks'), self::$version);
    }

    public static function gb_editor_assets()
    {
        // backend styels
        self::ytprefsscript();
        self::fitvids();

        if (!self::is_restrict_wizard() && current_user_can('edit_posts'))
        {
            // Scripts.
            wp_enqueue_script(
                    'epytgb-block-js', // Handle.
                    plugins_url('/dist/blocks.build.js', __FILE__), // Block.build.js: We register the block here. Built with Webpack.
                    array('wp-blocks', 'wp-i18n', 'wp-element'), // Dependencies, defined above.
                    self::$version, true // Enqueue the script in the footer.
            );

            // Styles.
            wp_enqueue_style(
                    'epytgb-block-editor-css', // Handle.
                    plugins_url('dist/blocks.editor.build.css', __FILE__), // Block editor CSS.
                    array('wp-edit-blocks'), // Dependency to include the CSS after it.
                    self::$version
            );

            wp_enqueue_style('__ytprefs_admin__vi_css', plugins_url('styles/ytvi-admin' . self::$min . '.css', __FILE__), array(), self::$version);

            // Tiny MCE
            wp_enqueue_style('__ytprefs_admin__tinymce_css', plugins_url('styles/epyt_mce_wizard_button' . self::$min . '.css', __FILE__), array(), self::$version);
        }
    }

    public static function gb_classic_block_setup()
    {
        if (!self::is_restrict_wizard() && current_user_can('edit_posts'))
        {
            add_thickbox();
            add_filter("mce_external_plugins", array(get_class(), "gb_add_tinymce_plugin"));
            add_filter('mce_buttons_2', array(get_class(), 'gb_register_tinymce_button'));
        }
    }

    public static function gb_add_tinymce_plugin($plugin_array)
    {
        $plugin_array['epyt_mce_wizard_button'] = plugins_url('scripts/epyt_mce_wizard_button' . self::$min . '.js', __FILE__) . '?ver=' . self::$version;
        return $plugin_array;
    }

    public static function gb_register_tinymce_button($buttons)
    {
        array_push($buttons, "epyt_mce_wizard_button");
        return $buttons;
    }

    public static function gb_svg_defs()
    {
        ?>
        <svg style="height: 0 !important; width: 0 !important; display: absolute !important; top: 0 !important; left: 0 !important;"><defs><style>.epytcls-1{fill:red;}.epytcls-2{fill-rule:evenodd;fill:url(#radial-gradient);}.epytcls-3{fill:#31aaff;}.epytcls-4{fill:#fff;}</style><radialGradient id="radial-gradient" cx="193" cy="85.85" r="77.53" gradientUnits="userSpaceOnUse"><stop offset="0.17" stop-color="#fff"/><stop offset="0.68" stop-color="#31aaff"/></radialGradient></defs></svg>
        <?php
    }

    public static function gb_register_block_types()
    {
        if (function_exists('register_block_type'))
        {
            register_block_type(
                    'epyt/youtube', array(
                'attributes' => array(
                    'shortcode' => array(
                        'type' => 'string'
                    )
                ),
                'render_callback' => array(get_class(), 'gb_render_callback_youtube'),
                    )
            );
        }
    }

    public static function gb_render_callback_youtube($attributes, $content)
    {
        if ($attributes && $attributes['shortcode'] && strpos($attributes['shortcode'], '[') === 0)
        {
            $render = do_shortcode($attributes['shortcode']);
            if (empty($render) && stripos($attributes['shortcode'], 'live=1') !== false)
            {
                $render = '<em>This is a live embed that is not currently streaming. You can optionally fill out the <a href="' . admin_url('admin.php?page=youtube-my-preferences') . '#not_live_content_scroll" target="_blank">Not Live Content</a> field in the YouTube plugin\'s Default Settings.</em>';
            }
            return $render;
        }
        return isset($attributes['shortcode']) ? $attributes['shortcode'] : '';
    }

}

// constants
define('EPYT_BASE_URL', rtrim(plugins_url('', __FILE__), "\\/") . '/');
define('EPYTVI_INCLUDES_PATH', rtrim(dirname(__FILE__), "\\/") . '/includes/vi/');
define('EPYTGB_INCLUDES_PATH', rtrim(dirname(__FILE__), "\\/") . '/includes/gutenberg/');
if (!defined('EPYTVI_ENDPOINTS_URL'))
    define('EPYTVI_ENDPOINTS_URL', 'https://dashboard-api.vidint.net/v1/api/widget/settings');

$youtubeplgplus = new YouTubePrefs();




