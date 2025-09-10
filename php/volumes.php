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
		<div class="archive_holder_volume">
            <div class="page_title"><span style="font-size: 1.2em;">ಸಂಪುಟಗಳು</span></div>
			<div class="column1"><ul>
<?php

include(__DIR__ . "/../inc/connect.php");

$db = @new mysqli('localhost', "$user", "$password", "$database");
if($db->connect_errno > 0)
{
	echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
	echo "</ul></div></div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");

$row_count = 30;

$query = "select distinct volume from article order by volume";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$count = 0;
$col = 1;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();
		$volume=$row['volume'];

		$query1 = "select distinct year from article where volume='$volume'";
		
		//~ $result1 = mysql_query($query1);
		//~ $num_rows1 = mysql_num_rows($result1);
		$result1 = $db->query($query1); 
		$num_rows1 = $result1 ? $result1->num_rows : 0;
		
		if($num_rows1 > 0)
		{
			for($i1=1;$i1<=$num_rows1;$i1++)
			{
				//~ $row1=mysql_fetch_assoc($result1);
				$row1 = $result1->fetch_assoc();
				
				if($i1==1)
				{
					$year=$row1['year'];
				}
				elseif($i1==2)
				{
					$year2 = $row1['year'];
					$year21 = preg_split('//',$year2);
					$year=$year."-".$year21[3].$year21[4];
				}
			}
			$count++;
			$volume_int = intval($volume);
			if($count > $row_count)
			{
				$col++;
				echo "</ul></div>\n
				<div class=\"column$col\"><ul>";
				$count = 1;
			}
			echo "<li><span class=\"yearspan\"><a href=\"issue.php?vol=$volume&amp;year=$year\"><span style=\"font-size: 1.15em;\">ಸಂಪುಟ</span>&nbsp;$volume_int ($year)</a></span></li>";
		}
		if($result1){$result1->free();}
	}
}
else
{
	echo "No data in the database";
}
if($result){$result->free();}
$db->close();

?>                
            </ul></div>
		</div>
		<?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>
    </div>

<?php include(__DIR__ ."/../inc/include_footer.php");?>
