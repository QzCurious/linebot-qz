# Library
- application/libraries/LINE_login.php

將上面檔案放到 CI 專案 libraries 資料夾，再在 controller 裡
用 `$this->load->library('LINE_login', $config)` 來初始化

# 範例
範例主機 https://linebot-qz.herokuapp.com/line

範例檔案
- application/controllers/Line.php
- application/config/line_config.php

在 line_config 的資料為參考用，不要拿去使用喔

# 補充
[line-bot-sdk-php](https://github.com/line/line-bot-sdk-php)
使用 composer 下載；在專案資料夾下
`$ composer require linecorp/line-bot-sdk` 就會安裝到
*vendor/linecorp/line-bot-sdk/*

在 *config/config.php* 設定
`$config['composer_autoload'] = 'vendor/autoload.php'`
就會自動載入 SDK 的 namespace

