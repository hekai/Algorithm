{* Smarty *}
<html>
<head>
<title>hello Algo </title>
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'header.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'index.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'algo.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'content.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'jquery-ui.css'}">


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
			function getWeek(){
			return $("#secret_week").html();
			}
			function getGroup(){
			return $("#secret_group").html();
			}
			function getUserID(){
			return $("#secret_userid").html();
			}
			function freshCommet(problem_detail){

						var problemID=parseInt(problem_detail.children('span:first').html());
						var sendData="type=1&&probID="+problemID;
						$.getJSON('getComment.php',sendData,function(data){

						var comments_lists= problem_detail.children('div:last').children().children().children('div:last');
						comments_lists.children().remove();
						comments_lists.append('<dl class="dl_comments s_line1 no_border_line"></dl>');

						{*update comments number*}
						var mm = comments_lists.parent().parent().parent().prev().children('div:first').children('a:last');
						mm.html('Comments('+data.length+')');

						$.each(data,function(i,d){
							var insert='<dl class="dl_comments s_line1 no_border_line">';
							insert+='<dt><a href="##"><img alt="'+d['nickname']+'" src="'+d['photoPath']+'"></img></a></dt>';
							insert+='<dd><a href="##">'+ d['nickname'] + ':</a>' + d['content'] + ' (' + d['time'] + ')';
							insert+='<div class="dl_comment_action"><p><a href="##">Delete</a></p></div></dl>';

							$(insert).appendTo(comments_lists.children('dl:last'));
							});

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
				
				var sendData={ userID:userid,probID:problemID,content:text.val(),insert:"- -!" };
				$.post('CommentProbOperator.php',sendData,function(data){
						console.log("add comment for problem success");
						console.log(data);
						freshCommet(problem_detail);
						text.val("");

				});

			});

			$( "#dialog-form" ).dialog({
			    autoOpen: false,
			    height: 700,
			    width: 600,
			    modal: true,
			    position:{ my:"center",at:"top"},
			    buttons: {
				"Publish": function() {
				
				var pojNO=$("#diag_no").val();
				var pojTitle=$("#diag_title").val();
				var pojSource=$("#diag_source").val();
				var pojDesription=$("#diag_description").val();

				var week= getWeek();
				var userid= getUserID();
				if(pojNO.length==0 || pojTitle.length==0)
					return false;

				var sendData={ userID:userid,week:week,title:pojTitle,pojID:pojNO,content:pojDesription,source:pojSource,insert:"- -!" };
				$.post('ProblemOperator.php',sendData,function(data){
						console.log("publish problem success");
						$("#diag_no").val("");
						$("#diag_title").val("");
						$("#diag_source").val("");
						$("#diag_description").val("");

				});

				},
				Cancel: function() {
				    $( this ).dialog( "close" );
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

				var probID = currentProblemID;
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

				var sendData={ code:code,ac:ac,language:language,userID:userid,probID:probID,insert:type };
				$.post('ScoreOperator.php',sendData,function(data){
						console.log("ac "+ probID+" success");
					//	$(this).dialog( "close" );
						$("#diag_ac_code").val("");
						
				});
				
				},
				Cancel: function() {
				    $( this ).dialog( "close" );
				}
			    },
			    {*open:function() {*}
					      {*$('.ui-widget-overlay').bind('click', function() {*}
					      {*$(this).dialog('close');*}
						  {*});*}
					  {*},*}
			    close: function() {
			    }
			});
 
			$(".publish").click(function() {
					$( "#dialog-form" ).dialog( "open" );
				});
			$(".ac_button").click(function() {
					 var problem_detail = $(this).parent().parent().parent();
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
					 var $link = 'getContent.php?probID=' + currentProblemID;

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
			$(".ac_score").click(function(){
					var scoreID = $(this).next().html();
					 var $link = 'getAC.php?scoreID=' + scoreID;

					 $.getJSON($link,function(data){
						 var $dialog = $('<div><span>'+ data['code']+'</span></div>').dialog({
						 autoOpen:true,
						 model:false,
						 position:{ my:"center",at:"top"},
						 title:data['nickname'] + " 'code",
						 width:500,
						 height:500});

					 });

			});

			function getRank(){
					var week = getWeek();
					var team = getGroup();
			
					var $link = 'getRank.php?week=' + week + '&&team=' + team;

					 $.getJSON($link,function(data){
					 console.log(data);


					 });


			};

		});
</script>

</head>

<body>
<div id="header">
<div class="bg_line">
<span class="hello_world">Hello <a>{$name}</a>, Welcome to Algo...</span><span class="goodbye"><a href="login.php?logout">logout</a></span>
</div>
</div>


<div id="text">
	<div id="left_rank" class="left_tab">
		<span class="week_rank_title">Week Rank:</span>
		<div class="week_best_div">
		<span id="week_best_span">The Best:</span>
		<fieldset id="week_best">
			<img alt="hacklu" src="photo.png"></img>
		</fieldset>
		</div>
		<fieldset class="week_rank">
		<dl class="dl_rank">
			<dt><span class="week_rank_span">NO.2:</span>&nbsp;</dt>
			<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>
		</dl>
		<dl class="dl_rank">
			<dt><span class="week_rank_span">NO.3:</span>&nbsp;</dt>
			<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>
		</dl>
		<dl class="dl_rank">
			<dt><span class="week_rank_span">NO.4:</span>&nbsp;</dt>
			<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>
		</dl>
		<dl class="dl_rank">
			<dt><span class="week_rank_span">NO.5:</span>&nbsp;</dt>
			<dd><a href="#"><img alt="hacklu" src="photo.png"></img></a></dd>
		</dl>

		</fieldset>
		<div class="week_best_div">
			<span id="week_worst_span">The Worst:</span>
			<fieldset id="week_worst" class="week_rank">
				<img alt="hacklu" src="photo.png"></img>
			</fieldset>
		</div>
	</div>

<div id="top">
<fieldset id="f_group">
{*use js set current *}
<legend><a href="##" class="" id="group1">Group1</a>/<a href="##" id="group2">Group2</a></legend>

<div class="container">
	<p><a href="##" class="s_txt0"><span>&lt;&lt;First</span></a></p>
	<p><a href="##" class="s_txt0"><span>&lt;Pre</span></a></p>
	<p><a href="##" class="s_txt0"><span>Next&gt;</span></a></p>
	<p><a href="##" class="s_txt0"><span>Last&gt;&gt;</span></a></p>
	<a id="add_algo" class="btn-p"><span class="publish">publish!</span></a>
</div>
{foreach $problems as $problem}
{*<h1>{$test[$problem@index].a}</h1>*}
<div class="algo">
	<div class="algo_detail s_line2">
		{*<div class="algo_face"><img src="{'getPhoto.php?userid='|cat:$problem.userID}" title="{$problem.nickname}"></img></div>*}
		<div class="algo_face"><img src="{$problem.photoPath}" title="{$problem.nickname}"></img></div>
		<div class="problem_detail">
			<span class="hide_data problemID">{$problem.id}</span>
			<div class="author_info">
				{*<a class="author_name" href="#">hacklu</a>	*}
				<a class="author_name" href="##">{$problem.name}</a>	
				{*<span class="author_nickname" >(hacklu)</sapn>*}
				<span class="author_nickname" >({$problem.nickname})</sapn>
			</div>
			<div class="problem_text">
				{*<a class="problem_link" href="##">poj1000</a>*}
				<a class="problem_link" href="##">poj{$problem.pojProblemID}</a>
				{*<span>this is a beginner's problem. Be happy with it</span>*}
				<span>&nbsp;&nbsp; {$problem.title}</span>
			</div>
			<div class="ac_info">
					{foreach $problem.score as $ac}
						{if $ac.AC eq '1'}
							<img class="ac_score" src="{$ac.photoPath}" title="{$ac.nickname|cat:' '|cat:$ac.ACtime}"><div class="hide_data scoreID">{$ac.id}</div></img>
						{/if}
					{/foreach}
			</div>
			<div class="clearfix">
				<div class="problem_func">
					<a class="btn_a ac_button" href="##">AC</a>
					<i class="s_txt3">|</i>
					{*<a href="#">Comments(0)</a>*}
					<a href="##" class="click_comments">Comments({$problem.commentCount})</a>
				</div>
				<div class="problem_from">
					{*<a class="problem_time s_txt0">2012/11/28 10:40:00</a>*}
					<a class="problem_time s_txt0">{$problem.time}</a>
					<em class="s_txt2">from</em>
					{*<a class="s_link2 s_txt0" href="#">ACM2006</a>*}
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
							{*<dt><a href="#"><img alt="hacklu" src="/Algorithm/upload/small.png"></img></a></dt>*}
							{*<dt><a href="#"><img alt="hacklu" src="/Algorithm/upload/small.png"></img></a></dt>*}
							{*<dd><a href="#">hacklu:</a>*}
							{*2pang is foolish!!(1 hour ago)*}
							{*<div class="dl_comment_action">*}
								{*<p><a href="#">Delete</a></p></div>*}
							{*</dd>*}
							{*<dd class="clear"></dd>*}
						 </dl>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
{/foreach}

</fieldset>
</div>

<!--
<div id="bottom_comment">
	there is no comments now!<br/>
	<textarea rows="10" cols="30"> add comments here...  </textarea>
</div>
-->
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
<div id="secret_group">{$group}</div>
<div id="secret_userid">{$userid}</div>
</div>
</body>
</html>
