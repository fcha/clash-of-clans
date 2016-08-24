<!DOCTYPE html>
<html>
    <head>
        <title>War Tactics - @yield('title')</title>
        <link rel="stylesheet" href="<?php echo url('assets/css/style.css')?>" />
    </head>
    <body>
		<div id="header"></div>
		<div id="container">
			<div id="left" class="column">
				<img src="{{ url('assets/images/Clash_logo.png') }}"/>
				<div id="cssmenu">
					<ul>
						<li><a href="/"><span>Home</span></a></li>
						<li><a href="/"><span>Clan</span></a></li>
						<li><a href="members"><span>Members</span></a></li>
					</ul>
				</div>
			</div>
			<div id="center" class="column">
				@yield('content')
			</div>
			<div id="right" class="column"></div>
		</div>
		<div id="footer"></div>
    </body>
</html>