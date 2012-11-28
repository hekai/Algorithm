<?php 
header("content-type:text/html; charset=utf-8");
require_once ('include/db_operator_class.php');

echo '<h3>get_ScoresByProb , problem = 1</h3>';
$scoreprob = get_ScoresByProb(1);
if($scoreprob!=null){
	foreach($scoreprob as $key=>$value){
		foreach($value as $key2=>$value2){
			printf("%s = %s ,", $key2, $value2);
		}
		echo '<br/>';
	}
}else{
	echo 'no result';
}

echo '<h3>get_ScoreContent , id = 1</h3>';
$score1 = get_ScoreContent(1);
if($score1!=null){
	foreach($score1 as $keyu1=>$valueu1){
		printf("%s = %s ,", $keyu1, $valueu1);
	}
	echo '<br/>';
}else{
	echo 'no result';
}
?>