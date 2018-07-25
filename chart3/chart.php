<?php 
	// inisialisasi get data tahun dan bulan
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;
	$get_company = isset($_POST['company']) ? $_POST['company'] : false;

	// load list anak perusahaan
	require_once '../assets/list_anak_perusahaan.php';

	// get data wika
	$get_data = file_get_contents("https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun=".$get_tahun."&company=yes");

	// encode data wika menjadi array biasa
	$data_wika = json_decode($get_data, true);

	foreach ($anak_perusahaan as $key => $value) {
		if($get_company == $key){
			$nama = $value['name'];
			$company_ = $value['company'];
		}
	}

	$groups = $groups_ = $kategori = array();

	$total = $total_a = $total_b = 0;

	// pecah data wika untuk filter sesuai dengan mapping perusahaan
	for($i=0; $i<count($data_wika); $i++){
		$nilai = number_format($data_wika[$i]['Diperoleh']/1000000, 4);

		$tmpDate = $data_wika[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);

		if($month <= $get_bulan){
			if($data_wika[$i]['Sumber'] && $data_wika[$i]['Sumber'] != "-"){
				$key = $data_wika[$i]['Sumber'];

				if($data_wika[$i]['Status'] == "Terendah" || $data_wika[$i]['Status'] == "Terkontrak"){
					if($data_wika[$i]['Company'] == $company_){
						if(!isset($groups[$key])){
							if($data_wika[$i]['Status'] == "Terendah"){
								$groups[$key] = array('y' => $nilai, 'id' => $company_);
								$groups_[$key] = array('y' => 0, 'id' => $company_);
								$total_a += $data_wika[$i]['Diperoleh'];
							}

							if($data_wika[$i]['Status'] == "Terkontrak"){
								$groups[$key] = array('y' => 0, 'id' => $company_);
								$groups_[$key] = array('y' => $nilai, 'id' => $company_);
								$total_b += $data_wika[$i]['Diperoleh'];
							}

							$sum = 0;

							for($j=0; $j<count($data_wika); $j++){
								if($data_wika[$j]['Sumber'] == $key && $data_wika[$j]['Company'] == $company_){
									if($data_wika[$j]['Status'] == "Terendah" || $data_wika[$j]['Terkontrak']){
										$temp = $sum;
										$sum = $temp+$data_wika[$j]['Diperoleh'];
									}
								}
							}

							$decimalsum = number_format($sum/1000000, 2, ',', ',');
							$kategori[$i] = "$key<br>Total : $decimalsum";							
						}
						else if(isset($groups[$key])){
							if($data_wika[$i]['Status'] == "Terendah"){
								$groups[$key]['y'] += $nilai;
								$total_a += $data_wika[$i]['Diperoleh'];
							}

							if($data_wika[$i]['Status'] == "Terkontrak"){
								$groups_[$key]['y'] += $nilai;
								$total_b += $data_wika[$i]['Diperoleh'];
							}
						}
					}
				}
			}
		}
	}

	$total = $total_a+$total_b;
	$list_kategori = json_encode(array_values($kategori));
	$filter = array_values(array_filter($groups));
	$filter_ = array_values(array_filter($groups_));

	$combine_1 = json_encode($filter, JSON_NUMERIC_CHECK);
	$combine_2 = json_encode($filter_, JSON_NUMERIC_CHECK);


	// // passing data jo
	// $dataValue_jo['id'] = $company_;
	// $dataValue_jo['name'] = '<span class="data-donat">JO :</span><br>';
	// $dataValue_jo['name'] .= '<span class="data-donat">'.number_format($jo/1000000, 2, ',', ',').' T</span><br>';
	// $dataValue_jo['name'] .= '<span class="data-donat">('.number_format($persentase_jo, 2, ',', ',').'%)</span>';
	// $dataValue_jo['y'] = $jo;
	// $dataValue_jo['color'] = '#8ecb60';
	// $dataValue_jo['jenis'] = 'JO';

	// // passing data non jo
	// $dataValue_non_jo['id'] = $company_;
	// $dataValue_non_jo['name'] = '<span class="data-donat">NON JO :</span><br>';
	// $dataValue_non_jo['name'] .= '<span class="data-donat">'.number_format($non_jo/1000000, 2, ',', ',').' T</span><br>';
	// $dataValue_non_jo['name'] .= '<span class="data-donat">('.number_format($persentase_non_jo, 2, ',', ',').'%)</span>';
	// $dataValue_non_jo['y'] = $non_jo;
	// $dataValue_non_jo['color'] = '#64b8df';
	// $dataValue_non_jo['jenis'] = 'Non JO';

	// $text = $nama.'<br>Total : '.number_format($total_jo_non_jo/1000000, 2, ',', ',').' T';

	// $data = array($dataValue_jo, $dataValue_non_jo);

	// $legend_highchart = array(
	// 	'jo' => '<b>JO : '.number_format($persentase_jo, 2, ',', ',').'%</b>',
	// 	'non_jo' => '<b>Non JO : '.number_format($persentase_non_jo, 2, ',', ',').'%</b>' 
	// );

	// // output yg akan dikirim ke highchart
	// $output = array(
	// 	'total_diperoleh' => '<b>Total Diperoleh : '.number_format($total_jo_non_jo/1000000, 2, ',', ',').' T</b>',
	// 	'text' => $text,
	// 	'data' => $data,
	// 	'legend_highchart' => $legend_highchart,
	// 	// 'anak_perusahaan' => $anak_perusahaan,
	// );

	$output = array(
		'data' => array(
			'id' => $company_,
			'name' => $nama,
			'total' => $total,
			'list_kategori' => $list_kategori,
			'filter' => $filter,
			'filter_' => $filter_,
			'list_1' => $combine_1,
			'list_2' => $combine_2,
		),
	);

	echo json_encode($output);