<?php
// LINE login
$config['LINE_login_channel_info'] = array(
    'channel_id' => '1568533598',
    'channel_secret' => 'b30ad652abea5f757adb025988d51bbe',
);

$config['LINE_authorization_request_param'] = array(
    // make sure this uri is set in App settings of LINE Login channel
    'redirect_uri' => 'https://linebot-qz.herokuapp.com/line/login_callback',
    'scope' => 'profile',
    'bot_prompt' => 'aggressive',
);

// Message API
$config['Messaging_API_info'] = array(
    'channel_secret' => '3a8c1cb03af77effc560228354a716a1',
    'channel_access_token' =>  'AdBGnxmkALT4Xy4FHH/yz25BwNZCwj2L/I8lLQovC3oLpt9zauS29XDzft3KXit08pLGIU9exskySr9XL5EUxRyVR9FWmrYzNw0E0iL0dIIz7muhKyOIHJHMbIfUEC/bzPgq/U9IwB+8Atx6/xhqqgdB04t89/1O/w1cDnyilFU=',
);
