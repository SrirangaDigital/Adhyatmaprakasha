<?php include(__DIR__ . "/../inc/include_header.php");?>

	<div class="content">
		<div class="col1">
			<div class="search_title">Search</div>
<?php

include(__DIR__ . "/../inc/connect.php");
require_once("common.php");

?>
			<div class="archive_search">
				<form method="POST" action="search-result.php">
					<div>
						<span class="label"><input name="check[]" type="checkbox" value="magazine" checked="checked"/>&nbsp;&nbsp;Magazine</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="english"/>&nbsp;&nbsp;English Books</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="kannada"/>&nbsp;&nbsp;Kannada Books</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="sanskrit"/>&nbsp;&nbsp;Sanskrit Books</span><br />
						<span class="label"><input name="check[]" type="checkbox" value="other"/>&nbsp;&nbsp;Other Books</span>
					</div>
 					<br/>
					<table>
						<tr>
							<td class="right"><input class="titlespan wide" name="title" type="text" id="title" onfocus="SetId('title')" placeholder="Title" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="right"><input class="titlespan wide" name="author" type="text" id="author" onfocus="SetId('author')" placeholder="Author" style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="right"><input class="titlespan wide" name="text" type="text" id="word" onfocus="SetId('word')" placeholder="Text"  style="height: 2em; margin: 0.5em 0em 0.5em 0em"/></td>
						</tr>
						<tr>
							<td class="submit">
								<input name="searchform" type="submit" class="titlespan med" id="button_search" value="Search"/>
								<input name="resetform" type="reset" class="titlespan med" id="button_reset" value="Reset"/>
							</td>
						</tr>
					</table>
				</form>
				<?php include("kannadaKeybord.php"); ?>
				<?php include("sanskritKeybord.php"); ?>
				<?php include("hindiKeybord.php"); ?>
				<?php include("tamilKeybord.php"); ?>
		</div>
		<div class="stitle">
			<span>Input modes for Kannada and Sanskrit</span><br/>
			<button id="kan">Kannada</button>
			<button id="san">Sanskrit</button>
			<button id="hin">Hindi</button>
			<button id="tam">Tamil</button>
		</div>
		</div>
        <?php include(__DIR__ ."/../inc/include_sidebar.php");?>
        <div class="clearfix"></div>
	</div>

<script src="lightbox/js/jquery-1.2.6.min.js"></script>
<script>
$(document).ready(function()
{
	$("#hindi").hide();
	$("#sanskrit").hide();
	$("#tamil").hide();
	$("#kannada").show();
	$("#kan").click(function()
	{
		$("#kannada").fadeIn();
		$("#sanskrit").hide();
		$("#hindi").hide();
		$("#tamil").hide();
	});
	$("#san").click(function()
	{
		$("#sanskrit").fadeIn();
		$("#kannada").hide();
		$("#hindi").hide();
		$("#tamil").hide();
	});
	$("#hin").click(function()
	{
		$("#hindi").fadeIn();
		$("#kannada").hide();
		$("#sanskrit").hide();
		$("#tamil").hide();
	});
	$("#tam").click(function()
	{
		$("#tamil").fadeIn();
		$("#kannada").hide();
		$("#sanskrit").hide();
		$("#hindi").hide();
	});
});
</script>
<script type="text/javascript" src="js/kannada_kbd.js" charset="UTF-8"></script>    
<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>    

<?php include(__DIR__ . "/../inc/include_footer.php");?>
