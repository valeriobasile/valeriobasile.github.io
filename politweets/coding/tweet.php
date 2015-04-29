<?
$TEST = false;

require_once("header.php");
require_once("usernamehash.php");

# open SQLite database from tab-separated data
try{
    $db = new PDO('sqlite:db/politweets.sqlite3');
}
catch(PDOException $e) {
    echo $e->getMessage();
}


if (isset($_GET['coder'])){
    $coder = $_GET['coder'];
}
elseif (isset($_POST['action'])){
    $coder = $_POST['coder'];
    $tweet_ind = $_POST['tweet_ind'];
}
else {
    echo "no coder<br />";
    echo "<a href='login.php'>login</a>";
    die();
}

# get list of parties for the coder
$sql = "SELECT party FROM coderparty where coder = '".$coder."'";
$result = $db->query($sql);
$rows = $result->fetch();
$party = $rows["party"];

# save
if (isset($_POST['action'])){
    if ($_POST['action'] == "next"){
        include("save.php");
    }
    elseif ($_POST['action'] == "undo"){
        include("undo.php");
    }
}


# last code
if ($TEST) {
    $sql = "SELECT count(*) AS c FROM last_code_test where coder = '".$coder."'";
}
else {
    $sql = "SELECT count(*) AS c FROM last_code where coder = '".$coder."'";
}
$result = $db->query($sql);
$rows = $result->fetch();
$row_count = $rows["c"];

# if it's the first time, create a record for the coder in last_code
if ($row_count == 0) {
    if ($TEST) {
        $sql = "INSERT INTO last_code_test (coder, tweet_ind) VALUES (?, -1)";
        try {
            $query = $db->prepare($sql);
            $query->bindParam(1,$coder);
            $res = $query->execute(array($coder));
        }
        catch(PDOException $e) {
            echo"error: ";
            echo $e->getMessage();
        }
    }
    else {
        $sql = "INSERT INTO last_code (coder, tweet_ind, party) VALUES (?, -1, ?)";
        try {
            $query = $db->prepare($sql);
            $query->bindParam(1,$coder);
            $query->bindParam(2,$party);
            $res = $query->execute(array($coder));
        }
        catch(PDOException $e) {
            echo"error: ";
            echo $e->getMessage();
        }
    }
    $next = 0;
}
else {
    if ($TEST) {
        $sql = "SELECT * FROM last_code_test where coder = '".$coder."'";
        
        $result = $db->query($sql);
        $rows = $result->fetch();
        $next = $rows["tweet_ind"]+1;
    }
    else {
        $sql = "SELECT * FROM last_code where coder = '".$coder."'";
        $result = $db->query($sql);
        $rows = $result->fetch();
        $next = $rows["tweet_ind"]+1;
    }
}

if ($TEST) {
    # show next tweet to code
    $sql = "SELECT * FROM tweet_test
            WHERE ind = ".$next.";";

    $result = $db->query($sql);
    $tweet = $result->fetch();
    $tweet_id = $tweet["id"];
    $timestamp = $tweet["timestamp"];
    $date = date("Y-m-d H:i:s", $timestamp);
    $user = $tweet["user"];
    $message = $tweet["message"];
}
else {
    $sql = "SELECT * FROM tweet
            WHERE ind = ".$next." AND party = '".$party."'";
    
    $result = $db->query($sql);
    $tweet = $result->fetch();
    $tweet_id = $tweet["id"];
    $timestamp = $tweet["timestamp"];
    $date = date("Y-m-d H:i:s", $timestamp);
    $user = $tweet["user"];
    $message = $tweet["message"];

}
?>
<a href="login.php">login</a>
<a href="info.php" target="_BLANK"><strong>info</strong></a>
<div id="tweet" class="tweet" style="background-color: <?=username_color($user)?>">
<blockquote class="twitter-tweet"><p><?=$message?></p>&mdash;<?=$user?>
<a href="https://twitter.com/<?=$user?>/status/<?=$tweet_id?>"><?=$date?></a>
</blockquote>
<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<a href="https://twitter.com/<?=$user?>/status/<?=$tweet_id?>" target="_blank">
view conversation</a>
</div>

<form id="tweet_form" action="tweet.php" method="POST">
<input type="hidden" name="tweet_ind" value="<?=$next?>" />
<input type="hidden" name="coder" value="<?=$coder?>" />
<input type="hidden" name="action" id="action" />
<?
include("variables.php");
?>
<div id="buttons">
<input id="undo" type="button" value="UNDO" onclick="document.getElementById('action').value='undo'; document.forms['tweet_form'].submit();"/>
<input id="next" type="button" value="NEXT" onclick="document.getElementById('action').value='next'; check_complete();"/>
</div>
</form>
<?
require_once("footer.php");
?>

