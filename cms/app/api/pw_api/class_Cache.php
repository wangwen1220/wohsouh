<?php

!defined('RUN_CMSTOP') && exit('Forbidden');
//api mode 10
//cmstopľ�л��ְ�
class Cache {

	var $base;
	var $db;

	function Cache($base) {
		$this->base = $base;
		$this->db = $base->db;
	}

	function updatesyncredit($syncredit) {
		return new ApiResponse(1);
	}
}