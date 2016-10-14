<?php

/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */

event('app_settings', function ($settings){
    if (isset($settings['cm_pwebcam_enabled'])) {
        \Phpfox::getService('admincp.module.process')->updateActivity('cmpwebcam', $settings['cm_pwebcam_enabled']);
    }
});

if (setting('cm_pwebcam_enabled')) {

    \Phpfox_Module::instance()->addComponentNames('block', [
        'cmpwebcam.box'    => '\Apps\CM_PWebCam\Block\Box',
    ])->addComponentNames('ajax', [
        'CM_PWebCam.ajax' => '\Apps\CM_PWebCam\Ajax\Ajax',
        'cmpwebcam.ajax'  => '\Apps\CM_PWebCam\Ajax\Ajax',
    ])->addTemplateDirs([
        'cmpwebcam' => PHPFOX_DIR_SITE_APPS . 'CM_PWebCam' . PHPFOX_DS . 'views',
    ]);
    group('/cmpwebcam', function (){

    });
}

