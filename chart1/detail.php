<?php
	// inisialisasi get data post dari client
	$get_company = isset($_POST['company']) ? $_POST['company'] : false;
	$get_jenis = isset($_POST['jenis']) ? $_POST['jenis'] : false;
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;

	$get_download = isset($_GET['download']) ? $_GET['download'] : false; 

	if($get_download && $get_download == 'yes'){
		$get_company = isset($_GET['company']) ? $_GET['company'] : false;
		$get_jenis = isset($_GET['jenis']) ? $_GET['jenis'] : false;
		$get_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : false;
		$get_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : false;
	}

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
				// $anak_perusahaan[$key]['sum_terendah_terkontrak'] = $anak_perusahaan[$key]['terendah'] + $anak_perusahaan[$key]['terkontrak'];
			}
		}
	}

	$output = array(
		'data' => $data,
		'total' => ($get_jenis == 'RKAP') ? 'Total RKAP: '.number_format($total, 0, ',', '.') : 'Total Diperoleh: '.number_format($total, 0, ',', '.'),
	);

	if(!$get_download) echo json_encode($output);
	else if($get_download && $get_download == 'yes'){ // export excel

		if(strtolower($get_jenis) == 'rkap') $judul = 'RKAP';
		else if(strtolower($get_jenis) == 'terendah' || strtolower($get_jenis) == 'terkontrak') $judul = 'Diperoleh';
		else $judul = 'Diperoleh';

		// Fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");
 
		// Mendefinisikan nama file ekspor "hasil-export.xls"
		header("Content-Disposition: attachment; filename=hasil-export.xls");

		?>
		<table class="table-detail" border="1px solid black">
			<thead>
				<tr>
					<th width="50%">Nama Proyek</th>
					<th width="20%"><?= $judul; ?></th>
					<th width="30%">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($output['data'] as $value){
						echo '<tr>';
						echo '<td>'.$value['title'].'</td>';
						echo '<td>'.$value['nilai'].'</td>';
						echo '<td>'.$value['keterangan'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th color="black" colspan="3" line-height="bold">
						<?= $output['total']; ?>
					</th>
				</tr>
			</tfoot>
		</table>
	<?php
	}
?>