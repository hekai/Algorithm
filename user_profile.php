<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>User Profile</title>
</head>
<body>
	<form method="post" action="upload.php" enctype="multipart/form-data">
		<input TYPE="hidden" name="MAX_FILE_SIZE" value="1000000"/> <br /> 
		File to upload/store in database: 
		<input type="file" name="form_data" size="40"/>
		<p>
		<input type="submit" name="submit" value="submit"/>
	</form>
</body>
</html>
