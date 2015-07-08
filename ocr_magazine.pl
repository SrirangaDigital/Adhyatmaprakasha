#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];
$type = $ARGV[4];
$table = 'testocr_magazine';

print "Magazine\n";
use DBI();

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");
$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

$sth11=$dbh->prepare("drop table if exists $table");
$sth11->execute();
$sth11->finish();

$sth11=$dbh->prepare("CREATE TABLE IF NOT EXISTS $table(volume varchar(10),
issue varchar(10),
cur_page varchar(15),
text varchar(5000)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11->execute();
$sth11->finish(); 

@volume = `ls Text/$type/`;

for($i1=0;$i1<@volume;$i1++)
{
	chop($volume[$i1]);
	@issue = `ls Text/$type/$volume[$i1]/`;

	for($i2=0;$i2<@issue;$i2++)
	{
		chop($issue[$i2]);
		@files = `ls Text/$type/$volume[$i1]/$issue[$i2]/`;

		for($i3=0;$i3<@files;$i3++)
		{
			chop($files[$i3]);
			if($files[$i3] =~ /\.txt/)
			{
				$vol = $volume[$i1];
				$prt = $issue[$i2];
				$cur_page = $files[$i3];
				open(DATA,"Text/$type/$vol/$prt/$cur_page")or die ("cannot open Text/$vol/$prt/$cur_page");
				
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
				
				$sth1=$dbh->prepare("insert into $table values ('$vol','$prt','$cur_page','$content')");
				$sth1->execute()  or die("volume $vol issue $prt Page $cur_page");
				$sth1->finish();
				close(DATA);
			}
		}
	}
}

