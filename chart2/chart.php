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

	// get data anak perusahaan
	foreach ($anak_perusahaan as $key => $value) {
		if($get_company == $key){
			$nama = $value['name'];
			$company_ = $value['company'];
		}
	}

	$jo = $non_jo = $total_jo_non_jo = 0;

	// pecah data wika untuk filter sesuai dengan mapping perusahaan
	foreach ($data_wika as $value) {
		$tempDate = $value['Create'];

		$date = substr($tempDate,0,-8);
		$month = substr($date,5,-4);
		$year = $value["Tahun"];

		$company = $value['Company'];
		$status = $value['Status'];
		$jenis = $value['Jenis'];
		$rkap = $value['RKAP'];
		$diperoleh = $value['Diperoleh'];

		// jika bulan lebih kecil sama dengan get bulan
		if($month <= $get_bulan){
			if($company == $company_){
				if($jenis == 'Non JO') $non_jo += $diperoleh;		
				if($jenis == 'JO') $jo += $diperoleh;
			}
		}
	}

	$total_jo_non_jo = $jo+$non_jo;
	$persentase_jo = ($total_jo_non_jo > 0) ? ($jo/$total_jo_non_jo)*100 : 0;
	$persentase_non_jo = ($total_jo_non_jo > 0) ? ($non_jo/$total_jo_non_jo)*100 : 0;

	$dataValue_jo = $dataValue_non_jo = array();

	// passing data jo
	$dataValue_jo['id'] = $company_;
	$dataValue_jo['name'] = '<span class="data-donat" style="color: #999">JO :</span><br>';
	$dataValue_jo['name'] .= '<span class="data-donat" style="color: #999">'.number_format($jo/1000000, 2, ',', ',').' T</span><br>';
	$dataValue_jo['name'] .= '<span class="data-donat" style="color: #999">('.number_format($persentase_jo, 2, ',', ',').'%)</span>';
	$dataValue_jo['y'] = $jo;
	$dataValue_jo['color'] = '#8ecb60';
	$dataValue_jo['jenis'] = 'JO';

	// passing data non jo
	$dataValue_non_jo['id'] = $company_;
	$dataValue_non_jo['name'] = '<span class="data-donat" style="color: #999">NON JO :</span><br>';
	$dataValue_non_jo['name'] .= '<span class="data-donat" style="color: #999">'.number_format($non_jo/1000000, 2, ',', ',').' T</span><br>';
	$dataValue_non_jo['name'] .= '<span class="data-donat" style="color: #999">('.number_format($persentase_non_jo, 2, ',', ',').'%)</span>';
	$dataValue_non_jo['y'] = $non_jo;
	$dataValue_non_jo['color'] = '#64b8df';
	$dataValue_non_jo['jenis'] = 'Non JO';

	$text = $nama.'<br>Total : '.number_format($total_jo_non_jo/1000000, 2, ',', ',').' T';

	$data = array($dataValue_jo, $dataValue_non_jo);

	$legend_highchart = array(
		'jo' => '<b>JO : '.number_format($persentase_jo, 2, ',', ',').'%</b>',
		'non_jo' => '<b>Non JO : '.number_format($persentase_non_jo, 2, ',', ',').'%</b>' 
	);

	// output yg akan dikirim ke highchart
	$output = array(
		'total_diperoleh' => '<b>Total Diperoleh : '.number_format($total_jo_non_jo/1000000, 2, ',', ',').' T</b>',
		'text' => $text,
		'data' => $data,
		'legend_highchart' => $legend_highchart,
		// 'anak_perusahaan' => $anak_perusahaan,
	);

	echo json_encode($output);