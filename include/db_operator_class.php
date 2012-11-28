<?php
require_once ('config.php');

//User Operator
function get_Users() {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team FROM USER AS u WHERE u.stat=0;";
	return mydb_query_return_double_array($query);
}

function get_UserById($id) {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team FROM USER AS u WHERE u.stat=0 and u.id = $id LIMIT 1;";
	return mydb_query_return_first_item($query);
}

function get_UserByEmail($email) {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team FROM USER AS u WHERE u.stat=0 and u.mail = '$email' LIMIT 1";
	return mydb_query_return_first_item($query);
}
//End User Operator

//Problem Operator
function get_ProblemsOnWeek($week) {
	$query = "SELECT p.id,p.userID,p.pojProblemID FROM problems AS p where p.stat=0 and p.week=$week;";
	return mydb_query_return_double_array($query);
}

function get_ProblemContentById($id){
	$query = "SELECT p.id,p.userID,p.pojProblemID,p.Context FROM problems AS p where p.stat=0 and p.id=$id;";
	return mydb_query_return_first_item($query);
}

function update_ProblemContent($id,$content){
	$query = "UPDATE problems AS p SET p.Context='$content' where p.stat=0 and p.id=$id;";
	mydb_query($query);
}

function add_Problem($userId,$pojID,$content,$week){
	$query = "insert into problems(stat,userID,pojProblemID,Context,time,week) values (0,$userId,$pojID,'$content',now(),$week);";
	mydb_query($query);
}
//End Problem Operator

//Score Operator
function get_ScoresByProb($probId) {
	$query = "SELECT s.id,s.userID,s.AC FROM score AS s where s.stat=0 and s.probID=$probId order by s.AC DESC,s.ACtime;";
	return mydb_query_return_double_array($query);
}

function get_ScoreContent($id){
	$query = "SELECT s.id,s.userID,s.AC,s.code,s.language FROM score AS s where s.stat=0 and s.id=$id;";
	return mydb_query_return_first_item($query);
}

function update_Score($id,$code,$ac){
	$query = "UPDATE score AS s SET s.code='$code' , s.AC=$ac , s.lastModify=now() WHERE s.stat=0 and s.id=$id;";
	mydb_query_without_return($query);
}

function add_Score($probId,$userId,$code,$ac,$language){
	if($ac>0){
		$query = "INSERT INTO score(probID,userID,AC,stat,code,language,ACtime,lastModify) values($probId,$userId,1,0,'$code','$language',now(),now());";
		mydb_query_without_return($query);
	}else{
		$query = "INSERT INTO score(probID,userID,AC,stat,code,language,lastModify) values($probId,$userId,0,0,'$code','$language',now());";
		mydb_query_without_return($query);
	}
}
//End Score Operator

//Comment for problem operator
function get_CommentsByProb($probId) {
	$query = "SELECT c.id,c.userID,c.content,c.time FROM commentsforproblem AS c where c.stat=0 and c.probID=$probId order by c.time;";
	return mydb_query_return_double_array($query);
}

function get_CommentsCountByProb($probId){
	$query = "SELECT count(*) FROM commentsforproblem AS c where c.stat=0 and c.probID=$probId;";
	return mydb_query_return_first_item($query);
}

function update_CommentInProb($id,$content){
	$query = "UPDATE commentsforproblem AS c SET c.content='$content' , c.lastModify=now() WHERE c.stat=0 and c.id=$id;";
	mydb_query_without_return($query);
}

function add_CommentInProb($probId,$userId,$content){
	$query = "INSERT INTO commentsforproblem(stat,probID,userID,content,time,lastModify) values(0,$probId,$userId,'$content',now(),now());";
	mydb_query_without_return($query);
}

//End Comment for problem operator

//Comment for spring operator
function get_CommentsByWeek($week,$team) {
	$query = "SELECT c.id,c.userID,c.content,c.time FROM commentsforspring AS c where c.stat=0 and c.week=$week and c.team=$team order by c.time;";
	return mydb_query_return_double_array($query);
}

function get_CommentsCountByWeek($week,$team){
	$query = "SELECT count(*) FROM commentsforspring AS c where c.stat=0 and c.week=$week and c.team=$team;";
	return mydb_query_return_first_item($query);
}

function update_CommentInSpring($id,$content){
	$query = "UPDATE commentsforspring AS c SET c.content='$content' , c.lastModify=now() WHERE c.stat=0 and c.id=$id;";
	mydb_query_without_return($query);
}

function add_CommentInSpring($week,$team,$userId,$content){
	$query = "INSERT INTO commentsforspring(stat,userID,content,week,time,team,lastModify) values(0,$userId,'$content',$week,now(),$team,now());";
	mydb_query_without_return($query);
}
//End Comment for spring operator
?>