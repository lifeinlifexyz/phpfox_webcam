<?php
namespace Apps\CM_PWebCam\Block;

/**
 * Profile Avatar With Webcam App
 * @author  		CodeMake.Org
 * @version 		1.0.0
 */

use Phpfox;
use Phpfox_Component;

defined('PHPFOX') or exit('NO DICE!');

class Box extends Phpfox_Component
{
    public function process()
    {
        $this->template()->assign(array(
                'sHeader' => _p('WebCam')
            )
        );
        return 'block';
    }
}

