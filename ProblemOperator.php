<?php
include 'permission.php';
require_once ('include/db_operator_class.php');
$title = $_POST['title'];
$pojID = $_POST['pojID'];
$content = $_POST['content'];
$source = $_POST['source'];

if(isset($_POST['insert'])){
	$userID = $_POST['userID'];
	$week = $_POST['week'];
	$level = $_POST['level'];
	$insert_id = add_Problem($userID, $pojID, $title, $content, $week, $source,$level);
	if($insert_id!=null){
		if($insert_id>0){
			$problems = get_ProblemSimpleById($insert_id);
			$score = get_ScoresByProb($problems['id']);
			$commentCount = get_CommentsCountByProb($problems['id']);
			$problems['score'] = $score;
			$problems['commentCount'] = $commentCount['count(*)'];
			$problems['success']='success';
			echo json_encode($problems);
		}else{
			$problems=array();
			$problems['success']='failure';
		}
	}
}else if(isset($_POST['update'])){
	$probID = $_POST['probID'];
	update_ProblemContent($probID,$pojID, $title, $content, $source);
}
?>