<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'database' => [
        'adapter' 	  => 'Mysql',
        'host'        => 'sergioav.mysql.tools',
        'username'    => 'sergioav_phmicro',
        'password'    => '6)M4simN2)',
        'dbname'      => 'sergioav_phmicro'
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'formsDir'       => APP_PATH . '/forms/',
        'viewsDir'       => APP_PATH . '/views/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
        'publicUrl'      => 'http://phalcon-micro.ztua.org//',
        'cryptSalt'      => 'eEAfR_&G&f,+vU]:jFr!!A&+1Ms9~8_4L!<@[N@IP_2My|:+.u>/6m,$D'
    ],
    'logger' => [
        'path'     => BASE_PATH . '/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ]
]);
