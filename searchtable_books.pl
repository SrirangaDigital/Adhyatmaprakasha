#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$type = $ARGV[4];

print "$type\n";

use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("CREATE TABLE IF NOT EXISTS searchtable_books(title varchar(500),
authid varchar(200),
authorname varchar(1000),
type varchar(20),
text varchar(5000),
page varchar(50),
page_end varchar(50),
cur_page varchar(10),
edition varchar(3),
volume varchar(3),
part varchar(10),
year varchar(10),
book_id varchar(10),
month varchar(10)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute() or die("query false");
$sth11->finish();

$sth1=$dbh->prepare("select * from ".$type."_books_list order by slno");
$sth1->execute();

while($ref=$sth1->fetchrow_hashref())
{
	$bookid = $ref->{'book_id'};
	$title = $ref->{'title'};
	$authid = $ref->{'authid'};
	$authorname = $ref->{'authorname'};
	$page = $ref->{'page'};
	$page_end = $ref->{'page_end'};
	$edition = $ref->{'edition'};
	$volume = $ref->{'volume'};
	$part = $ref->{'part'};
	$year = $ref->{'year'};
	$month = $ref->{'month'};
	$edition = $ref->{'edition'};
	
	$title =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	$sth2=$dbh->prepare("select * from testocr_books where book_id='$bookid' and type='$type'");
	$sth2->execute();
	
	while($ref2=$sth2->fetchrow_hashref())
	{
		$text = $ref2->{'text'};
		$text =~ s/'/\\'/g;
		$cur_page = $ref2->{'cur_page'};

		$sth4=$dbh->prepare("insert into searchtable_books values('$title','$authid','$authorname','$type','$text','$page','$page_end','$cur_page',
			'$edition','$volume','$part','$year','$bookid','$month')");
		$sth4->execute();
		$sth4->finish();
		$text = '';
	}
	$sth2->finish();
}

$sth1->finish();
$dbh->disconnect();
