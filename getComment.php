<?php 
header("content-type:text/html; charset=utf-8");
require_once ('include/db_operator_class.php');

echo '<h3>get_CommentsByProb , problem = 1</h3>';
$commentsprob = get_CommentsByProb(1);
if($commentsprob!=null){
	foreach($commentsprob as $key=>$value){
		foreach($value as $key2=>$value2){
			printf("%s = %s ,", $key2, $value2);
		}
		echo '<br/>';
	}
}else{
	echo 'no result';
}

echo '<h3>get_CommentsByProb , week = 1,group = 1</h3>';
$commentsspring = get_CommentsByWeek(1, 1);
if($commentsspring!=null){
	foreach($commentsspring as $key=>$value){
		foreach($value as $key2=>$value2){
			printf("%s = %s ,", $key2, $value2);
		}
		echo '<br/>';
	}
}else{
	echo 'no result';
}
?>