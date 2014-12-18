#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"apk_magazine.xml") or die "can't open apk_magazine.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=apk;host=localhost","root","mysql");

$sth11=$dbh->prepare("CREATE TABLE author(authorname varchar(400),sal varchar(50), authid int(6) auto_increment, primary key(authid))auto_increment=10001 ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<author sal="(.*)">(.*)<\/author>/)
	{
        $sal = $1;
		$authorname = $2;
		insert_authors($authorname,$sal);
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_authors()
{
	my($authorname) = @_;

	$authorname =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select authid from author where authorname='$authorname' and sal='$sal'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into author values('$authorname','$sal',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}
