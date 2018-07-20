<?php
	date_default_timezone_set('Asia/Jakarta');
	// define("BASE_PATH", true);

	// inisilisasi var $_GET
	$get_chart = isset($_GET['chart']) ? $_GET['chart'] : false;

	/**
	* List $_GET['chart']
	* chart1 => mengarah ke folder chart1/chart.php
	* chart2 => mengarah ke folder chart2/chart.php
	* chart3 => mengarah ke folder chart3/chart.php
	* chart4 => mengarah ke folder chart4/chart.php
	* chart5 => mengarah ke folder chart5/chart.php
	*/

	// cek $_GET
	if(!$get_chart) 
		die('Pastikan URL Anda Benar');
	else{
		$filename = strtolower($get_chart).'/index.php';

		// cek request ada filenya atau tidak 
		if(!file_exists($filename)) 
			die('Terjadi Kesalahan Sistem');
		else{
			// require file layout
			require_once $filename;
		} 
			
	}
