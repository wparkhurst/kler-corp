(function( $ ) {
    $(function() {
        $('.color-field').wpColorPicker();
        $(".area-name").on('click',  function(event) {
            event.preventDefault();
            $(this).parent().toggleClass('open');
        });
    });
})( jQuery );
tinymce.init({
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
    selector: "textarea",
    menubar : false,
    toolbar: " bold italic underline forecolor | image | code | addmedia",
    style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor addmedia"
    ],
});