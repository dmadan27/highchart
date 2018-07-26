<?php 
	// inisialisasi get data tahun dan bulan
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;
	// $get_tahun = '2018';
	// $get_bulan = '07';
	$get_company = isset($_POST['company']) ? $_POST['company'] : false;

	// load list anak perusahaan
	require_once '../assets/list_anak_perusahaan.php';

	// get data wika
	$get_data = file_get_contents("https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun=".$get_tahun."&company=yes");

	// encode data wika menjadi array biasa
	$data_wika = json_decode($get_data, true);

	// $temp_anak_perusahaan = $anak_perusahaan;

	foreach ($anak_perusahaan as $key => $value) {
		if($get_company == $key){
			$nama = $value['name'];
			$company_ = $value['company'];
		}
	}	

	$group = array();

	foreach($data_wika as $value){
		$tempDate = $value['Create'];

		$date = substr($tempDate,0,-8);
		$month = substr($date,5,-4);
		$year = $value["Tahun"];

		$company = $value['Company'];
		$status = $value['Status'];
		$sumber = $value['Sumber'];
		$rkap = $value['RKAP'];
		$diperoleh = number_format($value['Diperoleh']/1000000, 4);

		if(($month <= $get_bulan)){
			if($company == $company_){
				if($sumber && $sumber != '-'){
					$temp_sumber = $sumber;
					if(!isset($group[$temp_sumber])){
						if($status == 'Terendah'){
							$group[$temp_sumber]['Terendah'] = $diperoleh;
							$group[$temp_sumber]['Terkontrak'] = 0;
							$group[$temp_sumber]['sum'] = $group[$temp_sumber]['Terendah'] + $group[$temp_sumber]['Terkontrak'];
						}

						if($status == 'Terkontrak'){
							$group[$temp_sumber]['Terendah'] = 0;
							$group[$temp_sumber]['Terkontrak'] = $diperoleh;
							$group[$temp_sumber]['sum'] = $group[$temp_sumber]['Terendah'] + $group[$temp_sumber]['Terkontrak'];	
						}

					}
					else{
						if($status == 'Terendah'){
							$group[$temp_sumber]['Terendah'] += $diperoleh;
						}

						if($status == 'Terkontrak'){
							$group[$temp_sumber]['Terkontrak'] += $diperoleh;	
						}

						$group[$temp_sumber]['sum'] = $group[$temp_sumber]['Terendah'] + $group[$temp_sumber]['Terkontrak'];
					}
				}			
			}
		}
	}

	$data_terendah = $data_terkontrak = array();
	$kategori = array();
	$kategori['name'] = $nama;

	$total_diperoleh = $total_terendah = $total_terkontrak = 0;

	foreach($group as $key => $value){
		$dataValue_terendah = $dataValue_terkontrak = array();

		$kategori['categories'][] = $key.'<br>Total : '.number_format($value['sum'], 2, ',', ',');

		$dataValue_terendah[$key]['id'] = $company_;
		$dataValue_terendah[$key]['jenis'] = 'Terendah';
		$dataValue_terendah[$key]['sumber'] = $key;
		$dataValue_terendah[$key]['y'] = floatval($value['Terendah']);

		$dataValue_terkontrak[$key]['id'] = $company_;
		$dataValue_terkontrak[$key]['jenis'] = 'Terkontrak';
		$dataValue_terkontrak[$key]['sumber'] = $key;
		$dataValue_terkontrak[$key]['y'] = floatval($value['Terkontrak']);

		$total_diperoleh += $value['Terendah']+$value['Terkontrak'];
		$total_terendah += $value['Terendah'];
		$total_terkontrak += $value['Terkontrak'];

		$data_terendah[] = $dataValue_terendah;
		$data_terkontrak[] = $dataValue_terkontrak;		
	}

	$data_terendah_filter = $data_terkontrak_filter = array();
	$combine_terendah = $combine_terkontrak = $list_kategori = array();
	
	for($i=0; $i<count($data_terendah); $i++){
		$data_terendah_filter[$i] = isset($data_terendah[$i]) ? array_values(array_filter($data_terendah[$i])) : array();
		$data_terkontrak_filter[$i] = isset($data_terkontrak[$i]) ? array_values(array_filter($data_terkontrak[$i])) : array();

		$combine_terendah = array_merge($combine_terendah, $data_terendah_filter[$i]);
		$combine_terkontrak = array_merge($combine_terkontrak, $data_terkontrak_filter[$i]);
	}

	$legend_highchart = array(
		'terendah' => '<b>Terendah : '.number_format($total_terendah, 2, ',', ',').' T</b>',
		'terkontrak' => '<b>Terkontrak : '.number_format($total_terkontrak, 2, ',', ',').' T</b>',
	);

	$output = array(
		'data' => $group,
		'data_kategori' => array_values(array($kategori)),
		'series' => array(
			// data terendah
			array(
				'name' => 'Terendah',
				'data' => $combine_terendah,
				'point' => '',
				'color' => '#64b8df',
			),
			// data terkontrak
			array(
				'name' => 'Terkontrak',
				'data' => $combine_terkontrak,
				'point' => '',
				'color' => '#8ecb60',
			),
		),
		'total_diperoleh' => '<b>Total Diperoleh : '.number_format($total_diperoleh, 2, ',', ',').' T</b>',
		'legend_highchart' => $legend_highchart,
	);

	echo json_encode($output);