(function ($)
{
    // https://github.com/WordPress/gutenberg/issues/10509
    if ($('body').hasClass('block-editor-page'))
    {
        tinymce.PluginManager.add('epyt_mce_wizard_button', function (editor, url)
        {
            editor.addButton('epyt_mce_wizard_button', {
                title: 'YouTube Wizard',
                icon: 'icon epyt_mce_wizard_button--icon',
                onclick: function () // mousedown? touch?
                {
                    try
                    {
                        window._EPYTA_.mceBookmark = editor.selection.getBookmark(2, true);
                    }
                    catch (err)
                    {
                    }
                    setTimeout(function ()
                    {
                        tb_show('YouTube Wizard', window._EPYTA_.wizhref);
                        window._EPYTA_.widen_ytprefs_wiz();
                    }, 600);
                }
            });
        });
    }
})(jQuery);