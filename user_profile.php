<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Profile</title>
</head>
<body>
	Please upload your information to the server.<br/>
	<?php 
		if(isset($_GET['type'])){
			$type=$_GET['type'];
		}
		if($type=='update'){
			$uid=$_SESSION['uid'];
			$photoPath=$_SESSION['photoPath'];
			$nickname=$_SESSION['nickname'];
			$name=$_SESSION['name'];
			$sex=$_SESSION['sex'];
			$email=$_SESSION['email'];
			$pojname=$_SESSION['pojname'];
			$team=$_SESSION['team'];
		}else{
			if(isset($_GET['uid']))
				$uid=$_GET['uid'];
			else
				$uid='';
			$photoPath='';
			if(isset($_GET['name']))
				$nickname=$_GET['name'];
			else
				$nickname='';
			$name=$nickname;
			$sex='';
			if(isset($_GET['email']))
				$email=$_GET['email'];
			else
				$email='';
			$pojname='';
			$team='';
		}
	?>
	<form method="post" action="upload.php" enctype="multipart/form-data">
		<input TYPE="hidden" name="MAX_FILE_SIZE" value="1000000"/> <br /> 		
		<table border="1">
			<tr>
				<td>Weibo UID</td>
				<td><input type="text" value="<?php echo $uid;?>" disabled="disabled"/><br/>
					<input type="hidden" name="uid" value="<?php echo $uid;?>" />
				</td>
			</tr>
			<tr>
				<td>Photo: </td>
				<td><input type="file" name="form_data" size="40"/><?php echo '<img src="'.$photoPath.'" height=128 weight=128/>';?>
				<br/></td>
			</tr>
			<tr>
				<td>NickName</td>
				<td><input TYPE="text" name="nickname" value="<?php echo $nickname;?>"/></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input TYPE="text" name="name" value="<?php echo $name;?>"/></td>
			</tr>
			<tr>
				<td>Sex</td>
				<td>
					<select name="sex"">
						<option value="boy" <?php if($type=='update' && $sex=='boy'){echo 'selected="selected"';}?>>boy</option>
						<option value="girl" <?php if($type=='update' && $sex=='girl'){echo 'selected="selected"';}?>>girl</option>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input TYPE="text" name="email" value="<?php echo $email;?>
					"/></td>
			</tr>
			<tr>
				<td>POJ username</td>
				<td><input TYPE="text" name="poj_username" value="<?php echo $pojname;?>"/></td>
			</tr>
			<tr>
				<td>Group</td>
				<td>
					<select name="group">
						<option value="1" <?php if($type=='update' && $team==2){echo 'selected="selected"';}?>>1</option>
						<option value="2" <?php if($type=='update' && $team==2){echo 'selected="selected"';}?>>2</option>
					</select> 
				</td>
			</tr>
		</table>
		<input type="submit" name="upload" value="<?php echo $type;?>"/>
	</form>
</body>
</html>
