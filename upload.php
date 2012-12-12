<?php
// include 'permission.php';
session_start();
require_once 'include/db_operator_class.php';

	$form_data_name = $_FILES['form_data']['name'];
	$form_data_size = $_FILES['form_data']['size'];
	$form_data_type = $_FILES['form_data']['type'];
	$form_data = $_FILES['form_data']['tmp_name'];
	$form_error = $_FILES['form_data']['error'];
	
	$uid=$_POST['uid'];
	$name=$_POST['name'];
	$sex=$_POST['sex'];
	$nickname=$_POST['nickname'];
	$email=$_POST['email'];
	$pojusername=$_POST['poj_username'];
	$group=$_POST['group'];
	
	$upload=$_POST['upload'];
	
	if($name==null|| $nickname==null|| $email==null|| $pojusername==null){
		echo 'something is null!!! check again!!!';
		exit;
	}
	if($uid==null || $uid==''){
		$uid=1024;//add google user
	}
	
	if($upload=='update'){
		$userID = $_SESSION['userid'];
	}else if($upload=='insert'){
		if($uid!=1024){
			$tmpResult=get_UserByUid($uid);
		}else{
			$tmpResult=get_UserByEmail($email);
		}
		if($tmpResult!=null && count($tmpResult)>0){
			echo 'Exist user. Please login directly.';
			exit;
		}
	}
	
	if($upload=='insert')
		$userID = add_User($uid, $name, $sex, $nickname, $pojusername, $email, $group);
	else if($upload=='update'){
		update_User($userID, $name, $sex, $nickname, $pojusername, $email, $group);
	}
		
	if($userID<=0){
		echo 'insert error.';
		exit;
	}
	
	if($form_data==null){
		if($upload=='insert'){
			echo 'you did not upload the image file.';
			exit;
		}else if($upload=='update'){
			header("Location: sinaredirect.php?uid=".$uid);
			exit;
		}
	}
// 	echo $form_data_name . ' - ' . $form_data_size . ' - ' . $form_data_type . ' - ' . $form_data;
	
	if($form_error > 0){
		echo '!problem:';
		switch($form_error)
		{
			case 1: echo '文件大小超过服务器限制';
			break;
			case 2: echo '文件太大！';
			break;
			case 3: echo '文件只加载了一部分！';
			break;
			case 4: echo '文件加载失败！';
			break;
		}
	
		exit;
	}
	if($form_data_size > 1000000){
		echo '文件过大！';
		exit;
	}
	if($form_data_type!='image/jpeg' && $form_data_type!='image/gif'
			&& $form_data_type!='image/png'){
		echo '文件不是JPG,GIF,PNG图片！';
		exit;
	}
	
	if($form_data_type == 'image/jpeg'){
		$type = '.jpg';
	}
	if($form_data_type == 'image/gif'){
		$type = '.gif';
	}
	if($form_data_type == 'image/png'){
		$type = '.png';
	}
	$upfilePath = 'upload/';
	
	$upfile = $upfilePath . $userID  . $type;
	if(is_uploaded_file($form_data)){
		if(!move_uploaded_file($form_data, $upfile)){
			echo '移动文件失败！';
			exit;
		}
	}else{
		echo 'problem!';
		exit;
	}

// 	$fp      = fopen($form_data, 'r');
// 	$content = fread($fp, filesize($form_data));
// 	$content = addslashes($content);
// 	fclose($fp);
	
// 	$data = addslashes(fread(fopen($form_data, "r"), filesize($form_data)));
	 
// 	$query="UPDATE user SET photo = '$content' , photoType = '$form_data_type' WHERE id = 1 ;";
	$query="UPDATE user SET photoPath = '$upfile' , photoType = '$form_data_type' WHERE id = $userID;";
	mydb_query_without_return($query);
	
	header("Location: sinaredirect.php?uid=".$uid);

?>