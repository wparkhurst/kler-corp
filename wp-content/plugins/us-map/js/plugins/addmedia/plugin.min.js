tinymce.PluginManager.add("addmedia", function (a, b) {
    a.addButton("addmedia", {
        text: "Add Media", icon: !1, onclick: function () {
           tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        	
        	window.send_to_editor = function(html) {
            console.log(html);
            a.insertContent(html);
         // imgurl = jQuery('img',html).attr('src');
         // jQuery('#wpss_upload_image').val(imgurl);
            tb_remove();

         //jQuery('#wpss_upload_image_thumb').html("<img height='65' src='"+imgurl+"'/>");
            };
            // a.windowManager.open({
            //     title: "Add Media",
            //     body: [{type: "textbox", name: "title", label: "Title"}],
            //     onsubmit: function (b) {
            //         a.insertContent("Title: " + b.data.title)
            //     }
            // })
        }
    });
});