#!/bin/bash

# Update and install our packages
apt-get update
apt-get install -y unzip mariadb-server mariadb-client php7.0 php7.0-mysql libapache2-mod-php7.0 php7.0-mcrypt php7.0-mbstring

# Generate passwords and secrets
head /dev/urandom | tr -dc A-Za-z0-9 | head -c 15 >/home/vagrant/.wp-db-passwd
head /dev/urandom | tr -dc A-Za-z0-9 | head -c 32 >/home/vagrant/.pma-bf-secret

# Creating directories and apache error/access log files
mkdir /var/www/local/dev /var/www/local/wp /var/www/phpmyadmin
touch /var/log/apache2/{wp,dev,phpmyadmin}-local.{error,access}.log 

# Creating our WordPress install
cd /var/www/local/wp
echo '<?php phpinfo() ?>' > phpinfo.php
wget -O wp.zip https://wordpress.org/latest.zip
unzip wp.zip
mv wordpress/* ./
rmdir wordpress/
rm -f wp.zip
cp /home/vagrant/configs/wp-config.php /var/www/local/wp/wp-config.php
sed -i "s/<SLWPDB>/$(cat /home/vagrant/.wp-db-passwd)/g" /var/www/local/wp/wp-config.php
cd -

# Creating database and user for the WordPress install
mysql -u root -e "create database wordpress; create user 'default_wp'@'%' IDENTIFIED BY '$(cat /home/vagrant/.wp-db-passwd)'; grant all privileges on wordpress.* to 'default_wp'@'%'"

# Importing the database
mysql wordpress < /home/vagrant/configs/defaultwp.sql

# Installing wp-cli
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
php wp-cli.phar --info
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp

# Replacing config files and adding apache virtual hosts
mv /etc/apache2/apache2.conf /etc/apache2/apache2-original.conf
cp /home/vagrant/configs/apache2.conf /etc/apache2/apache2.conf
cp /home/vagrant/configs/*-local.conf /etc/apache2/sites-enabled/

# Setting up phpMyAdmin
cd /var/www/phpmyadmin
wget -O pma.tar.gz https://files.phpmyadmin.net/phpMyAdmin/4.8.2/phpMyAdmin-4.8.2-english.tar.gz
tar xvzf pma.tar.gz --strip 1
rm pma.tar.gz
cp /home/vagrant/configs/config.inc.php /var/www/phpmyadmin/config.inc.php
sed -i "s/<SLPMABF>/$(cat /home/vagrant/.pma-bf-secret)/g" /var/www/phpmyadmin/config.inc.php
cd -

find /var/www/ -type d -exec chmod 755 {} \;
find /var/www/ -type f -exec chmod 644 {} \;
find /var/www/ -exec chown www-data:www-data {} \;


service apache2 restart

echo '#######################################'
echo '#              All Done!              #'
echo '#      To SSH into the VM, run:       #'
echo '#             vagrant ssh             #'
echo '#######################################'
echo ''
echo 'Be sure to add the following to your /etc/hosts file:'
echo '127.0.0.1 wp.local www.wp.local'
echo '127.0.0.1 dev.local www.dev.local'
echo '127.0.0.1 phpmyadmin.local www.phpmyadmin.local'
echo ''
echo 'Then visit the sites:'
echo 'http://wp.local:8080/'
echo 'http://phpmyadmin.local:8080/'
echo 'http://dev.local:8080/'