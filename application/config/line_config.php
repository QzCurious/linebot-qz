<?php
// LINE login
$config['LINE_login_channel_info'] = array(
    'channel_id' => '1636079326',
    'channel_secret' => 'a9df399e603d4a7f2128846642beee38',
);

$config['LINE_authorization_request_param'] = array(
    // make sure this uri is set in App settings of LINE Login channel
    'redirect_uri' => 'https://linebot-qz.herokuapp.com/line/login_callback',
    'scope' => 'profile',
    'bot_prompt' => 'normal',
);

// Message API
$config['Messaging_API_info'] = array(
    'channel_secret' => 'e8f51ad15fcc158528e518ce8366113c',
    'channel_access_token' =>  'ZTqSlVo0UagS+ppQvf1dTOZD7Vi0gDbdMRxw8fqZpug2iSdoKNWMTfhMpy5w76BmmjvZyH8+KUvi41F4s3Zgc87QTZItw3RVn25pRRgHqZuHYBCplYIM042qUJS3x7G52gXvoAI4M6H85POn110H3wdB04t89/1O/w1cDnyilFU=',
);
