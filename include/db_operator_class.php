<?php
require_once ('config.php');

//User Operator
function get_Users() {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team,u.photoPath FROM USER AS u WHERE u.stat=0;";
	return mydb_query_return_double_array($query);
}

function get_UserById($id) {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team,u.photoPath FROM USER AS u WHERE u.stat=0 and u.id = $id LIMIT 1;";
	return mydb_query_return_first_item($query);
}

function get_UserByEmail($email) {
	$query = "SELECT u.id,u.name,u.nickname,u.POJ_user_name,u.type,u.team,u.photoPath FROM USER AS u WHERE u.stat=0 and u.mail = '$email' LIMIT 1";
	return mydb_query_return_first_item($query);
}

function get_UserByUid($uid) {
	$query = "SELECT u.id,u.uid,u.name,u.nickname,u.POJ_user_name,u.type,u.team,u.photoPath FROM USER AS u WHERE u.stat=0 and u.uid = $uid LIMIT 1";
	return mydb_query_return_first_item($query);
}

//End User Operator

//Problem Operator
function get_ProblemsOnWeek($week) {
	$query = "SELECT p.id,p.userID,u.name,u.nickname,u.photoPath,p.pojProblemID,p.title,p.time,p.source FROM problems AS p,user AS u where p.stat=0 and p.week=$week and p.userID = u.id and u.stat = 0 order by p.time;";
	return mydb_query_return_double_array($query);
}

function get_ProblemContentById($id){
	$query = "SELECT p.id,p.userID,u.name,u.nickname,u.photoPath,p.pojProblemID,p.title,p.Context,p.time,p.source FROM problems AS p,user AS u where p.stat=0 and p.id=$id and u.stat=0 and p.userID=u.id;";
	return mydb_query_return_first_item($query);
}

function update_ProblemContent($id,$pojID,$title,$content,$source){
	$query = "UPDATE problems AS p SET p.pojProblemID = $pojID , p.title = '$title' , p.Context='$content' , p.source = '$source' where p.stat=0 and p.id=$id;";
	mydb_query_without_return($query);
}

function add_Problem($userId,$pojID,$title,$content,$week,$source){
	$query = "insert into problems(stat,userID,pojProblemID,title,Context,time,week,source) values (0,$userId,$pojID,'$title','$content',now(),$week,'$source');";
	mydb_query_without_return($query);
}
//End Problem Operator

//Score Operator
function get_ScoresByWeek($week){
	$query = "SELECT s.id,s.userID,u.name,u.nickname,u.photoPath,s.AC,s.ACtime,s.lastModify FROM score AS s, user AS u WHERE s.stat=0 AND u.stat = 0 AND s.userID = u.id AND s.probID IN (SELECT id FROM problems AS p WHERE p.stat=0 AND p.week=$week) ORDER BY s.probID;";
	return mydb_query_return_double_array($query);
}

function get_ScoresByProb($probId) {
	$query = "SELECT s.id,s.userID,u.name,u.nickname,u.photoPath,s.AC,s.ACtime,s.lastModify FROM score AS s, user AS u where s.stat=0 and s.probID=$probId AND u.stat = 0 AND s.userID = u.id GROUP BY s.userID order by s.AC DESC,s.ACtime;";
	return mydb_query_return_double_array($query);
}

function get_ScoreContent($id){
	$query = "SELECT s.id,p.title,s.userID,u.name,u.nickname,u.photoPath,s.AC,s.code,s.language,s.ACtime,s.lastModify FROM score AS s, user AS u, problems AS p where s.stat=0 and s.id=$id AND u.stat = 0 AND s.userID = u.id AND p.stat=0 AND p.id = s.probID;";
	return mydb_query_return_first_item($query);
}

function update_Score($id,$code,$ac,$language){
	$query = "UPDATE score AS s SET s.code='$code' , s.AC=$ac , s.lastModify=now() , s.language = '$language' WHERE s.stat=0 and s.id=$id;";
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
	$query = "SELECT c.id,c.userID,u.name,u.nickname,u.photoPath,c.content,c.time FROM commentsforproblem AS c,user AS u where c.stat=0 and c.probID=$probId AND c.userID=u.id AND u.stat=0 order by c.time;";
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

//urlencode
function my_urlencode_double($array){
	for ($i=0;$i<count($array);$i++){
		foreach ($array[$i] as $key=>$value){
			$array[$i][$key]=urlencode($value);
		}
	}
	return $array;
}

function my_urlencode_single($array){
	foreach ($array as $key=>$value){
		$array[$key]=urlencode($value);
	}
	return $array;
}
//End urlencode 

//login

//End login

?>