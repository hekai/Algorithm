<?php 
header("content-type:text/html; charset=utf-8");
require_once ('include/db_operator_class.php');

// echo '<h3>add_Problem </h3>';
// add_Problem(1, 1000, 'Hello add_Problem', 1);

echo '<h3>get_ProblemsOnWeek , week = 1</h3>';
$problems = get_ProblemsOnWeek(1);
if($problems!=null){
	foreach($problems as $key=>$value){
		foreach($value as $key2=>$value2){
			printf("%s = %s ,", $key2, $value2);
		}
		echo '<br/>';
	}
}else{
	echo 'no result';
}

echo '<h3>get_ProblemContentById , id = 1</h3>';
$problem1 = get_ProblemContentById(1);
if($problem1!=null){
	foreach($problem1 as $keyu1=>$valueu1){
		printf("%s = %s ,", $keyu1, $valueu1);
	}
	echo '<br/>';
}else{
	echo 'no result';
}

?>