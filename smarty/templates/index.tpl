{* Smarty *}
<html style="overflow-x:hidden">
<head>
<title>hello Algo </title>
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'header.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'index.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'algo.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'content.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'jquery-ui.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'comments.css'}">


<script type="text/javascript" src="{$CSS_DIR|cat:'../js/jquery.js'}"></script>
<script type="text/javascript" src="{$CSS_DIR|cat:'../js/jquery-ui.js'}"></script>

{*dialog inline css*}
<style>
	 .diag_label {
		 display:block;
		 }
	 .diag_input { display:block;
}
	 .diag_input { margin-bottom:12px; width:95%; padding: .4em;
}
	 .diag_fieldset { padding:0; border:0;
		}
	 .diag_textarea { width:95%; height:238px; padding:.4em;
			}
	 .diag_validateTips { border: 1px solid transparent; padding: 3px;margin:5px 0;
		}
</style>

<script type="text/javascript">
	$(function(){
			var currentProblemID;
			var currentProblemDetail;
			var canPublish=true;
			var canComment=true;
			var canCommentSprint=true;
			var canAC=true;
			function getWeek(){
			return $("#secret_week").html();
			}
			function getCurrentWeek(){
			return $("#secret_current_week").html();
			}
			function getGroup(){
			return $("#secret_group").html();
			}
			function getUserID(){
			return $("#secret_userid").html();
			}
			function freshCommet(problem_detail){

						var problemID=parseInt(problem_detail.children('span:first').html());
						var sendData="type=prob&&probID="+problemID;
						$.getJSON('getComment.php',sendData,function(data){
						if(data==null)
							return false;

						var comments_lists= problem_detail.children('div:last').children().children().children('div:last');
						comments_lists.children().remove();
						comments_lists.append('<dl class="dl_comments s_line1 no_border_line"></dl>');

						{*update comments number*}
						var mm = comments_lists.parent().parent().parent().prev().children('div:first').children('a:last');
						mm.html('Comments('+data.length+')');

						$.each(data,function(i,d){
							var insert='<dl class="dl_comments s_line1 no_border_line">';
							insert+='<dt><a href="##"><img  class="round1" onclick="getACRate(' +d['userID'] + ')" alt="'+d['nickname']+'" src="'+d['photoPath']+'"></img></a></dt>';
							insert+='<dd><a href="##" onclick="getACRate(' + d['userID'] + ')">' + d['nickname'] + ':</a>' + d['content'] + ' (' + d['time'] + ')';
							insert+='<div class="dl_comment_action"><p><a href="##">Delete</a></p></div></dl>';

							$(insert).appendTo(comments_lists.children('dl:last'));
							});

						});

			};
			function freshAc_info(problem_detail){

						var problemID=parseInt(problem_detail.children('span:first').html());
						var sendData="type=all&&probID="+problemID;
						$.getJSON('getAC.php',sendData,function(data){
						if(data==null)
							return false;

						var ac_info = problem_detail.children('div:first').next().next();
						ac_info.children().remove();

						$.each(data,function(i,d){
							var insert='<img class="ac_score round2" src="' + d['photoPath'] +'" title="' +d['nickname'] + ' ' + d['ACtime'] +'"><div class="hide_data scoreID">' + d['id'] +'</div></img>';

							ac_info.append(insert);
							});

						});

			};
			function freshCommet_Sprint(){
					var week = getCurrentWeek();
					var team = getGroup();
					var type = 'sprint';
					var sendData = { type:type,week:week,team:team}
					$.getJSON('getComment.php',sendData,function(data){
						if(data==null)
							return false;
					$('.g_title').html(data.length+' note on sprint');
					$('.g_commit_comments').children().remove();
					$.each(data,function(i,d){
							var insert='<div class="g_one_comment"><img  onclick="getACRate(' +d['userID'] + ')" class="g_avatar round1" src="' + d['photoPath'] + '"><div class="g_comment_content_bgc">';
							insert+= '<div class="g_comment_inner"><div class="g_comment_content_bubble"><a href="##" class="g_comment-header-author">'+ d['nickname'] + '</a><span class="g_comment-time"> (' + d['time'] +')</span></div>';
							insert+= '<div class="g_comment_content_text"><div class="g_real_content"><p class="g_content">' + d['content'] + '</p></div></div></div></div></div></div></div>';


							$(insert).appendTo($('.g_commit_comments'));
							});

						});


			};
			function getRank(){
					var week = getCurrentWeek();
					var team = getGroup();
			
					var $link = 'getRank.php?type=all&week=' + week + '&&team=' + team;
					var $link_worst = 'getRank.php?type=worst&week=' + week + '&&team=' + team;

					 $.getJSON($link,function(data){

						{*$('#left_rank').children().remove();*}
					 
						if(data==null)
							return false;
						$.each(data,function(i,d){

							var m=i+1;
							if(i==0){
						$('#left_rank').children().remove();

								var insert='<span class="week_rank_title">Week Rank:</span><div class="week_best_div"><span id="week_best_span">The Best:</span><fieldset id="week_best"><img  onclick="getACRate(' +d['userID'] + ')" title="' + d['nickname'] + '" src="'+d['photoPath'] + '"></img></fieldset></div><fieldset  class="week_rank"></fieldset>';
								$('#left_rank').append(insert);
							}
							else{

								var insert='<dl class="dl_rank"><dt><span class="week_rank_span">NO.'+ m+':</span>&nbsp;</dt><dd><a href="##"><img  onclick="getACRate(' +d['userID'] + ')" title="'+d['nickname'] +'" src="' + d['photoPath']+'"></img></a></dd></dl>';
								{*$(insert).append($('.week_rank').children('dl:last'));*}
								$('.week_rank').append(insert);
							}

					 });
				 }).complete(function() {
				$.getJSON($link_worst,function(data){
						if(data==null)
							return false;
						$.each(data,function(i,d){
	{*<div id="left_rank" class="left_tab">*}
		{*<span class="week_rank_title">Week Rank:</span>*}
		{*<div class="week_best_div">*}
		{*<span id="week_best_span">The Best:</span>*}
		{*<fieldset id="week_best">*}
			{*<img alt="hacklu" src="photo.png"></img>*}
		{*</fieldset>*}
		{*</div>*}
		{*<fieldset class="week_rank">*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.2:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.3:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.4:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.5:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}

		{*</fieldset>*}
		{*<div class="week_best_div">*}
			{*<span id="week_worst_span">The Worst:</span>*}
			{*<fieldset id="week_worst" class="week_rank">*}
				{*<img alt="hacklu" src="photo.png"></img>*}
			{*</fieldset>*}
		{*</div>*}
	{*</div>*}
							if(i==0){
								var insert = '<div class="week_best_div" style="height:650px;"><span id="week_worst_span">The Worst:</span><fieldset id="week_worst" class="week_rank"><img  onclick="getACRate(' +d['id'] + ')" title="' + d['nickname'] + '" src="' + d['photoPath'] + '"></img></fieldset>';
								$('#left_rank').append(insert);
							}
							else{
								var insert = '<img  onclick="getACRate(' +d['id'] + ')" title="' + d['nickname'] + '" src="' + d['photoPath'] + '"></img>';
								$('#week_worst').append(insert);
							}

					 });

				
				})
				});
			};

			$(".click_comments").click(function(){
				
				var t =	$(this).parent().parent().next().css("display")
				var problem_detail = $(this).parent().parent().parent();
				if(t=="none")
					{
					freshCommet(problem_detail);
					}
				$(this).parent().parent().next().toggle();
			});

			$(".add_comment").click(function(){
				var text = $(this).parent().parent().parent().parent().children('textarea');
				{*console.log(text.val());*}
				if(text.val().length==0)
					return false;
				var problem_detail = $(this).parents('.problem_detail');
				var problemID=problem_detail.children('span:first').html();

				var userid = getUserID();
				
				if(canComment==false)
					return false;
				canComment = false;
				var sendData={ userID:userid,probID:problemID,content:text.val(),insert:"- -!" };
				$.post('CommentProbOperator.php',sendData,function(data){
						console.log("add comment for problem success");
						console.log(data);
						freshCommet(problem_detail);
						text.val("");

				}).complete(function(){ canComment = true; });

			});

			$(".gg_button").click(function(){
				var text=$('#g_comment_body').val();
				var insert="insert";
				var userID = getUserID();
				var week = getCurrentWeek();
				var team = getGroup();

				if(text.length==0)
					return false;
				
				var sendData = { userID:userID,week:week,team:team,content:text,insert:insert};
				if(canCommentSprint==false)
					return false;
				canCommentSprint = false;
				$.post('CommentSprintOperator.php',sendData,function(data){
						console.log("add comment for Sprint success");
						console.log(data);
						freshCommet_Sprint();
						$('#g_comment_body').val("");

				}).complete(function(){ canCommentSprint = true; });

			});

			$( "#dialog-form" ).dialog({
			    autoOpen: false,
			    height: 700,
			    width: 600,
			    modal: true,
			    position:{ my:"center",at:"top"},
			    buttons: {
				"Publish": function() {
			        var this_dialog = this;	
				var pojNO=$("#diag_no").val();
				var pojTitle=$("#diag_title").val();
				var pojSource=$("#diag_source").val();
				var pojDesription=$("#diag_description").val();

				var week= getCurrentWeek();
				var userid= getUserID();
				var level = getGroup();
				if(pojNO.length==0 || pojTitle.length==0){
					return false;
					}

				if(canPublish== false)
					return false;
				canPublish = false;
				var sendData={ userID:userid,week:week,title:pojTitle,pojID:pojNO,content:pojDesription,source:pojSource,level:level,insert:"- -!" };
				$.post('ProblemOperator.php',sendData,function(data){
						console.log("publish problem success");
						console.log(data);
						$("#diag_no").val("");
						$("#diag_title").val("");
						$("#diag_source").val("");
						$("#diag_description").val("");

				    $( this_dialog).dialog( "close" );
						location.reload();
				}).complete(function(){ canPublish = true; });

				},
				Cancel: function() {
				    $(this).dialog( "close" );
				}
			    },
			    close: function() {
			    }
			});
			$( "#dialog-ac" ).dialog({
			    autoOpen: false,
			    height: 700,
			    width: 600,
			    modal: true,
			    position:{ my:"center",at:"top"},
			    buttons: {
				"Submit": function() {
				var this_dialog = this;

				var probID = currentProblemID;
				var problemDetail = currentProblemDetail;
				var code = $("#diag_ac_code").val();
				if(code.length==0)
					return false;
				var ac;
				if($("#diag_ac").is(':checked'))
					ac = "1";
				else
					ac = "0";
				var language=$("#diag_language").val();

				var userid= getUserID();

				var type="insert ni mei";

				if(canAC== false)
					return false;
				canAC = false;
				var sendData={ code:code,ac:ac,language:language,userID:userid,probID:probID,insert:type };
				$.post('ScoreOperator.php',sendData,function(data){
						console.log("ac "+ probID+" success");
					//	$(this).dialog( "close" );
						$("#diag_ac_code").val("");
						getRank();
						freshAc_info(problemDetail);
						$( this_dialog).dialog( "close" );
						
				}).complete(function(){ canAC = true; });
				},
				Cancel: function() {
				    $( this ).dialog( "close" );
				}
			    },
			    close: function() {
			    }
			});
 
			$(".publish").click(function() {
					$( "#dialog-form" ).dialog( "open" );
				});
			$(".ac_button").click(function() {
					 var problem_detail = $(this).parent().parent().parent();
					 currentProblemDetail = problem_detail;
					 currentProblemID = parseInt(problem_detail.children('span:first').html());
					 var problemPojId = problem_detail.children('div:first').next().children().html();
					$("#dialog-ac").dialog({ title:'AC '+ problemPojId +' ?'});
					$("#dialog-ac").dialog("open");
				});

				{*set current group*}
			if(getGroup()=="1")
				$("#group1").addClass("current_group");
			else
				$("#group2").addClass("current_group");

			$(".problem_link").click(function(){
					 var problem_detail = $(this).parent().parent();
					 currentProblemID = problem_detail.children('span:first').html();
					 var $link = 'getContent.php?type=detail&&probID=' + currentProblemID;

					 $.getJSON($link,function(data){
						 var $dialog = $('<div><span>'+ data['Context']+'</span></div>').dialog({
						 autoOpen:true,
						 model:false,
						 position:{ my:"center",at:"top"},
						 title: 'POJ ' + data['pojProblemID'] +'  '+ data['title'],
						 width:500,
						 height:500});

					 });


				});
			$(".ac_score").live("click",function(){
					var scoreID = $(this).next().html();
					 var $link = 'getAC.php?scoreID=' + scoreID +'&type=detail';

					 var jqxhr=$.getJSON($link,function(data){
						 var $dialog = $('<div><span>'+ data['code']+'</span></div>').dialog({
						 autoOpen:true,
						 model:false,
						 position:{ my:"center",at:"top"},
						 title:data['nickname'] + " 'code",
						 width:500,
						 height:500});

					 }).success(function() { console.log("success")})
						.error(function(data){ console.log("error");console.log(data)})
						.complete(function(){ console.log(" get ac score compelete")});

			});

			{*pages *}
			$('.page0').click(function(){
				var level=getGroup();
				var week = '1';
				var url='index.php?level=' + level + '&&current_week=' + week;
				window.location = url;
			});
			$('.page1').click(function(){
				var level=getGroup();
				var week = parseInt(getCurrentWeek()) -1 ;
				var url='index.php?level=' + level + '&&current_week=' + week;
				window.location = url;
			});
			$('.page2').click(function(){
				var level=getGroup();
				var week = parseInt(getCurrentWeek()) +1 ;
				var url='index.php?level=' + level + '&&current_week=' + week;
				window.location = url;
			});
			$('.page3').click(function(){
				var level=getGroup();
				var week = getWeek();
				var url='index.php?level=' + level + '&&current_week=' + week;
				window.location = url;
			});

			$(".author_name").click(function(){
				var usrId = $(this).parent().children('div:first').html();
				var link = 'getACRate.php?userID=' + usrId;
				var linkUser = 'getUser.php?userID=' + usrId;
				var username;
				$.getJSON(linkUser,function(data){
					
					username = data['nickname'];

				}).complete(function(){
				$.getJSON(link,function(d){
					var acRate = parseInt(d['teamAC'])/parseInt(d['teamPcount']);
					var show = '<div><p>AC rate=' + acRate +'(' +  d['teamAC'] +'/' + d['teamPcount'] + ')</p>';

					var acedRate = parseInt(d['ACed'])/parseInt(d['userPCount']);
					show += '<p>ACed rate=' + acedRate +'(' +  d['ACed'] +'/' + d['userPCount'] + ')</p>';

					var dialog = $(show).dialog({ title:username+ ' \'s info', modal:false,focus:true});
				});

				});

			});


			function fix_pages(){
				var cur= getCurrentWeek();
				var max= getWeek();
				if(cur==max){
					$('.page3').hide();
					$('.page2').hide();
					}
				if(max=='1')
					$('.page').hide();
				if(cur=='1'){
					$('.page0').hide();
					$('.page1').hide();
					}

			};

			getRank();
			fix_pages();
			freshCommet_Sprint();

		});
			function getACRate(usrId){
				var link = 'getACRate.php?userID=' + usrId;
				var linkUser = 'getUser.php?userID=' + usrId;
				var username;
				$.getJSON(linkUser,function(data){
					
					username = data['nickname'];

				}).complete(function(){
				$.getJSON(link,function(d){
					var teamAC = parseInt(d['teamAC']);
					var teamPcount = parseInt(d['teamPcount']);
					var ACed = parseInt(d['ACed']);
					var userPCount = parseInt(['userPCount']);

					if(teamPcount != 0)
						var acRate = parseInt(d['teamAC'])/parseInt(d['teamPcount']);
					else 
						var acRate = '';
					var show = '<div><p>AC rate=' + acRate +'(' +  d['teamAC'] +'/' + d['teamPcount'] + ')</p>';

					if(userPCount != 0)
						var acedRate = parseInt(d['ACed'])/parseInt(d['userPCount']);
					else
						var acedRate = '';
					show += '<p>ACed rate=' + acedRate +'(' +  d['ACed'] +'/' + d['userPCount'] + ')</p>';

					var dialog = $(show).dialog({ title:username+ ' \'s info', modal:false,focus:true});
				});

				});


			};
