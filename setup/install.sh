#!/bin/bash

# This script will create a new simplistic db for you with the params of your choice. You only need to run this once to get wordpress up and running in no time.
# DISCLAIMER: this script is not meant to be used in production environment. It is not bullet proof and does not escape your input, so I am assuming that you are not using any special characters in the configuration input.

# PLEASE ENTER YOUR SCRIPT CONFIGURATION BELOW:

# mysql user name
MYSQL_USER='root'

# mysql password
MYSQL_PASSWD=''

# db name
DB_NAME='quickcommerce'

# db server name
DB_SERVER='localhost'

# domain to be installed.
DOMAIN_NAME='quickcommerce.dev'

# wordpress install path
INSTALLED_DIR='/home/httpd/QuickCommerce'

# php install
PHP=/usr/bin/php

# ALL DONE! YOU DO NOT NEED TO DO ANYTHING ELSE AFTER THIS LINE

# update wp-config.php
INSTALLED_DIR_PARSED=`echo $INSTALLED_DIR | sed -e 's/\//\\\\\//g'`
sed -i 's/\/home\/httpd\/QuickCommerce/'$INSTALLED_DIR_PARSED'/g' $INSTALLED_DIR/wp-config.php
sed -i 's/quickcommerce/'$DB_NAME'/g' $INSTALLED_DIR/wp-config.php
sed -i 's/localhost/'$DB_SERVER'/g' $INSTALLED_DIR/wp-config.php
sed -i 's/root/'$MYSQL_USER'/g' $INSTALLED_DIR/wp-config.php
sed -i "s/'DB_PASSWORD', ''/'DB_PASSWORD', '$MYSQL_PASSWD'/g" $INSTALLED_DIR/wp-config.php
# import into localdb
mysql --user=$MYSQL_USER --password=$MYSQL_PASSWD -e "drop database if exists $DB_NAME;create database $DB_NAME character set utf8 collate utf8_general_ci;"
bzcat $INSTALLED_DIR/setup/testdb.bz2 | mysql --user=$MYSQL_USER --password=$MYSQL_PASSWD $DB_NAME
# update localdb
$PHP -r 'mysql_connect("'$DB_SERVER'", "'$MYSQL_USER'", "'$MYSQL_PASSWD'");mysql_select_db("'$DB_NAME'");$r = mysql_query("show tables");while ($table = mysql_fetch_array($r, MYSQL_ASSOC)) {$table_name = $table["Tables_in_'$DB_NAME'"];$r1 = mysql_query("show columns from $table_name");while ($col = mysql_fetch_array($r1, MYSQL_ASSOC)) {$sql1 = "update $table_name set $col[Field]=replace($col[Field], \"quickcommerce.dev\", \"'$DOMAIN_NAME'\") where $col[Field] like \"%quickcommerce.dev%\"";mysql_query($sql1);}}'

echo "INSTALLATION DONE!"
