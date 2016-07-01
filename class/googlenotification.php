<?php
namespace GenericPushServer\Google;

class GoogleNotification {
	private $key;
	private $result;

	public function __construct($key) {
		$this->key = $key;
	}

	public function notify($regIds, $title, $data) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $this->getPostFields($regIds, $title, $data));
		$this->result = curl_exec($curl);
		if ($this->result === false) {
			throw new \Exception(curl_error($curl));
		}
		curl_close($curl);
	}

	public function getOutputArray() {
		return json_decode($this->result, true);
	}

	public function getOutput() {
		return json_decode($this->result);
	}

	private function getHeaders() {
		return [
				'Authorization: key=' . $this->key,
				'Content-Type: application/json'
		];
	}

	private function getPostFields($phoneIds, $title, $message) {
		$fields = [
				'registration_ids' => is_string($phoneIds) ? [
						$phoneIds
				] : $phoneIds,
				'data' => is_string($message) ? [
						'message' => $message,
						'title' => $title
				] : $message
		];
		return json_encode($fields, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
}