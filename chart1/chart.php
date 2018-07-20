<?php 
	// inisialisasi get data tahun dan bulan
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;

	// mapping anak perusahaan
	$anak_perusahaan = array(
		array(
			'company' => '4547d242-0ed5-4d09-ac37-420e5e19a703',
			'name' => 'Witon (Wika Beton)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		array(
			'company' => 'c0b9186f-75d6-4865-b0f3-890d7db8fa2e',
			'name' => 'Wikon',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		array(
			'company' => '514f7570-0c8f-4589-9368-69465c8b5ed2',
			'name' => 'WR (Wika Realty)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		array(
			'company' => '8d6255cb-1067-4ac9-a9bf-9c086363267',
			'name' => 'WG (Wika Gedung)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		// ganti
		array(
			'company' => '9c791f07-bf39-4186-a317-7965e547dde7',
			'name' => 'Wijaya Karya',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		array(
			'company' => '73bf37c7-8bde-4678-92d7-1b9882bbd1a4',
			'name' => 'Bitumen',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
		array(
			'company' => 'cc7c5a60-2e2a-424e-852b-562bbf0a239d',
			'name' => 'Serpan',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum_terendah_terkontrak' => 0,
		),
	);

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
		if($month <= $get_bulan){
			// pecah anak perusahaan untuk difilter
			foreach($temp_anak_perusahaan as $key => $row){
				// jika ada yg sesuai dgn anak perusahaan
				if($company == $row['company']){
					$anak_perusahaan[$key]['rkap'] += $rkap;
					if($status == 'Terendah') $anak_perusahaan[$key]['terendah'] += $diperoleh;
					if($status == 'Terkontrak') $anak_perusahaan[$key]['terkontrak'] += $diperoleh;
				}
				// sum terendah + terkontrak
				$anak_perusahaan[$key]['sum_terendah_terkontrak'] = $anak_perusahaan[$key]['terendah'] + $anak_perusahaan[$key]['terkontrak'];
			}
		}
	}

	// inisialisasi var untuk data bar
	$data_rkap = $data_terendah = array();
	$data_terkontrak = $categories = array();
	
	// pecah anak perusahaan untuk passing data
	foreach ($anak_perusahaan as $key => $value) {
		$dataValue_rkap = $dataValue_terendah = $dataValue_terkontrak = array();

		// passing data id
		$dataValue_rkap['id'] = $dataValue_terendah['id'] = $dataValue_terkontrak['id'] = $value['company'];

		// passing data nilai
		$dataValue_rkap['y'] = $value['rkap']/1000000;
		$dataValue_terendah['y'] = $value['terendah']/1000000;
		$dataValue_terkontrak['y'] = $value['terkontrak']/1000000;
		
		// passing label
		$categories[] = $value['name'].' | Diperoleh : '.$value['sum_terendah_terkontrak'].' T';

		
		
		$data_rkap[] = $dataValue_rkap;
		$data_terendah[] = $dataValue_terendah;
		$data_terkontrak[] = $dataValue_terkontrak;
	}

	// output yg akan dikirim ke highchart
	$output = array(
		'xAxis' => array(
			'categories' => $categories,
		),
		'series' => array(
			// data rkap
			array(
				'name' => 'RKAP',
				'data' => $data_rkap,
				'point' => '',
				'color' => '#ed7d64',
			),
			// data terendah
			array(
				'name' => 'Terendah',
				'data' => $data_terendah,
				'point' => '',
				'color' => '#64b8df',
			),
			// data terkontrak
			array(
				'name' => 'Terkontrak',
				'data' => $data_terkontrak,
				'point' => '',
				'color' => '#8ecb60',
			),
		),
		'total-highchart' => ,
		'legend-highchart' => ,
	);

	echo json_encode($output);