</script>

</head>

<body>
<div id="header">
<div class="bg_line">
<span class="hello_world">Hello <a>{$name}</a>, Welcome to Algo...</span><span class="goodbye"><a href="user_profile.php?type=update">Setting</a>&nbsp;&nbsp;&nbsp;<a href="login.php?logout">Logout</a></span>
</div>
</div>


<div id="text">
	<div id="left_rank" class="left_tab">
		<span class="week_rank_title">Week Rank:</span>
		{*<div class="week_best_div">*}
		{*<span id="week_best_span">The Best:</span>*}
		{*<fieldset id="week_best">*}
			{*<img alt="hacklu" src="photo.png"></img>*}
		{*</fieldset>*}
		{*</div>*}
		{*<fieldset class="week_rank">*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.2:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.3:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.4:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}
		{*<dl class="dl_rank">*}
			{*<dt><span class="week_rank_span">NO.5:</span>&nbsp;</dt>*}
			{*<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>*}
		{*</dl>*}

		{*</fieldset>*}
		{*<div class="week_best_div">*}
			{*<span id="week_worst_span">The Worst:</span>*}
			{*<fieldset id="week_worst" class="week_rank">*}
				{*<img alt="hacklu" src="photo.png"></img>*}
			{*</fieldset>*}
		{*</div>*}
	</div>

