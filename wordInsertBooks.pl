#!/usr/bin/perl
use POSIX;
$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$type = $ARGV[4];


print "$type\n";
use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->do('SET NAMES utf8');

$sth11=$dbh->prepare("CREATE TABLE IF NOT EXISTS word_books(type varchar(10),
book_id varchar(10),
height varchar(10),
width varchar(10),
pagenum varchar(10),
l int(10),
b int(10),
t int(10),
r int(10),
word varchar(50),
wordid int(10) NOT NULL AUTO_INCREMENT,
PRIMARY KEY (wordid))AUTO_INCREMENT=1001  ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$columnType = $type;
$type = $type.'_books';
$wordLt3 = 0;
@book_id = `ls Volumes_xml/$type/`;


for($i2=0;$i2<@book_id;$i2++)
{
	chop($book_id[$i2]);
	$id = $book_id[$i2];
	
	@files = `ls Volumes_xml/$type/$id`;
	for($i3 = 0; $i3 < @files; $i3++)
	{
		chop($files[$i3]);
		$file = $files[$i3];
		open(IN,"Volumes_xml/$type/$id/$file")or die ("cannot open Volumes_xml/$type/$id/$file");
		$line = <IN>;
		while($line)
		{
			if($line =~ /<OBJECT data="(.*)" type="(.*)" height="(.*)" width="(.*)" usemap="(.*).djvu" >/)
			{
				$height = $3;
				$width = $4;
				$page = $5;
			}
			elsif($line =~ /<WORD coords="(.*)">(.*)<\/WORD>/)
			{
				$cords = $1;
				$word = $2;
				if(length($word) > 2)
				{
					insert_word($columnType,$id,$height,$width,$page,$cords,$word);
				}
			}
			$line = <IN>;
		}
		close(IN);
	}
}

$dbh->disconnect();

sub insert_word()
{
	my($columnType,$id,$height,$width,$page,$cords,$word) = @_;
	
	#~ $word =~ s/\&apos;/'/g;
	$word =~ s/\\/\//g;
	$word =~ s/'/\\'/g;
	$word =~ s/\"/\\"/g;
	$word =~ s/\n/ /g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s///g;
	$word =~ s/^\s+|\s+$//g;
	#~ Base image size is 800X1200
	#~ Also note that coordinate has already been shifted to top left from bottom left (DjVu)
	@sumne = split(/,/, $cords);
	$left = floor($sumne[0] * 800 / $width);
	$top = floor($sumne[2] * 800 / $width);
	$bottom = floor($sumne[1] * 1200 / $height);
	$right = floor($sumne[3] * 1200 / $height);
	
	my($sth1,$sth);

	$sth = $dbh->prepare("insert into word_books values('$columnType','$id','$height','$width','$page','$left','$bottom','$right','$top','$word','')");
	$sth->execute() or die("query failes");
	$sth->finish();
}

