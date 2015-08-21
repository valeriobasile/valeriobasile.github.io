<?
function progress_bar($progress, $total){
	if ($progress < $total){
		print "<div style=\"float:left; width:".$progress."px; background-color: lightblue\">&nbsp;</div>";
		print "<div style=\"float:left; width:".($total-$progress)."px; background-color: lightgrey\">&nbsp;</div>";
	}
	else {
		print "<div style=\"float:left; width:".$total."px; background-color: lightgreen\">&nbsp;</div>";	
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>Crawling del.icio.us</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:20%;
	margin-right:20%;
}

td {
	border: 1px solid #ddd;
}

.td_number {
	text-align: right;
}
.footnote {
	font-size: smaller;
	font-style: italic;
}

pre {
	background: #ddd;
}
</style>

</head>
<body>
<h1>Crawling <a href="http://del.icio.us">del.icio.us</a> for data</h1>
<h2>Evaluation links</h2>
<ul>
<li><a href="evaluation.php?user=FT">FabioT</a></li>
<li><a href="evaluation.php?user=FV">FabioV</a></li>
<li><a href="evaluation.php?user=SP">Silvio</a></li>
<li><a href="evaluation.php?user=VB">Valerio</a></li>
</ul>
<br/>
<h2>Validation progress</h2>
<table>
<?
$db_file = "db/list.sqlite";
$table_name = "list";
$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 
$query = sqlite_query($db, "select count(*) as count from $table_name where valid=1;");
$assoc = sqlite_fetch_all($query);
print "<tr>";
print "<td>Total</td>";
print "<td>";
progress_bar($assoc[0]["count"]/3, 500);
print "</td>";
print "</tr>";

$query = sqlite_query($db, "select count(*) as count, tag from $table_name where valid=1 group by tag;");
$assoc = sqlite_fetch_all($query);
foreach($assoc as $row){
	print "<tr>";
	print "<td>".$row["tag"]."</td>";
	print "<td>";
	progress_bar($row["count"]*10, 500);
	print "</td>";
	print "</tr>";
}
?>
</table>
<br/>

<h2>Evaluation progress</h2>
<table>
<?
$db_file = "db/list.sqlite";
$table_name = "list";
$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 
$users = array("FT", "FV", "SP", "VB");

foreach ($users as $user){
	$query = sqlite_query($db, "select count(*) as count from $table_name where $user=1 or $user=2;");
	$assoc = sqlite_fetch_all($query);
	print "<tr>";
	print "<td>$user</td>";
	print "<td>";
	progress_bar($assoc[0]["count"]/3, 500);
	print "</td>";
	print "</tr>";

}
?>
</table>
<br/>

<!--<a href="export.php">export in CSV format</a>-->
</html>
