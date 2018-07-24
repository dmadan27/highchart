<?php
	// inisialisasi get data tahun dan bulan
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

	// pecah data wika untuk filter sesuai dengan mapping perusahaan
	foreach ($data_wika as $value) {
		$tempDate = $value['Create'];

		$date = substr($tempDate,0,-8);
		$month = substr($date,5,-4);
		$year = $value["Tahun"];

		$company = $value['Company'];
		$status = $value['Status'];
		$rkap = $value['RKAP'];
		$diperoleh = $value['Diperoleh'];

		// jika bulan lebih kecil sama dengan get bulan
		if($value['Tactic'] && $month <= $get_bulan){
			// pecah anak perusahaan untuk difilter
			foreach($temp_anak_perusahaan as $key => $row){
				// jika ada yg sesuai dgn anak perusahaan
				if($company == $row['company']){
					$anak_perusahaan[$key]['jumlah_proyek']++;
					if($status == 'Terendah' || $status == 'Terkontrak')
						$anak_perusahaan[$key]['jumlah_terendah_terkontrak']++;
				}

				if($anak_perusahaan[$key]['jumlah_terendah_terkontrak'] > 0){
					$anak_perusahaan[$key]['ci_jumlah'] = $anak_perusahaan[$key]['jumlah_terendah_terkontrak']/$anak_perusahaan[$key]['jumlah_proyek']*100;
				}
				
			}
		}
	}

	// inisialisasi var untuk data bar
	$data_jumlah_proyek = $data_jumlah_nilai = array();
	$categories = array();

	// inisialisasi var untuk total_highchart dan data di legend
	$total_jumlah_penawaran = $total_jumlah_terendah_terkontrak = 0;

	// pecah anak perusahaan untuk passing data
	foreach ($anak_perusahaan as $key => $value) {
		$dataValue_jumlah_proyek = $dataValue_jumlah_terendah_terkontrak = array();
		$dataValue_categories = array();

		// passing data jumlah proyek
		$dataValue_jumlah_proyek['id'] = $value['company'];
		$dataValue_jumlah_proyek['jenis'] = 'jumlah_proyek';
		$dataValue_jumlah_proyek['y'] = $value['jumlah_proyek'];

		// passing data jumlah terendah terkontrak
		$dataValue_jumlah_terendah_terkontrak['id'] = $value['company'];
		$dataValue_jumlah_terendah_terkontrak['jenis'] = 'Terendah';
		$dataValue_jumlah_terendah_terkontrak['y'] = $value['jumlah_terendah_terkontrak'];

		// passing label
		$dataValue_categories['name'] = 'CI='.number_format($value['ci_jumlah'],2,',',',').'%';
		$dataValue_categories['categories'] = array($value['name']);

		// hitung data total jumlah penawaran, terendah-terkontrak
		$total_jumlah_penawaran += $value['jumlah_proyek'];
		$total_jumlah_terendah_terkontrak += $value['jumlah_terendah_terkontrak'];

		$data_jumlah_proyek[] = $dataValue_jumlah_proyek;
		$data_jumlah_nilai[] = $dataValue_jumlah_terendah_terkontrak;
		$categories[] = $dataValue_categories;
	}

	// passing data total rkap, terendah dan terkontrak ke legend
	$legend_highchart = array(
		'jumlah_penawaran' => '<b>Jumlah Penawaran : '.$total_jumlah_penawaran.'</b>',
		'terendah_terkontrak' => '<b> Terendah & Terkontrak : '.$total_jumlah_terendah_terkontrak.'</b>',
	);

	// output yg akan dikirim ke highchart
	$output = array(
		'xAxis' => array(
			'categories' => $categories,
		),
		'series' => array(
			// data rkap
			array(
				'name' => 'Jumlah Proyek',
				'data' => $data_jumlah_proyek,
				'point' => '',
				'color' => '#8e8eb7',
			),
			// data terendah
			array(
				'name' => 'Terendah & Terkontrak',
				'data' => $data_jumlah_nilai,
				'point' => '',
				'color' => '#eeaf4b',
			),
		),
		'legend_highchart' => $legend_highchart,
	);

	echo json_encode($output);
