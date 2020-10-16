<?php

require_once 'config/config.php';

require_once  'helpers/urlHelper.php';
require_once 'helpers/debugger.php';
require_once 'helpers/session_helper.php';

require '../vendor/autoload.php';

spl_autoload_register(function($className)
{
    require_once 'libraries/'.$className.'.php';

});
?>
