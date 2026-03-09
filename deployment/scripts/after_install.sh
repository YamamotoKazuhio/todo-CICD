#!/bin/bash
source /home/ec2-user/.bash_profile

# Change Permission
sudo chown ec2-user:ec2-user -R /var/www/todo-app

# reset deploy log
: >/var/www/todo-app/deploy.log

# backend build & migrate
echo "start backend build & migrate" >>/var/www/todo-app/deploy.log
cd /var/www/todo-app
composer install &>>/var/www/todo-app/deploy.log
sudo -u apache php artisan migrate --force &>> /var/www/todo-app/deploy.log
echo "end backend build & migrate" >> /var/www/todo-app/deploy.log
# Clear any previous cached views and optimize the application
echo "start clear cache" >> /var/www/todo-app/deploy.log
php /var/www/todo-app/artisan cache:clear &>> /var/www/todo-app/deploy.log
php /var/www/todo-app/artisan view:clear &>> /var/www/todo-app/deploy.log
php /var/www/todo-app/artisan config:cache &>> /var/www/todo-app/deploy.log
php /var/www/todo-app/artisan optimize &>> /var/www/todo-app/deploy.log
php /var/www/todo-app/artisan route:cache &>> /var/www/todo-app/deploy.log
echo "end clear cache" >> /var/www/todo-app/deploy.log

# frontend build
echo "start frontend build" >> /var/www/todo-app/deploy.log
cd /var/www/todo-app
npm install &>> /var/www/todo-app/deploy.log
set +e
npm run production &>> /var/www/todo-app/deploy.log
set -e
echo "end frontend build" >> /var/www/todo-app/deploy.log

# change permission
echo "start change permission" >> /var/www/todo-app/deploy.log
sudo chown apache:apache -R /var/www/todo-app

exit