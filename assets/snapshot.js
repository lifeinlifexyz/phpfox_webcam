/**
 * CodeMake.Org
 */

$Ready(function () {
    if ($('.profile_image form').length > 0){
        $('#cmpwebcam-snapshot').remove();
        var cmpwebcamElement = '<div id="cmpwebcam-snapshot" class="cmpwebcam-snapshot">WebCam</div>';
        $('.profile_image').prepend(cmpwebcamElement);
        $('.profile_image').off('click').on('click', '#cmpwebcam-snapshot', function () {
            tb_show('WebCam', $.ajaxBox('cmpwebcam.snapshotBox', 'height=400&width=400'));
        });
        if ($('.js_box_title').text() == 'WebCam'){
            $('.js_box').off('click').on('click', '.js_box_close a', function () {
                // Webcam.freeze();
                alert('turned off');
            });
        }

    }
});
