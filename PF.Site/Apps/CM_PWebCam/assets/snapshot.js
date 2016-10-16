/**
 * CodeMake.Org
 */

$Ready(function () {
    if ($('.profile_image form').length > 0){
        $('#cmpwebcam-snapshot').remove();
        var cmpwebcamElement = '<div id="cmpwebcam-snapshot" class="cmpwebcam-snapshot">WebCam</div>';
        $('.profile_image').prepend(cmpwebcamElement);
        $('.profile_image').off('click').on('click', '#cmpwebcam-snapshot', function () {
            tb_show('WebCam', $.ajaxBox('cmpwebcam.snapshotBox', 'height=350&width=360'));
        });
    }
});
