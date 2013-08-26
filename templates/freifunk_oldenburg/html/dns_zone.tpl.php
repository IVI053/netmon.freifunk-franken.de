<script src="lib/extern/jquery/jquery.min.js"></script>
<script src="lib/extern/DataTables/jquery.dataTables.min.js"></script>
<script src="lib/extern/DataTables/jquery.dataTables.Plugin.DateSort.js"></script>

<script type="text/javascript">
{literal}
$(document).ready(function() {
	$('#dns_ressource_record_list').dataTable( {
		"bFilter": false,
		"bInfo": false,
		"bPaginate": false,
		"aoColumns": [ 
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "html" },
			{ "sType": "date-eu" },
			{ "sType": "date-eu" },
			{ "sType": "string" }
		],
		"aaSorting": [[ 0, "desc" ]]
	} );
} );
{/literal}
</script>

<h1>DNS-Zone <i>{$dns_zone->getName()}</i></h1>
Hier erfährst du alles über die DNS-Zone <i>{$dns_zone->getName()}</i>.

<h2>Daten</h2>
<div>
	<div style="float:left; width:35%;">
		<p>
			<b>Name:</b> {$dns_zone->getName()}<br>
			<b>Primary DNS:</b> {$dns_zone->getPriDns()}<br>
			<b>Secondary DNS:</b> {$dns_zone->getSecDns()}<br>
			<b>Serial:</b> {$dns_zone->getSerial()}<br>
		</p>
	</div>
	<div style="float:left; width:65%;">
		<p>
			<b>Refresh:</b> {$dns_zone->getRefresh()}<br>
			<b>Retry:</b> {$dns_zone->getRetry()}<br>
			<b>Expire:</b> {$dns_zone->getExpire()}<br>
			<b>TTL:</b> {$dns_zone->getTtl()}<br>
		</p>
	</div>
</div>
<br style="clear: both;">

<h2>Ressource Records</h2>
{if !empty($dns_ressource_record_list)}
	<table class="display" id="dns_ressource_record_list" style="width: 100%;">
		<thead>
			<tr>
				<th>Host</th>
				<th>Type</th>
				<th>Destination</th>
				<th>Pri</th>
				<th>Benutzer</th>
				<th>Erstellt</th>
				<th>Letztes Update</th>
				<th>Aktionen</th>
			</tr>
		</thead>
		<tbody>
			{foreach item=dns_ressource_record from=$dns_ressource_record_list}
				<tr>
					<td>{$dns_ressource_record->getHost()}.{$dns_zone->getName()}</td>
					<td>{$dns_ressource_record->getType()}</td>
					<td>
						{if $dns_ressource_record->getType() == 'A' OR $dns_ressource_record->getType() == 'AAAA'}
							{$dns_ressource_record->getDestination()->getIp()}
						{else}
							{$dns_ressource_record->getDestinationId()}
						{/if}
					</td>
					<td>{$dns_ressource_record->getPri()}</td>
					<td><a href="./user.php?user_id={$dns_ressource_record->getUser()->getUserId()}">{$dns_ressource_record->getUser()->getNickname()}</a></td>
					<td>{$dns_ressource_record->getCreateDate()|date_format:"%d.%m.%Y"}</td>
					<td>{$dns_ressource_record->getUpdateDate()|date_format:"%d.%m.%Y %H:%M"}</td>
					<td><a href="./dns_ressource_record.php?section=delete&dns_ressource_record_id={$dns_ressource_record->getDnsRessourceRecordId()}">Löschen</a></td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{else}
	<p>Keine DNS Ressource Records eingetragen.</p>
{/if}

<h2>Ressource Record hinzufügen</h2>
<p><a href="./dns_ressource_record.php?section=add&dns_zone_id={$dns_zone->getDnsZoneId()}">Einen neuen Ressource Record hinzufügen</a></p>