<div id="top">
<fieldset id="f_group">
{*use js set current *}
<legend><a href="index.php?level=1" class="" id="group1">Group1</a>/<a href="index.php?level=2" id="group2">Group2</a></legend>

<div class="container">
	<p><a href="##" class="s_txt0 pages page0"><span>&lt;&lt;First</span></a></p>
	<p><a href="##" class="s_txt0 pages page1"><span>&lt;Pre</span></a></p>
	<p><a href="##" class="s_txt0 pages page2"><span>Next&gt;</span></a></p>
	<p><a href="##" class="s_txt0 pages page3"><span>Last&gt;&gt;</span></a></p>
	<a id="add_algo" class="btn-p"><span class="publish">publish!</span></a>
</div>
{if $problems != ''}
{foreach $problems as $problem}
{*<h1>{$test[$problem@index].a}</h1>*}
<div class="algo">
	<div class="algo_detail s_line2">
		<div class="algo_face"><img class="round3" src="{$problem.photoPath}" title="{$problem.nickname}" onclick="getACRate({$problem.userID})"></img></div>
		<div class="problem_detail">
			<span class="hide_data problemID">{$problem.id}</span>
			<div class="author_info">
				<div class="hide_data">{$problem.userID}</div>
				<a class="author_name" href="##">{$problem.name}</a>	
				<span class="author_nickname" >({$problem.nickname})</sapn>
			</div>
			<div class="problem_text">
				<a class="problem_link" href="##">poj{$problem.pojProblemID}</a>
				<span>&nbsp;&nbsp; {$problem.title}</span>
			</div>
			<div class="ac_info">
					{foreach $problem.score as $ac}
						{if $ac.AC eq '1'}
							<img class="ac_score round2" src="{$ac.photoPath}" title="{$ac.nickname|cat:' '|cat:$ac.ACtime}"><div class="hide_data scoreID">{$ac.id}</div></img>
						{/if}
					{/foreach}
			</div>
			<div class="clearfix">
				<div class="problem_func">
					<a class="btn_a ac_button" href="##">AC</a>
					<i class="s_txt3">|</i>
					<a href="##" class="click_comments">Comments({$problem.commentCount})</a>
				</div>
				<div class="problem_from">
					<a class="problem_time s_txt0">{$problem.time}</a>
					<em class="s_txt2">from</em>
					<a class="s_link2 s_txt0" href="##">{$problem.source}</a>
				</div>
			</div>
			<div class="problem_comments s_line1">
				<div>
					<!-- comment box -->
					<div class="s_line1 input clearfix">
						<div><textarea class="c_input"></textarea>
						<div class="action"><p class="btn"><a class="btn_a" href="###" onclick="return false"><span class="add_comment">comment</span></a></p></div>
					</div>
					<!-- comments -->
					<div class="comments_lists">
						<dl class="dl_comments s_line1 no_border_line">
						 </dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
{/foreach}
{/if}
</fieldset>
<div class="g_if">
<div class="g_all_comments">
	<h2 class="g_title">0 note on sprint</h2>
	<div class="g_commit_comments">
	</div>
