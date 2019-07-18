<h1>Hooray!</h1>
<p class="ytvi-login-success-message"></p>
<a class="button-primary vi-logged-in-goto" target="_blank"  href="<?php echo admin_url('admin.php?page=youtube-ep-vi'); ?>">
    <?php
    if (!self::vi_script_setup_done())
    {
        ?>
        Click here to complete setup &raquo;
        <?php
    }
    else
    {
        ?>
        Click here to begin customizing &raquo;
        <?php
    }
    ?>
</a>
