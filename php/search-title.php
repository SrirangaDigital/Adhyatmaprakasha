<?php

	include(__DIR__ . "/../inc/connect.php");
	
	$search_input = (isset($_POST['query']))? $_POST['query'] : '';
	$language = (isset($_POST['language']))? $_POST['language'] : '';
	//$search_input = 'ಪ್ರಶ್ನೋತ್ತರ';

	$db = @new mysqli('localhost', "$user", "$password", "$database");
	mysqli_set_charset ( $db , "utf8" );

	if($db->connect_errno > 0)
	{
		echo json_encode(["error" => "Not connected to the database (" . $db->connect_errno . ")"]);
		exit(1);
	}


	//results array template for testing
	// $results_template = [
	// 	[
	// 		"book_id" => "001", 
	// 		"book_title" => "ಅಧ್ಯಾತ್ಮವೆಂದರೇನು (ಪ್ರಶ್ನೋತ್ತರ)", 
	// 		"type"=>"kannada", 
	// 		"authid" => "10001",
	// 		"authorname" => "ಶ್ರೀ ಶ್ರೀಸಚ್ಚಿದಾನಂದೇಂದ್ರಸರಸ್ವತೀ ಸ್ವಾಮಿಗಳವರು"
	// 	],		
	// 	[
	// 		"book_id" => "002", 
	// 		"book_title" => "ರಸನಿಮಿಷಗಳು (ಅಧ್ಯಾತ್ಮಚಿಂತನೆಗೆ ಅರ್ಹವಾದ ಬಿಡಿಲೇಖನಗಳು)", 
	// 		"type"=>"kannada", 
	// 		"authid" => "10001",
	// 		"authorname" => "ಶ್ರೀ ಶ್ರೀಸಚ್ಚಿದಾನಂದೇಂದ್ರಸರಸ್ವತೀ ಸ್ವಾಮಿಗಳವರು"
	// 	],		
	// 	[
	// 		"book_id" => "027", 
	// 		"book_title" => "ಶೀ ಶಂಕರಭಗವತ್ಪಾದರ ಸರ್ವಸಮ್ಮತೋಪದೇಶಗಳು", 
	// 		"type"=>"kannada", 
	// 		"authid" => "10001",
	// 		"authorname" => "ಶ್ರೀ ಶ್ರೀಸಚ್ಚಿದಾನಂದೇಂದ್ರಸರಸ್ವತೀ ಸ್ವಾಮಿಗಳವರು"
	// 	]
	// ];

	// $error = [];

	$tablename = $language . "_books_list";
	$query = "select * from " . $tablename . " where title like '%$search_input%' order by slno";
	$results = $db->query($query); 
	$num_rows = $results ? $results->num_rows : 0;

	$results_from_DB = array();


	if($num_rows > 0)
	{
		while($row = $results->fetch_assoc())
		{

			$book_id = $row['book_id'];
			$authid = $row['authid'];
			$authorname = $row['authorname'];
			$type = $row['type'];
			$title = $row['title'];

			$tmpArray = ["book_id" => $book_id, "book_title" => $title, "type" => $type, "authid" => $authid, "authorname" => $authorname];
			array_push($results_from_DB,$tmpArray);
		}

		if(sizeof($results_from_DB) > 0)
			echo json_encode($results_from_DB);
		else
			echo json_encode(["error" => "No results found for " . $search_input]);				
	}
	else{
			echo json_encode(["error" => "No results found for " . $search_input]);
	}


?>