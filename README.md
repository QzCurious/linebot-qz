# Library
- application/libraries/LINE_login.php
- application/libraries/LINE_message.php

將上面檔案放到 CI 專案 libraries 資料夾，再在 controller 裡
用 `$this->load->library('LINE_login', $config)` 來初始化

# 範例
範例主機 https://linebot-qz.herokuapp.com/line

範例檔案
- application/controllers/Line.php
- application/config/line_config.php

在 line_config 的資料為參考用，不要拿去使用喔
