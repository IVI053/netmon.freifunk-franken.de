<?php

// +---------------------------------------------------------------------------+
// index.php
// Netmon, Freifunk Netzverwaltung und Monitoring Software
//
// Copyright (c) 2009 Clemens John <clemens-john@gmx.de>
// +---------------------------------------------------------------------------+
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 3
// of the License, or any later version.
// +---------------------------------------------------------------------------+
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
// +---------------------------------------------------------------------------+/

/**
 * This file contains a class with many helpfull methods used for editing.
 *
 * @author	Clemens John <clemens-john@gmx.de>
 * @version	0.1
 * @package	Netmon Freifunk Netzverwaltung und Monitoring Software
 */

require_once($path.'lib/classes/core/subnetcalculator.class.php');

class Interfaces {

	public function addNewInterface() {
		try {
			DB::getInstance()->exec("INSERT INTO interfaces (router_id, project_id, create_date, name, ipv4_addr, ipv6_addr)
						 VALUES ('$_GET[router_id]', '$_POST[project_id]', NOW(), '$_POST[name]', '$_POST[ipv4_addr]', '$_POST[ipv6_addr]');");
			$interface_id = DB::getInstance()->lastInsertId();
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getInterfaceByInterfaceId($interface_id) {
		try {
			$sql = "SELECT  *
					FROM interfaces
				WHERE id='$interface_id'";
			$result = DB::getInstance()->query($sql);
			$interface = $result->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $interface;
	}

	public function getInterfacesByRouterId($router_id) {
		$interfaces = array();
		try {
			$sql = "SELECT  interfaces.id as interface_id, interfaces.router_id, interfaces.project_id, interfaces.create_date, interfaces.name, interfaces.mac_addr, interfaces.ipv4_addr, interfaces.ipv6_addr,
					projects.title, projects.is_wlan, projects.wlan_essid, projects.wlan_bssid, projects.wlan_channel, projects.is_vpn, projects.vpn_server, projects.vpn_server_port, projects.vpn_server_device, projects.vpn_server_proto, projects.vpn_server_ca_crt, projects.vpn_server_ca_key, projects.vpn_server_pass, projects.is_ccd_ftp_sync, projects.ccd_ftp_folder, projects.ccd_ftp_username, projects.ccd_ftp_password, projects.is_olsr, projects.is_batman_adv, projects.ipv, projects.ipv4_host, projects.ipv4_netmask, projects.ipv4_dhcp_kind
					FROM interfaces
					LEFT JOIN projects on (projects.id=interfaces.project_id)
				WHERE router_id='$router_id'
				ORDER BY interfaces.name asc";
			$result = DB::getInstance()->query($sql);
			foreach($result as $row) {
				if($row['ipv']=='ipv4') {
					$row['ipv4_netmask_dot'] = SubnetCalculator::getNmask($row['ipv4_netmask']);
					$row['ipv4_bcast'] = SubnetCalculator::getDqBcast($GLOBALS['net_prefix'].".".$row['ipv4_host'], $row['ipv4_netmask']);
				 }
				$interfaces[] = $row;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $interfaces;
	}

	public function getIPv4InterfacesByRouterId($router_id) {
		$interfaces = array();
		try {
			$sql = "SELECT  interfaces.id as interface_id, interfaces.router_id, interfaces.project_id, interfaces.create_date, interfaces.name, interfaces.mac_addr, interfaces.ipv4_addr, interfaces.ipv6_addr,
					projects.title, projects.is_wlan, projects.wlan_essid, projects.wlan_bssid, projects.wlan_channel, projects.is_vpn, projects.vpn_server, projects.vpn_server_port, projects.vpn_server_device, projects.vpn_server_proto, projects.vpn_server_ca_crt, projects.vpn_server_ca_key, projects.vpn_server_pass, projects.is_ccd_ftp_sync, projects.ccd_ftp_folder, projects.ccd_ftp_username, projects.ccd_ftp_password, projects.is_olsr, projects.is_batman_adv, projects.ipv, projects.ipv4_host, projects.ipv4_netmask, projects.ipv4_dhcp_kind
					FROM interfaces
					LEFT JOIN projects on (projects.id=interfaces.project_id)
				WHERE router_id='$router_id' AND projects.ipv='ipv4'
				ORDER BY interfaces.name asc";
			$result = DB::getInstance()->query($sql);
			foreach($result as $row) {
				if($row['ipv']=='ipv4') {
					$row['ipv4_netmask_dot'] = SubnetCalculator::getNmask($row['ipv4_netmask']);
					$row['ipv4_bcast'] = SubnetCalculator::getDqBcast($GLOBALS['net_prefix'].".".$row['ipv4_host'], $row['ipv4_netmask']);
				 }
				$interfaces[] = $row;
			}
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $interfaces;
	}

	public function deleteInterface($interface_id) {
		$interface_data = Interfaces::getInterfaceByInterfaceId($interface_id);

		//Delete Interface
		try {
			DB::getInstance()->exec("DELETE FROM interfaces WHERE id='$interface_id';");
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}

		$message[] = array("Das Interface $interface_data[name] wurde entfernt.",1);
		Message::setMessage($message);
		return true;
	}

	public function getInterfaceCrawlByCrawlCycleAndRouterIdAndInterfaceName($crawl_cycle_id, $router_id, $interface_name) {
		try {
			$sql = "SELECT  *
					FROM crawl_interfaces
				WHERE 	crawl_cycle_id='$crawl_cycle_id' AND router_id='$router_id' AND name='$interface_name'";
			$result = DB::getInstance()->query($sql);
			$interface = $result->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $interface;
	}

}

?>