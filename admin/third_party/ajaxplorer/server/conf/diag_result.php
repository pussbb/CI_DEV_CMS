<?php $diagResults = array (
  'Client' => 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Ubuntu/10.10 Chromium/8.0.552.224 Chrome/8.0.552.224 Safari/534.10',
  'Magic Quotes Enabled' => 'No',
  'DOM Enabled' => 'Yes',
  'GD Enabled' => 'Yes',
  'Upload Max Size' => '100M',
  'Memory Limit' => '128M',
  'Max execution time' => '30',
  'Safe Mode' => '0',
  'Safe Mode GID' => '0',
  'Xml parser enabled' => '1',
  'MCrypt Enabled' => 'Yes',
  'Serveur OS' => 'Linux',
  'Session Save Path' => '',
  'PHP Version' => '5.3.1',
  'Locale' => 'ru_RU.utf8',
  'Directory Separator' => '/',
  'Upload Tmp Dir Writeable' => true,
  'PHP Upload Max Size' => 104857600,
  'PHP Post Max Size' => 104857600,
  'AJXP Upload Max Size' => '0',
  'Users enabled' => 1,
  'Guest enabled' => 0,
  'Writeable Folders' => '[<b>conf</b>:true,<br> <b>users</b>:true,<br> <b>logs</b>:true]',
  'Zlib Enabled' => 'Yes',
);$outputArray = array (
  0 => 
  array (
    'name' => 'AjaXplorer version',
    'result' => false,
    'level' => 'info',
    'info' => 'AJXP version : 3.1.1',
  ),
  1 => 
  array (
    'name' => 'Client Browser',
    'result' => false,
    'level' => 'info',
    'info' => 'Current client Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Ubuntu/10.10 Chromium/8.0.552.224 Chrome/8.0.552.224 Safari/534.10',
  ),
  2 => 
  array (
    'name' => 'Magic quotes',
    'result' => false,
    'level' => 'info',
    'info' => 'Magic quotes enabled : 0',
  ),
  3 => 
  array (
    'name' => 'DOM Xml enabled',
    'result' => true,
    'level' => 'error',
    'info' => 'Dom XML is required, you may have to install the php-xml extension.',
  ),
  4 => 
  array (
    'name' => 'PHP error level',
    'result' => false,
    'level' => 'info',
    'info' => 'E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING | E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE',
  ),
  5 => 
  array (
    'name' => 'PHP GD version',
    'result' => true,
    'level' => 'warning',
    'info' => 'GD is required for generating thumbnails',
  ),
  6 => 
  array (
    'name' => 'PHP Limits variables',
    'result' => false,
    'level' => 'info',
    'info' => '<b>Testing configs</b>
Upload Max Size=100M
Memory Limit=128M
Max execution time=30
Safe Mode=0
Safe Mode GID=0
Xml parser enabled=1',
  ),
  7 => 
  array (
    'name' => 'MCrypt enabled',
    'result' => true,
    'level' => 'warning',
    'info' => 'MCrypt is required for generating publiclets',
  ),
  8 => 
  array (
    'name' => 'PHP operating system',
    'result' => false,
    'level' => 'info',
    'info' => 'Current operating system Linux',
  ),
  9 => 
  array (
    'name' => 'PHP Session',
    'result' => false,
    'level' => 'warning',
    'info' => 'Warning, it seems that your temporary folder used to save session data is not set. If you are encountering troubles with logging and sessions, please check session.save_path in your php.ini. Otherwise you can ignore this.',
  ),
  10 => 
  array (
    'name' => 'PHP version',
    'result' => true,
    'level' => 'error',
    'info' => 'Minimum required version is PHP 5.1.0, PHP 5.2 or higher recommended when using foreign language',
  ),
  11 => 
  array (
    'name' => 'Server charset encoding',
    'result' => true,
    'level' => 'error',
    'info' => 'You must set a correct charset encoding in your locale definition in the form: en_us.UTF-8. Please refer to setlocale man page. If your detected locale is C, please check <a href="http://www.ajaxplorer.info/documentation/chapter-8-faq/#c87">http://www.ajaxplorer.info/documentation/chapter-8-faq/#c87</a>. ',
  ),
  12 => 
  array (
    'name' => 'Upload particularities',
    'result' => false,
    'level' => 'info',
    'info' => '<b>Testing configs</b>
Upload Tmp Dir Writeable=1
PHP Upload Max Size=104857600
PHP Post Max Size=104857600
AJXP Upload Max Size=0',
  ),
  13 => 
  array (
    'name' => 'Users Configuration',
    'result' => false,
    'level' => 'info',
    'info' => 'Current config for users',
  ),
  14 => 
  array (
    'name' => 'Required writeable folder',
    'result' => false,
    'level' => 'info',
    'info' => '[<b>conf</b>:true,<br><b>users</b>:true,<br><b>logs</b>:true]',
  ),
  15 => 
  array (
    'name' => 'Zlib extension (ZIP)',
    'result' => false,
    'level' => 'info',
    'info' => 'Extension enabled : 1',
  ),
  16 => 
  array (
    'name' => 'Filesystem Plugin
 Testing repository : Default Files',
    'result' => true,
    'level' => 'error',
    'info' => '',
  ),
); ?>