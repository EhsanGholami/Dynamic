<?php

return array(

    // ------------------------| Config |--------------------------- #
    'DebugMode'  => TRUE,
    'SqlErrorDetais' => false,

    // --------------------------| DB |----------------------------- #
    'DbName' => 'DB_NAME', // Db Name
    'DbHost' => 'DB_HOST', // Db Host
    'DbUser' => 'DB_USER', // Db UserName
    'DbPass' => 'DB_PASS', // Db PassWord

    // ----------------------| Security |----------------------- #
    'Blowfish_Pre' => '$6$rounds=>5000$', // blowfish for CRYPT_SHA256 encryption (php.net/manual/en/function.crypt.php)
    'Blowfish_End' => '$', // blowfish for encryption
    'UrlAllowedChars' => 'a-z 0-9~%.:_\-=&', // Allowed chars in url
    'Session_IPCheck' => FALSE,
    'Session_UserAgentCheck' => FALSE,
    'Session_Secure' => TRUE, // check user agent and ip

    // ----------------------| Config |----------------------- #

    'AppName' => 'Dynamic', // application name (used in cookie name)

    // Whilte List Controllers

    'Controllers' => array('main'),


    /// Method Permissions

    'CheckPermissions' => TRUE ,
    'ForbiddenByDefault' => TRUE,
    'AntiCsrf' => TRUE,
    'CsrfTokenName' => '__pctk'و
	'DefualtPerm' => 'guest'


);