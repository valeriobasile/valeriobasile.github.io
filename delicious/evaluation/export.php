<?php
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=delicious-evaluation.csv");
header("Pragma: no-cache");
header("Expires: 0");

$db_file = "db/list.sqlite";
$table_name = "list";

$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 


echo ("id\ttag\tFT\tFV\tSP\tVB\turl\ttitle\n");
$query = sqlite_query($db, "select * from $table_name");
$assoc = sqlite_fetch_all($query);
foreach ($assoc as $row){
	if ($row["valid"]==1)
		echo($row["id"]."\t".$row["tag"]."\t".$row["FT"]."\t".$row["FV"]."\t".$row["SP"]."\t".$row["VB"]."\t".$row["url"]."\t".$row["title"]."\n");
}


?>
