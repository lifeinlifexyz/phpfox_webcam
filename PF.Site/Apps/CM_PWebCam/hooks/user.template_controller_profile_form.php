<?php
if (setting('cm_pwebcam_enabled') && Phpfox::isUser()) {
    echo '<a style="cursor: pointer;" onclick="tb_show(\''._p('WebCam').'\', $.ajaxBox(\'cmpwebcam.snapshotBox\', \'height=350&width=360\'));">'._p('Change avatar with webcam').'</a><div style="display:none;" id="cmpwebcam_fup_avatar_result"></div>';
}