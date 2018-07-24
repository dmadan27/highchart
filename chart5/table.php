<?php
	$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : false;

	if(strtolower($jenis) == 'nilai_proyek') $judul = 'Penawaran';
	else if(strtolower($jenis) == 'terendah' || strtolower($jenis) == 'terkontrak') $judul = 'Diperoleh';
	else $judul = 'Diperoleh';

?>
<!-- total diperoleh dan btn download -->
<span id="total-detail" style="font-size:14px;color:#6483c3;padding:10px;float:right"></span>

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