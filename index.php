<?php
header("content-type:text/html; charset=utf-8");
include 'permission.php';
require_once('include/smarty_setup.php');
require_once 'include/db_operator_class.php';

$smarty = new Algo();

$week=$_SESSION['week'];
$team=$_SESSION['team'];

if(isset($_GET['level'])){
	$level=$_GET['level'];
	$group=$level;
	$problems = get_ProblemsOnWeek($week,$level);
}else{
	$group=$team;
	$problems = get_ProblemsOnWeek($week,$team);
}

if($problems!=null){
	for ($i= 0;$i< count($problems); $i++){
		$score = get_ScoresByProb($problems[$i]['id']);
		$commentCount = get_CommentsCountByProb($problems[$i]['id']);
		$problems[$i]['score'] = $score;
		$problems[$i]['commentCount'] = $commentCount['count(*)'];
	}
	$smarty->assign('problems',$problems);
}else{
	$smarty->assign('problems','');
}
$smarty->assign('name',$_SESSION['name']);
$smarty->assign('week',$week);
$smarty->assign('group',$group);
$smarty->assign('userid',$_SESSION['userid']);

$smarty->display('index.tpl');

?>
