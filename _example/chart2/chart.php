<?php 
error_reporting(0);
$dop2=$_GET["dop2"];
$url =null;
$pilih=$_GET["year"];
$pilih_2=$_GET["month"];
// request API
$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?tahun='.$pilih.'';
$url2='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?tahun='.$pilih.'';
$url3='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?tahun='.$pilih.'';
$json = file_get_contents($url);
$json2 = file_get_contents($url2);
$json3 = file_get_contents($url3);
// deserialize data from JSON
$json_data = json_decode($json,true);
$json_data2 = json_decode($json2,true);
$json_data3 = json_decode($json3,true);

//var_dump
$i=0;
$total = 0;
$total_2 = 0;
$total_3 = 0;

for($i=0; $i<count($json_data); $i++){
			$tmpDate = $json_data[$i]['Create'];
			$date = substr($tmpDate,0,-8);
			$month = substr($date,5,-4);
			if($month<=$pilih_2){
		$total=$total+$json_data[$i]['RKAP'];
		if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak")
		{
			if($json_data[$i]['Jenis']=="Non JO")
			{
				$total_2=$total_2+$json_data[$i]['Diperoleh'];
			}
			if($json_data[$i]['Jenis']=="JO")
			{
				$total_3=$total_3+$json_data[$i]['Diperoleh'];
			}
		}
		}	
	}
				$total=$total_2+$total_3;
				$persentaseone=($total_2/$total)*100;
				$persentasetwo=($total_3/$total)*100;



//var_dump
$ii=0;
$total_B = 0;
$total_2_B = 0;
$total_3_B = 0;

for($ii=0; $ii<count($json_data2); $ii++){
		if($json_data2[$ii]['Status']=="Terendah"||$json_data2[$ii]['Status']=="Terkontrak")
		{
		$tmpDatex = $json_data[$ii]['Create'];
		$datex = substr($tmpDatex,0,-8);
		$monthx = substr($datex,5,-4);
			if($monthx<=$pilih_2){
			if($json_data2[$ii]['Jenis']=="Non JO")
			{
				$total_2_B=$total_2_B+$json_data2[$ii]['Diperoleh'];
			}
			if($json_data2[$ii]['Jenis']=="JO")
			{
				$total_3_B=$total_3_B+$json_data2[$ii]['Diperoleh'];
			}
		}
		}	
	}
				$total_B=$total_2_B+$total_3_B;
				$persentaseone_B=($total_2_B/$total_B)*100;
				$persentasetwo_B=($total_3_B/$total_B)*100;


//var_dump
$iii=0;
$total_C = 0;
$total_2_C = 0;
$total_3_C = 0;

for($iii=0; $iii<count($json_data3); $iii++){
		$tmpDatexx = $json_data[$iii]['Create'];
		$datexx = substr($tmpDatexx,0,-8);
		$monthxx = substr($datexx,5,-4);
			if($monthxx<=$pilih_2){
		if($json_data3[$iii]['Status']=="Terendah"||$json_data3[$iii]['Status']=="Terkontrak")
		{
			if($json_data3[$iii]['Jenis']=="Non JO")
			{
				$total_2_C=$total_2_C+$json_data3[$iii]['Diperoleh'];
			}
			if($json_data3[$iii]['Jenis']=="JO")
			{
				$total_3_C=$total_3_C+$json_data3[$iii]['Diperoleh'];
			}
		}
		}	
	}
				$total_C=$total_2_C+$total_3_C;
				$persentaseone_C=($total_2_C/$total_C)*100;
				$persentasetwo_C=($total_3_C/$total_C)*100;
				
$kill=$total+$total_B+$total_C;
$persentaseone_kill=(($total_2+$total_2_B+$total_2_C)/$kill)*100;
$persentasetwo_kill=(($total_3+$total_3_B+$total_3_C)/$kill)*100;



