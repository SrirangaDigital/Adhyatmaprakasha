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

$sth11=$dbh->prepare("drop table if exists searchtable_magazine");
$sth11->execute();
$sth11->finish();

$sth11=$dbh->prepare("CREATE TABLE searchtable_magazine(title varchar(500),
authid varchar(200),
authorname varchar(1000),
text varchar(5000),
page varchar(10),
page_end varchar(10),
cur_page varchar(10),
volume varchar(3),
issue varchar(10),
year varchar(10),
month varchar(50),
titleid varchar(30)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish();

$sth1=$dbh->prepare("select * from article order by titleid");
$sth1->execute();

while($ref=$sth1->fetchrow_hashref())
{
	$title = $ref->{'title'};
	$titleid = $ref->{'titleid'};
	$authid = $ref->{'authid'};
	$authorname = $ref->{'authorname'};
	$page = $ref->{'page'};
	$page_end = $ref->{'page_end'};
	$volume = $ref->{'volume'};
	$issue = $ref->{'issue'};
	$year = $ref->{'year'};
	$month = $ref->{'month'};
	
	$title =~ s/'/\\'/g;
	$authorname =~ s/'/\\'/g;
	
	$sth2=$dbh->prepare("select * from testocr_magazine where volume='$volume' and issue='$issue' and cur_page between '$page' and '$page_end'");
	$sth2->execute();
	
	while($ref2=$sth2->fetchrow_hashref())
	{
		$text = $ref2->{'text'};
		$text =~ s/'/\\'/g;
		$cur_page = $ref2->{'cur_page'};
			
		$sth4=$dbh->prepare("insert into searchtable_magazine values('$title','$authid','$authorname','$text','$page','$page_end','$cur_page',
			'$volume','$issue','$year','$month','$titleid')");
		$text = '';
		$sth4->execute();
		$sth4->finish();
	}
	$sth2->finish();
}

$sth1->finish();
$dbh->disconnect();
