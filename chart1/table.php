<?php
	$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : false;

	if(strtolower($jenis) == 'rkap') $judul = 'RKAP';
	else if(strtolower($jenis) == 'terendah' || strtolower($jenis) == 'terkontrak') $judul = 'Diperoleh';
	else $judul = 'Diperoleh';
?>


<!-- table list detail proyek -->
<table class="table-detail">
	<thead>
		<tr>
			<!-- nama proyek -->
			<th class="table-header" width="60%">Nama Proyek</th>
			<!-- total diperoleh / rkap -->
			<th class="table-header" width="25%"><?= $judul ?></th>
			<!-- Keterangan / status -->
			<th class="table-header" width="15%">Keterangan</th>
			<th></th>
		</tr>
	</thead>
	<tbody></tbody>
</table>