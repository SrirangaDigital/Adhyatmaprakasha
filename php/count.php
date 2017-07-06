 <?php

include("connect.php");

if(isset($_SESSION['visitor_number']))
{
	echo $_SESSION['visitor_number'];
}
else
{
	//include("connect.php");

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

	$update_query= "update visitor set count=count+1";
	$result = $db->query($update_query);
 
	$pick = "select count from visitor";
	$pick_result = $db->query($pick);
	$num_results = $pick_result ? $pick_result->num_rows : 0; 
	
	if($num_results > 0)
	{
		$row = $pick_result->fetch_assoc();
		$_SESSION['visitor_number'] = $row['count'];
		echo $_SESSION['visitor_number'];
	}
	if($result){$result->free();}
	$db->close();
}
?>
