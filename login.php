<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link rel=stylesheet href="include/css/login.css">
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=856922159" type="text/javascript" charset="utf-8"></script>
<?php 
	if(isset($_GET['logout']))
		echo '<script>WB2.logout();;</script>';
?>
<script type="text/javascript">

WB2.anyWhere(function(W){
    W.widget.connectButton({
        id: "wb_connect_btn",	
        type:"1,2",
        callback : {
            login:function(o){	//登录后的回调函数
            	window.location.href='sinaredirect.php?uid='+o.id;
            },	
            logout:function(){	//退出后的回调函数
            	window.location.href='logout.php';
            }
        }
    });
});

</script>
<title>Super Algorithm Team</title>
</head>
<body>
<div class="center">
  <div class="main">
    <p class = "first">Welcome To Our</p>
    <p class = "first">Super Algorithm Team</p>
    <div id="wb_connect_btn"></div>
  </div>
</div>
</body>
</html>
