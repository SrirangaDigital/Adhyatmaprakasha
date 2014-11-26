#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"apk_sanskrit_toc.xml") or die "can't open apk_sanskrit_toc.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth1=$dbh->prepare("CREATE TABLE sanskrit_book_toc(
book_id varchar(10),
btitle varchar(2000),
level int(2),
title varchar(10000),
page varchar(20),
type varchar(20),
slno int(6) auto_increment, primary key(slno)) auto_increment=10001 ENGINE=MyISAM");

$sth1->execute();
$sth1->finish();

$line = <IN>;
$scount = 0;

while($line)
{
	chop($line);
	if($line =~ /<sanskrit>/)
	{
		$type = "sanskrit";
	}
	if($line =~ /<book code="(.*)"[\s]+btitle="(.*)">/)
	{
		$book_id = $1;
		$btitle = $2;
    }
    elsif($line =~ /<s([0-9]+)[\s]+title="(.*)"[\s]+page="(.*)">/)
	{
		$level = $1;
		$title = $2;
		$page = $3;
        insert_to_db($book_id,$btitle,$level,$title,$page,$type);
		$title =  "";
		$level = "";
		$page = "";
		$scount++;
        
	}
	elsif($line =~ /<\/s([0-9]+)>/)
	{
	}
	else
	{
		print $line . "\n";
	}

$line = <IN>;
}

close(IN);


sub insert_to_db()
{
	my($book_id,$btitle,$level,$title,$page,$type) = @_;
	my($sth2);

	$btitle =~ s/'/\\'/g;
	$title =~ s/'/\\'/g;
    
	$sth2=$dbh->prepare("insert into sanskrit_book_toc values('$book_id','$btitle','$level','$title','$page','$type','')");
	$sth2->execute();
	$sth2->finish();
}

