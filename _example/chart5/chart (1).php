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
$total_DOP4 = 0;
$total_DOP5 = 0;
$total_DOP6 = 0;
$total_DOP7 = 0;

$jum_DOP1 = 0;
$jum_DOP2 = 0;
$jum_DOP3 = 0;
$jum_DOP4 = 0;
$jum_DOP5 = 0;
$jum_DOP6 = 0;
$jum_DOP7 = 0;

$jums_DOP1 = 0;
$jums_DOP2 = 0;
$jums_DOP3 = 0;
$jums_DOP4 = 0;
$jums_DOP5 = 0;
$jums_DOP6 = 0;
$jums_DOP7 = 0;

foreach ($json_data as $item) 
	{
			$tmpDate = $item["Create"];
			$date = substr($tmpDate,0,-8);
			$month = substr($date,5,-4);
			
			$lala=number_format($item['Tactic']/1000000,2);
			$lala2=number_format($item['RKAP']/1000000,2);
	
		if($item['Company'] && $month<=$pilih_2)
			{
			if($item['DOP']=="DOP 1"){
	                	$total_DOP1=$total_DOP1+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP1=$jums_DOP1+$item['Diperoleh'];
				}	
	               	}
			if($item['DOP']=="DOP 2"){
	                	 $total_DOP2=$total_DOP2+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP2=$jums_DOP2+$item['Diperoleh'];
				}	
	               }
	               if($item['DOP']=="DOP 3"){
	                	 $total_DOP3=$total_DOP3+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP3=$jums_DOP3+$item['Diperoleh'];
				}	
	               }
	               if($item['DOP']=="DOP 4"){
	                	 $total_DOP4=$total_DOP3+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP4=$jums_DOP4+$item['Diperoleh'];
				}	
	               }
	               if($item['DOP']=="DOP 5"){
	                	 $total_DOP5=$total_DOP5+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP5=$jums_DOP5+$item['Diperoleh'];
				}	
	               }
	               if($item['DOP']=="DOP 6"){
	                	 $total_DOP6=$total_DOP6+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP6=$jums_DOP6+$item['Diperoleh'];
				}	
	               }
	               if($item['DOP']=="DOP 7"){
	                	 $total_DOP7=$total_DOP7+$item['Tactic'];
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jums_DOP7=$jums_DOP7+$item['Diperoleh'];
				}	
	               }
	            }

	}
	
	$total_DOP1=number_format($total_DOP1/1000000,2);
	$total_DOP2=number_format($total_DOP2/1000000,2);
	$total_DOP3=number_format($total_DOP3/1000000,2);
	$total_DOP4=number_format($total_DOP4/1000000,2);
	$total_DOP5=number_format($total_DOP5/1000000,2);
	$total_DOP6=number_format($total_DOP6/1000000,2);
	$total_DOP7=number_format($total_DOP7/1000000,2);
	
	$jum_DOP1=number_format($jums_DOP1/1000000,2);
	$jum_DOP2=number_format($jums_DOP2/1000000,2);
	$jum_DOP3=number_format($jums_DOP3/1000000,2);
	$jum_DOP4=number_format($jums_DOP4/1000000,2);
	$jum_DOP5=number_format($jums_DOP5/1000000,2);
	$jum_DOP6=number_format($jums_DOP6/1000000,2);
	$jum_DOP7=number_format($jums_DOP7/1000000,2);
	
	$total_x=$jum_DOP1/$total_DOP1*100;
	$total_xx=$jum_DOP2/$total_DOP2*100;
	$total_xxx=$jum_DOP3/$total_DOP3*100;
	$total_xxxx=$jum_DOP4/$total_DOP4*100;
	$total_xxxxx=$jum_DOP5/$total_DOP5*100;
	$total_xxxxxx=$jum_DOP6/$total_DOP6*100;
	$total_xxxxxxx=$jum_DOP7/$total_DOP7*100;
?>
<script type="text/javascript">

var data = [
	{y:<?php echo $total_DOP1; ?>, id: 0},
	{y:<?php echo $total_DOP2; ?>, id: 2},
	{y:<?php echo $total_DOP3; ?>,id: 4},
	{y:<?php echo $total_DOP4; ?>, id: 6},
	{y:<?php echo $total_DOP5; ?>, id: 8},
	{y:<?php echo $total_DOP6; ?>, id: 10},
	{y:<?php echo $total_DOP7; ?>, id: 12}
	];
var data2 = [
	{y: <?php echo $jum_DOP1; ?>, id: 1},
	{y: <?php echo $jum_DOP2; ?>, id: 3},
	{y: <?php echo $jum_DOP3; ?>, id: 5},
	{y: <?php echo $jum_DOP4; ?>, id: 7},
	{y: <?php echo $jum_DOP5; ?>, id: 9},
	{y: <?php echo $jum_DOP6; ?>, id: 11},
	{y: <?php echo $jum_DOP7; ?>, id: 13}
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
	$('#containerlis').hide();
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
                    style: {fontFamily:'Arial, Helvetica, sans-serif',fontSize:20},
                    formatter: function () {
										    if(this.y > 0) {
									            return Highcharts.numberFormat(this.y,2);
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
                categories: ["Witon (Wika Beton)"]
            }, {
                name: "CI=<?php echo number_format($total_xx,2, ',', ',');?>%",
                categories: ["Wikon (Wika Industri Konstruksi)"]
            }, {
                name: "CI=<?php echo number_format($total_xxx,2, ',', ',');?>%",
                categories: ["WR (Wika Realty)"]
            }, {
                name: "CI=<?php echo number_format($total_xxxx,2, ',', ',');?>%",
                categories: ["WG (Wika Gedung)"]
            }, {
                name: "CI=<?php echo number_format($total_xxxxx,2, ',', ',');?>%",
                categories: ["WRK (Wika Rekayasa Konstruksi))"]
            }, {
                name: "CI=<?php echo number_format($total_xxxxxx,2, ',', ',');?>%",
                categories: ["Bitumen"]
            }, {
                name: "CI=<?php echo number_format($total_xxxxxxx,2, ',', ',');?>%",
                categories: ["Serpan"]
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
            },
	labels:{
		formatter:function(){
			return(this.value/1)+" T"
			}
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
            name: 'Nilai Proyek',
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
			 if(this.id==6){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%204");
			 }
			 if(this.id==8){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%205");
			 }
			 if(this.id==10){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%206");
			 }
			 if(this.id==12){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=02&kl=DOP%207");
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
			 if(this.id==7){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%204");
			 }
			 if(this.id==9){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%205");
			 }
			 if(this.id==11){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%206");
			 }
			 if(this.id==13){
			 $('#container').hide();
			 $('#containerlis').show();
			 $('#dem').show();
			var thn = $('#year').val();
			var mnth = $('#month').val();
		  	$('#containerlis').load("function.php?year="+thn+"&month="+mnth+"&id=03&kl=DOP%207");
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
	$('#container10').hide();
$('#containerlis').hide();
	$('#dem').hide();
	}
</script>
<div id="legendary" style="font-size:16px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
<span style="color:#6483c3;"></span>
</div>
<div id="container4" ></div>
<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
<img src="../image/ungu1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;<span style="color:#8e8eb7;"><b>Jumlah Nilai Proyek: <?php echo  number_format($total_DOP1+$total_DOP2+$total_DOP3,2, ',', ','); ?></b></span></br>
<img src="../image/orange1.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;<span style="color:#eeaf4b;"><b>Jumlah Nilai Terendah & Terkontrak : <?php echo number_format($jum_DOP1+$jum_DOP2+$jum_DOP3,2, ',', ','); ?></b></span>
</div>