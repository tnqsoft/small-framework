<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Yaml\Yaml;

date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once "vendor/autoload.php";

$appConfig = Yaml::parse(file_get_contents(__DIR__.'/config/config.yml'));
// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = $appConfig['app']['mode'] === 'dev'?true:false;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
$dbconfig = $appConfig['database'];
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
// the connection configuration
$conn = array(
    'dbname' => $dbconfig['dbname'],
    'user' => $dbconfig['user'],
    'password' => $dbconfig['password'],
    'host' => $dbconfig['host'],
    'driver' => $dbconfig['driver'],
    'port' => $dbconfig['port'],
);
// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
