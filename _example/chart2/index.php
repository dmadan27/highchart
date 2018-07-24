<?php 
session_start();
error_reporting(0);
$history;
$history2;
$name_bln="Januari";
if (empty($_SESSION[Thn])){$history="2018";}
else if (!empty($_SESSION[Thn])){$history=$_SESSION[Thn];}
if (empty($_SESSION[bln])){$history2="01";$name_bln="Januari";}
else if (!empty($_SESSION[bln])){
	$history2=$_SESSION[bln];
	if( $_SESSION[bln]=="01" ){$name_bln="Januari";}
	else if( $_SESSION[bln]=="02" ){$name_bln="Februari";}
	else if( $_SESSION[bln]=="03" ){$name_bln="Maret";}
	else if( $_SESSION[bln]=="04" ){$name_bln="April";}
	else if( $_SESSION[bln]=="05" ){$name_bln="Mei";}
	else if( $_SESSION[bln]=="06" ){$name_bln="Juni";}
	else if( $_SESSION[bln]=="07" ){$name_bln="Juli";}
	else if( $_SESSION[bln]=="08" ){$name_bln="Agustus";}
	else if( $_SESSION[bln]=="09" ){$name_bln="September";}
	else if( $_SESSION[bln]=="10" ){$name_bln="Oktober";}
	else if( $_SESSION[bln]=="11" ){$name_bln="November";}
	else if( $_SESSION[bln]=="12" ){$name_bln="Desember";}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Wika</title>
                <link rel="stylesheet" href="../style.css" type="text/css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
                
                <style>
                #container4{
			height:250px;
			width:50%;
			float:left;
		}
		#container5{
			height:250px;
			width:50%;
			float:left;
		
		}
		#container6{
			height:250px;
			width:50%;
			margin: auto;
		}
.bawah {
margin-top:250px;
}
		@media only screen and (max-width: 768px) {
		   	#container4{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			}
			#container5{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			}
			#container6{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			
			}
.bawah {
margin-top:0px;
}
		}
		@media only screen and (max-width: 500px) {
	   		#container4{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			}
			#container5{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			}
			#container6{
				height:250px;
				width:100%;
				float:none;
				margin: auto;
			
			}
.bawah{
display:none;
}
		}
		</style>
                
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-3d.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript">
			$( function() {
	      			$('#container_chart').load("chart.php?dop2=<?php echo $dopx ?>&year=<?php echo $history; ?>&month=<?php echo $history2; ?>");
	 		 });
	 		 function backon2(){
				var thn = $('#year').val();
				var mnth = $('#month').val();
				$('#container_chart').load("chart.php?dop2=<?php echo $dopx ?>&year="+thn+"&month="+mnth);
	 		 }      
		</script>
	</head>
	<body>



<div id="head4" style="padding:2px 0px 2px 0px;font-size:20px;">
	<table border="0" style="width:100%">
		<tr>
			<td style="width:90;color:#FFF;%">
				&nbsp;&nbsp;JO vs Non JO (Dalam Trilyun)</td><td style="width:10%;color:#FFF;">
				<span id="dem" onClick="backon();"><i class="fa fa-bar-chart-o"></i></span>
			</td>
		</tr>
	</table>
</div>

<div id="container" style="height:550px;">
	      	<div id="legendary" style="font-size:20px;color:#5c5c57;padding-top:10px;padding-right:10px;background-color:#FFF;">
		<form method="post" name="kirim">
			<img src="../image/calender.png" style="width:16px;height:16px;padding-top:5px;"  />
			
			<select onchange="backon2()" name="month" id="month">
			<option value=<?php echo $history2; ?> style="display:none;"><?php echo $name_bln; ?></option>
			  <option value="01">Januari</option>
			  <option value="02">Februari</option>
			  <option value="03">Maret</option>
			  <option value="04">April</option>
			  <option value="05">Mei</option>
			  <option value="06">Juni</option>
			  <option value="07">Juli</option>
			  <option value="08">Agustus</option>
			  <option value="09">September</option>
			  <option value="10">Oktober</option>
			  <option value="11">November</option>
			  <option value="12">Desember</option>
			</select>
			
			<select onchange="backon2()" name="year" id="year">
				<option value=<?php echo $history; ?> style="display:none;"><?php echo $history; ?></option>
                                <option value="2016">2016</option>
				<option value="2017">2017</option>
			 	   <option value="2018">2018</option>
			</select>
			</form>
		</div>
		<div id="container_chart" ></div>
</div>
		<div id="containerlis" ></div>

</body>
</html>
