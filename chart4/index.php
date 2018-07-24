<?php ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wika - Competitive Index Berdasarkan Jumlah Proyek</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<!-- load css -->
			<link rel="stylesheet" href="assets/css/style_new.css" type="text/css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<!--  -->
	</head>
	</head>
	<body>
		<!-- container -->
		<div class="container">

			<!-- title -->
			<div class="container-title">
				<table border="0" style="width: 100%">
					<tr>
						<!-- judul hightchart -->
						<td style="width: 90%; color: #FFF;"><span id="title_highchart">&nbsp;&nbsp;Competitive Index Berdasarkan Jumlah Proyek</span></td>
						<!-- button highchart -->
						<td style="width: 10%; color:#FFF;"><span id="btn_highchart" style="cursor: pointer;"><i class="fa fa-bar-chart-o"></i></span></td>
					</tr>
				</table>
			</div>

			<!-- highchart -->
			<div class="container-highchart">
				<!-- form tahun dan bulan -->
				<div class="form-highchart">
					<!-- gambar calendar -->
					<img src="assets/image/image2/calender.png" style="width:16px; height:16px; padding-top:5px;">
					<!-- select bulan -->
					<select id="bulan"></select>
					<!-- select tahun -->
					<select id="tahun"></select>
				</div>

				<!-- data total menyeluruh highchart -->
				<div id="total-highchart" class="form-highchart" style="text-align: right; color: #6483c3"></div>

				<!-- highchart -->
				<div id="body-highchart"></div>

				<!-- data total per anak perusahaan -->
				<div id="legend-highchart" class="form-highchart" style="text-align: center;"></div>

			</div>

			<!-- detail -->
			<div class="container-detail" style="display: none;">
			</div>

		</div>

		<!-- load js -->
			<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
			<script type="text/javascript" src="assets/js/blockui.min.js"></script>
			<!-- js highchart -->
			<script src="https://code.highcharts.com/highcharts.js"></script>
			<script src="https://code.highcharts.com/highcharts-3d.js"></script>
			<script src="https://code.highcharts.com/modules/exporting.js"></script>
			<!-- komentari Group.js jika tidak digunakan -->
			<script src="assets/js/group.js"></script>

			<!-- js custom highchart -->
			<script type="text/javascript" src="assets/js/init.js"></script>
			<script type="text/javascript" src="chart4/chart.js"></script>
			<script type="text/javascript" src="chart4/detail.js"></script>
		<!--  -->
	</body>
</html>
