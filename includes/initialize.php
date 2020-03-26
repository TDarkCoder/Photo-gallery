<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'E:'.DS.'WNPM'.DS.'nginx'.DS.'www'.DS.'photogallery');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// Configurations
require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."functions.php");
require_once(LIB_PATH.DS."session.php");
require_once(LIB_PATH.DS."database.php");
require_once(LIB_PATH.DS."database_object.php");

// Models
require_once(LIB_PATH.DS."models".DS."user.php");
require_once(LIB_PATH.DS."models".DS."photo.php");
require_once(LIB_PATH.DS."models".DS."comment.php");
