<?php
/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */

defined('PHPFOX') or exit('NO DICE!');

?>
<i id="cmpwebcam_ajax_load" style="display: none;" class="fa fa-spinner" aria-hidden="true"></i>
<div id="cmpwebcam_result" style="display: none;"></div>
<div id="cmpwebcam_my_camera"></div>
<script type="text/javascript">
    {literal}
    $Behavior.onBoxLoad = function()
    {
        var cropped;
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
        Webcam.attach('#cmpwebcam_my_camera');
        $('.js_box:first').on('click', '.js_box_close a', function () {
            Webcam.reset();
        });
        $('#cmpwebcam_preview_snapshot').off('click').on('click', function () {
            Webcam.freeze();
            $('#cmpwebcam_pre_take_buttons').hide();
            $('#cmpwebcam_post_take_buttons').show();
        });
        $('#cmpwebcam_cancel_preview').off('click').on('click', function () {
            Webcam.unfreeze();
            $('#cmpwebcam_pre_take_buttons').show();
            $('#cmpwebcam_post_take_buttons').hide();
        });
        $('#cmpwebcam_save_photo').off('click').on('click', function () {
            Webcam.snap( function(data_uri) {
                $('#cmpwebcam_ajax_load').show();
                $.ajaxCall('cmpwebcam.uploadPhoto', 'data-image='+data_uri+'{/literal}{if isset($fup)}&fup=true{/if}{literal}', 'POST');
                $('#cmpwebcam_pre_take_buttons').show();
                $('#cmpwebcam_post_take_buttons').hide();
            } );
        });
        $('#cmpwebcam_crop').off('click').on('click', function () {
            $('#cmpwebcam_result').show();
            $('#cmpwebcam_my_camera').hide();
            $('#cmpwebcam_pre_take_buttons').hide();
            $('#cmpwebcam_post_take_buttons').hide();
            $('#cmpwebcam_crop_section_buttons').show();
            Webcam.snap( function(data_uri) {
                var cropType = 'square';
                if (typeof cm_pwebcam_type_of_the_inner_container_of_the_crop != 'undefined' && cm_pwebcam_type_of_the_inner_container_of_the_crop != ''){
                    cropType = cm_pwebcam_type_of_the_inner_container_of_the_crop;
                }
                cropped = $('#cmpwebcam_result').croppie({
                    url: data_uri,
                    viewport: {
                        width: 200,
                        height: 200,
                        type: cropType
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });
                $('#cmpwebcam_crop_save').click(function(){
                    cropped.croppie('result','canvas').then(function (data_uri)
                    {
                        $('#cmpwebcam_ajax_load').show();
                        $.ajaxCall('cmpwebcam.uploadPhoto', 'data-image='+data_uri+'{/literal}{if isset($fup)}&fup=true{/if}{literal}', 'POST');
                    });
                });
            });
        });
        $('#cmpwebcam_goto_webcam').off('click').on('click', function () {
            $('#cmpwebcam_crop_section_buttons').hide();
            $('#cmpwebcam_result').hide();
            cropped.croppie('destroy');
            $('#cmpwebcam_my_camera').show();
            $('#cmpwebcam_cancel_preview').trigger('click');
        });
    };
    $Behavior.onBoxLoad();
    {/literal}
</script>
<div id="cmpwebcam_pre_take_buttons">
    <button type="button" class="btn btn-primary btn-lg" id="cmpwebcam_preview_snapshot">
        <i class="fa fa-camera" aria-hidden="true"></i>
    </button>
</div>
<div id="cmpwebcam_post_take_buttons" style="display:none">
    <button type="button" class="btn btn-warning btn-lg" id="cmpwebcam_cancel_preview">
        <i class="fa fa-reply" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-primary btn-lg" id="cmpwebcam_crop">
        <i class="fa fa-crop" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-success btn-lg" id="cmpwebcam_save_photo">
        <i class="fa fa-save" aria-hidden="true"></i>
    </button>
</div>

<div id="cmpwebcam_crop_section_buttons" style="display:none">
    <button type="button" class="btn btn-warning btn-lg" id="cmpwebcam_goto_webcam">
        <i class="fa fa-reply" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-success btn-lg" id="cmpwebcam_crop_save">
        <i class="fa fa-save" aria-hidden="true"></i>
    </button>
</div>