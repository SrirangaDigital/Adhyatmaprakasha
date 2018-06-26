#!/usr/bin/perl
$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"apk_book_id_other.xml") or die "can't open apk_book_id_other.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth_drop=$dbh->prepare("DROP TABLE IF EXISTS other_books_list");
$sth_drop->execute();
$sth_drop->finish();

$sth1=$dbh->prepare("CREATE TABLE other_books_list(
book_id varchar(4), 
level int(2),
title varchar(1000),
authid varchar(200),
authorname varchar(1000),
page varchar(4),
page_end varchar(4),
edition varchar(2),
volume varchar(3),
part varchar(2),
type varchar(1000),
year int(4),
month varchar(2),
language varchar(10),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	if($line =~ /<s([0-9]+) title="(.*)" author="(.*)" page="(.*)" info="(.*)" type="(.*)" date="(.*)" cid="(.*)" language="(.*)">/)
	{
		$level = $1;
		$title = $2;
		$authors = $3;
		if($authors ne "")
		{
			@list = split(/;/,$authors);
			for($i=0;$i<@list;$i++)
			{
				$authid = $authid . ";" . get_authid($list[$i], $9);
			}
			$authid =~ s/^;//;
		}
		else
		{
			$authid = "";
		}
		if($4 ne "")
		{
			($page,$page_end) = split(/-/,$4);
		}
		else
		{
			$page = "";
			$page_end = "";
		}
		if($5 ne "")
		{
			($edition,$volume,$part,$book_id) = split(/:/,$5);
		}
		else
		{
			$edition = "";
			$volume = "";
			$part = "";
			$book_id = "";
		}
		$type = $6;
		$date = $7;
		if($date ne "")
		{
			($day,$month,$year) = split(/:/,$date);
		}
		else
		{
			$year = 0;
			$month = "00";
		}
		if($9 ne "")
		{
			$language = $9;
		}
		else
		{
			$language = '';
		}
		
		insert_to_db($book_id,$level,$title,$authid,$authors,$page,$page_end,$edition,$volume,$part,$type,$year,$month,$language);
		$title =  "";
		$level = "";
		$authid = "";
		$authors = "";
		$page = "";
		$page_end = "";
		$edition = "";
		$volume = "";
		$part = "";
		$book_id = "";
		$type = "";
		$date = "";
		$scount++;
		$year = 0;
		$month = "";
	}
	elsif($line =~ /<\/s([0-9]+)>/)
	{
	}
	else
	{
		#~ print $line . "\n";
	}
$line = <IN>;
}

close(IN);

#~ print "Total S count:" . $scount . "\n";

sub insert_to_db()
{
	my($book_id,$level,$title,$authid,$authors,$page,$page_end,$edition,$volume,$part,$type,$year,$month,$language) = @_;
	my($sth2);

	$title =~ s/'/\\'/g;

	$sth2=$dbh->prepare("insert into other_books_list values('$book_id','$level','$title','$authid','$authors','$page','$page_end','$edition','$volume','$part','$type','$year','$month','$language','0')");
	$sth2->execute();
	$sth2->finish();
}


sub get_authid()
{
	my($authorname, $language) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author_other where authorname='$authorname' and language = '$language'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}
