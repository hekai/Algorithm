<?php
header("content-type:text/html; charset=utf-8");
require_once('include/smarty_setup.php');
require_once 'include/db_operator_class.php';

$smarty = new Algo();

$smarty->assign('name','hacklu');

	//'user_photo'=>'/Algorithm/upload/small.png',
			$Algo = array('user_name' => 'hacklu',
				'user_nickname' => 'hacklu',
				'user_photo' => '/Algorithm/upload/small.png',
				'problem' => array('no'=>'1000',
						   'submit_time'=>'2012/11/28 10:40:00',
						   'source'=>'ACM2006',
						   'title'=>'A+B'),
				'ac_info' => array(
						   array('img'=>'/Algorithm/upload/1.jpg',
						   	 'time'=>'12/1 1:1',
							 'name'=>'jeff'),
						   array('img'=>'/Algorithm/upload/1.jpg',
						   	 'time'=>'12/1 2:1',
							 'name'=>'hacklu'),
						 ),
				'comment_num'=>'3'
						   );
			$Algo1= array('user_name' => 'hacklu',
				'user_nickname' => 'hacklu',
				'user_photo' => '/Algorithm/upload/small.png',
				'problem' => array('no'=>'1000',
						   'submit_time'=>'2012/11/28 10:40:00',
						   'source'=>'ACM2006',
						   'title'=>'A+B'),
				'ac_info' => array(
							   ),
				'comment_num'=>'2'
						   );

$smarty->assign('myAlgos', array($Algo,$Algo1));

$problems = get_ProblemsOnWeek(1);

if($problems!=null){
	for ($i= 0;$i< count($problems); $i++){
		$score = get_ScoresByProb($problems[$i]['id']);
		$commentCount = get_CommentsCountByProb($problems[$i]['id']);
		$problems[$i]['score'] = $score;
		$problems[$i]['commentCount'] = $commentCount['count(*)'];
	}
	$smarty->assign('problems',$problems);
}

$smarty->display('index.tpl');

?>
