<?php
$db_file = "db/list.sqlite";
$table_name = "list";
$colors = array(0 => "lightgrey", 1 => "lightgreen", 2 => "pink");
$labels = array(0 => "not reviewed", 1 => "valid", 2 => "not valid");

function tag_stats($db, $tag){
	global $colors;
	global $labels;
	global $table_name;
	
	$query = sqlite_query($db, "select count(*) as count, valid from $table_name where tag = '$tag' group by valid;");
	$assoc = sqlite_fetch_all($query);
	foreach ($assoc as $row){
		print ("<span style=\"padding: 0.1em; background-color: ".$colors[$row["valid"]]."\">".$labels[$row["valid"]].": ".$row["count"]."</span> ");
	}
}

function print_menu($tags){
	foreach($tags as $tag){
		print("<a href=\"#$tag\">$tag</a> ");
	}
	print("<br />");
}

function table_row($row){
	global $colors;

	print "<tr>";
	print "<td width=\"80\">";
	print "<span style=\"padding: 0.1em; background-color: ".$colors[0]."\"><input name=\"valid_".$row["id"]."\" type=\"radio\" value=\"0\" ".($row["valid"]==0?"checked=\"checked\"":"")." onclick=\"document.forms['form_valid'].changed_".$row["id"].".value=1\"></input></span>";
	print "<span style=\"padding: 0.1em; background-color: ".$colors[1]."\"><input name=\"valid_".$row["id"]."\" type=\"radio\" value=\"1\" ".($row["valid"]==1?"checked=\"checked\"":"")." onclick=\"document.forms['form_valid'].changed_".$row["id"].".value=1\"></input></span>";
	print "<span style=\"padding: 0.1em; background-color: ".$colors[2]."\"><input name=\"valid_".$row["id"]."\" type=\"radio\" value=\"2\" ".($row["valid"]==2?"checked=\"checked\"":"")." onclick=\"document.forms['form_valid'].changed_".$row["id"].".value=1\"></input></span>";
	print "<input name=\"changed_".$row["id"]."\" type=\"hidden\" value=\"0\" />";
	print "</td>";
	print "<td><span style=\"padding: 0.1em; background-color: ".$colors[$row["valid"]]."\">";
	print "<a target=\"link\" href=\"".$row["url"]."\">".$row["title"]."</a>";
	print "</span></td>";
	print "</tr>";
}



$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 

# create table if it doesn't exist
$query = sqlite_query($db, "SELECT name FROM sqlite_master WHERE type='table' AND name='$table_name';");
$totaltables = sqlite_num_rows($query);
if ($totaltables<1){ 
	sqlite_query($db, "CREATE TABLE $table_name (id int, VB int, SP int, FT int, FV int, tag varchar(200), valid int, url varchar(200), title varchar(200))");
	$file_array = file("list.txt");
	
	$id = 1;
	print "<pre>";
	foreach ($file_array as $line){
		$record = explode("\t", $line);
		$tag = $record[0];
		$url = $record[1];
		$title = $record[2];
		$sql = "insert into list (id, tag, valid, url, title) values ($id, '$tag', 0, '$url', '".sqlite_escape_string(substr($title, 0, -1))."');\n";
		$id = $id + 1;
		print $sql;
		sqlite_query($db, $sql);
	}
	 print "</pre>";
}

print ("<form name=\"form_valid\" action=\"save_valid.php\" method=\"post\" target=\"_top\">");

#$tags = array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian");
$tags = array("resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science", "business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

foreach ($tags as $tag){
	print("<a name=\"$tag\" />");
	print("<h2>$tag</h2>");
	print_menu($tags);
	tag_stats($db, $tag);	
	print ("<input type=\"submit\" value=\"save\" />");
	$query = sqlite_query($db, "select * from $table_name where tag = '$tag';");
	$assoc = sqlite_fetch_all($query);
	print ("<table border=\"0\">");
	foreach ($assoc as $row){
		print (table_row($row));
	}
	print ("</table>");
}

print ("</form>");
?>