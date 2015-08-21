<?php
$user = isset($_GET["user"]) ? $_GET["user"] : "VB";
$db_file = "db/list.sqlite";
$table_name = "list";
$colors = array(0 => "lightgrey", 1 => "lightblue", 2 => "yellow");
$labels = array(0 => "not reviewed", 1 => "subject", 2 => "non-subject");

function table_row($row){
	global $user;
	global $labels;
	global $colors;
	
	print "<tr>";
	print "<td style=\"text-align: center; padding: 0.2em; background-color: ".$colors[0]."\"><input name=\"".$row["id"]."\" type=\"radio\" value=\"0\" ".($row[$user]==0?"checked=\"checked\"":"")." onclick=\"document.forms['form_evaluation'].changed_".$row["id"].".value=1\"></input></td>";
	print "<td style=\"text-align: center;padding: 0.2em; background-color: ".$colors[1]."\"><input name=\"".$row["id"]."\" type=\"radio\" value=\"1\" ".($row[$user]==1?"checked=\"checked\"":"")." onclick=\"document.forms['form_evaluation'].changed_".$row["id"].".value=1\"></input></td>";
	print "<td style=\"text-align: center;padding: 0.2em; background-color: ".$colors[2]."\"><input name=\"".$row["id"]."\" type=\"radio\" value=\"2\" ".($row[$user]==2?"checked=\"checked\"":"")." onclick=\"document.forms['form_evaluation'].changed_".$row["id"].".value=1\"></input></td>";
	print "<input name=\"changed_".$row["id"]."\" type=\"hidden\" value=\"0\" />";
	print "<td><a target=\"link\" href=\"".$row["url"]."\">".$row["title"]."</a></td>";
	print "</tr>";
}

function print_menu($tags){
	foreach($tags as $tag){
		print("<a href=\"#$tag\">$tag</a> ");
	}
	print("<br />");
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

print ("user: <strong>$user</strong>");
print ("<form name=\"form_evaluation\" action=\"save.php\" method=\"post\" target=\"_top\">");
print ("<input type=\"hidden\" name=\"user\" value=\"$user\" />");

# first run
#$tags = array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian");

# second run (complete)
#$tags = array("resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science", "business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

# second run (first half)
#$tags = array("resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science");

# second run (second half)
#$tags = array("business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

# first and second run together
$tags = array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian", "resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science", "business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

shuffle($tags);

foreach ($tags as $tag){
	$query = sqlite_query($db, "select * from $table_name where tag = '$tag' and valid=1;");
	$assoc = sqlite_fetch_all($query);
	if (sqlite_num_rows($query) > 0){
		print("<a name=\"$tag\" />");
		print("<h2>$tag</h2>");
		print_menu($tags);
		print ("<input type=\"submit\" value=\"save\" />");
		print ("<a href=\"index.php\" target=\"_top\">back</a>");
		print ("<table border=\"0\">");
		print "<tr>";
		print "<td><span style=\"text-align: center; padding: 0.2em; background-color: ".$colors[0]."\">".$labels[0]."</span></td>";
		print "<td><span style=\"text-align: center; padding: 0.2em; background-color: ".$colors[1]."\">".$labels[1]."</span></td>";
		print "<td><span style=\"text-align: center; padding: 0.2em; background-color: ".$colors[2]."\">".$labels[2]."</span></td>";
		print "<td>title</td>";
		print "</tr>";
		foreach ($assoc as $row){
			print (table_row($row));
		}
		print ("</table>");
	}
}

print ("</form>");
?>
