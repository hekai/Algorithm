{* Smarty *}
<html>
<head>
<title>hello Algo </title>
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'header.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'index.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'algo.css'}">
<link rel="stylesheet" type="text/css" href="{$CSS_DIR|cat:'content.css'}">
</head>
<body>

<div id="header">
<div class="bg_line">
<span class="hello_world">Hello <a>{$name}</a>, Welcome to Algo...</span><span class="goodbye"><a href="#">logout</a></span>
</div>
</div>


<div id="text">
<div id="left_rank">
<span>The Best</span>
<fieldset class="week_rank" id="week_best">
		<img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img>
</fieldset>
<fieldset class="week_rank">
{*<legend><span>Rank</span></legend>*}
	<dl class="dl_rank">
		<dt><span>2</span></dt>
		<dd><a href="#"><img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img></a></dd>
	</dl>
	<dl class="dl_rank">
		<dt><span>3</span></dt>
		<dd><a href="#"><img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img></a></dd>
	</dl>
	<dl class="dl_rank">
		<dt><span>4</span></dt>
		<dd><a href="#"><img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img></a></dd>
	</dl>
	<dl class="dl_rank">
		<dt><span>5</span></dt>
		<dd><a href="#"><img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img></a></dd>
	</dl>

</fieldset>
<fieldset id="week_worst" class="week_rank">
		<img alt="hacklu" src="/Algorithm/upload/hacklu.jpg"></img>
</fieldset>
</div>

<div id="top">
<fieldset id="f_group">
{*use js set current *}
<legend><a href="#" class="current">Group1</a>/<a href="#">Group2</a></legend>

<div class="container">
	<p><a href="#" class="s_txt0"><span>&lt;&lt;First</span></a></p>
	<p><a href="#" class="s_txt0"><span>&lt;Pre</span></a></p>
	<p><a href="#" class="s_txt0"><span>Next&gt;</span></a></p>
	<p><a href="#" class="s_txt0"><span>Last&gt;&gt;</span></a></p>
	<a id="add_algo" class="btn-p"><span class="publish">publish!</span></a>
</div>
{foreach $myAlgos as $Algo}
<div class="algo">
	<div class="algo_detail s_line2">
		{*<div class="algo_face"><img src="/Algorithm/upload/small.png" title="hacklu"></img></div>*}
		<div class="algo_face"><img src="{$Algo.user_photo}" title="{$Algo.user_name}"></img></div>
		<div class="problem_detail">
			<div class="author_info">
				{*<a class="author_name" href="#">hacklu</a>	*}
				<a class="author_name" href="#">{$Algo.user_name}</a>	
				{*<span class="author_nickname" >(hacklu)</sapn>*}
				<span class="author_nickname" >({$Algo.user_nickname})</sapn>
			</div>
			<div class="problem_text">
				{*<a class="problem_link" href="#">poj1000</a>*}
				<a class="problem_link" href="#">poj{$Algo.problem.no}</a>
				{*<span>this is a beginner's problem. Be happy with it</span>*}
				<span>{$Algo.problem.title}</span>
			</div>
			<div class="ac_info">
				{*<img src="/Algorithm/upload/1.jpg" title="hacklu" ></img>*}
				{*<img src="/Algorithm/upload/1.jpg" title="jeff" ></img>*}
				{*<img src="/Algorithm/upload/1.jpg" title="cj" ></img>*}
				{*<img src="/Algorithm/upload/1.jpg" title="pangzi" ></img>*}
				{*<img src="/Algorithm/upload/1.jpg" title="ss" ></img>*}
				{*<img src="/Algorithm/upload/1.jpg" title="hk" ></img>*}
					{foreach $Algo.ac_info as $ac}
						{*{assign var="name" value=$ac.name}*}
						{*{assign var="time" value=$ac.time}*}
						{*{assign var="t" value="$name$time"}*}
						{*<img src={$ac.img} title="{$ac.fix_bug}"></img>*}
						<img src={$ac.img} title="{$ac.name|cat:' '|cat:$ac.time}"></img>
						{*{$title=$ac.name + ' at '}*}
						{*<img src={$ac.img} title={$ac.name+$ac.time}></img>*}
					{/foreach}
			</div>
			<div class="clearfix">
				<div class="problem_func">
					<a class="btn_a" href="#">AC</a>
					<i class="s_txt3">|</i>
					{*<a href="#">Comments(0)</a>*}
					<a href="#">Comments({$Algo.comment_num})</a>
				</div>
				<div class="problem_from">
					{*<a class="problem_time s_txt0">2012/11/28 10:40:00</a>*}
					<a class="problem_time s_txt0">{$Algo.problem.submit_time}</a>
					<em class="s_txt2">from</em>
					{*<a class="s_link2 s_txt0" href="#">ACM2006</a>*}
					<a class="s_link2 s_txt0" href="#">{$Algo.problem.source}</a>
				</div>
			</div>
			<div class="problem_comments s_line1">
				<div>
					<!-- comment box -->
					<div class="s_line1 input clearfix">
						<div><textarea class="c_input"></textarea>
						<div class="action"><p class="btn"><a class="btn_a" href="###" onclick="return false"><span>comment</span></a></p></div>
					</div>
					<!-- comments -->
					<div class="comments_lists">
						<dl class="dl_comments s_line1 no_border_line">
							<dt><a href="#"><img alt="hacklu" src="/Algorithm/upload/small.png"></img></a></dt>
							<dd><a href="#">hacklu:</a>
							2pang is foolish!!(1 hour ago)
							<div class="dl_comment_action">
								<p><a href="#">Delete</a></p></div>
							</dd>
							<dd class="clear"></dd>
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
</div>

</body>
</html>
