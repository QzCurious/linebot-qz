<?php
class LINE_message {
    private $channel_access_token;

    public function __construct($channel_access_token){
        $this->channel_access_token = $channel_access_token['channel_access_token'];
    }

    /**
     * Push a message to a specific user
     */
    public function push_message($userId, $message){
        define('PUSH_MESSGAE_URL', 'https://api.line.me/v2/bot/message/push');

        $curl = curl_init(PUSH_MESSGAE_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->channel_access_token,
        ));
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'to' => $userId,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $message,
                ),
            ),
        )));
        $result = curl_exec($curl);
        if($result === FALSE)
            throw new Exception('curl_exec() failed.');
        if(($response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) != '200')
            var_dump($result);die;
            throw new Exception('LINE server response with code: '.$response_code);
        curl_close($curl);
    }
}
