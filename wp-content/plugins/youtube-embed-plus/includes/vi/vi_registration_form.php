<div class="vi-demo-col-phone">
    <div class="vi-demo-mobile-caption-list">
        <div class="vi-demo-mobile-caption vi-demo-caption-1 demo-hide">
            <p>
                A game blogger posts Nintendo Switch game reviews and monetizes them using vi. The player combines a funny ad about Switch's chipmaker with an interview about Switch game quality.
            </p>
        </div>
        <div class="vi-demo-mobile-caption vi-demo-caption-2">
            <p>
                A food blogger posts a tasty pasta recipe that's monetized using vi. The player intelligently combines a food promotion followed by directions for a complementary salad into <strong>one</strong> ad unit.
            </p>
        </div>
    </div>
    <div class="vi-demo-mobile">
        <div class="vi-demo-mobile-ratio">
            <img class="vi-demo-screen-1 vi-demo-screen" src="<?php echo plugins_url(self::$folder_name . '/images/vi-demo-1.gif') ?>"/>
            <img class="vi-demo-screen-2 vi-demo-screen" src="<?php echo plugins_url(self::$folder_name . '/images/vi-demo-2.gif') ?>"/>
        </div>
    </div>

    <p class="vi-ad-source-row">
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-billboard.png') ?>"/>
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-nowthis.png') ?>"/>
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-bonnier.png') ?>"/>
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-cbc.png') ?>"/>
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-thetelegraph.png') ?>"/>
        <img class="vi-ad-source" src="<?php echo plugins_url(self::$folder_name . '/images/vi-source-itn.png') ?>"/>
    </p>

