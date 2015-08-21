<?

$db_file = "db/list.sqlite";
$table_name = "list";
$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 

foreach($_POST as $id => $value){
	if(substr($id, 0, 7)==="changed" && $value === "1"){
		$id = substr($id, 8);
		$value = $_POST["valid_".$id];
		$sql = "update $table_name set valid = '$value' where id = '$id';\n";
		#echo $sql;
		sqlite_query($db, $sql);
	}
}

header("Location: evaluation_valid.php");
?>
