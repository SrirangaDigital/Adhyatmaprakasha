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
                <div class="page_title">List of Authors</div>
                <table class="letter_tab">
                    <tr class="level1">
                        <td>
                            <div class="letter"><a href="authors.php?letter=ಅ">ಅ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಆ">ಆ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಇ">ಇ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಈ">ಈ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಉ">ಉ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಊ">ಊ</a></div>                        
                            <div class="letter"><a href="authors.php?letter=ಋ">ಋ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಎ">ಎ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಏ">ಏ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಐ">ಐ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಒ">ಒ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಓ">ಓ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಔ">ಔ</a></div>
                        </td>
                    </tr>
                    <tr class="level2">
                        <td>
                            <div class="letter"><a href="authors.php?letter=ಕ">ಕ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಖ">ಖ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಗ">ಗ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಘ">ಘ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಚ">ಚ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಛ">ಛ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಜ">ಜ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಟ">ಟ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಡ">ಡ</a></div>
                            <div class="letter"><a href="authors.php?letter=ತ">ತ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಥ">ಥ</a></div>
                            <div class="letter"><a href="authors.php?letter=ದ">ದ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಧ">ಧ</a></div>
                            <div class="letter"><a href="authors.php?letter=ನ">ನ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಪ">ಪ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಫ">ಫ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಬ">ಬ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಭ">ಭ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಮ">ಮ</a></div>
                        </td>
                    </tr>
                    <tr class="level3">
                        <td>
                            <div class="letter"><a href="authors.php?letter=ಯ">ಯ</a></div>
                            <div class="letter"><a href="authors.php?letter=ರ">ರ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಲ">ಲ</a></div>
                            <div class="letter"><a href="authors.php?letter=ವ">ವ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಶ">ಶ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಷ">ಷ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಸ">ಸ</a></div>
                            <div class="letter"><a href="authors.php?letter=ಹ">ಹ</a></div>
                            <div class="all"><a href="authors.php?letter=Special">All</a></div>
                        </td>
                    </tr>
                </table>
                <ul class="dot">
<?php

include(__DIR__ . "/../inc/connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];

	if(!(isValidLetter($letter)))
	{
		echo "<li>Invalid URL</li>";
		
		echo "</ul></div></div>";
		include("include_footer.php");
		echo "<div class=\"clearfix\"></div></div>";
		include("include_footer_out.php");
		echo "</body></html>";
		exit(1);
	}

	if($letter == '')
	{
		$letter = 'ಅ';
	}
}
else
{
	$letter = 'ಅ';
}

$db = @new mysqli('localhost', "$user", "$password", "$database");
$db->set_charset("utf8");
if($db->connect_errno > 0)
{
	echo '<li>Not connected to the database [' . $db->connect_errno . ']</li>';
	echo "</ul></div></div>";
	include("include_footer.php");
	echo "<div class=\"clearfix\"></div></div>";
	include("include_footer_out.php");
	echo "</body></html>";
	exit(1);
}

//~ $db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
//~ $rs = mysql_select_db($database,$db) or die("No Database");
if($letter == 'Special')
{
	$query = "select * from author order by authorname";
}

else
{
    $query = "select * from author where authorname like '$letter%' order by authorname";
}
/*
$query = "select * from author where authorname like '$letter%' order by authorname";
*/

//~ $result = mysql_query($query);
//~ $num_rows = mysql_num_rows($result);

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		//~ $row=mysql_fetch_assoc($result);
		$row = $result->fetch_assoc();

		$authid=$row['authid'];
		$authorname=$row['authorname'];
        $sal=$row['sal'];
        
        if($authorname != '')
        {
            echo "<li>";
            if($sal != '')
            {
                echo "<span class=\"sub_titlespan\"><a href=\"auth_magazine.php?authid=$authid&amp;author=" . urlencode($sal) . "&nbsp;" . urlencode($authorname) . "\">$sal&nbsp;$authorname</a></span>";
            }
            else
            {
                echo "<span class=\"sub_titlespan\"><a href=\"auth_magazine.php?authid=$authid&amp;author=" . urlencode($sal) . "&nbsp;" . urlencode($authorname) . "\">$authorname</a></span>";
            }
            echo "</li>\n";
        }
    }
}
else
{
	echo "<li>Sorry! No author names were found to begin with the letter '$letter'</li>";
}

if($result){$result->free();}
$db->close();
?>
                </ul>
            </div>
		</div>
		<?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>        
    </div>

<?php include(__DIR__ ."/../inc/include_footer.php");?>
