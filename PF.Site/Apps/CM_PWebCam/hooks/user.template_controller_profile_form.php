<?php
if (setting('cm_pwebcam_enabled')) {

    echo '<a style="cursor: pointer;" onclick="tb_show(\''._p('WebCam').'\', $.ajaxBox(\'cmpwebcam.snapshotBox\', \'height=350&width=360&fup=true\'));">'._p('Change avatar with webcam').'</a><div style="display:none;" id="cmpwebcam_fup_avatar_result"></div>';

}