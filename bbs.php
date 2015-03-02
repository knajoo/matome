<?php

require_once 'common.php';

?>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title>掲示板</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div>
			<p id="bbs_head">一言どうぞ</p>
			<form action="write.php" method="post">
				名前<br />
				<input type="text" name="name" value="" size="24"><br />
				コメント<br />
				<textarea name="comment" cols="40" rows="3"></textarea><br />
				<input type="submit" name="submit" value="書き込み"><br />
			</form>
		</div>
<?php
		$records = bbs_read();

		foreach ($records as $key => $record) {
?>
		<div class="content">
			<span class="id"><?php print h($key + 1); ?></span>
			<span class="name">名前 : <?php print h($record['name']); ?></span>
			<span class="time"><?php print date('Y年m月d日H時i分s秒', intval($record['time'])); ?></span>
			<p class="comment"><?php print nl2br(h($record['comment'])); ?></p>
		</div>
	<?php
		}
	?>
</body>
</html>
