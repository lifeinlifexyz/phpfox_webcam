<?php
if (setting('cm_pwebcam_enabled')) {
    asset(array(
        '@CM_PWebCam/cmpwebcam.css',
        '@CM_PWebCam/webcam.min.js'
    ));
    if (setting('cm_pwebcam_enable_link_on_top_the_profile_image'))asset(array('@CM_PWebCam/snapshot.js'));
}
