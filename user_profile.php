<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Profile</title>
</head>
<body>
	Please upload your information to the server.<br/>
	<form method="post" action="upload.php" enctype="multipart/form-data">
		<input TYPE="hidden" name="MAX_FILE_SIZE" value="1000000"/> <br /> 		
		<table border="1">
			<tr>
				<td>Weibo UID</td>
				<td><input type="text" name="uid" value="<?php echo $_GET['uid']?>"/><br/></td>
			</tr>
			<tr>
				<td>Photo: </td>
				<td><input type="file" name="form_data" size="40"/><br/></td>
			</tr>
			<tr>
				<td>NickName</td>
				<td><input TYPE="text" name="nickname" value="<?php echo $_GET['name']?>"/></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><input TYPE="text" name="name" value="<?php echo $_GET['name']?>"/></td>
			</tr>
			<tr>
				<td>Sex</td>
				<td>
					<select name="sex">
						<option value="boy">boy</option>
						<option value="girl">girl</option>
					</select> 
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input TYPE="text" name="email" /></td>
			</tr>
			<tr>
				<td>POJ username</td>
				<td><input TYPE="text" name="poj_username" /></td>
			</tr>
			<tr>
				<td>Group</td>
				<td>
					<select name="group">
						<option value="1">1</option>
						<option value="2">2</option>
					</select> 
				</td>
			</tr>
		</table>
		<input type="submit" name="upload" value="submit"/>
	</form>
</body>
</html>
