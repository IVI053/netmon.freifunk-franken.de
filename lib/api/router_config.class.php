<?php

require_once($path.'lib/core/subnetcalculator.class.php');
require_once($path.'lib/core/user.class.php');

class RouterConfig {
	public function getIpDataByIpId($ip_id){
		return(Helper::getIpDataByIpId($ip_id));
	}

	public function getSubnetById($subnet_id){
		return(Helper::getSubnetById($subnet_id));
	}

	public function getIpIdByIp($ip){
		return(Helper::getIpIdByIp($ip));
	}

	public function getPlublicUserInfoByID($ip){
		return(User_old::getPlublicUserInfoByID($ip));
	}

	public function getCommunityInfo() {
		return array('net_prefix'=>$GLOBALS['net_prefix'], 'community_name'=>$GLOBALS['community_name'], 'community_website'=>$GLOBALS['community_website']);
	}

	public function getDqNetmaskByCdr($cdr_nmask) {
		return SubnetCalculator::getNmask($cdr_nmask);
	}
}

?>