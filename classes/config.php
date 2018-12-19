<?php
  // Define application constants
  define('UPLOADPATH', 'localhost/Projects/Blog_Application/images/');
  define('GW_MAXFILESIZE', 32768);      // 32 KB

  //define database constants
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');  
  define('DB_PASS', '100figures');  
  define('DB_NAME', 'content_man');

  //define salt constants for hashing our passwords
  define('SITE_KEY', 'Hp98r[90H9(*&^%UP090hvbkoid3p4o[09]3-0');
  define('SALT', 'OIHGBUj0u(*&5ua0iyih=34iq-9yti=qi-9vdljam');

  //root path information
  define('ROOT_PATH', realpath(dirname(__FILE__)));
  define('BASE_URL', 'http://localhost/Blog_Application/');
?>