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
		$nilaitactic = $value['Tactic'];
		$diperoleh = $value['Diperoleh'];
		$ci_nilai = $value['CI_Nilai'];


		// jika bulan lebih kecil sama dengan get bulan
		if($month <= $get_bulan){
			// pecah anak perusahaan untuk difilter
			foreach($temp_anak_perusahaan as $key => $row){
				// jika ada yg sesuai dgn anak perusahaan
				if($company == $row['company']){
					$anak_perusahaan[$key]['nilai_tactic'] += $nilaitactic;

					if($status == 'Terendah' || $status == 'Terkontrak') $anak_perusahaan[$key]['diperoleh'] += $diperoleh;

				}
				// CI_Nilai persentase = (terendah + terkontrak) / Jumlah Proyek * 100)
				$anak_perusahaan[$key]['ci_nilai'] = $anak_perusahaan[$key]['nilai_tactic'] / $anak_perusahaan[$key]['diperoleh'] * 100;
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

		// passing data nilai
		$dataValue_rkap['y'] = $value['rkap']/1000000;
		$dataValue_terendah['y'] = $value['terendah']/1000000;
		$dataValue_terkontrak['y'] = $value['terkontrak']/1000000;
		
		// passing label
		$categories[] = $value['name'].' | CI = '.$value['sum_terendah_terkontrak'].' %';

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
		'rkap' => '<b>Jumlah Nilai Proyek : '.number_format($total_rkap/1000000, 2, ',', ',').' T</b>',
		'terendah' => '<b>Jumlah Nilai Terendah & Terkontrak : '.number_format($total_terendah/1000000, 2, ',', ',').' T</b>',
		'terkontrak' => '<b> Terkontrak : '.number_format($total_terkontrak/1000000, 2, ',', ',').' T</b>',
	);

	// output yg akan dikirim ke highchart
	$output = array(
		'xAxis' => array(
			'categories' => $categories,
		),
		'series' => array(
			// data Nilai Proyek
			array(
				'name' => 'Nilai Proyek',
				'data' => $data_rkap,
				'point' => '',
				'color' => '#8e8eb7',
			),	
			// data terendah
			array(
				'name' => 'Nilai Terendah & Terkontrak',
				'data' => $data_terendah,
				'point' => '',
				'color' => '#eeaf4b',
			),
			// data terkontrak
			// array(
			// 	'name' => 'Terkontrak',
			// 	'data' => $data_terkontrak,
			// 	'point' => '',
			// 	'color' => '#8ecb60',
			// ),
		),
		'total_highchart' => 'Total Diperoleh : '.number_format($total_sum_terendah_terkontrak, 2, ',', ','),
		'legend_highchart' => $legend_highchart,
	);

	echo json_encode($output);