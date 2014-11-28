#!/bin/sh

host="localhost"
db="apk"
usr="root"
pwd="mysql"

echo "drop database apk; create database apk;" | /usr/bin/mysql -uroot -pmysql

perl author_english.pl $host $db $usr $pwd
perl author_kannada.pl $host $db $usr $pwd
perl author_sanskrit.pl $host $db $usr $pwd

perl bookid_english.pl $host $db $usr $pwd
perl toc_english.pl $host $db $usr $pwd

perl bookid_kannada.pl $host $db $usr $pwd
perl toc_kannada.pl $host $db $usr $pwd

perl bookid_sanskrit.pl $host $db $usr $pwd
perl toc_sanskrit.pl $host $db $usr $pwd

/usr/bin/mysql -uroot -pmysql apk < ap.sql
