<?php session_start();
error_reporting(0);
include('includes/config.php');
include('proses.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
	$("#results").load("fetch_pages.php");  //initial page number to load
	$(".pagination").bootpag({
	   total: <?php echo $pages; ?>, // total number of pages
	   page: 1, //initial page
	   maxVisible: 5 //maximum visible links
	}).on("page", function(e, num){
		e.preventDefault();
		$("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
		$("#results").load("fetch_pages.php", {'page':num});
	});
});

<?php
$results = mysqli_query($db,"SELECT COUNT(*) FROM kolam");
$get_total_rows = mysqli_fetch_array($results); //total records

//break total records into pages
$pages = ceil($get_total_rows[0]/$item_per_page);	

?>

<div id="results"></div>
<div class="pagination"></div>

<?php
include("config.inc.php"); //include config file

//sanitize post value
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}

//get current starting point of records
$position = (($page_number-1) * $item_per_page);

//Limit our results within a specified range. 
$results = mysqli_query($db, "SELECT * FROM kolam ORDER BY id ASC LIMIT $position, $item_per_page");

//output results from database
echo '<ul class="page_result">';
while($row = mysqli_fetch_array($results))
{
	echo '<li id="item_'.$row["id"].'">'.$row["id"].'. <span class="page_name">'.$row["jenis"].'</span></li>';
}
echo '</ul>';