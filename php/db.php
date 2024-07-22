<?php
class Database
{
    private $username = 'adamenkom';
    private $client_secret = 'ZTgwOTZiZmE4NDQ2MjViZTA0YWQ3MDkxMDYwNDQ2MmI=';

    public function get_token() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.nsonline.com.ua/api/access_token/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=" . $this->username . "&client_secret=" . $this->client_secret);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($server_output === false || $http_code !== 200) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return (object)['error' => 'Помилка отримання ключа: ' . $error_msg];
        }

        curl_close($ch);
        return json_decode($server_output);
    }

    public function get_products($token) {
        $authToken = 'Bearer ' . $token;
        $ch = curl_init('https://api.nsonline.com.ua/api/catalog/product/');
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $authToken,
                'Content-Type: application/xml'
            )
        ));
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
}
?>
