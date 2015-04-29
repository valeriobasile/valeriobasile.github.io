<pre>
<?php
# open SQLite database from tab-separated data
$db = new PDO('sqlite:db/politweets.sqlite3');

$sql = "SELECT * FROM tweet LIMIT 10000,10001";
$result = $db->query($sql);
$rows = $result->fetchAll();
$row_count = count($rows);

foreach ($rows as $row) {
        print_r($row);
}

?>
</pre>
