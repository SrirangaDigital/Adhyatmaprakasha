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

$sth11=$dbh->prepare("CREATE TABLE IF NOT EXISTS testocr_books(type varchar(20),
book_id varchar(10),
cur_page varchar(10),
text varchar(5000)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

$columnType = $type;
$type = $type.'_books';
@bookid = `ls Text/$type/`;

for($i2=0;$i2<@bookid;$i2++)
{
	chop($bookid[$i2]);
	@files = `ls Text/$type/$bookid[$i2]/`;

	for($i3=0;$i3<@files;$i3++)
	{
		chop($files[$i3]);
		if($files[$i3] =~ /\.txt/)
		{
			$typ = $type;
			$bkid = $bookid[$i2];
			$cur_page = $files[$i3];
			
			open(DATA,"Text/$typ/$bkid/$cur_page")or die ("cannot open Text/$typ/$bkid/$cur_page");
			
			local $/;
			$content = <DATA>;
			$cur_page =~ s/\.txt//g;
			
			$line=<DATA>;
			$content =~ s/\\/\//g;
			$content =~ s/'/\\'/g;
			$content =~ s/\"/\\"/g;
			$content =~ s/\n/ /g;
			$content =~ s///g;
			$content =~ s///g;
			$content =~ s///g;
			$content =~ s/^\s+|\s+$//g;
			
			$sth1=$dbh->prepare("insert into testocr_books values ('$columnType','$bkid','$cur_page','$content')");
			$sth1->execute()  or die("type $typ bookid $bkid Page $cur_page");
			$sth1->finish();
			close(DATA);
		}
	}
}
