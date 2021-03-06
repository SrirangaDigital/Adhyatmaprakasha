#!/bin/sh

host="localhost"
db="apk"
usr="root"
pwd="mysql"

echo "DROP DATABASE IF EXISTS $db" | /usr/bin/mysql -u$usr -p$pwd
echo "CREATE DATABASE  IF NOT EXISTS $db CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -u$usr -p$pwd
echo "..........Magazine Insertion..........";
perl author_magazine.pl $host $db $usr $pwd
perl article_magazine.pl $host $db $usr $pwd

echo "..........Book Insertion..........";
perl author_english.pl $host $db $usr $pwd
perl author_kannada.pl $host $db $usr $pwd
perl author_sanskrit.pl $host $db $usr $pwd
perl author_other.pl $host $db $usr $pwd

perl bookid_english.pl $host $db $usr $pwd
perl toc_english.pl $host $db $usr $pwd

perl book_categories_kannada.pl $host $db $usr $pwd
perl bookid_kannada.pl $host $db $usr $pwd
perl toc_kannada.pl $host $db $usr $pwd

perl bookid_sanskrit.pl $host $db $usr $pwd
perl toc_sanskrit.pl $host $db $usr $pwd

perl bookid_other.pl $host $db $usr $pwd
perl toc_other.pl $host $db $usr $pwd

echo "USE $db; DROP TABLE IF EXISTS testocr_books;" | /usr/bin/mysql -u$usr -p$pwd
echo "\n..........Test OCR..........";
perl ocr_books.pl $host $db $usr $pwd 'english'
perl ocr_books.pl $host $db $usr $pwd 'sanskrit'
perl ocr_books.pl $host $db $usr $pwd 'kannada'
perl ocr_books.pl $host $db $usr $pwd 'other'
perl ocr_magazine.pl $host $db $usr $pwd 'magazine'

echo "USE $db; DROP TABLE IF EXISTS searchtable_books;" | /usr/bin/mysql -u$usr -p$pwd

echo "\n..........Search Table..........";
perl searchtable_books.pl $host $db $usr $pwd 'kannada'
perl searchtable_books.pl $host $db $usr $pwd 'english'
perl searchtable_books.pl $host $db $usr $pwd 'sanskrit'
perl searchtable_books.pl $host $db $usr $pwd 'other'
perl searchtable_magazine.pl $host $db $usr $pwd 'magazine'

echo "USE $db; DROP TABLE IF EXISTS word_books;" | /usr/bin/mysql -u$usr -p$pwd
echo "\n..........Word Insertion..........";
perl wordInsertBooks.pl $host $db $usr $pwd 'kannada'
perl wordInsertBooks.pl $host $db $usr $pwd 'english'
perl wordInsertBooks.pl $host $db $usr $pwd 'sanskrit'
perl wordInsertBooks.pl $host $db $usr $pwd 'other'
perl wordInsertMagazine.pl $host $db $usr $pwd 'magazine'

echo "\n..........Indexing..........\n";
echo "create fulltext index text_index_books on searchtable_books (text);" | /usr/bin/mysql -uroot -p$pwd $db 
echo "create fulltext index text_index_magazine on searchtable_magazine (text);" | /usr/bin/mysql -uroot -p$pwd $db 
echo "create fulltext index word_index_books on word_books (word);" | /usr/bin/mysql -uroot -p$pwd $db 
echo "create fulltext index word_index_magazine on word_magazine (word);" | /usr/bin/mysql -uroot -p$pwd $db 

#~ /usr/bin/mysql -uroot -pmysql apk < ap.sql
