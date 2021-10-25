<?php
/*
This program is the AJAX call for Larson's code example.

This code takes an input from the front end call and checks it against two databases, returning matching parts in either.
It also formats the results into a single string for use by the front end HTML file.
Basic input sanitization is employed on input.

This code was written by Larson Long.
*/

$c_title_array = [];
$c_p_ID_array = [];
$c_attr_array = [];

$mysqli = new mysqli("localhost", "username", "password", "nysus_app");
if($mysqli->connect_error) {
  exit('Could not connect');
}

// select parents string
$sql = "SELECT title, ID FROM parent WHERE title = ?";

// select children string
$sql2 = "SELECT title, ID, attr FROM child WHERE (ID = ?) OR (attr = ?)";

// run parent SQL statement
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($p_title, $p_ID);
$stmt->fetch();
$stmt->close();


//run children SQL string
$stmt = $mysqli->prepare($sql2);
$stmt->bind_param("ss", $p_ID, $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($c_title, $c_p_ID, $c_attr);
//put children results in proper arrays
while ($stmt->fetch()){
  array_push($c_title_array, $c_title);
  array_push($c_p_ID_array, $c_p_ID);
  array_push($c_attr_array, $c_attr);
}

$stmt->close();
$mysqli->close();

//put values into a single string to return them
if (is_null($p_title)){
  $p_title = "Sorry, that input did not match anything. Please try another word.";
}
$out = $p_title;
$out .= "#";

if (!empty($c_title_array)) {
  for($i = 0; $i < count($c_title_array); $i++){
    $out .= $c_title_array[$i];
    $out .= "\n";
  }
} 

//return values to program
echo $out;

?>