<?php
namespace Apps\CM_PWebCam;

use Core\App;

/**
 * Class Install
 * @author  CodeMake.Org
 * @version 4.5.0
 * @package Apps\CM_PWebCam
 */
class Install extends App\App
{
    private $_app_phrases = [

    ];
    protected function setId()
    {
        $this->id = 'CM_PWebCam';
    }
    protected function setAlias()
    {
        $this->alias = 'cmpwebcam';
    }
    protected function setName()
    {
        $this->name = 'CM Profile Avatar with Webcam';
    }
    protected function setVersion() {
        $this->version = '1.0.1';
    }
    protected function setSupportVersion() {
        $this->start_support_version = '4.2.0';
        $this->end_support_version = '4.5.0';
    }
    protected function setSettings() {
        $this->settings = ['cm_pwebcam_enabled' => ['info' => 'Profile Avatar With Webcam App Enabled','type' => 'input:radio','value' => '1',],'cm_pwebcam_enable_link_on_top_the_profile_image' => ['info' => 'Enable webcam link on top the profile image','type' => 'input:radio','value' => '1',],'cm_pwebcam_type_of_the_inner_container_of_the_crop' => ['info' => 'Type of the inner container of the crop. The visible part of the image.','type' => 'select','options' => ['square' => 'square','circle' => 'circle',],'js_variable' => '1',],];
    }
    protected function setUserGroupSettings() {}
    protected function setComponent() {}
    protected function setComponentBlock() {}
    protected function setPhrase() {
        $this->phrase = $this->_app_phrases;
    }
    protected function setOthers() {
//        $this->icon = '//cdn.codemake.org/phpfox/cmpwebcam/default.png';
        $this->_publisher = 'CodeMake.Org';
        $this->_publisher_url = 'http://codemake.org/';
    }
    public $store_id = '1605';
    public $vendor = '<a href="//codemake.org" target="_blank">CodeMake.Org</a> - See all our products <a href="//store.phpfox.com/techie/u/ecodemaster" target=_new>HERE</a> - contact us at: support@codemake.org';
}