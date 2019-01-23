<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// config/config.php 設定
//   $config['composer_autoload'] = 'vendor/autoload.php';

use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Response;

class Line extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->config->load('line_config');
        $LINE_login_channel_info = $this->config->item('LINE_login_channel_info');
        $this->load->library('LINE_login', $LINE_login_channel_info);
    }

    public function index(){
        // 產生 LINE 登入連結並顯示於頁面
        $authorization_param = $this->config->item('LINE_authorization_request_param');
        echo '<a href="'.$this->line_login->authorization_request_string($authorization_param).'">login</a>';
    }

    public function login_callback(){
        // 接收 line 登入後的結果
        $this->line_login->check_authorization_response();

        // 為了使用 line login api 的功能，送出 token 請求，這樣才能取得我們需要 userId
        $access_token_callback = $this->config->item('LINE_authorization_request_param')['redirect_uri'];
        $this->line_login->request_access_token($access_token_callback);

        // 取得 userId
        // 這邊就可以把 userId 存到資料庫去
        $userId = $this->line_login->get_user_profile()['userId'];

        // 以下使用 line php sdk
        // 建立 LINEBot，要用來傳訊息
        $channel_access_token = $this->config->item('Messaging_API_info')['channel_access_token'];
        $bot = new LINEBot(new CurlHTTPClient($channel_access_token), array(
            'channelSecret' => $this->config->item('Messaging_API_info')['channel_secret']
        ));

        // 傳送文字訊息
        // 'SDK message' 改成你要傳的訊息字串
        $response = $bot->pushMessage($userId, new TextMessageBuilder('SDK message'));
        if(!$response->isSucceeded()){
            echo 'Failed to sent text message<br/>';
        }
        else
            echo 'Text message sent<br/>';

        // 傳送圖片訊息
        // ImageMessageBuilder() 兩個參數都要接一個 url
        //   第一個是真正圖片的 url
        //   第二個是預覽用的，也就是要縮圖
        $response = $bot->pushMessage($userId, new ImageMessageBuilder('https://picsum.photos/200/300', 'https://picsum.photos/200/300'));
        if(!$response->isSucceeded())
            echo 'Failed to sent image message<br/>';
        else
            echo 'Image message sent<br/>';

        // 傳送 Template 訊息
        // LINE reference: https://developers.line.biz/en/reference/messaging-api/#template-messages
        $response = $bot->pushMessage($userId, new TemplateMessageBuilder('altText',
            new ButtonTemplateBuilder(
                'title',
                'content',
                'https://picsum.photos/1024/960', // 縮圖 (Template 訊息沒有原圖)
                // LINE reference: https://developers.line.biz/en/reference/messaging-api/#uri-action
                $uriTmpActB = array(new UriTemplateActionBuilder('label', 'https://www.google.com'))
            )
        ));
        if(!$response->isSucceeded())
            echo 'Failed to sent template message<br/>';
        else
            echo 'Template message sent<br/>';
    }
}
