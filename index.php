<?php
	// inisilisasi var $_GET
	$get_chart = isset($_GET['chart']) ? $_GET['chart'] : false;

	// cek $_GET
	if(!$get_chart) die('Pastikan URL Anda Benar');
	else{
		switch (strtolower($get_chart)) {
			case 'chart1':
				# code...
				break;

			case 'chart1':
				# code...
				break;

			case 'chart1':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}