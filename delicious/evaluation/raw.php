<?php
header('Content-type: text/plain');
$db_file = "db/list.sqlite";

$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 

# first run
#$tags = array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian");

# second run (complete)
$tags = array("resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science", "business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

# second run (first half)
#$tags = array("resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science");

# second run (second half)
#$tags = array("business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

# first and second run together
$tags = array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian", "resource", "blog", "linkedin", "webdev", "awesome", "inspiration", "iphone", "upload", "logo", "science", "business", "webcomic", "copyright", "architecture", "university", "guitar", "geometry", "gardening", "chocolate", "bible");

#shuffle($tags);

print "tag\tVB\tSP\tFT\tFV\turl\n";
foreach ($tags as $tag){
	$query = sqlite_query($db, "select * from list where tag = '$tag' and valid=1;");
	$assoc = sqlite_fetch_all($query);
	if (sqlite_num_rows($query) > 0){
		foreach ($assoc as $row){
			print $tag."\t".$row["VB"]."\t".$row["SP"]."\t".$row["FT"]."\t".$row["FV"]."\t".$row["url"]."\n";
		}
	}
}

?>
