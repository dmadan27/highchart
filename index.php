<?php
	date_default_timezone_set('Asia/Jakarta');
	// define("BASE_PATH", true);

	// inisilisasi var $_GET
	$get_chart = isset($_GET['chart']) ? $_GET['chart'] : false;

	/**
	* List $_GET['chart']
	* chart1 => mengarah ke folder chart1/chart.php - chart ok terendah dan terkontrak
	* chart2 => mengarah ke folder chart2/chart.php - jo vs non jo
	* chart3 => mengarah ke folder chart3/chart.php - sumber dana
	* chart4 => mengarah ke folder chart4/chart.php - jumlah proyek
	* chart5 => mengarah ke folder chart5/chart.php - nilai proyek
	* chart6 => mengarah ke folder chart6/chart.php - pemberi kerja
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
			$get_company = isset($_GET['company']) ? $_GET['company'] : false;
			// require file layout
			require_once $filename;
		} 
			
	}
