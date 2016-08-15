<?php
    $entryData = array(
        'category' => "keke"
      , 'title'    => "the title"
      , 'article'  => "kekekekekekeefoo"
      , 'when'     => time()
    );

    $context = new ZMQContext();
    $socket = $context->getSocket(ZMQ::SOCKET_PUSH, 'my pusher');
    $socket->connect("tcp://localhost:5555");
    $socket->send(json_encode($entryData));
