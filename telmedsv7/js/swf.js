jQuery(document).ready(function() {

jQuery('#upload_swf_button').click(function() {
 formfield = jQuery('#swf').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#swf').val(imgurl);
 tb_remove();
}

});