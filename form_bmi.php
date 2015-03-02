<?php

require_once 'functions.php';

function show_form($errors = '') {

	if (is_array($errors)) {
		$error_text = '<ul><li>';
		$error_text .= implode('</li><li>', $errors);
		$error_text .= '</li></ul>';
	}else{
		// エラーがないならば$error_textはブランク
		$error_text = '';
	}

?>

<div>
	<p id="bmi_form">BMIを計算します。</p>
	<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
<?php print $error_text ?>
	   <p id ="form">身  長  : <input type="text" name="height">
		 体  重  : <input type="text" name="mass">
		<input type="submit" name="submit" value="送信"</p>
		</form>
</div>
<?php
} // show_form終わり

function validate_form() {

	$errors = array();

	if ($_POST['height'] == '') {
		$errors[] = '身長を入力してください。';
	}

	// 入力された値が数値か正規表現で調べる。
	if (($_POST['height'] !== '') && (!is_numeric($_POST['height']))) {
		$errors[] = '身長は数値で入力してください。';
	}

	if ($_POST['mass'] == '') {
		$errors[] = '体重を入力してください。';
	}

	if (($_POST['mass'] !== '') && (!preg_match("/^[1-9]\d*$/",$_POST['mass']))) {
		$errors[] = '体重は数値で入力してください。';
	}


	return $errors;
}

function process_form() {

		$bmi = bmi($_POST['height'], $_POST['mass']);

		if ($bmi < 18.5) {
?>
<div class="result">
	<p>あなたのBMI値は<?php print h($bmi); ?>です。<br />
		もう少しお肉をつけてもいいかも？</p><br />
</div>
<?php
		} else if ($bmi > 25) {
?>
<div class="result">
	<p>あなたのBMI値は<?php print h($bmi); ?>です。<br />
	ダイエットが必要ですな。</p><br />
</div>
<?php
		} else {
?>
	<div class="result">
	<p>あなたのBMI値は<?php print h($bmi); ?>です。<br />
		普通の上等です。</p><br />
</div>
<?php

		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BMIを計算します</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<div>
<?php

if (isset($_POST['submit'])) {
	// validate_form()がエラーを返したら、それをshow_form()へ返す
	if ($form_errors = validate_form()) {
		show_form($form_errors);
	}else{
		// サブミットされた値が妥当であれば、それを処理
		process_form();
	}
}else{
	// フォームがサブミットされなければ、表示
	show_form();
}

?>
	</div>
</body>
</html>
