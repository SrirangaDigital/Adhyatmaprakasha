<?php include(__DIR__ . "/../inc/include_header.php");?>

	<div class="content">
		<div class="colnav">
            <p>
                <br /><br />
				<span class="lang1"><a href="volumes.php">Volumes</a></span><br /><br />
				<span class="lang1"><a href="articles.php">Articles</a></span><br /><br />
				<span class="lang1"><a href="authors.php">Authors</a></span><br /><br />
			</p>
		</div>
		<div class="colmiddle">
            <div class="archive_holder">
<?php

include(__DIR__ . "/../inc/connect.php");
require_once("common.php");

if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}
if(isset($_GET['issue'])){$issue = $_GET['issue'];}else{$issue = '';}

if(!(isValidVolume($volume) && isValidPart($issue)))
{
	echo "Invalid URL";
	
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset("utf8");
if($db->connect_errno > 0)
{
	echo 'Not connected to the database [' . $db->connect_errno . ']';
	echo "</div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}


//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("0"=>"","1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");

$query = "select distinct year,month from article where volume='$volume' and issue='$issue'";

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	//~ $row=mysql_fetch_assoc($result);
	$row = $result->fetch_assoc();

	$month=$row['month'];
	$year=$row['year'];
	
	$dissue = preg_replace("/^0/", "", $issue);
	$dissue = preg_replace("/\-0/", "-", $dissue);
	
	echo "<div class=\"page_title\">ಸಂಪುಟ&nbsp;".intval($volume)."&nbsp;- ಸಂಚಿಕೆ&nbsp;".$dissue."&nbsp;&nbsp;:&nbsp;&nbsp;$month&nbsp;".$year."</div>";
}

if($result){$result->free();}

$query1 = "select * from article where volume='$volume' and issue='$issue' order by page";

$result1 = $db->query($query1); 
$num_rows1 = $result1 ? $result1->num_rows : 0;


if($num_rows1 > 0)
{
    echo "<ul class=\"dot\">";

	for($i=1;$i<=$num_rows1;$i++)
	{
		//~ $row1=mysql_fetch_assoc($result1);
		$row1 = $result1->fetch_assoc();

		$titleid=$row1['titleid'];
		$title=$row1['title'];
		$page=$row1['page'];
		$authid=trim($row1['authid']);
		$volume=$row1['volume'];
		$issue=$row1['issue'];
		$year=$row1['year'];
		$month=$row1['month'];
		
		$title1=addslashes($title);
		
		echo "<li>";
		echo "<span class=\"sub_titlespan\"><a target=\"_blank\" href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=$page&amp;year=$year&amp;month=$month\">$title</a></span>";


		if(isset($authid) && $authid!= '' && $authid != 0)
		{

            echo "<br /><span class=\"authorspan\">&mdash;</span>";
			$aut = preg_split('/;/',$authid);

			$fl = 0;
			foreach ($aut as $aid)
			{
				$query2 = "select * from author where authid=$aid";

				//~ $result2 = mysql_query($query2);
				//~ $num_rows2 = mysql_num_rows($result2);

				$result2 = $db->query($query2); 
				$num_rows2 = $result2 ? $result2->num_rows : 0;

				if($num_rows2 > 0)
				{
					//~ $row2=mysql_fetch_assoc($result2);
					$row2 = $result2->fetch_assoc();
					
					$authorname=$row2['authorname'];
                    $sal=$row2['sal'];
                    if($sal != '')
                    {
                        if($fl == 0)
                        {
                            echo "<span class=\"magazine_author\"><a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($sal) . urlencode($authorname) . "\"><span style=\"color: #D2691E\">$sal&nbsp;$authorname</span></a></span>";
                            $fl = 1;
                        }
                        else
                        {
                            echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"magazine_author\"><a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($sal) . urlencode($authorname) . "\">$sal&nbsp;$authorname</a></span>";
                        }
                    }
                    else
                    {
                        if($fl == 0)
                        {
                            echo "<span class=\"magazine_author\"><a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($authorname) . "\"><span style=\"color: #D2691E\">$authorname</span></a></span>";
                            $fl = 1;
                        }
                        else
                        {
                            echo "<span class=\"titlespan\">;&nbsp;</span><span class=\"magazine_author\"><a href=\"auth_magazine.php?authid=$aid&amp;author=" . urlencode($authorname) . "\">$authorname</a></span>";
                        }                        
                    }
				}
				if($result2){$result2->free();}
			}
		}
		//~ echo "<br /><span class=\"downloadspan\"><a href=\"magazineReader.php?volume=$volume&amp;issue=$issue&amp;page=$page&amp;year=$year&amp;month=$month\">View article</a>&nbsp;|&nbsp;<a href=\"javascript:void(0);\">Download article (DjVu)</a>&nbsp;|&nbsp;<a href=\"javascript:void(0);\">Download article (PDF)</a></span>";
		echo "</li>\n";
	}
    echo "</ul>";

}
else
{
	echo "No data in the database";
}

if($result1){$result1->free();}
$db->close();
?>            
            </div>
        </div>
		<?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>
    </div>
<?php include(__DIR__ ."/../inc/include_footer.php");?>
