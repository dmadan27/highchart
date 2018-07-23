<?php
	include "my_json_list.php";
	
	$data_terendah=$format_indonesia = number_format ($terendah/1000000, 2);
	$data_terendah1=$format_indonesia = number_format ($terendah1/1000000, 2);
	$data_terendah2=$format_indonesia = number_format ($terendah2/1000000, 2);
	$data_terkontrak=$format_indonesia = number_format ($terkontrak/1000000, 2);
	$data_terkontrak1=$format_indonesia = number_format ($terkontrak1/1000000, 2);
	$data_terkontrak2=$format_indonesia = number_format ($terkontrak2/1000000, 2);

	$data_RKAP=$format_indonesia = number_format ($RKAP/1000000, 2);
	$data_RKAP1=$format_indonesia = number_format ($RKAP1/1000000, 2);
	$data_RKAP2=$format_indonesia = number_format ($RKAP2/1000000, 2);
	
	$total_terendah=$data_terendah+$data_terendah1+$data_terendah2;
	$total_terkontrak=$data_terkontrak+$data_terkontrak1+$data_terkontrak2;
	$total_RKAP=$data_RKAP+$data_RKAP1+$data_RKAP2;
	$total=$total_terendah+$total_terkontrak;
?>
<script type="text/javascript">
						var data = [{y:<?php echo $data_terendah; ?>, id:1},{y:<?php echo $data_terendah1; ?>, id:4},{y:<?php echo $data_terendah2; ?>, id:7}];
						var data2 = [{y:<?php echo $data_terkontrak; ?>, id:2},{y:<?php echo $data_terkontrak1; ?>, id:5},{y:<?php echo $data_terkontrak2; ?>, id:8}];
						var data3 = [{y:<?php echo $data_RKAP; ?>, id:3},{y:<?php echo $data_RKAP1; ?>, id:6},{y:<?php echo $data_RKAP2; ?>, id:9}];
						$(function () {
								Highcharts.setOptions
								({
									lang: {
									        	decimalPoint: ',',
									        	thousandsSep: ' '
										}
										});
								$('#container2').hide();
								$('#dem').hide();
								$('#container4').highcharts({
								chart: {
									type: 'column',
									options3d: {
									enabled: true,
									alpha: 10,
									beta: 0,
									depth: 75
									}
							},
							title: {
								text: ''
							},
							subtitle: {
								text: ''
							},
							plotOptions: {
								column: {
									dallowPointSelect: true,
									cursor: 'pointer',
									depth: 35,
									 dataLabels: {
										enabled: true,
										color:'#999',
										allowOverlap: true,
										style: {fontFamily:'Arial, Helvetica, sans-serif',fontSize:12 },
										formatter: function () {
										    if(this.y > 0) {
									            return Highcharts.numberFormat(this.y,3);
										    } else {
										        return '';
										    }
   										 }
									}
								}
							},
							credits: {
							  enabled: false
							},
							xAxis: {
								categories:["DOP 1<br/>", "DOP 2<br/>", "DOP 3<br/>"],
								labels: {
            								formatter: function() {
            								
                   							var index = this.axis.categories.indexOf(this.value),
                   							sum = 0;
                   							if(index==0){
                      								sum = <?php echo $data_terendah+$data_terkontrak; ?>;
                      							} 
                      							if(index==1){
                      								sum = <?php echo $data_terendah1+$data_terkontrak1; ?>;
                      							}  
                      							if(index==2){
                      								sum = <?php echo $data_terendah2+$data_terkontrak2; ?>;
                      							}
                      							var angkaStr = sum.toString().split('.').join(',');          
	                						return this.value + 'Diperoleh : ' + angkaStr + ' T';
	            							}
            							}
							},
							yAxis: {
								title: {
									text: null
								},
						labels:{
							formatter:function(){
								return(this.value/1)+" T"
								}
								}
							},
						legend: {
								enabled: false
							},
							series: [
							{
								name: 'RKAP',
								"data": data3,
								 point:{
									  events:{
										  click: function (event) {
												$('#container').hide();
												$('#container2').show();
												$('#dem').show();
												var thn = $('#year').val();
												var mnth = $('#month').val();
												$('#container2').load("function.php?status=RKAP&id="+this.id+"&year="+thn+"&month="+mnth);
										  }
									  }
								  },
								color:'#ed7d64'
							},
							{
								name: 'Terendah',
								"data": data,
								 point:{
									  events:{
										  click: function (event) {
												$('#container').hide();
												$('#container2').show();
												$('#dem').show();
												var thn = $('#year').val();
												var mnth = $('#month').val();
												$('#container2').load("function.php?status=Terendah&id="+this.id+"&year="+thn+"&month="+mnth);
										  }
									  }
								  },
								color:'#64b8df'
							},
							{
								name: 'Terkontrak',
								"data": data2,
								 point:{
									  events:{
										  click: function (event) {
												$('#container').hide();
												$('#container2').show();
												$('#dem').show();
												var thn = $('#year').val();
												var mnth = $('#month').val();
												$('#container2').load("function.php?status=Terkontrak&id="+this.id+"&year="+thn+"&month="+mnth);
										  }
									  }
								  },
								color:'#8ecb60'
							}
							]
						});
					});
                
					function backon(){
						$('#container').show();
						$('#container2').hide();
						$('#dem').hide();
					}
				</script>
<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
				<span style="color:#6483c3;"><b>Total Diperoleh : <?php echo $format_indonesia = number_format ($total, 2, ',', ','); ?> T</b></span>
			</div>
			<div id="container4" ></div>
			<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
				<img src="../image/merah.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
				<span style="color:#ed7d64;"><b>RKAP : <?php echo $format_indonesia = number_format ($total_RKAP, 2, ',', ','); ?></b> T</span></br>
				<img src="../image/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
				<span style="color:#64b8df;"><b>Terendah : <?php echo $format_indonesia = number_format ($total_terendah, 2, ',', ','); ?></b> T</span>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="../image/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
				<span style="color:#8ecb60;"><b>Terkontrak : <?php echo $format_indonesia = number_format ($total_terkontrak, 2, ',', ','); ?></b> T</span>
			</div>