?>
<script type="text/javascript">
		
 var data = [{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">Non JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_2/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentaseone,2, ',', ','); ?>%)</span>',y: <?php echo $persentaseone; ?>,id: 0,color:'#64b8df' },{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_3/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentasetwo,2, ',', ','); ?>%)</span>',y: <?php echo $persentasetwo; ?>,id: 1,color:'#8ecb60' }];
 
$(function () {
Highcharts.setOptions({
    lang: {
        decimalPoint: ',',
        thousandsSep: ' '
    }
});

     	$('#container2').hide();
	$('#container3').hide();
	$('#dem').hide();
	$('#containerA').hide();
 	$('#containerB').hide();
 	$('#containerC').hide();
 	$('#containerD').hide();
    $('#container4').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0
            }
        },
        title: {
            text: "DOP 1<br>Total : <?php echo $format_indonesia = number_format (($total_3+$total_2)/1000000, 2, ',', ','); ?> T",
                margin: 0,
                y: 0,
                x: 0,
                align: 'center',
                verticalAlign: 'middle',
                style :
                {
                	color: '#4572A7',
	                fontSize: '15px'
                }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        
	credits: {
    	  enabled: false
  		},
         plotOptions: {
            pie: {
	        cursor: 'pointer',
                innerSize: 120,
                depth: 25,
                dataLabels: 
                {
                   distance: 1
                   
                }
            }
        },
        
	exporting: {
            enabled: false
        },
        series: [{
            type: 'pie',
               name: 'Persentase',
              "data": data,
               point:{
                  events:{
                      click: function (event) {
			 if(this.id==1){
			 	$('#container').hide();
			 	$('#container2').hide();
			 	$('#dem').show();
			 	$('#container3').show();
			 	$('#containerA').hide();
			 	$('#containerB').hide();
			 	$('#containerC').hide();
			 	$('#containerD').hide();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03");
			 	}
			 else{
			 	$('#container').hide();
			 	$('#container2').show();
			 	$('#dem').show();
			 	$('#container3').hide();
			 	$('#containerA').hide();
			 	$('#containerB').hide();
			 	$('#containerC').hide();
			 	$('#containerD').hide();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02");
			 	}
                      }
                  }
              }
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 320
                },
                chartOptions: {
                    plotOptions: {
            		pie: {
	       			 cursor: 'pointer',
               			 innerSize: 120,
                		 depth: 25,
                		 dataLabels:false
            		}
        		}
                }
            }]
        }
    });
    
});
		</script>
		
		
		
		<script type="text/javascript">
                  function backon(){
	           	$('#container').show();
	           	$('#container2').hide();
	            	$('#container3').hide();
	           	$('#dem').hide();
	           	$('#containerA').hide();
		 	$('#containerB').hide();
		 	$('#containerC').hide();
		 	$('#containerD').hide();

	         }
</script>



<script type="text/javascript">
		
 var data_B = [{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">Non JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_2_B/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentaseone_B,2, ',', ','); ?>%)</span>',y: <?php echo $persentaseone_B; ?>,id: 3,color:'#64b8df' },{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_3_B/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentasetwo_B,2, ',', ','); ?>%)</span>',y: <?php echo $persentasetwo_B; ?>,id: 4,color:'#8ecb60' }];
 
$(function () {
     	$('#container2').hide();
	$('#container3').hide();
	$('#containerA').hide();
 	$('#containerB').hide();
 	$('#containerC').hide();
 	$('#containerD').hide();
	$('#dem').hide();
    $('#container5').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0
            }
        },
        title: {
            text: "DOP 2<br>Total : <?php echo $format_indonesia = number_format (($total_3_B+$total_2_B)/1000000, 2, ',', ','); ?> T",
                margin: 0,
                y: 0,
                x: 0,
                align: 'center',
                verticalAlign: 'middle',
                style :
                {
                	color: '#4572A7',
	                fontSize: '15px'
                }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
		credits: {
    	  enabled: false
  		},
         plotOptions: {
            pie: {
            cursor: 'pointer',
                innerSize: 120,
                depth: 25,
                dataLabels: 
                {
                   distance: 1
                   
                }
            }
        },exporting: {
            enabled: false
        },
        series: [{
            type: 'pie',
               name: 'Persentase',
              "data": data_B,
               point:{
                  events:{
                      click: function (event) {
			 if(this.id==4){
			 	$('#container').hide();
			 	$('#container2').hide();
			 	$('#dem').show();
			 	$('#container3').hide();
			 	$('#containerA').hide();
			 	$('#containerB').show();
			 	$('#containerC').hide();
			 	$('#containerD').hide();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=B");
			 	}
			 else if(this.id==3){
			 	$('#container').hide();
			 	$('#container2').hide();
			 	$('#dem').show();
			 	$('#container3').hide();
			 	$('#containerA').show();
			 	$('#containerB').hide();
			 	$('#containerC').hide();
			 	$('#containerD').hide();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=A");
			 	}
                      }
                  }
              }
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 320
                },
                chartOptions: {
                    plotOptions: {
            		pie: {
	       			 cursor: 'pointer',
               			 innerSize: 120,
                		 depth: 25,
                		 dataLabels:false
            		}
        		}
                }
            }]
        }
    });
});
		</script>



