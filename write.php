<?php require_once 'common.php';

// フォームが送信された場合、入力内容をチェックして書き込みを行う
if (isset($_POST['submit'])) {
	if (!isset($_POST['name'])) {
		$errors['name'] = '名前が入力されていません。';
	} else if (mb_strlen($_POST['name']) == 0) {
		$errors['name'] = '名前が入力されていません。';
	} else if (mb_strlen($_POST['name'] > 20)) {
		$errors['name'] = '名前は２０文字以下で入力してください。';
	}
	if (!isset($_POST['comment'])) {
		$errors['comment'] = 'コメントが入力されていません。';
	} else if (mb_strlen($_POST['comment']) == 0) {
		$errors['comment'] = 'コメントが入力されていません。';
	}
	} else {
	$errors['submit'] = 'フォームが正しく送信されていません。';
}

// エラーがなければ書き込み処理に進む
if (count($errors) == 0) {
	$result = bbs_write($_POST);
	if (!$result) {
		$errors['result'] = '書き込みに失敗しました。';
	}
}

// エラーがなければindex.phpに戻す
if (count($errors) == 0) {
	header('Location: bbs.php');
}

// 以下エラーが発生した場合のHTMLページ
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ナジョー板 - 投稿エラー</title>
	<style>
		ul.error {color: red;}
	</style>
</head>
<body>
	<h1>ナジョー板 - 投稿エラー</h1>
	<h2>以下のエラーが発生しました。</h2>
	<ul class='error'><?php
		foreach ($errors as $error) {
			?>
			<li><?php print $error; ?></li>
		<?PHP
		}
?>
	</ul>
<a href="bbs.php">ナジョー板に戻る</a>
</body>
</html>
