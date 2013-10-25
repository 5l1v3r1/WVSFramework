<?php

require 'system/wvsframework.php';

$wvs = new WVSFramework;
$wvs->default_config = DEFAULT_CONFIG_FILE;
$wvs->run();

?>