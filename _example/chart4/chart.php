<?php 
error_reporting(0);
$pilih=$_GET["year"];
$pilih_2=$_GET["month"]; 
$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun='.$pilih.'');
// deserialize data from JSON
$json_data = json_decode($json,true);
//var_dump
$i=0;
$total = 0;
$total_2 = 0;
$total_DOP1 = 0;
$total_DOP2 = 0;
$total_DOP3 = 0;

$jum_DOP1 = 0;
$jum_DOP2 = 0;
$jum_DOP3 = 0;


foreach ($json_data as $item) 
	{
			$tmpDate = $item["Create"];
			$date = substr($tmpDate,0,-8);
			$month = substr($date,5,-4);

		if($item['Tactic'] && $month<=$pilih_2)
		{
		
			if($item['DOP']=="DOP 1"){
	                $total_DOP1++;

				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP1++;
				}	
	               	}
			if($item['DOP']=="DOP 2"){
	                	 $total_DOP2++;
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP2++;
				}	
	               }
	        if($item['DOP']=="DOP 3"){
	                	 $total_DOP3++;
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP3++;
				}	
	               }
	      }    
	}
	$total_x=$jum_DOP1/$total_DOP1*100;
	$total_xx=$jum_DOP2/$total_DOP2*100;
	$total_xxx=$jum_DOP3/$total_DOP3*100;
?>
<script type="text/javascript">

var data = [
	{y:<?php echo $total_DOP1; ?>, id: 0},
	{y:<?php echo $total_DOP2; ?>, id: 2},
	{y:<?php echo $total_DOP3; ?>,id: 4},
	];
var data2 = [
	{y: <?php echo $jum_DOP1; ?>, id: 1},
	{y: <?php echo $jum_DOP2; ?>, id: 3},
	{y: <?php echo $jum_DOP3; ?>, id: 5},
	];

$(function () {
Highcharts.setOptions({
    lang: {
        decimalPoint: ',',
        thousandsSep: ' '
    }
});
	$('#container2').hide();
	$('#container3').hide();
	$('#container5').hide();
	$('#container6').hide();
	$('#container7').hide();
	$('#container8').hide();
	$('#container9').hide();
	$('#container10').hide();
	
	$('#dem').hide();
        $('#container4').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                
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
                    style: {fontFamily:'Arial, Helvetica, sans-serif',fontSize:20 },
                    formatter: function () {
										    if(this.y > 0) {
									            return Highcharts.numberFormat(this.y,0);
										    } else {
										        return '';
										    }
   										 }
                }
            }
        },
        xAxis: {
           categories: [{
                name: "CI=<?php echo number_format($total_x,2, ',', ',');?>%",
                categories: ["DOP 1"]
            }, {
                name: "CI=<?php echo number_format($total_xx,2, ',', ',');?>%",
                categories: ["DOP 2"]
            }, {
                name: "CI=<?php echo number_format($total_xxx,2, ',', ',');?>%",
                categories: ["DOP 3"]
            }],
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
            }
	
        },
credits: {
    	  enabled: false
  		},
	legend: {
            enabled: false
        },
        series: [
        {
            name: 'Jumlah Proyek',
            "data": data,
             point:{
                  events:{
                      click: function (event) {
			 if(this.id==0){
			$('#container').hide();
			$('#containerlis').show();
			$('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%201");
			 }
			 if(this.id==2){
			$('#container').hide();
			 $('#containerlis').show();
			$('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%202");
			 }
			if(this.id==4){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%203");
			 }
			 
                      }
                  }
              },
            color:'#8e8eb7'
        },
        {
            name: 'Terendah & Terkontrak',
            "data": data2,
             point:{
                  events:{
                      click: function (event) {
			if(this.id==1){
			$('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			 var thn = $('#year').val();
			 var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%201");
			 }
			 if(this.id==3){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%202");
			 }
			 if(this.id==5){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%203");
			 }
			 
                      }
                  }
              },
            color:'#eeaf4b'
        }
        ]
    });
});
                </script>
<script type="text/javascript">
function backon(){
	$('#container').show();
	$('#container2').hide();
	$('#container3').hide();
	$('#container5').hide();
	$('#container6').hide();
	$('#container7').hide();
	$('#container8').hide();
	$('#container9').hide();
	$('#containerlis').hide();
	$('#dem').hide();
	}
</script>
<div id="legendary" style="font-size:16px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
<span style="color:#6483c3;"></span>
</div>
<div id="container4" ></div>
<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
<img src="../image/ungu1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;<span style="color:#8e8eb7;"><b>Jumlah Penawaran: <?php echo $total_DOP1+$total_DOP2+$total_DOP3; ?></b></span></br>
<img src="../image/orange1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;<span style="color:#eeaf4b;"><b>Terendah & Terkontrak : <?php echo $jum_DOP1+$jum_DOP2+$jum_DOP3; ?></b></span>
  </div>