</div>
<div class="vi-demo-col-content">
    <div class="vi-demo">
        <?php
        $multiCatWarning = '';
        if (!empty(self::$alloptions[self::$opt_vi_js_settings]['iabCategory']))
        {
            $iabCategoryList = explode(',', self::$alloptions[self::$opt_vi_js_settings]['iabCategory']);
            if (count($iabCategoryList) > 1)
            {
                $multiCatWarning = ' Note: If you selected more than one video category, you must stay logged in to this settings page for your categories to automatically add variety to your ads.';
            }
        }
        if (self::$alloptions[self::$opt_vi_token] === false)
        {
            ?>
            <div class="login-expire">
                For your security, your session has expired. Please login to vi again below to view your settings. <?php echo $multiCatWarning; ?>
            </div>
            <?php
        }
        else if ((self::vi_script_setup_done() && !self::vi_last_login_valid()))
        {
            ?>
            <div class="login-expire">
                For your security, your session expires every 30 days. Please login to vi again below to view your settings. <?php echo $multiCatWarning; ?>
            </div>
            <?php
        }
        ?>
        <p class="vi-demo-lede">
            You now have the option to make money embedding quality video ads that offer up to 10 times higher CPMs than display advertising. The ads that you will embed are privacy/GDPR friendly,
            powered by <img class="vi-logo-text" alt="vi" src="<?php echo plugins_url(self::$folder_name . '/images/vi_logo.svg'); ?>">
            video intelligence,
            <!--            <a href="https://www.vi.ai/publisher-video-monetization/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">video intelligence</a>,-->
            completely separate from your YouTube embeds, and can provide extra income on top of revenue from your current ads.
        </p>
        <p>
            Instead of an ordinary video ad, vi ads are so effective because they wrap an ad with additional useful video content that you yourself don't have to produce. 
            Embed the vi player, and the content will automatically match your site's topics to attract your visitors' attention. 
            <strong>You get free related content that you're paid to embed. </strong>
        </p>
        <p>
            Check out the demos on the right. Below, sign up for free in minutes.
        </p>
    </div>
    <div class="ytvi-wrap">
        <div class="ytvi-step ytvi-step-1">
            <div class="ytvi-step-1--form">
                <div class="side-signup ytprefs-ajax-form">
                    <h1>Start earning today</h1>
                    <h2>Earn 10x higher CPMs</h2>
                    <p class="description">Where should we send your welcome and revenue info?</p>
                    <p>
                        <input class="textinput regular-text ytvi-register-email" type="text" placeholder="Your email" />
                    </p>
                    <p class="description">
                        <label>
                            <input type="checkbox" class="ytvi-step-1--confirm"/>
                            I understand that vi will create my account using my email, my domain, and EmbedPlus as the referral.
                        </label>
                    </p>
                    <p>
                        <input disabled class="button-primary ytvi-step-1--submit-register ytprefs-ajax-form--submit" type="button" value="Next &raquo;"/>
                    </p>
                </div>
                <div class="side-login ytprefs-ajax-form">
                    <h1>Log in to vi</h1>
                    <h2>Join 40,000+ publishers</h2>
                    <p class="description">Already signed up? Login here using the info from your welcome email.</p>
                    <p>
                        <input class="textinput regular-text ytvi-login-email" type="text" placeholder="Your email" />
                    </p>
                    <p>
                        <input class="textinput regular-text ytvi-password" type="password" placeholder="Password" />
                    </p>
                    <p>
                        <input class="button-primary ytvi-step-1--submit-login ytprefs-ajax-form--submit" type="button" value="Log In &raquo;">
                        <a class="vi-forgot-pw" href="https://dashboard.vi.ai/resetPassword/" target="_blank">Forgot Password?</a>
                    </p>
                </div>
                <div class="vi-contact-support">
                    <p class="center"><em>Need help signing up or signing in? Contact support at <strong><a href="mailto:ext@embedplus.com">ext@embedplus.com</a></strong></em></p>
                    <p class="center"><a href="https://www.vi.ai/legals/?aid=WP_embedplus&utm_source=Wordpress&utm_medium=WP_embedplus" target="_blank">vi.ai Terms & Privacy</a></p>
                </div>
            </div>
           <?php
            if (!self::vi_script_setup_done())
            {
                ?>
                <p class="box-vi-not-interested">
                    Not interested? You can hide this by checking <a class="vi-not-interested" target="_top" href="<?php echo admin_url('admin.php?page=youtube-my-preferences#vi_hide_monetize_tab') ?>"><em>Hide "Monetize" Feature</em></a> found in the YouTube Settings "Defaults" tab.
                </p>            
                <?php
            }
            ?>
        </div>
        <div class="ytvi-step ytvi-step-2-loading">
            <p class="ytvi-loading--message">
                <img src="<?php echo EPYT_BASE_URL . 'images/ajax-loader.gif' ?>"> Loading sign up form...
            </p>
        </div>
        <div class="ytvi-step ytvi-step-2">
            <h3>Step 2 of 2 - Complete Registration</h3>
            <div class="ytvi-registration">
                <div class="ytvi-step-2-msg">
                    <ol>
                        <li><strong>Register</strong> below.</li>
                        <li><strong>Check your email</strong> for a confirmation link. Vi will verify your site for quality standards, so it may take about 48 hours for approval. Weekend signups will be processed starting on Monday.</li>
                        <li><strong>Come right back here</strong> after creating your password
                            <?php
                            $curr_screen = get_current_screen();
                            echo strpos($curr_screen->id, 'youtube-ep-vi') !== false || strpos($curr_screen->id, 'youtube-my-preferences') !== false ? 'and refresh this page.' : 'and <a target="_blank" href="' . admin_url('admin.php?page=youtube-ep-vi') . '">click here</a>.'
                            ?> (Note: <u><strong>Skip</strong> the "integration tags" step</u> that you might see after confirmation, because this plugin will automatically do that step for you.)
                        </li>
                        <li>
                            <strong>Login below</strong> to complete the setup.
                        </li>
                    </ol>
                </div>
                <iframe frameborder="0"></iframe>
                <p class="center">
                    <input class="button-secondary ytvi-registration--cancel" type="button" value="&laquo; Go Back"/>
                </p>
            </div>
        </div>
        <div class="ytvi-step ytvi-login-loading">
            <p class="ytvi-loading--message">
                <img src="<?php echo EPYT_BASE_URL . 'images/ajax-loader.gif' ?>"> Logging you in...
            </p>
        </div>

    </div>
</div>
<?php
if (!self::vi_cover_prompt_yes())
{
    ?>
    <div class="clearboth vi-cover-clear"></div>
    <div class="vi-cover-prompt">
        <h1>
            Hey! We have a new optional feature to help you earn income by embedding relevant video content that offers you up to 10x higher CPMs than display advertising. 
            <br>
            <br>
            Are you interested in learning more about this free feature?
        </h1>
        <p class="vi-cover-prompt-buttons">
            <button type="button" class="button-primary vi-cover-prompt-yes">Yes, tell me more.</button>
            <button type="button" class="button-secondary vi-cover-prompt-maybe">Maybe later.</button>
            <button type="button" class="button-secondary vi-cover-prompt-no">No, hide this feature.</button>
        </p>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" class="viblurfilter-svg">
        <defs>
        <filter id="viblurfilter">
            <feGaussianBlur stdDeviation="8" />
        </filter>
        </defs>
        </svg>
    </div>
<?php } ?>
