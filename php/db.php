<?php
class Database
{
	private $username = 'adamenkom';
	private $client_secret = 'ZTgwOTZiZmE4NDQ2MjViZTA0YWQ3MDkxMDYwNDQ2MmI=';

	public function get_token(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.nsonline.com.ua/api/access_token/");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt(
			$ch,
			CURLOPT_POSTFIELDS,
			"username=" . $this->username . "&client_secret=" . $this->client_secret
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close($ch);
		header('Content-Type: application/json');
		var_dump(json_decode($server_output));
		$obj = json_decode($server_output);
		return $obj;
	}
	public function get_products($token){
		$authToken = 'Bearer ' . $token;
		// Setup cURL
		$ch = curl_init('https://api.nsonline.com.ua/api/catalog/product/');
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $authToken,
				'Content-Type: application/xml'
			)
		));
		// Send the request
		$server_output = curl_exec($ch);
		curl_close($ch);
		return $server_output;
	}


	public function get_images($token){
		$authToken = 'Bearer ' . $token;
		// Setup cURL
		$ch = curl_init('https://api.nsonline.com.ua/api/images/product/');
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $authToken,
				'Content-Type: application/xml'
			)
		));
		// Send the request
		$server_output = curl_exec($ch);
		curl_close($ch);
		return $server_output;
	}
}
