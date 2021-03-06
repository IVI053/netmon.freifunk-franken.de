<?php

require_once('lib/core/interfaces.class.php');
require_once('lib/core/router.class.php');
require_once('lib/core/user.class.php');

class Main {
	public function public_user_info($user_id) {
		return(User_old::getPlublicUserInfoByID($user_id));
	}

	public function subnet_info($subnet_id) {
		return(Helper::getSubnetById($subnet_id));
	}

	public function crawler_config() {
		return array('crawl_cycle' => $GLOBALS['crawl_cycle']);
	}

	public function getAllServiceIDsByServiceType($type) {
		return(Helper::getAllServiceIDsByServiceType($type));
	}
}

?>