    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
            "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
    <title>Freifunk Oldenburg | Netmon</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link href="./templates/{$template}/css/central_netmon.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div id="page_margins">
	<div id="page">
		<div id="header">
			<div id="topnav">
				<!-- start: skip link navigation -->
				<a class="skip" href="#navigation" title="skip link">Skip to the navigation</a><span class="hideme">.</span>
				<a class="skip" href="#content" title="skip link">Skip to the content</a><span class="hideme">.</span>
				<!-- end: skip link navigation -->
				<span>
					{if $installed}
<!--						{foreach $top_menu as $topmenu}
							<span class="topmenubox"><a style="color: #FFFFFF" href="{$topmenu.href}">{$topmenu.name}</a></span>
						{/foreach}-->
						{foreach $loginOutMenu as $menu key=count}
							{if $count != 0}| {/if}<a href="{$menu.href}">{$menu.name}</a>
						{/foreach}
					{/if}
				</span>
			</div>
		    <div id="headerbg">
		    </div>
			<h1>Freifunk Oldenburg | Netmon</h1>
			<span>Die freie WLAN-Community aus Oldenburg &#8226; Freie Netze für alle!</span>
		</div>				
		<!-- begin: main navigation #nav -->
		<div id="nav"> <a id="navigation" name="navigation"></a>
			<!-- skiplink anchor: navigation -->
			<div id="nav_main">
				<ul>
					<li><a href="http://blog.freifunk-ol.de/">Neues</a></li>
					<li><a href="http://wiki.freifunk-ol.de/">Informationen</a></li>
					<li><a href="http://wiki.freifunk-ol.de/index.php?title=Kontakt">Kontakt</a></li>
					<li id="current"><a href="#">Netzwerk</a></li>
					<li><a href="http://ticket.freifunk-ol.de/">Entwicklung</a></li>
				</ul>

				<div class="searchbox">
                  <form id="searchForm" name="searchForm" action="./search.php" method="POST">
                    <input class="suchBox" type="text" onblur="this.value='Suchbegriff eingeben...'" onclick="this.value=''" value="Suchbegriff eingeben..." name="search_string"/>
                    <input type="hidden" value="all" name="search_range"/>
                  </form>
                </div>
	</div>
	<div id="nav_sub">
		{if $installed}
			{if isset($installation_menu)}
				<ul>
					{foreach $installation_menu as $menu}
						<li><a href="{$menu.href}">{$menu.name}</a></li>
					{/foreach}
				</ul>
			{/if}
			{if isset($normal_menu)}
				<ul>
					{foreach $normal_menu as $menu}
						<li><a  href="{$menu.0.href}">{$menu.0.name}</a>
							<ul>
							{foreach $menu.1 as $submenu}
								<li><a href="{$submenu.href}">{$submenu.name}</a></li>
							{/foreach}
							</ul>
						</li>
					{/foreach}
				</ul>
			{/if}
			{if isset($admin_menu)}
				<ul>
					{foreach $admin_menu as $menu}
						<li><a {if $menu.selected=='true'}class="selected"{/if} href="{$menu.href}">{$menu.name}</a></li>
					{/foreach}
				</ul>
			{/if}
			{if isset($root_menu)}
				<ul>
					{foreach $root_menu as $menu}
						<li><a  href="{$menu.0.href}">{$menu.0.name}</a>
							<ul>
							{foreach $menu.1 as $submenu}
								<li><a href="{$submenu.href}">{$submenu.name}</a></li>
							{/foreach}
							</ul>
						</li>
					{/foreach}
				</ul>
			{/if}
		{/if}
	</div>
</div>
<!-- end: main navigation -->

<!-- begin: main content area #main -->
<div id="main">
	<!--Systemmeldungen-->
	{foreach $message as $output}
		{if $output.1==0}
			<div id="messagebox" style="background-color: #f7ce3e">{$output.0}</div>
		{/if}
		{if $output.1==1}
			<div id="messagebox" style="background-color: #97ff5f">{$output.0}</div>
		{/if}
		{if $output.1==2}
			<div id="messagebox" style="background-color: #ff5353">{$output.0}</div>
		{/if}
	{/foreach}
	<div id="content">