<?php
if (setting('cm_pwebcam_enabled')) {
    asset(array(
        '@CM_PWebCam/cmpwebcam.css',
        '@CM_PWebCam/webcam.min.js',
        '@CM_PWebCam/snapshot.js'
    ));
}
