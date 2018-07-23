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
	
	// inisialisasi var untuk total_highchart dan data di legend
	$total_sum_terendah_terkontrak = $total_rkap = 0;
	$total_terendah = $total_terkontrak = 0;

	// pecah anak perusahaan untuk passing data
	foreach ($anak_perusahaan as $key => $value) {
		$dataValue_rkap = $dataValue_terendah = $dataValue_terkontrak = array();

		// passing data id
		$dataValue_rkap['id'] = $dataValue_terendah['id'] = $dataValue_terkontrak['id'] = $value['company'];

		// passing data jenis
		$dataValue_rkap['jenis'] = 'RKAP';
		$dataValue_terendah['jenis'] = 'Terendah';
		$dataValue_terkontrak['jenis'] = 'Terkontrak';		

		// passing data nilai
		$dataValue_rkap['y'] = $value['rkap']/1000000;
		$dataValue_terendah['y'] = $value['terendah']/1000000;
		$dataValue_terkontrak['y'] = $value['terkontrak']/1000000;
		
		// passing label
		$categories[] = $value['name'].' | Diperoleh : '.$value['sum_terendah_terkontrak'].' T';

		// passing data total-highchart
		$total_sum_terendah_terkontrak += $value['sum_terendah_terkontrak']; 
		
		// hitung data total rkap, terendah dan terkontrak
		$total_rkap += $value['rkap'];
		$total_terendah += $value['terendah'];
		$total_terkontrak += $value['terkontrak'];

		$data_rkap[] = $dataValue_rkap;
		$data_terendah[] = $dataValue_terendah;
		$data_terkontrak[] = $dataValue_terkontrak;
	}

	// passing data total rkap, terendah dan terkontrak ke legend
	$legend_highchart = array(
		'rkap' => '<b>RKAP : '.number_format($total_rkap/1000000, 2, ',', ',').' T</b>',
		'terendah' => '<b> Terendah : '.number_format($total_terendah/1000000, 2, ',', ',').' T</b>',
		'terkontrak' => '<b> Terkontrak : '.number_format($total_terkontrak/1000000, 2, ',', ',').' T</b>',
	);

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
		'total_highchart' => 'Total Diperoleh : '.number_format($total_sum_terendah_terkontrak, 2, ',', ',').' T',
		'legend_highchart' => $legend_highchart,
	);

	echo json_encode($output);