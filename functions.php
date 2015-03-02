<?php

function bmi($height, $mass) {
	$height = $height / 100;
	$mass = $mass / ($height * $height);
	return $mass;
}

function h($str) {
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}