<script type="text/javascript">
		
 var data_C = [{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">Non JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_2_C/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentaseone_C,2, ',', ','); ?>%)</span>',y: <?php echo $persentaseone_C; ?>,id: 5,color:'#64b8df' },{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_3_C/1000000, 2, ',', ','); ?> T</span><br><span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;">(<?php echo number_format( $persentasetwo_C,2, ',', ','); ?>%)</span>',y: <?php echo $persentasetwo_C; ?>,id: 6,color:'#8ecb60' }];
 
$(function () {
     $('#container2').hide();
	$('#container3').hide();
	$('#dem').hide();
	$('#containerA').hide();
 	$('#containerB').hide();
 	$('#containerC').hide();
 	$('#containerD').hide();
    $('#container6').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0
            }
        },
        title: {
            text: "DOP 3 <br>Total : <?php echo $format_indonesia = number_format (($total_3_C+$total_2_C)/1000000, 2, ',', ','); ?> T",
                margin: 0,
                y: 0,
                x: 0,
                align: 'center',
                verticalAlign: 'middle',
                style :
                {
                	color: '#4572A7',
	                fontSize: '15px'
                }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
	credits: {
    		  enabled: false
  		},
         plotOptions: {
            pie: {
            cursor: 'pointer',
                innerSize: 120,
                depth: 25,
                dataLabels: 
                {
                   distance: 1
                   
                }
            }
        },exporting: {
            enabled: false
        },
        series: [{
            type: 'pie',
               name: 'Persentase',
              "data": data_C,
               point:{
                  events:{
                      click: function (event) {
			 if(this.id==6){
			 	$('#container').hide();
			 	$('#container2').hide();
			 	$('#dem').show();
			 	$('#container3').hide();
			 	$('#containerA').hide();
			 	$('#containerB').hide();
			 	$('#containerC').hide();
			 	$('#containerD').show();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=D");
			 	}
			 else if(this.id==5){
			 	$('#container').hide();
			 	$('#container2').hide();
			 	$('#dem').show();
			 	$('#container3').hide();
			 	$('#containerA').hide();
			 	$('#containerB').hide();
			 	$('#containerC').show();
			 	$('#containerD').hide();
var thn = $('#year').val();
					var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=C");
			 	}
                      }
                  }
              }
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 320
                },
                chartOptions: {
                    plotOptions: {
            		pie: {
	       			 cursor: 'pointer',
               			 innerSize: 120,
                		 depth: 25,
                		 dataLabels:false
            		}
        		}
                }
            }]
        }
    });
});
		</script>
<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
         <span style="color:#6483c3;">
         <b>Total Diperoleh : <?php echo $format_indonesia = number_format ($kill/1000000, 2, ',', ','); ?></b> T
         </span>
        </div>

            <div id="container4"></div>
            <div id="container5"></div>
            <div id="container6"></div> 

<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;" class="bawah">
		<img src="../image/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
		<span style="color:#64b8df;"><b>Non JO : <?php echo number_format( $persentaseone_kill,2, ',', ','); ?>%</b></span>&nbsp;&nbsp;&nbsp;&nbsp;
  		<img src="../image/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
  		<span style="color:#8ecb60;"><b>JO : <?php echo number_format( $persentasetwo_kill,2, ',', ','); ?>%</b></span></br>
  		&nbsp;
	</div>

  