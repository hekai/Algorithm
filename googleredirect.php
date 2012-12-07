<?php
session_start();
require_once 'include/openid.php';
require_once 'include/db_operator_class.php';
try {
	$openid = new LightOpenID('hacklu.com/Algorithm');
	if(!$openid->mode) {
		if(isset($_GET['login'])) {
			$openid->identity = 'https://www.google.com/accounts/o8/id';
			$openid->required = array('contact/email');
			header('Location: ' . $openid->authUrl());
		}
		?>
<a href="<?php echo $_SERVER['PHP_SELF'] . "?login"?>">Login with Google</a>
<?php
	} elseif($openid->mode == 'cancel') {
		echo 'User has canceled authentication!';
	} else {
		if($openid->validate())
		{
				
			$identity = $openid->identity;
			$attributes = $openid->getAttributes();
			$email = $attributes['contact/email'];
			
			$user_result=get_UserByEmail($email);
			if($user_result!=null){
				$_SESSION['login']=1;
				$_SESSION['uid']=$uid;
				$_SESSION['userid']=$user_result['id'];
				$_SESSION['name']=$user_result['name'];
				$_SESSION['nickname']=$user_result['nickname'];
				$_SESSION['pojname']=$user_result['POJ_user_name'];
				$_SESSION['sex']=$user_result['sex'];
				$_SESSION['email']=$user_result['mail'];
				$_SESSION['week']=getWeek();
				$_SESSION['team']=$user_result['team'];
				$_SESSION['photoPath']=$user_result['photoPath'];
				header("Location: index.php");
				exit;
			}
		}
		else
		{
		header('Location: user_profile.php?&&email='.$email.'&&type=insert');
		}
	}
} catch(ErrorException $e) {
	echo $e->getMessage();
}
?>
