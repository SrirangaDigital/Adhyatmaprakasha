<?php
	include(__DIR__ . "/../php/connect.php");
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
		<p><a href="<?php echo $base_url; ?>php/circulars/revised_price_list_2026.pdf?v=1.1" target="_blank"><img style="width: 50%;" src="<?php echo $base_url; ?>php/images/revised_price_list_2026.jpg" /></a></p>
		<p>
			<span class="news"><a href="<?php echo $base_url; ?>php/circulars/revised_price_list_2026.pdf?v=1.1" target="_blank">Revised price list of books</a></span><br /><br />
		</p>
		<p>
			<span class="news"><a href="<?php echo $base_url; ?>php/circulars/intro.php">ಶ್ರೀ ಸಚ್ಚಿದಾನಂದ ಅಧ್ಯಾತ್ಮವಿದ್ಯಾಲಯ - ಪರಿಚಯ ಪತ್ರ ಮತ್ತು ಪಾಠಕ್ರಮ</a></span>
		</p><br />
	</div>

    <div class="widget">
		<div class="title">Keep in touch</div>
		<p>
			For all the latest and regular communication and updates:<br /><br />
		</p>	
			<p><img style="width: 20%;" src="<?php echo $base_url; ?>php/images/whatsapp.png" /></p>
			<!-- <p>Please send a WhatsApp message "Shri Gurubhyo Namaha" to +91-8073081405 and add the phone number as Adhyatma Prakasha Karyalaya to get messages on adhyatma in Kannada.<br /><br /></p>  -->
			<p>WhatsApp Broadcast on Adhyatma : <span style="color: #D2691E;">8073081405</span></p>
			<p style="margin-bottom: 20px;">WhatsApp Communication with Karyalaya : <span style="color: #D2691E;">9535790641</span></p>
			<p><a href="http://www.youtube.com/apkbooks" target="_blank"><img style="width: 20%;" src="<?php echo $base_url; ?>php/images/youtube.png" /></a></p>
			<p>Videos and talks of scholars from Karyalaya will be available at: <span class="lang"><a href="http://www.youtube.com/apkbooks" target="_blank">Youtube</a></span><br /><br /></p> 

			<p><a href="http://www.facebook.com/groups/AdhyatmaPrakasha/" target="_blank"><img style="width: 20%;" src="<?php echo $base_url; ?>php/images/facebook.png" /></a></p>
			<p>Group interaction of like minded people is at <span class="lang"><a href="http://www.facebook.com/groups/AdhyatmaPrakasha/" target="_blank">Facebook</a></span></p>
			<p>Please subscribe to the same</p>

			<p style="margin-top: 20px;"><a href="https://x.com/AKaryalaya/" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/X_logo_2023.svg" alt="twitter image" width="43px" height="43px"/></a></p>
			<p>Please follow twitter handle of Adhyatma Prakasha Karyalaya <span class="lang"><a href=" https://x.com/AKaryalaya/" target="_blank">Twitter</a></span></p>

	</div>
	<div class="rule"></div>
	<div class="widget">
        <div class="title">Top viewed books</div>
        <p>
            <span class="lang"><a href="<?php echo $base_url; ?>php/english_books.php">English</a></span><br />
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
						echo "<span class=\"news\"><a href=\"" . $base_url . "php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
				
            ?>
            <br /><span class="lang"><a href="<?php echo $base_url; ?>php/kannada_books.php">ಕನ್ನಡ</a></span><br />
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
						echo "<span class=\"news\"><a href=\"" . $base_url . "php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
			?>
            <br /><span class="lang"><a href="<?php echo $base_url; ?>php/sanskrit_books.php">संस्कृतम् </a></span><br />
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
						echo "<span class=\"news\"><a href=\"" . $base_url . "php/".$row1["type"]."/".$row1["type"]."_books_toc.php?book_id=".$row1["book_id"]."&amp;type=".$row1["type"]."&amp;book_title=" . urlencode($row1["title"]) . "\"\">".$row1["title"]."</a></span><br />";
					}
				}
			?>
        </p>
    </div>
      <div class="visitors">
		<table class="visit">
			<th>Visitors</th>
			<tr>
				<td><?php include(__DIR__ . "/../php/count.php")?></td>
			</tr>
		</table>
	</div>
</div>
