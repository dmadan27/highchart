<?php
	// inisialisasi get data post dari client
	$get_company = isset($_POST['company']) ? $_POST['company'] : false;
	$get_jenis = isset($_POST['jenis']) ? $_POST['jenis'] : false;
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;

	// load list anak perusahaan
	require_once '../assets/list_anak_perusahaan.php';

	// get data wika
	$get_data = file_get_contents("https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun=".$get_tahun."&company=yes");

	// encode data wika menjadi array biasa
	$data_wika = json_decode($get_data, true);

	// passing data
	$temp_anak_perusahaan = $anak_perusahaan;

	$data = array();
	$total = 0;

	// pecah data wika untuk filter sesuai dengan mapping perusahaan
	foreach ($data_wika as $value) {
		$tempDate = $value['Create'];

		$date = substr($tempDate,0,-8);
		$month = substr($date,5,-4);
		$year = $value["Tahun"];

		$company = $value['Company'];
		$proyek = $value['Title'];
		$status = $value['Status'];
		$rkap = $value['RKAP'];
		$diperoleh = $value['Diperoleh'];

		// jika bulan lebih kecil sama dengan get bulan
		if($month <= $get_bulan){
			// pecah anak perusahaan untuk difilter
			foreach($temp_anak_perusahaan as $key => $row){
				// jika ada yg sesuai dgn anak perusahaan
				if($get_company == $row['company']){
					if($get_jenis == 'RKAP'){
						$dataRow = array();
						$dataRow['title'] = $proyek;
						$dataRow['keterangan'] = $status;
						$dataRow['nilai'] = number_format($rkap, 0, ',', '.');

						$data[] = $dataRow;
						$total += $rkap;
					}
					else if($get_jenis == 'Terendah' && $status == $get_jenis){
						$dataRow = array();
						$dataRow['title'] = $proyek;
						$dataRow['keterangan'] = $status;
						$dataRow['nilai'] = number_format($diperoleh, 0, ',', '.');

						$data[] = $dataRow;
						$total += $diperoleh;
					}
					else if($get_jenis == 'Terkontrak' && $status == $get_jenis){
						$dataRow = array();
						$dataRow['title'] = $proyek;
						$dataRow['keterangan'] = $status;
						$dataRow['nilai'] = number_format($diperoleh, 0, ',', '.');

						$data[] = $dataRow;
						$total += $diperoleh;	
					}

				}
				// sum terendah + terkontrak
				$anak_perusahaan[$key]['sum_terendah_terkontrak'] = $anak_perusahaan[$key]['terendah'] + $anak_perusahaan[$key]['terkontrak'];
			}
		}
	}

	$label_total = ($get_jenis == 'RKAP') ? 'Total RKAP: '.number_format($total, 0, ',', '.') : 'Total Diperoleh: '.number_format($total, 0, ',', '.');

	$output = array(
		'data' => $data,
		'total' => $label_total,
	);

	echo json_encode($output);