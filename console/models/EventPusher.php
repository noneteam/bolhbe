<?php

namespace console\models;

use yii\helpers\Html;
use Ratchet\Wamp\Topic;
use Ratchet\ConnectionInterface;

class EventPusher implements \Ratchet\Wamp\WampServerInterface
{
	protected $subscribedTopics = array();

	public function onSubscribe(ConnectionInterface $conn, $topic)
	{
		$subject = $topic->getId();

		if (!array_key_exists($subject, $this->subscribedTopics))
			$this->subscribedTopics[$subject] = $topic;
	}

	public function onPushEventData($event)
	{
		$eventData = json_decode($event, true);

		if (!array_key_exists($eventData['subscribeKey'], $this->subscribedTopics))
			return;

		$topic = $this->subscribedTopics[$eventData['subscribeKey']];

		if($topic instanceof Topic) {

			foreach($eventData as $eventField => &$fieldValue)
				$fieldValue = Html::encode($fieldValue);

			$topic->broadcast($eventData);

		} else return;
	}

	public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
	{
		$conn->callError($id, $topic, 'You are not allowed to make calls')->close();
	}

	public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
	{
		$conn->close();
	}

	public function onUnSubscribe(ConnectionInterface $conn, $topic){}

	public function onOpen(ConnectionInterface $conn){}

	public function onClose(ConnectionInterface $conn){}

	public function onError(ConnectionInterface $conn, \Exception $e){}
}