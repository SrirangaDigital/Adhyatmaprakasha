<?php

function isValidId($book_id)
{
	if(is_array($book_id)){return false;}
	return preg_match("/^[0-9][0-9][0-9]|[0-9][0-9][0-9][A-Z]$/", $book_id) ? true : false;
}
function isValidLetter($letter)
{
	return is_array($letter) ? false : true;
}
function isValidType($type)
{
	if(is_array($type)){return false;}
	return preg_match("/^(kannada|english|sanskrit)$/", $type) ? true : false;
}


function isValidTitle($title)
{
	return is_array($title) ? false : true;
}
function isValidVolume($vol)
{
	if(is_array($vol)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $vol) ? true : false;
}
function isValidPart($issue)
{
	if(is_array($issue)){return false;}
	return preg_match("/^([0-9][0-9]|[0-9][0-9]\-[0-9][0-9])$/", $issue) ? true : false;
}
function isValidYear($year)
{
	if(is_array($year)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9]\-[0-9][0-9])$/", $year) ? true : false;
}

function isValidAuthid($authid)
{
	if(is_array($authid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $authid) ? true : false;
}

function isValidAuthor($author)
{
	return is_array($author) ? false : true;
}

function isValidText($text)
{
	return is_array($text) ? false : true;
}

function entityReferenceReplace($term)
{
	if(is_array($term))
	{
		$term = "$term";
	}
	
	$term = preg_replace("/<i>/", "", $term);
	$term = preg_replace("/<\/i>/", "", $term);
	$term = preg_replace("/\;/", "&#59;", $term);
	$term = preg_replace("/</", "&#60;", $term);
	$term = preg_replace("/=/", "&#61;", $term);
	$term = preg_replace("/>/", "&#62;", $term);
	$term = preg_replace("/\(/", "&#40;", $term);
	$term = preg_replace("/\)/", "&#41;", $term);
	$term = preg_replace("/\:/", "&#58;", $term);
	$term = preg_replace("/Drop table|Create table|Alter table|Delete from|Desc table|Show databases|iframe/i", "", $term);
	
	return($term);
}
/*
isValidTitle, isValidFeature, isValidAuthor, isValidText
*/
function romanNumerals($num) 
{
    $n = intval($num);
    $res = '';
 
    /*** roman_numerals array  ***/
    $roman_numerals = array('M'  => 1000, 'CM' => 900, 'D'  => 500, 'CD' => 400, 'C'  => 100, 'XC' => 90, 'L'  => 50, 'XL' => 40, 'X'  => 10, 'IX' => 9, 'V'  => 5, 'IV' => 4, 'I'  => 1);
 
    foreach ($roman_numerals as $roman => $number) 
    {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);
 
        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);
 
        /*** substract from the number ***/
        $n = $n % $number;
    }
 
    /*** return the res ***/
    return $res;
    }
?>
