<?php 
// 	error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Wika - Competitive Index Berdasarkan Nilai Proyek (Dalam Trilyun)</title>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<!-- load css -->
		<link rel="stylesheet" href="../../style.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

		<!-- <script type="text/javascript">
			$( function() {
	      			$('#container_chart').load("chart.php?dop2=<?php echo $dopx ?>&year=<?php echo $history; ?>&month=<?php echo $history2; ?>");
	 		 });
	 		 function backon2(){
				var thn = $('#year').val();
				var mnth = $('#month').val();
				$('#container_chart').load("chart.php?dop2=<?php echo $dopx ?>&year="+thn+"&month="+mnth);
	 		 }
	 		 function ddm1(){
	 		 	location.reload(); 
	 		 }     
		</script> -->
			
	</head>
	<body>

		<div id="head4" style="padding:2px 0px 2px 0px;font-size:20px;">
			<table border="0" style="width:100%">
				<tr>
					<td style="width:90;color:#FFF;%">Competitive Index Berdasarkan Nilai Proyek<br>(Dalam Trilyun)</td>
					<td style="width:10%;color:#FFF;">
						<span id="dem" onClick="backon();"><i class="fa fa-bar-chart-o"></i></span>
					</td>
				</tr>
			</table>
		</div>

		<div id="container" >
			<div id="legendary" style="font-size:20px;color:#5c5c57;padding-top:10px;padding-right:10px;background-color:#FFF;">
				<img src="../../image/calender.png" style="width:16px;height:16px;padding-top:5px;"  />
				<!-- select bulan -->
				<select id="bulan"></select>
				<!-- select tahun -->
				<select id="tahun"></select>
			</div>
			
			<!-- highchart -->
			<div id="container_chart" style="background-color:#FFF;min-height:400px;">
			    <div id="legendary" style="font-size:16px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
					<span style="color:#6483c3;"></span>
				</div>
		        <div id="container4"></div>
		        <div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
					<img src="../../image/ungu1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
					<span id="jumlah_nilai_proyek" style="color:#8e8eb7;"></span></br>
					<img src="../../image/orange1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
					<span id="jumlah_terendah_terkontrak" style="color:#eeaf4b;"></span>
  				</div>
			</div>
		</div>

		<!-- list detail -->
		<div id="container2" style="background-color:#FFF;min-height:400px;display:none">
		    <span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
	            <!-- link download -->
	            
	        </span>
	        
	        <!-- tabel detail -->
	        <table class="tbl-qa">
	            <thead>
	                <tr>
	                    <th class="table-header" width="50%">Nama Proyek</th>
                        <th class="table-header" width="20%">Penawaran</th>
			            <th class="table-header" width="30%">Keterangan</th>
	                </tr>
	            </thead>
	            <tbody></tbody>
	        </table>
		</div>


		<!-- <div id="containerlis" ></div> -->
		
		<!-- load js -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<!-- js highchart -->
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/highcharts-3d.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="../../group.js"></script>
		<!-- js custom -->
		<script type="text/javascript">
			$(document).ready(function(){
				setTahun();
				setBulan();
				// load highchart
				get_data_chart(function(data){
					generate_chart(data);
				});

                $('#tahun').on('change', function(){
                    get_data_chart(function(data){
					    generate_chart(data);
				    }); 
                });
                
                $('#bulan').on('change', function(){
                    get_data_chart(function(data){
					    generate_chart(data);
				    });
                });
			});
            
            /**
            * 
            */
            function generate_chart(data){
                $('#jumlah_terendah_terkontrak').html(data.total.terendah_terkontrak);
                $('#jumlah_nilai_proyek').html(data.total.jumlah_nilai_proyek);
                
                Highcharts.setOptions({
					lang: {
				        	decimalPoint: ',',
				        	thousandsSep: ' '
						}
				});
				
                var myChart = Highcharts.chart('container4', {
				        chart: {
				            type: 'column',
				            options3d: {
					            enabled: true,
					            // alpha: 10,
					            // beta: 0,
					            // depth: 75
					        }
				        },
				        title: {text: ''},
				        subtitle: {text: ''},
				        plotOptions: {
				        	column: {
				        		allowPointSeect: true,
				        		cursor: 'pointer',
				        		depth: 35,
							 	dataLabels: {
									enabled: true,
									color:'#999',
									allowOverlap: true,
									style: {fontFamily:'Arial, Helvetica, sans-serif', fontSize:20 },
									formatter: function () {
									    if(this.y > 0) {
								            return Highcharts.numberFormat(this.y,2);
									    } 
									    else {
								        	return '';
									    }
								 	}
								}
							}
				        },
				        credits: {enabled: false},
				        // label xAxis chart
				        xAxis: {
				            categories: data.xAxis.categories,
				            labels: {
				            	style: {
                    				fontSize:'15px',
                    				fontFamily:'Arial, Helvetica, sans-serif'
                				}
				            }
				        },
				        yAxis: {
				            title: {
				                text: null
				            },
				        },
				        legend:{
				        	enabled: false
				        },
				        // data chart
				        series: [
				        	{
				        		name: 'Ni;ai Proyek',
				                data: data.data.data_nilai,
				                point:{
				                    events:{
				                        click: function(event){
				                            alert(this.id);
				                        }
				                    }  
				                },
				    //     		point:{
				    //     			events:{
								//   		click: function (event) {
								// 			$('#container').hide();
								// 			$('#container2').show();
								// 			$('#dem').show();
								// 			var thn = $('#year').val();
								// 			var mnth = $('#month').val();
								// 			$('#container2').load("function.php?status=RKAP&id="+this.id+"&year="+thn+"&month="+mnth);
								//   		}
								//   	}
				    //     		},
				        		color: '#8e8eb7'
				        	},
				        	{
				        		name: 'Terendah & Terkontrak',
				                data: data.data.data_terendah_terkontrak,
				                point:{
				                    events:{
				                        click: function(event){
				                            // alert(this.id);
				                            get_detail_chart(this.id);
				                        }
				                    }  
				                },
				    //     		point:{
				    //     			events:{
								//   		click: function (event) {
								// 			$('#container').hide();
								// 			$('#container2').show();
								// 			$('#dem').show();
								// 			var thn = $('#year').val();
								// 			var mnth = $('#month').val();
								// 			$('#container2').load("function.php?status=RKAP&id="+this.id+"&year="+thn+"&month="+mnth);
								//   		}
								//   	}
				    //     		},
				        		color: '#eeaf4b'
				        	},
				        ]
				    });
            }
            
			/**
			*
			*/
			function get_data_chart(handleData){
				$.ajax({
					url: "api.php",
					type: "POST",
					dataType: "JSON",
					data: {
						'tahun' : $('#tahun').val().trim(),
						'bulan' : $('#bulan').val().trim(),
					},
					success: function(output){
						console.log(output);
						handleData(output);
					},
					error: function (jqXHR, textStatus, errorThrown){
			            alert("Koneksi Error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }
				})
			}
			
			/**
			*
			*/
			function get_detail_chart(id){
			    // hide highchart   
			    $('#container').hide();
			    // tampilkan detail
			    $('#container2').show();
			    // btn back highchart   
			    $('#dem').show();
			    
			    // get data detail
			    $.ajax({
					url: "detail.php",
					type: "POST",
					dataType: "JSON",
					data: {
						'tahun' : $('#tahun').val().trim(),
						'bulan' : $('#bulan').val().trim(),
						'id' : id,
					},
					success: function(output){
						// tampilkan detail
					},
					error: function (jqXHR, textStatus, errorThrown){
			            alert("Koneksi Error");
			            console.log(jqXHR, textStatus, errorThrown);
			        }
				})
			    
			}

			/**
			*
			*/
			function setBulan(){
				var bulan = [
					{value: "1", text: "Januari"},
					{value: "2", text: "Februari"},
					{value: "3", text: "Maret"},
					{value: "4", text: "April"},
					{value: "5", text: "Mei"},
					{value: "6", text: "Juni"},
					{value: "7", text: "Juli"},
					{value: "8", text: "Agustus"},
					{value: "9", text: "September"},
					{value: "10", text: "Oktober"},
					{value: "11", text: "November"},
					{value: "12", text: "Desember"},
				];

				$.each(bulan, function(i, item){
					var option = new Option(item.text, item.value);
					$('#bulan').append(option);
				});
			}

			/**
			*
			*/
			function setTahun(){
				var tahun = [
					{value: "2016", text: "2016"},
					{value: "2017", text: "2017"},
					{value: "2018", text: "2018"},
				];

				$.each(tahun, function(i, item){
					var option = new Option(item.text, item.value);
					$('#tahun').append(option);
				});

				$('#tahun').val('2018');
			}

		</script>
	

       	
	</body>
</html>
