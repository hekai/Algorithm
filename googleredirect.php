<?php
session_start();
require_once 'include/openid.php';
require_once 'include/db_operator_class.php';
try {
	$openid = new LightOpenID('hwk256.xicp.net:8080');
	if(!$openid->mode) {
		if(isset($_GET['login'])) {
			$openid->identity = 'https://www.google.com/accounts/o8/id';
			$openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
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
// 			echo 'User <b>' . $openid->identity . '</b> has logged in.<br>';
				
// 			echo "<h3>User information</h3>";
				
			$identity = $openid->identity;
			$attributes = $openid->getAttributes();
			$email = $attributes['contact/email'];
			$first_name = $attributes['namePerson/first'];
			$last_name = $attributes['namePerson/last'];
				
// 			echo "mode: " . $openid->mode . "<br>";
// 			echo "identity: " . $identity . "<br>";
// 			echo "email: " . $email . "<br>";
// 			echo "first_name: " . $first_name . "<br>";
// 			echo "last_name: " . $last_name . "<br>";
			
			$user_result=get_UserByEmail($email);
			if($user_result!=null){
				$_SESSION['login']=1;
				$_SESSION['userid']=$user_result['id'];
				$_SESSION['name']=$user_result['name'];
				$_SESSION['ncikname']=$user_result['nickname'];
				$_SESSION['team']=$user_result['team'];
				$_SESSION['photoPath']=$user_result['photoPath'];
				header("Location: index.php");
				exit;
			}
		}
		else
		{
// 			echo 'User ' . $openid->identity . 'has not logged in.<br/>';
// 			$attributes = $openid->getAttributes();
// 			$email = $attributes['contact/email'];
// 			echo "email: " . $email . "<br>";
// 			$user_result=get_UserByEmail($email);
// 			echo ''.$user_result.'';
			header("Location: login.php");
		}
	}
} catch(ErrorException $e) {
	echo $e->getMessage();
}
?>