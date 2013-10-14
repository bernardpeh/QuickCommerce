# Introduction #

The purpose of this project is to help you get a minimalistic but functioning woocommerce website up and running with default settings really quickly. If you follow the installation process correctly, you should have a wordpress base running woocommerce with twentythirteen responsive theme. Quickcommerce can be useful if you want to showcase the power of woocommerce, test for plugins compatibility before deploying to your woocommerce production site, debug woocommerce functionality with minimal sets of plugins. 

Being able to spawn off a clean slate of woocommerce installation quickly is convenient. If you intend to build a new woocommerce site, you can also use this db and settings as a base.

## Pre-requisite ##
* [Wordpress requirements](http://wordpress.org/about/requirements/)
* Any linux distro supporting PHP commandline and bash

## Installation ##
* clone the dir from github

```
// To cut down the install time, I am assuming you will use your installation dir as /home/httpd.
cd /home/httpd
git@github.com:bernardpeh/QuickCommerce.git 
cd QuickCommerce
// this will pull in the bdd test and woocommerce plugin
git submodule update --init
```

* [Setup new domain in your local machine](https://www.digitalocean.com/community/articles/how-to-set-up-apache-virtual-hosts-on-centos-6) - eg, quickcommerce.dev

```
// For quick setup, use this as your httpd.conf
<VirtualHost *:80>
    ServerName quickcommerce.dev
    DocumentRoot /home/httpd/QuickCommerce/
    ServerAdmin root@localhost
    ErrorLog /var/log/apache2/quickcommerce-error_log
    CustomLog /var/log/apache2/quickcommerce-access_log combined
    <Directory "/home/httpd/QuickCommerce">
      AddType text/html .html
      AddHandler server-parsed .html
      Options Includes FollowSymLinks
      AllowOverride All
    </Directory>
    DirectoryIndex index.html index.htm index.shtml index.php index.php4 index.php3 index.cgi
</VirtualHost>
```

* Edit configuration parameters in the install script and run it. see /home/httpd/setup/install.sh

```
cd /home/httpd/QuickCommerce/setup/
// edit the params and run it
./install.sh
```
## Test Users ##

* Admin user

user: admin

pass: 12345 

* Customer 

user: test@localhost.localdomain

pass: 12345

## Browser Testing (Optional) ##

I wrote some test cases to test the basic functionality of woocommerce. To run the test, install [phpunit](http://phpunit.de/manual/3.0/en/installation.html) and firefox. Then go to path_to_your_wordpress_install/bdd and run

```
./runtest basic_test
```

see your firefox doing all the tricks. After all the test, see the result.txt for a summary of the test.


