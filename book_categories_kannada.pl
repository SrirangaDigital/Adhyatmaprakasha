#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"book_categories.xml") or die "can't open book_categories.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$dbh->{'mysql_enable_utf8'} = 1;
$dbh->do('SET NAMES utf8');

$sth_drop=$dbh->prepare("DROP TABLE IF EXISTS kannada_book_categories");
$sth_drop->execute();
$sth_drop->finish();

$sth11=$dbh->prepare("CREATE TABLE kannada_book_categories(title varchar(400), cid varchar(4), primary key(cid))ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<category cid="(.*)">(.*)<\/category>/)
	{
		$cid = $1;
		$title = $2;
		insert_categories($cid, $title);
    }
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_categories()
{
	my($cid, $title) = @_;
	$title =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("insert into kannada_book_categories values('$title','$cid')");
	$sth->execute();
	$sth->finish();	
}
