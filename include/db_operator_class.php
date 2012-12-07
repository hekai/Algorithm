<?php
require_once ('config.php');

function mydb_query_without_return($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
	mysql_query($query);
	$insert_id = mysql_insert_id();
	mysql_close($connection);
	return $insert_id;
}

function mydb_query_return_double_array($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array=array();
	while($tmp = mysql_fetch_array($result,MYSQL_ASSOC)){
		$result_array[] = $tmp;
	}
	mysql_close($connection);
	return $result_array;
}

function mydb_query_return_first_item($query){
	$connection =  mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	if(!$connection){
		die("Could not connect to the database:<br/>".mysql_error());
	}
	$db_select = mysql_select_db(DB_NAME);
	if(!$db_select){
		die("Could not select the database:<br/>".mysql_error());
	}
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET time_zone = '+8:00'");
	$result = mysql_query($query);
	if(!$result){
		die("Could not query the database:<br/>".mysql_error());
	}
	$result_array = mysql_fetch_array($result,MYSQL_ASSOC);
	mysql_close($connection);
	return $result_array;
}

//User Operator
function get_Users() {
	$query = "SELECT * FROM user AS u WHERE u.stat=0;";
	return mydb_query_return_double_array($query);
}

function get_UserById($id) {
	$query = "SELECT * FROM user AS u WHERE u.stat=0 and u.id = $id LIMIT 1;";
	return mydb_query_return_first_item($query);
}

function get_UserByEmail($email) {
	if (!get_magic_quotes_gpc()){
		$email = addslashes($email);
	}
	$query = "SELECT * FROM user AS u WHERE u.stat=0 and u.mail = '$email' LIMIT 1";
	return mydb_query_return_first_item($query);
}

function get_UserByUid($uid) {
	$query = "SELECT * FROM user AS u WHERE u.stat=0 and u.uid = $uid LIMIT 1";
	return mydb_query_return_first_item($query);
}

function add_User($uid,$name,$sex,$nickname,$pojusername,$email,$team){
	if (!get_magic_quotes_gpc()){
		$name = addslashes($name);
		$nickname = addslashes($nickname);
		$pojusername = addslashes($pojusername);
		$email = addslashes($email);
	}
	$query = "insert into user(uid,stat,sex,name,nickname,POJ_user_name,mail,type,team) values($uid,0,'$sex','$name','$nickname','$pojusername','$email',2,$team);";
	return mydb_query_without_return($query);
}

function update_User($id,$name,$sex,$nickname,$pojusername,$email,$team){
	if (!get_magic_quotes_gpc()){
		$name = addslashes($name);
		$nickname = addslashes($nickname);
		$pojusername = addslashes($pojusername);
		$email = addslashes($email);
	}
	$query = "update user as u set u.name='$name' , u.sex = '$sex' , u.nickname='$nickname',u.POJ_user_name='$pojusername',u.mail='$email',u.team=$team where u.id=$id";
	mydb_query_without_return($query);
}

//End User Operator

//Problem Operator
function get_ProblemsOnWeek($week,$level) {
	$query = "SELECT p.id,p.userID,u.name,u.nickname,u.photoPath,p.pojProblemID,p.title,p.time,p.source FROM problems AS p,user AS u where p.stat=0 and p.week=$week and p.level=$level and p.userID = u.id and u.stat = 0 order by p.time;";
	return mydb_query_return_double_array($query);
}

function get_ProblemContentById($id){
	$query = "SELECT p.id,p.userID,u.name,u.nickname,u.photoPath,p.pojProblemID,p.title,p.Context,p.time,p.source FROM problems AS p,user AS u where p.stat=0 and p.id=$id and u.stat=0 and p.userID=u.id;";
	return mydb_query_return_first_item($query);
}

function get_ProblemSimpleById($id){
	$query = "SELECT p.id,p.userID,u.name,u.nickname,u.photoPath,p.pojProblemID,p.title,p.time,p.source FROM problems AS p,user AS u where p.stat=0 and p.id=$id and u.stat=0 and p.userID=u.id;";
	return mydb_query_return_first_item($query);
}

function update_ProblemContent($id,$pojID,$title,$content,$source){
	if (!get_magic_quotes_gpc()){
		$title = addslashes($title);
		$content = addslashes($content);
		$source = addslashes($source);
	}
	$query = "UPDATE problems AS p SET p.pojProblemID = $pojID , p.title = '$title' , p.Context='$content' , p.source = '$source' where p.stat=0 and p.id=$id;";
	mydb_query_without_return($query);
}

