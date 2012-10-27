<script type="text/javascript">
	document.body.id='tab7';
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

<h1>Konfiguration der Hardware Chipsets</h1>
<h2>Vorhandene Chipsets</h2>
<table class="display" id="routerlist">
	<thead>
		<tr>
			<th>Chipset</th>
			<th>Name</th>
			<th>Erstellt</th>
			<th>Aktionen</th>
		</tr>
	</thead>
	<tbody>
		{foreach key=count item=chipset from=$chipsets_with_name}
			<tr>
				<td>{$chipset.name}</td>
				<td>{$chipset.hardware_name}</td>
				<td>{$chipset.create_date|date_format:"%d.%m.%Y %H:%M"} Uhr</td>
				<td><a href="./config.php?section=edit_hardware_name&chipset_id={$chipset.id}">Editieren</a></td>
			</tr>
		{/foreach}
	</tbody>
</table>


<h2>Nicht Zugewiesene Chipsets</h2>
<table class="display" id="routerlist">
	<thead>
		<tr>
			<th>Chipset</th>
			<th>Erstellt</th>
			<th>Aktionen</th>
		</tr>
	</thead>
	<tbody>
		{foreach key=count item=chipset from=$chipsets_without_name}
			<tr>
				<td>{$chipset.name}</td>
				<td>{$chipset.create_date|date_format:"%d.%m.%Y %H:%M"} Uhr</td>
				<td><a href="./config.php?section=edit_hardware_name&chipset_id={$chipset.id}">Editieren</a></td>
			</tr>
		{/foreach}
	</tbody>
</table>