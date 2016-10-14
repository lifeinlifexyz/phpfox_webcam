<?php
/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<div id="results">Your captured image will appear here...</div>
<div id="cmpwebcam_my_camera"></div>
<script type="text/javascript">
    {literal}
    $Behavior.onBoxLoad = function()
    {
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#cmpwebcam_my_camera' );
        $('#cmpwebcam_preview_snapshot').off('click').on('click', function () {
            Webcam.freeze();
            $('#pre_take_buttons').css('display', 'none');
            $('#post_take_buttons').css('display', 'block');
        });
        $('#cmpwebcam_cancel_preview').off('click').on('click', function () {
            // cancel preview freeze and return to live camera feed
            Webcam.unfreeze();
            // swap buttons back
            $('#pre_take_buttons').css('display', 'block');
            $('#post_take_buttons').css('display', 'none');
        });
        $('#cmpwebcam_save_photo').off('click').on('click', function () {
            // actually snap photo (from preview freeze) and display it
            Webcam.snap( function(data_uri) {
                // display results in page
                $('#results').html('<h2>Here is your image:</h2><img src="'+data_uri+'"/>');
                $('#pre_take_buttons').css('display', 'block');
                $('#post_take_buttons').css('display', 'none');
            } );
        });
    };
    $Behavior.onBoxLoad();

    {/literal}
</script>
<div id="pre_take_buttons">
    <input type=button value="Take Snapshot" id="cmpwebcam_preview_snapshot">
</div>
<div id="post_take_buttons" style="display:none">
    <input type="button" value="&lt; Take Another" id="cmpwebcam_cancel_preview">
    <input type="button" value="Save Photo &gt;" id="cmpwebcam_save_photo" style="font-weight:bold;">
</div>