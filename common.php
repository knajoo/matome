<?php

mb_internal_encoding("UTF-8");

mb_language("ja");

setlocale(LC_ALL, "js_JP.UTF-8");

$bbs_file = "bbs.csv";

function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

// 掲示板のデータをファイルに書き込む
function bbs_write($data) {
	global $bbs_file;

	$handle = fopen($bbs_file, "a");
	// コメントの改行コードを統一する
	$data["comment"] = str_replace(array("\r\n", "\n", "\r"), PHP_EOL, $data["comment"]);

	// 書き込みたいデータを配列にまとめる
	$csv[] = $data["name"];
	$csv[] = $data["comment"];
	$csv[] = time();

	// ファイルに書き込みを行う
	$result = fputcsv($handle, $csv);

	fclose($handle);

	return $result;
}

// 掲示板のデータをファイルから読み込む
function bbs_read() {
	global $bbs_file;

	$handle = fopen($bbs_file, "r");
	// 開いたポインタからデータを一行ずつ取得して配列に格納
	while ($csv = fgetcsv($handle)) {
		var_dump($csv);
		$record["name"] = $csv[0];
		$record["comment"] = $csv[1];
		$record["time"] = $csv[2];
		$records[] = $record;
	}
	fclose($handle);

	return $records;
}
