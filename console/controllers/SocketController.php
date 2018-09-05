<?php

namespace console\controllers;

use yii\helpers\Console;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Wamp\WampServer;
use React\EventLoop\Factory;
use React\ZMQ\Context;
use React\Socket\Server;
use console\models\EventPusher;

class SocketController extends \yii\console\Controller
{
	public function actionStart($port=5555)
	{
		$this->stdout('Запуск веб-сокета.' . PHP_EOL, Console::FG_GREY);

		$loop = Factory::create();

		// Класс, который реализуем ниже.
		$pusher = new EventPusher;

		// Listen for the web server to make a ZeroMQ push after an ajax request
		$context = new Context($loop);
		$pull = $context->getSocket(\ZMQ::SOCKET_PULL);

		// Binding to 127.0.0.1 means the only client that can connect is itself
		$pull->bind('tcp://127.0.0.1:'.$port);

		$pull->on('message', array($pusher, 'onPushEventData'));

		// Set up our WebSocket server for clients wanting real-time updates
		$webSock = new Server($loop);

		// Binding to 0.0.0.0 means remotes can connect
		$webSock->listen(8080, '0.0.0.0');

		$webServer = new IoServer(
			new HttpServer(
				new WsServer(
					new WampServer(
						$pusher
					)
				)
			),
			$webSock
		);

		$loop->run();
	}

	public function actionIndex($value)
	{
		$context = new \ZMQContext();

		$socket = $context->getSocket(\ZMQ::SOCKET_PUSH);

		if($socket instanceof \ZMQSocket) {

			$socket->connect("tcp://127.0.0.1:5555");

			$socket->send(json_encode([
				'subscribeKey' => 'eventMonitoring',
				'result' => $value,
			]));

		}

	}
}