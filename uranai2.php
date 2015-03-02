<?php

require_once 'functions.php';

// 結果配列を用意する
$uranai[1] = "大吉です。おめでとうございます☆";
$uranai[2] = "大吉です。臨時収入があるかもしれません";
$uranai[3] = "大吉です。今日は楽しく過ごせるでしょう♬";
$uranai[4] = "中吉です。街に出掛けると良いことがあるでしょう。";
$uranai[5] = "小吉です。今日はまったり過ごしてみては";
$uranai[6] = "末吉です。PHPの勉強をするといいことがあるでしょう。";
$uranai[7] = "大凶です。今日は自宅でゆっくり過ごしてください。";
// mt_rand()関数の結果を$key変数に記憶
$key = mt_rand(1,7);

function show_form() {
?>
	<form action="" method="post">
		<p id="uranai_form">Name : <input type="text" name="name">
		<input type="submit" name="submit" value="占う"></p>
	</form>
<?php
}

function result() {

	global $uranai, $key;

	if (isset($_POST['submit'])) {
		if ($_POST['name'] == '') {
			print 'あなたの今日の運勢は' . h($uranai[$key]) . '<br />';
		} else {
			print h($_POST['name']) . 'さんの今日の運勢は' . h($uranai[$key]) . '<br />';
		}
?>
<p><button onclick="location.reload()">もう一度</button></p>
<?php
	}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>おみくじ</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
 <div>
	<p id="uranai">今日の運勢</p>
<?php

	if (!isset($_POST['submit'])) {
		show_form();
	} else {
?>
		<div id="uranai_result">
<?php
		result();
?>
</div>
<?php
	}

?>

<!--<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">もう一度</a>-->
	</div>
</body>
</html>
