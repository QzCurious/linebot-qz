<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Line extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->config->load('line_config');
        $auth_info = $this->config->item('auth_info');
        $this->load->library('LINE_login', $auth_info);
    }

    public function index(){
        $line_login = $this->config->item('line_login');
        echo '<a href="'.$this->line_login->authorization_request_string($line_login).'">login</a>';
    }

    public function login_callback(){
        $this->line_login->check_authorization_response();

        $access_token_callback = $this->config->item('line_login')['redirect_uri'];
        $this->line_login->request_access_token($access_token_callback);

        $userId = $this->line_login->get_user_profile()['userId'];
        $channel_access_token = $this->config->item('channel_access_token');
        $this->load->library('LINE_message',
            array('channel_access_token' => $channel_access_token));
        $this->line_message->push_message($userId, 'Got it!');
    }
}
