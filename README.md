# StreetLight 
Vagrant LAMP Install for PHP Development 

## Information

Provides an Ubuntu 16.06 x64 virtual machine with:

* Apache2
* PHP 7.0 
* MariaDB (MySQL).
* wp-cli

StreetLight automatically creates a LAMP install with a blank WordPress install and phpMyAdmin.
It also provides a directory to add project files to: `www`

## Prerequisites

Install Vagrant from the website https://www.vagrantup.com/
Install Virtual Box from https://www.virtualbox.org

## Setup

Git clone this project into a directory on your computer.

Example:
```
~$ mkdir -p Documents/Vagrant/Project
~$ cd Documents/Vagrant/Project
Project$ git clone https://github.com/mgtrrz/streetlight.git
```

To begin the VM setup, simply run: `vagrant up`

### Post Setup


Add the following to your /etc/hosts file:

```
127.0.0.1 wp.local www.wp.local 
127.0.0.1 dev.local www.dev.local 
127.0.0.1 phpmyadmin.local www.phpmyadmin.local
```

Once installation is complete, visit the sites!

http://phpmyadmin.local:8080
http://wp.local:8080
http://dev.local:8080

The `www` folder on your local computer is mounted to the `/var/www/local` folder on the VM and contains folders to the `dev` and the `wp` site. You can navigate into these folders and make any changes. There is no need to refresh, restart or run any commands. Any changes you make are instant.

#### Accessing WordPress

To log in to the WordPress Admin, you'll need to set your password using `wp-cli`.

1) Log in to the VM with `vagrant ssh`
2) Navigate to the WordPress directory: `cd /var/www/wp`
3) Use wp-cli to change the admin password:

```
vagrant@vagrant:/var/www/wp$ wp user update 1 --user_pass=YOURPASSWORD
```

Then try logging in at http://wp.local:8080/wp-admin

#### Adding more local sites

To add additional sites to the VM you created, create a new folder in the `www` directory and name it something memorable, possibly related to the project.

1) SSH into the VM with `vagrant ssh` and use `sudo su` to make yourself the root user.
2) Add a new file in the `/etc/apache2/sites-enabled/` folder with a file name such as `project-local.conf`
3) Add the following contents into that file:

```
<VirtualHost *:80>
	ServerName <Name>.local
	ServerAlias www.<Name>.local
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/local/<Project-Directory>

	ErrorLog ${APACHE_LOG_DIR}/<Name>-local.error.log
	CustomLog ${APACHE_LOG_DIR}/<Name>-local.access.log combined
</VirtualHost>
```

Be sure to replace `<Name>` with the name of the URL or project. The name that you enter here will be used to access the site with your browser (e.g. http://project.local), so keep it sane (no spaces or crazy characters). Also make sure that the `<Project-Directory>` matches the name of the folder you created in your local `www` folder.

Finally, run `sudo service apache2 restart`. If apache doesn't come up, use `sudo service apache2 status` to view any errors. You can also run `apachectl -t` to check the config files for any syntax errors.

### Accessing and Managing the VM

From the same directory you initiated `vagrant up`, run: `vagrant ssh` to drop into the VM. You can also shut down the VM with `vagrant halt`. To completely delete and remove the VM instance, run `vagrant destroy`
