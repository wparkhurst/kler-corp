<?php  
ob_start();
$overview = get_option('cookielawinfo_privacy_overview_content_settings', array('privacy_overview_content' => '','privacy_overview_title' => '',));
$cli_always_enable_text = __('Always Enabled', 'cookie-law-info'); 
$cli_enable_text = __('Enabled', 'cookie-law-info'); 
$cli_disable_text = __('Disabled', 'cookie-law-info'); 
$cli_privacy_readmore='<a class="cli-privacy-readmore" data-readmore-text="'.__('Show more', 'cookie-law-info').'" data-readless-text="'.__('Show less', 'cookie-law-info').'"></a>';
$third_party_cookie_options=get_option('cookielawinfo_thirdparty_settings');
$necessary_cookie_options=get_option('cookielawinfo_necessary_settings');
?>
<div class="cli-container-fluid cli-tab-container">
    <div class="cli-row">
        <div class="cli-col-12 cli-align-items-stretch cli-px-0">
            <div class="cli-privacy-overview">
                <?php  
                $overview_title = $overview['privacy_overview_title'];
                $privacy_overview_content = $overview['privacy_overview_content'] ;
                $privacy_overview_content=nl2br($privacy_overview_content); 
                $privacy_overview_content = do_shortcode(stripslashes($privacy_overview_content));
                $content_length=strlen(strip_tags($privacy_overview_content));
                ?>
                <h4><?php echo $overview_title; ?></h4>                                         
                <div class="cli-privacy-content">
                    <p class="cli-privacy-content-text"><?php echo $privacy_overview_content;?></p>
                </div>
                <?php echo $cli_privacy_readmore; ?>
            </div>
        </div>  
        <div class="cli-col-12 cli-align-items-stretch cli-px-0 cli-tab-section-container">
            <div class="cli-tab-section cli-privacy-tab">
                <div class="cli-tab-header">
                    <a class="cli-nav-link cli-settings-mobile" >
                        <?php echo $overview_title; ?>
                    </a>
                </div>
                <div class="cli-tab-content">
                    <div class="cli-tab-pane cli-fade">
                        <p><?php echo $privacy_overview_content;?></p>
                    </div>
                </div>

            </div>
            <?php  
            $cookie_categories = self::get_cookie_categories();
            foreach ($cookie_categories as $key => $value) 
            {   
                $checked = false;
                $cli_checked='';
                if(isset($_COOKIE["cookielawinfo-checkbox-$key"]) && $_COOKIE["cookielawinfo-checkbox-$key"] =='yes')
                {
                    $checked = true;  
                    $cli_checked='checked';
                }
                else if(!isset($_COOKIE["cookielawinfo-checkbox-$key"]))
                {   
                    $checked = true;
                    $cli_checked='checked';     
                }
                if($key == 'necessary') 
                {   
                    $cli_switch='
                    <span class="cli-necessary-caption">'.$cli_always_enable_text.'</span> ';
                    $cli_cat_content=$necessary_cookie_options['necessary_description'];
                }
                else
                {
                    $cli_switch=
                    '<div class="cli-switch">
                        <input type="checkbox" id="checkbox-'.$key.'" class="cli-user-preference-checkbox" data-id="checkbox-'.$key.'" '.$cli_checked.' />
                        <label for="checkbox-'.$key.'" class="cli-slider" data-cli-enable="'.$cli_enable_text.'" data-cli-disable="'.$cli_disable_text.'">'.$value.'</label>
                    </div>';
                    $cli_cat_content=$third_party_cookie_options['thirdparty_description'];
                }
            ?>
                <div class="cli-tab-section">
                <div class="cli-tab-header">
                    <a class="cli-nav-link cli-settings-mobile" data-target="<?php echo $key; ?>" data-toggle="cli-toggle-tab" >
                        <?php echo $value ?> 
                    </a>
                <?php echo $cli_switch; ?>
                </div>
                <div class="cli-tab-content">
                    <div class="cli-tab-pane cli-fade" data-id="<?php echo $key; ?>">
                        <p><?php echo do_shortcode($cli_cat_content, 'cookielawinfo-category' ); ?></p>
                    </div>
                </div>
                </div>
            <?php  } ?>
           
        </div>
    </div> 
</div> 
<?php $pop_out=ob_get_contents();
ob_end_clean();