function add_Problem($userId,$pojID,$title,$content,$week,$source,$level){
	if (!get_magic_quotes_gpc()){
		$title = addslashes($title);
		$content = addslashes($content);
		$source = addslashes($source);
	}
	$query = "insert into problems(stat,userID,pojProblemID,title,Context,time,week,source,level) values (0,$userId,$pojID,'$title','$content',now(),$week,'$source',$level);";
	return mydb_query_without_return($query);
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
	if (!get_magic_quotes_gpc()){
		$code = addslashes($code);
	}
	$query = "UPDATE score AS s SET s.code='$code' , s.AC=$ac , s.lastModify=now() , s.language = '$language' WHERE s.stat=0 and s.id=$id;";
	mydb_query_without_return($query);
}

function add_Score($probId,$userId,$code,$ac,$language){
	if (!get_magic_quotes_gpc()){
		$code = addslashes($code);
	}
	if($ac>0){
		$query = "INSERT INTO score(probID,userID,AC,stat,code,language,ACtime,lastModify) values($probId,$userId,1,0,'$code','$language',now(),now());";
		return mydb_query_without_return($query);
	}else{
		$query = "INSERT INTO score(probID,userID,AC,stat,code,language,lastModify) values($probId,$userId,0,0,'$code','$language',now());";
		return mydb_query_without_return($query);
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
	if (!get_magic_quotes_gpc()){
		$content = addslashes($content);
	}
	$query = "UPDATE commentsforproblem AS c SET c.content='$content' , c.lastModify=now() WHERE c.stat=0 and c.id=$id;";
	mydb_query_without_return($query);
}

function add_CommentInProb($probId,$userId,$content){
	if (!get_magic_quotes_gpc()){
		$content = addslashes($content);
	}
	$query = "INSERT INTO commentsforproblem(stat,probID,userID,content,time,lastModify) values(0,$probId,$userId,'$content',now(),now());";
	return mydb_query_without_return($query);
}

//End Comment for problem operator

//Comment for spring operator
function get_CommentsByWeek($week,$team) {
	$query = "SELECT c.id,c.userID,c.content,c.time, u.nickname, u.photoPath FROM commentsforspring AS c,user AS u where c.stat=0 and c.week=$week and c.team=$team AND c.userID=u.id AND u.stat=0  order by c.time;";
	return mydb_query_return_double_array($query);
}

function get_CommentsCountByWeek($week,$team){
	$query = "SELECT count(*) FROM commentsforspring AS c where c.stat=0 and c.week=$week and c.team=$team;";
	return mydb_query_return_first_item($query);
}

function update_CommentInSpring($id,$content){
	if (!get_magic_quotes_gpc()){
		$content = addslashes($content);
	}
	$query = "UPDATE commentsforspring AS c SET c.content='$content' , c.lastModify=now() WHERE c.stat=0 and c.id=$id;";
	mydb_query_without_return($query);
}

function add_CommentInSpring($week,$team,$userId,$content){
	if (!get_magic_quotes_gpc()){
		$content = addslashes($content);
	}
	$query = "INSERT INTO commentsforspring(stat,userID,content,week,time,team,lastModify) values(0,$userId,'$content',$week,now(),$team,now());";
	return mydb_query_without_return($query);
}
//End Comment for spring operator

//Rank
function getRandOnWeek($week,$team){
	$query = "SELECT s.userID,s.probID,u.name,u.nickname,u.photoPath,count(distinct s.probID) 'count' FROM score AS s,user AS u where s.stat=0 and s.userID=u.id and u.team=$team and s.ac=1 AND s.probID IN (SELECT id FROM problems AS p WHERE p.stat=0 AND p.week=$week AND p.level=$team) group by s.userID order by count(distinct s.probID) desc;";
	return mydb_query_return_double_array($query);
}

function getWorstOnWeek($week,$team){
	$query = "select u.id,u.name,u.nickname,u.photoPath,t.count from user as u left join (select s.userID,count(distinct s.probID) as count from score as s,problems as p where s.probID=p.id and s.AC=1 and p.week=$week and p.level=$team and s.stat=0 and p.stat=0 group by s.userID) t on t.userID=u.id and u.stat=0 and t.count=0 order by t.count limit 1";
	return mydb_query_return_first_item($query);
}
//End Rank

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
