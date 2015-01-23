#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"apk_magazine.xml") or die "can't open apk_magazine.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=apk;host=localhost","root","mysql");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth11r=$dbh->prepare("CREATE TABLE article(volume varchar(6),
issue varchar(5),
month varchar(50),
year int(8), 
title varchar(500), 
page varchar(10), 
page_end varchar(10),
authid varchar(200),
authorname varchar(1000),
titleid varchar(30), primary key(titleid)) ENGINE=MyISAM");
$sth11r->execute();
$sth11r->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		#print $volume . "\n";
	}
	elsif($line =~ /<issue inum="(.*)" month="(.*)" year="(.*)">/)
	{
		$issue = $1;
		$month = $2;
		$year = $3;
		$count = 0;
		$prev_pages = "";
	}
	elsif($line =~ /<title>(.*)<\/title>/)
	{
		$title = $1;
	}
    elsif($line =~ /<page>(.*)<\/page>/)
	{
		$pages = $1;
		($page, $page_end) = split(/-/, $pages);
		if($pages eq $prev_pages)
		{
			$count++;
			$id = "rec_" . $volume . "_" . $issue . "_" . $page . "_" . $page_end . "_" . $count; 
		}
		else
		{
			$id = "rec_" . $volume . "_" . $issue . "_" . $page . "_" . $page_end . "_0";
			$count = 0;
		}
		$prev_pages = $pages;
	}
	elsif($line =~ /<author sal="(.*)">(.*)<\/author>/)
	{
        $sal = $1;
		$authorname = $2;
		$authids = $authids . ";" . get_authid($authorname);
		$author_name = $author_name . ";" . $sal . $authorname;
	}
    elsif($line =~ /<allauthors \/>/)
	{
		$authids = "0";
		$author_name = "";
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_article($volume,$issue,$month,$year,$title,$page,$page_end,$authids,$author_name,$id);
		$authids = "";
		$author_name = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($volume,$issue,$month,$year,$title,$page,$page_end,$authids,$author_name,$id) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into article values('$volume','$issue','$month','$year','$title','$page','$page_end','$authids','$author_name','$id')");
	
	$sth1->execute();
	$sth1->finish();
}

sub get_authid()
{
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname' and sal='$sal'");
	$sth->execute();
			
	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}
