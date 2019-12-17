#!/bin/bash

ENV=development php /var/www/wechat_work_broadcast_system/public/cli.php migrate:install
ENV=development php /var/www/wechat_work_broadcast_system/public/cli.php migrate
