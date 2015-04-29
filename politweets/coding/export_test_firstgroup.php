<?
ini_set('max_execution_time', 300);
# open SQLite database from tab-separated data
try{
    $db = new PDO('sqlite:db/politweets.sqlite3');
}
catch(PDOException $e) {
    echo $e->getMessage();
}

for ($i=2; $i<=10; $i++) {
    #echo $i;
    $fp = fopen('testset/T'.$i.'.csv', 'w');
    #fputcsv($fp, array('bert','joris','petra','sjoerd'));

    $sql = "SELECT c_bert.T".$i.", c_joris.T".$i.", c_petra.T".$i.", c_sjoerd.T".$i."
    FROM tweet_test_first
    INNER JOIN code as c_bert
    ON c_bert.tweet_ind = tweet_test_first.ind
    INNER JOIN code as c_joris
    ON c_joris.tweet_ind = tweet_test_first.ind
    INNER JOIN code as c_petra
    ON c_petra.tweet_ind = tweet_test_first.ind
    INNER JOIN code as c_sjoerd
    ON c_sjoerd.tweet_ind = tweet_test_first.ind
    where c_bert.partition='test_first'
    and c_joris.partition='test_first'
    and c_petra.partition='test_first'
    and c_sjoerd.partition='test_first'
    and c_bert.coder='bert'
    and c_joris.coder='joris'
    and c_petra.coder='petra'
    and c_sjoerd.coder='sjoerd'
    and tweet_test_first.party != 'SGP'
    and tweet_test_first.party != 'D66'
    and tweet_test_first.party != 'DPK'
    and tweet_test_first.party != 'CU'
    order by tweet_test_first.party";

    $result = $db->query($sql);
    $rows = $result->fetchAll();

    foreach($rows as $row) {
        $fields = array();
        $fields [] = $row[0];
        $fields [] = $row[1];
        $fields [] = $row[2];
        $fields [] = $row[3];
        if ($row[0]!=''&&$row[1]!=''&&$row[2]!=''&&$row[3]!='')
            fputcsv($fp, $fields);
    }

    $sql = "SELECT c_bert.T".$i.", c_joris.T".$i.", c_petra.T".$i.", c_sjoerd.T".$i."
    FROM tweet_test_second
    INNER JOIN code as c_bert
    ON c_bert.tweet_ind = tweet_test_second.ind
    INNER JOIN code as c_joris
    ON c_joris.tweet_ind = tweet_test_second.ind
    INNER JOIN code as c_petra
    ON c_petra.tweet_ind = tweet_test_second.ind
    INNER JOIN code as c_sjoerd
    ON c_sjoerd.tweet_ind = tweet_test_second.ind
    where c_bert.partition='test_second'
    and c_joris.partition='test_second'
    and c_petra.partition='test_second'
    and c_sjoerd.partition='test_second'
    and c_bert.coder='bert'
    and c_joris.coder='joris'
    and c_petra.coder='petra'
    and c_sjoerd.coder='sjoerd'
    order by tweet_test_second.id";

    $result = $db->query($sql);
    $rows = $result->fetchAll();

    foreach($rows as $row) {
        $fields = array();
        $fields [] = $row[0];
        $fields [] = $row[1];
        $fields [] = $row[2];
        $fields [] = $row[3];
        if ($row[0]!=''&&$row[1]!=''&&$row[2]!=''&&$row[3]!='')
            fputcsv($fp, $fields);
    }

    fclose($fp);
    chmod('testset/T'.$i.'.csv', 0766);
}

# 'personal' variable test
$fp = fopen('testset/personal.csv', 'w');

$sql = "SELECT c_bert.T8, c_joris.T8, c_petra.T8, c_sjoerd.T8
FROM tweet_test
INNER JOIN code as c_bert
ON c_bert.tweet_ind = tweet_test.ind
INNER JOIN code as c_joris
ON c_joris.tweet_ind = tweet_test.ind
INNER JOIN code as c_petra
ON c_petra.tweet_ind = tweet_test.ind
INNER JOIN code as c_sjoerd
ON c_sjoerd.tweet_ind = tweet_test.ind
where c_bert.partition='test'
and c_joris.partition='test'
and c_petra.partition='test'
and c_sjoerd.partition='test'
and c_bert.coder='bert'
and c_joris.coder='joris'
and c_petra.coder='petra'
and c_sjoerd.coder='sjoerd'
order by tweet_test.id";

$result = $db->query($sql);
$rows = $result->fetchAll();

foreach($rows as $row) {
    $fields = array();
    $fields [] = $row[0];
    $fields [] = $row[1];
    $fields [] = $row[2];
    $fields [] = $row[3];
    fputcsv($fp, $fields);
}

#header("location: testset/");
?>