</div>

<div class="g_discussion">
	<img src="{$photoPath}"  class="g_avatar round1">
		<div class="g_discussion-bubble-content">
			<div class="g_discussion-bubble-inner">
				<div class="g_write_bucket">
					<textarea name="comment" tabindex="2" id="g_comment_body"  style="height: 38px; "></textarea>
				</div>
					<p class="g_classy-primary " tabindex="2"><a class="gg_button">Comment</a></p>
			</div>
	
		</div>
</div>
</div>
</div>

<div class="fixbug"></div> {* this is so important!. fix the div height auto *}
</div>

{*dialog is here~*}
<div id="dialog-form" title="Publish New Problem">
    <p class="diag_validateTips">All form fields are required.</p>
    <form>
    <fieldset>
        <label class="diag_label" for="">Poj No</label>
        <input class="diag_input" type="text" name="no" id="diag_no" class="text ui-widget-content ui-corner-all" />
        <label class="diag_label" for="">Problem Title</label>
        <input class="diag_input" type="text" name="title" id="diag_title" value="" class="text ui-widget-content ui-corner-all" />
        <label class="diag_label" for="">Problem Source</label>
        <input class="diag_input" type="text" name="source" id="diag_source" value="" class="text ui-widget-content ui-corner-all" />
        <label class="diag_label" for="">Problem Description</label>
	<textarea class="diag_textarea ui-corner-all ui-widget-content" id="diag_description"></textarea>
        <!--<input type="textarea" name="description" id="diag_description" value="" class="text ui-widget-content ui-corner-all" />-->
    </fieldset>
    </form>
</div>
<div id="dialog-ac" title="AC it!">
    <form>
    <fieldset>
        <label class="diag_label" for="">Language</label>
        <select class="diag_input" type="select" name="language" id="diag_language" value="" class="select ui-widget-content ui-corner-all" />
	<option value="c">C</option>
	<option value="c++">C++</option>
	<option value="gcc">GCC</option>
	<option value="g++">G++</option>
	<option value="java">Java</option>
</select>
        <label class="diag_label" style="display:inline-block; margin:0 0 3px 0;" for="">AC?</label>
        <input class="" type="checkbox" name="" id="diag_ac" check="checked" class="checkbox ui-widget-content ui-corner-all" />
        <label class="diag_label" for="">Code here</label>
	<textarea class="diag_textarea ui-corner-all ui-widget-content" id="diag_ac_code" style="height:390px;"></textarea>
    </fieldset>
    </form>
</div>
{*hide data here*}
<div id="secret_data" class="hide_data">
<div id="secret_week">{$week}</div>
<div id="secret_current_week">{$current_week}</div>
<div id="secret_group">{$group}</div>
<div id="secret_userid">{$userid}</div>
<div id="secret_photoPath">{$photoPath}</div>
</div>
</body>
</html>
