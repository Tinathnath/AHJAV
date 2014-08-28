<?php
/**
 * global.php in ahjav.
 * User: Nathan
 * Date: 26/02/14
 * Time: 10:52
 */
//APPLICATION OPTIONS
define('ENV_MODE', 'production');

if(ENV_MODE == 'dev')
{
    define('DB_NAME', 'ahjav');
    define('DB_DRIVER', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWD', '');
    define('CFG_DB_DSN', DB_DRIVER.':'.DB_PASSWD.'//'.DB_USER.'@'.DB_HOST.'/'.DB_NAME);
}
else if(ENV_MODE == 'production')
{
    define('DB_NAME', 'applicatr1');
    define('DB_DRIVER', 'mysql');
    define('DB_HOST', 'mysql51-128.perso');
    define('DB_USER', 'applicatr1');
    define('DB_PASSWD', 'ahjavapi1');
    define('CFG_DB_DSN', DB_DRIVER.'://'.DB_USER.':'.DB_PASSWD.'@'.DB_HOST.'/'.DB_NAME);
}


define('LIB_DIR',  dirname(__FILE__).'/../lib/');
define('CFG_DIR',  dirname(__FILE__).'/');
define('WEB_DIR',  dirname(__FILE__).'/../web/');
define('HTML_DIR', dirname(__FILE__).'/../html/');

define('SCHEMA_FILENAME', 'schema.yml');
define('MODELS_DIRNAME', 'models');

try
{
require_once(LIB_DIR.'vendor/doctrine/Doctrine.php');
require_once(LIB_DIR.'AutoLoader.class.php');
spl_autoload_register(array('Doctrine_Core', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));
ahjav\Autoloader::register();

//GLOBAL OBJECTS
$doctrineManager = Doctrine_Manager::getInstance();
$connection = Doctrine_Manager::connection(CFG_DB_DSN, 'global');

//MANAGER CONF
$doctrineManager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
$doctrineManager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
$doctrineManager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
$doctrineManager->setCharset('utf8');
$doctrineManager->setCollate('utf8_unicode_ci');
$doctrineManager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);

Doctrine_Core::loadModels(LIB_DIR.'models/');
}
catch (Exception $e)
{
    echo 'Fatal: '.$e->getMessage();
    echo '<br/>'.$e->getTraceAsString();
}
function encodeCharset($string)
{
    return utf8_encode($string);
}
//header('Content-type: text/html; charset=ISO-8859-1');
//header('Content-type: text/html; charset=UTF-8');
