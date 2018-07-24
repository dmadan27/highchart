<?php
	error_reporting(0);
	
    $get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : $_POST['tahun'];
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : $_POST['tahun'];

	$json = file_get_contents("https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun=".$get_tahun."&company=yes");
	
	// deserialize data from JSON
	$json_data = json_decode($json,true);
	
	// inisialisasi var total proyek
	$total_DOP1 = $total_DOP2 = $total_DOP3 = 0;
	$total_DOP4 = $total_DOP5 = $total_DOP6 = $total_DOP7 = 0;

	// jumlah terkontrak / terendah
	$jum_DOP1 = $jum_DOP2 = $jum_DOP3 = $jum_DOP4 = 0;
	$jum_DOP5 = $jum_DOP6 = $jum_DOP7 = 0;

	// kategory label anak perusahaan
	$anak_perusahaan = array(
		array(
			'id' => '4547d242-0ed5-4d09-ac37-420e5e19a703',
			'name' => 'Witon (Wika Beton)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		array(
			'id' => 'c0b9186f-75d6-4865-b0f3-890d7db8fa2e',
			'name' => 'Wikon',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		array(
			'id' => '514f7570-0c8f-4589-9368-69465c8b5ed2',
			'name' => 'WR (Wika Realty)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		array(
			'id' => '8d6255cb-1067-4ac9-a9bf-9c086363267',
			'name' => 'WG (Wika Gedung)',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		// ganti
		array(
			'id' => '9c791f07-bf39-4186-a317-7965e547dde7',
			'name' => 'Wijaya Karya',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		array(
			'id' => '73bf37c7-8bde-4678-92d7-1b9882bbd1a4',
			'name' => 'Bitumen',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
		array(
			'id' => 'cc7c5a60-2e2a-424e-852b-562bbf0a239d',
			'name' => 'Serpan',
			'rkap' => 0,
			'terendah' => 0,
			'terkontrak' => 0,
			'sum' => 0,
		),
	);
    
	foreach($json_data as $item){
		$tmpDate = $item["Create"];
		$date = substr($tmpDate,0,-8);
		$month = (int) substr($date,5,-4);
		
		// jika ada nilai company dan bulan sesuai dgn dari get_bulan
		if($item['Company'] && $month <= $get_bulan){
			// seleksi sesuai DOP
			switch ($item['Company']) {
				// dop 1
				case '4547d242-0ed5-4d09-ac37-420e5e19a703':
					$total_DOP1 += $item['Tactic'];
					$jum_DOP1 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP1+=$item['Diperoleh'] : $jum_DOP1+=0;
					break;

				// dop 2
				case 'c0b9186f-75d6-4865-b0f3-890d7db8fa2e':
					$total_DOP2 += $item['Tactic'];
					$jum_DOP2 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP2+=$item['Diperoleh'] : $jum_DOP2+=0;
					break;

				// dop 3
				case '514f7570-0c8f-4589-9368-69465c8b5ed2':
					$total_DOP3 += $item['Tactic'];
					$jum_DOP3 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP3+=$item['Diperoleh'] : $jum_DOP3+=0;
					break;

				// dop 4
				case '8d6255cb-1067-4ac9-a9bf-9c086363267':
					$total_DOP4 += $item['Tactic'];
					$jum_DOP4 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP4+=$item['Diperoleh'] : $jum_DOP4+=0;
					break;

				// dop 5
				case '9c791f07-bf39-4186-a317-7965e547dde7':
					$total_DOP5 += $item['Tactic'];
					$jum_DOP5 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP5+=$item['Diperoleh'] : $jum_DOP5+=0;
					break;

				// dop 6
				case '73bf37c7-8bde-4678-92d7-1b9882bbd1a4':
					$total_DOP6 += $item['Tactic'];
					$jum_DOP6 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP6+=$item['Diperoleh'] : $jum_DOP6+=0;
					break;

				// dop 7
				case 'cc7c5a60-2e2a-424e-852b-562bbf0a239d':
					$total_DOP7 += $item['Tactic'];
					$jum_DOP7 = ($item['Status']=="Terkontrak" || $item['Status']=="Terendah") ? $jum_DOP7+=$item['Diperoleh'] : $jum_DOP7+=0;
					break;
				
				default:
					# code...
					break;
			}
		}	
	}

    $i = 0;
    
    $data_terendah_terkontrak = array(
        array('y' => $jum_DOP1/1000000, 'id' => 1), 
        array('y' => $jum_DOP2/1000000, 'id' => 4), 
        array('y' => $jum_DOP3/1000000, 'id' => 7), 
        array('y' => $jum_DOP4/1000000, 'id' => 10),
        array('y' => $jum_DOP5/1000000, 'id' => 13), 
        array('y' => $jum_DOP6/1000000, 'id' => 16), 
        array('y' => $jum_DOP7/1000000, 'id' => 19)
    );
    
    $data_nilai = array(
        array('y' => $total_DOP1/1000000, 'id' => 2), 
        array('y' => $total_DOP2/1000000, 'id' => 5), 
        array('y' => $total_DOP3/1000000, 'id' => 8), 
        array('y' => $total_DOP4/1000000, 'id' => 11),
        array('y' => $total_DOP5/1000000, 'id' => 14), 
        array('y' => $total_DOP6/1000000, 'id' => 17), 
        array('y' => $total_DOP7/1000000, 'id' => 20)
    );
    
    $jumlah_terendah_terkontrak = 0;
    $jumlah_nilai = 0;
    
    foreach($anak_perusahaan as $value){
        // $sum = $data_terendah[$i]['y']+$data_terkontrak[$i]['y'];
        // $label_xAxis[] = $value['name'].' | Diperoleh : '.$sum.' T';
        $ci = ($data_terendah_terkontrak[$i]['y']/$data_nilai[$i]['y']*100);

        $dataValue = array();
        $dataValue['name'] = number_format($ci,2, ',', ',').'%';
        $dataValue['categories'] = array($value['name']);

        $total_terendah_terkontrak += $data_terendah_terkontrak[$i]['y'];
        $jumlah_nilai_proyek += $data_nilai[$i]['y'];
        
        $i++;

        $label_xAxis[] = $dataValue;
    }
    
    
    $output = array(
        'xAxis' => array(
			'categories' => $label_xAxis,
		),
		'data' => array(
		    'data_nilai' => $data_nilai,
		    'data_terendah_terkontrak' => $data_terendah_terkontrak,
		 ),
		 'total' => array(
		    'jumlah_nilai_proyek' => '<b>Jumlah Nilai Proyek : '.number_format ($jumlah_nilai_proyek, 2, ',', ',').' T</b>',
		    'terendah_terkontrak' => '<b>Jumlah Nilai Terendah & Terkontrak : '.number_format ($total_terendah_terkontrak, 2, ',', ',').' T</b>',
		 ),
		 'all' => $json_data
    );
    
    echo json_encode($output);