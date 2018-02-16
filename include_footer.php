<?php
	include("php/connect.php");
	$db = @new mysqli('localhost', "$user", "$password", "$database");
	mysqli_set_charset ( $db , "utf8" );
	$limit = 3;
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
?>
<div class="col2">
    <div class="widget">
		<div class="title">News updates</div>
		<p>
			<span class="news"><a href="php/circulars/intro.php">ಶ್ರೀ ಸಚ್ಚಿದಾನಂದ ಅಧ್ಯಾತ್ಮವಿದ್ಯಾಲಯ - ಪರಿಚಯ ಪತ್ರ ಮತ್ತು ಪಾಠಕ್ರಮ</a></span>
		</p><br />
		<p>
			<span class="news"><a href="Volumes/PDF/kannada/111A/index_tamil.pdf">Translation of Paramarthika Chintamani is now available in Tamil</a></span>
		</p>
	</div>
	<br />
    <div class="widget">
		<div class="title">Keep in touch</div>
		<p>
			For all the latest and regular communication and updates:<br /><br />
		</p>	
			<p><img style="width: 20%;" src="php/images/whatsapp.png" /></p>
			<p>Please send a WhatsApp message "Shri Gurubhyo Namaha" to +91-9073081405 and add the phone number as Adhyatma Prakasha Karyalaya.<br /><br /></p> 
			<p><a href="http://www.youtube.com/c/apkbooks" target="_blank"><img style="width: 20%;" src="php/images/youtube.png" /></a></p>
			<p>Videos and talks of scholars from Karyalaya will be available at: <span class="lang"><a href="http://www.youtube.com/c/apkbooks" target="_blank">Youtube</a></span><br /><br /></p> 
			<p><a href="http://www.facebook.com/groups/AdhyatmaPrakasha/"" target="_blank"><img style="width: 20%;" src="php/images/facebook.png" /></a></p>
			<p>Group interaction of like minded people is at <span class="lang"><a href="http://www.facebook.com/groups/AdhyatmaPrakasha/" target="_blank">Facebook</a></span></p>
		<p>Please subscribe to the same</p>
	</div>
	<div class="rule"></div>
	<div class="widget">
        <div class="title">Top viewed books</div>
        <p>
            <span class="lang"><a href="php/english_books.php">English</a></span><br />
            <?php
				$query = "select * from topviewed where language = 'english' order by hits desc limit $limit";
				$result = $db->query($query); 
				$num_rows = $result ? $result->num_rows : 0;
				if($num_rows > 0)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row = $result->fetch_assoc();
						$query1 = "select * from english_books_list where book_id = ".$row["bookid"]."";
						$result1 = $db->query($query1);
						$row1 = $result1->fetch_assoc();
						echo "<span class=\"news\"><a href=\"php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
				
            ?>
            <br /><span class="lang"><a href="php/kannada_books.php">ಕನ್ನಡ</a></span><br />
            <?php 
				$query = "select * from topviewed where language = 'kannada' order by hits desc limit $limit";
				$result = $db->query($query); 
				$num_rows = $result ? $result->num_rows : 0;
				if($num_rows > 0)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row = $result->fetch_assoc();
						$query1 = "select * from kannada_books_list where book_id = ".$row["bookid"]."";
						$result1 = $db->query($query1);
						$row1 = $result1->fetch_assoc();
						echo "<span class=\"news\"><a href=\"php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
			?>
            <br /><span class="lang"><a href="php/sanskrit_books.php">संस्कृतम् </a></span><br />
            <?php 
				$query = "select * from topviewed where language = 'sanskrit' order by hits desc limit $limit";
				$result = $db->query($query); 
				$num_rows = $result ? $result->num_rows : 0;
				if($num_rows > 0)
				{
					for($i=1;$i<=$num_rows;$i++)
					{
						$row = $result->fetch_assoc();
						$query1 = "select * from sanskrit_books_list where book_id = ".$row["bookid"]."";
						$result1 = $db->query($query1);
						$row1 = $result1->fetch_assoc();
						echo "<span class=\"news\"><a href=\"php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
			?>
        </p>
    </div>
      <div class="visitors">
		<table class="visit">
			<th>Visitors</th>
			<tr>
				<td><?php include("php/count.php")?></td>
			</tr>
		</table>
	</div>
</div>
