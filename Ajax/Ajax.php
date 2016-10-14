<?php
namespace Apps\CM_PWebCam\Ajax;

/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */

use Phpfox;
use Phpfox_Ajax;
use Phpfox_Image;

/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */


class Ajax extends Phpfox_Ajax
{
    public function snapshotBox()
    {
        Phpfox::isUser();
        if (setting('cm_pwebcam_enabled')) {
            return Phpfox::getBlock('cmpwebcam.box');
        }
    }

    public function uploadPhoto()
    {
        Phpfox::isUser();
        if (Phpfox::isModule('user')){
            if (isset($aVals['data-image']) && !empty($aVals['data-image'])) {
                $iUserId = Phpfox::getUserId();
                $sTempPath = PHPFOX_DIR_CACHE . md5('user_avatar' . $iUserId) . '.jpg';
                list($mType, $aData) = explode(';', $aVals['data-image']);
                list(, $aData) = explode(',', $aData);
                $aData = base64_decode($aData);
                file_put_contents($sTempPath, $aData);
                $oImage = Phpfox_Image::instance();
                $sUserImage = Phpfox::getUserBy('user_image');

                foreach (Phpfox::getParam('user.user_pic_sizes') as $iSize) {
                    if (Phpfox::getParam('core.keep_non_square_images')) {
                        $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize), $iSize, $iSize);
                    }
                    $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize . '_square'), $iSize, $iSize, false);
                }
                @unlink($sTempPath);
                if (!defined('PHPFOX_IS_AJAX_PAGE')) {
                    define('PHPFOX_IS_AJAX_PAGE', true);
                }
                Phpfox::getLib('url')->send('profile');
            }
        }
    }
}