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
            return Phpfox::getBlock('cmpwebcam.box', array('fup'=>true));
        }
    }

    public function uploadPhoto()
    {
        Phpfox::isUser();
        if (Phpfox::isModule('user')){
            if (!empty($this->get('data-image'))) {
                $iUserId = Phpfox::getUserId();

                $sTempPath = PHPFOX_DIR_CACHE . md5('user_avatar' . $iUserId) . '.jpg';
                $mData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', str_replace(' ', '+', $this->get('data-image'))));
                file_put_contents($sTempPath, $mData);
                Phpfox::getService('user.process')->removeProfilePic(Phpfox::getUserId());
                if (file_exists($sTempPath)){
                    $aUserImage = Phpfox::getService('user.process')->uploadImage($iUserId, true, $sTempPath);
                }
                if (isset($aUserImage['user_image']) && !empty($aUserImage['user_image'])){
                    $sUserImage = $aUserImage['user_image'];
                }else {
                    $sUserImage = Phpfox::getUserBy('user_image');
                }
                if ($sUserImage){
                    $oImage = Phpfox_Image::instance();
                    foreach (Phpfox::getParam('user.user_pic_sizes') as $iSize) {
                        if (Phpfox::getParam('core.keep_non_square_images')) {
                            $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize), $iSize, $iSize);
                        }
                        $oImage->createThumbnail($sTempPath, Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_' . $iSize . '_square'), $iSize, $iSize, false);
                    }
                    @unlink($sTempPath);
                    $this->hide('#cmpwebcam_ajax_load');
                    if (!defined('PHPFOX_IS_USER_PROFILE')){
                        if (file_exists(Phpfox::getParam('core.dir_user') . sprintf($sUserImage, '_75_square'))){
                            $this->call('if ($("#cmpwebcam_fup_avatar_result").length > 0){$("#cmpwebcam_fup_avatar_result").html(\'<img width="75" src="'.Phpfox::getParam('core.url_user') . sprintf($sUserImage, '_75_square').'?v='.uniqid().'" />\');$("#cmpwebcam_fup_avatar_result").show();}else{window.location.href="'.Phpfox::getLib('url')->makeUrl('profile').'";}');
                        } else {
                            $this->alert(_p('Your avatar photo successfully changed'));
                        }
                    } else {
                        $this->call('window.location.href="'.Phpfox::getLib('url')->makeUrl('profile').'";');
                    }

                }

            }
        }
    }
}