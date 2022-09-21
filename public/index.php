<?php

// echo phpinfo();
 
require '../vendor/autoload.php';

 

//test the post data
 
$connection = new MongoDB\Client("mongodb://pocho:elapache@localhost:27017");

$db = $connection->finaly;
echo "db 'gettingstarted' selected<br><br>";
$col = $db->todo;
echo "Collection $col selected<br><br>";

$doc = ["name" => 'testeo',"age" => 333];

$col->insertOne($doc);
echo "<p>User inserted successfully: ";


// $record = $col->find( [ 'name' =>$name] );  
// foreach ($record as $user) {  
//     echo $user['name'], ': ', $user['age']."</p>";  
// }

die;

use App\Kernel;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
