<?php
require './vendor/autoload.php';
$loop   = \React\EventLoop\Factory::create();
$pusher = new \Thruway\Peer\Client("realm1", $loop);

$pusher->on('open', function ($session) use ($loop) {
  echo "thruway new connection\n";
  $context = new React\ZMQ\Context($loop);
  $pull    = $context->getSocket(ZMQ::SOCKET_PULL);
  $pull->bind('tcp://127.0.0.1:5555');

  $pull->on('message', function ($entry) use ($session) {
    echo "recv message from index.php\n";
    $entryData = json_decode($entry, true);
    if (isset($entryData['category'])) {
      echo "publish {$entryData['category']}\n";
      $session->publish($entryData['category'], [$entryData]);
    }
  });
});

$router = new Thruway\Peer\Router($loop);
$router->addInternalClient($pusher);
$router->addTransportProvider(new Thruway\Transport\RatchetTransportProvider("0.0.0.0", 7070));
$router->start();
