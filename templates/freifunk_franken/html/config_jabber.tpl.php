<script type="text/javascript">
	document.body.id='tab5';
</script>

<ul id="tabnav">
	<li class="tab1"><a href="./config.php?section=edit">Datenbank</a></li>
	<li class="tab2"><a href="./config.php?section=edit_netmon">Netmon</a></li>
	<li class="tab3"><a href="./config.php?section=edit_community">Community</a></li>
	<li class="tab4"><a href="./config.php?section=edit_email">Email</a></li>
	<li class="tab5"><a href="./config.php?section=edit_jabber">Jabber</a></li>
	<li class="tab6"><a href="./config.php?section=edit_twitter">Twitter</a></li>
	<li class="tab7"><a href="./config.php?section=edit_hardware">Hardware</a></li>
</ul>

<h1>Jabber Konfiguration</h1>
<form action="./config.php?section=insert_edit_jabber" method="POST">
	<p>Jabber Server:<br><input name="jabber_server" type="text" size="30" value="{$jabber_server}"></p>
	<p>Jabber Username:<br><input name="jabber_username" type="text" size="30" value="{$jabber_username}"></p>
	<p>Jabber Passwort:<br><input name="jabber_password" type="password" size="30" value="{$jabber_password}"></p>

	<p><input type="submit" value="Absenden"></p>
</form>