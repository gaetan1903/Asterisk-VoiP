#!/bin/bash 

cp -f /etc/asterisk/extensions.conf ./
cp -rf /usr/share/asterisk/agi-bin/* ./ 
mysqldump -u server -pserver Asterisk > asterisk.sql
