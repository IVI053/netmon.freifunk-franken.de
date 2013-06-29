<script src="lib/classes/extern/jquery/jquery.min.js"></script>
<script src="lib/classes/extern/DataTables/jquery.dataTables.min.js"></script>

<script type="text/javascript">
{literal}
$(document).ready(function() {
	$('#routerlist').dataTable( {
		"bFilter": false,
		"bInfo": false,
		"bPaginate": false,
		"aoColumns": [ 
			{ "sType": "html" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "string" },
			{ "sType": "html" },
			{ "sType": "string" }, // zuverlässigkeit need own
			{ "sType": "numeric" },
			{ "sType": "numeric" },
			{ "sType": "numeric" }
		],
		"aaSorting": [[ 7, "desc" ]]
	} );
} );
{/literal}
</script>

<h1>Liste der Router</h1>
{if !empty($routerlist)}
	<table class="display" id="routerlist" style="width: 100%;">
		<thead>
			<tr>
				<th>Hostname</th>
				<th>O</th>
				<th>Stand</th>
				<th>Technik</th>
				<th>Benutzer</th>
				<th>Online</th>
				<th>Up (Std.)</th>
				<th>Clients</th>
				<th>Traffic</th>
			</tr>
		</thead>
		<tbody>
			{foreach key=count item=router from=$routerlist}
				<tr>
					<td><a href="./router_status.php?router_id={$router.router_id}">{$router.hostname}</a></td>
					<td>
						{if $router.actual_crawl_data.status=="online"}
							<img src="./templates/{$template}/img/ffmap/status_up_small.png" title="online" alt="online">
						{elseif $router.actual_crawl_data.status=="offline"}
							<img src="./templates/{$template}/img/ffmap/status_down_small.png" title="offline" alt="offline">
						{elseif $router.actual_crawl_data.status=="unknown"}
							<img src="./templates/{$template}/img/ffmap/status_unknown_small.png" title="unknown" alt="unknown">
						{/if}
					</td>
					<td>{$router.actual_crawl_data.crawl_date|date_format:"%H:%M"} Uhr</td>
					<td>{if !empty($router.hardware_name)}{$router.hardware_name}{else}{$router.short_chipset_name}{if $router.short_chipset_name!=$router.chipset_name}...{/if}{/if}</td>
					<td><a href="./user.php?user_id={$router.user_id}">{$router.nickname}</a></td>
					<td value="{math equation='round(x,1)' x=$router.router_reliability.online_percent}">{math equation="round(x,1)" x=$router.router_reliability.online_percent}%</td>
					<td>{math equation="round(x,1)" x=$router.actual_crawl_data.uptime/60/60}</td>
					<td>{$router.actual_crawl_data.client_count}</td>
					<td>{$router.traffic}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{else}
<p>Keine Router vorhanden.</p>
{/if}