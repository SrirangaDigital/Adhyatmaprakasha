#!/bin/sh

host="localhost"
db="apk"
usr="root"
pwd="mysql"

echo "CREATE DATABASE  IF NOT EXISTS $db CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd

perl author_magazine.pl $host $db $usr $pwd
perl article_magazine.pl $host $db $usr $pwd

perl author_english.pl $host $db $usr $pwd
perl author_kannada.pl $host $db $usr $pwd
perl author_sanskrit.pl $host $db $usr $pwd

perl bookid_english.pl $host $db $usr $pwd
perl toc_english.pl $host $db $usr $pwd

perl book_categories_kannada.pl $host $db $usr $pwd
perl bookid_kannada.pl $host $db $usr $pwd
perl toc_kannada.pl $host $db $usr $pwd

perl bookid_sanskrit.pl $host $db $usr $pwd
perl toc_sanskrit.pl $host $db $usr $pwd

#~ /usr/bin/mysql -uroot -pmysql apk < ap.sql
