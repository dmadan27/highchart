<?php 
	error_reporting(0);
	include "my_json_list.php";	
?>
<script type="text/javascript">

var data = <?php echo $list_1;?>;
var data2 = <?php echo $list_2; ?>;





$(function () {
Highcharts.setOptions({
    lang: {
        decimalPoint: ',',
        thousandsSep: ' '
    }
});

	/** DOP1 **/
	$('#container2').hide();
	$('#dem').hide();
        $('#container4').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true
            }
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
credits: {
    	  enabled: false
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
      			  return Highcharts.numberFormat(this.y,2);
   			 }
                }
            }
        },
        xAxis: {
            categories: [{
                name: "DOP 1",
                categories: <?php echo $list_kategori_1; ?>
            }, {
                name: "DOP 2",
                categories: <?php echo $list_kategori_2; ?>
            }, {
                name: "DOP 3",
                categories: <?php echo $list_kategori_3; ?>
            }],
            labels: {
                           rotation: 0
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
            name: 'Terendah',
            "data": data,
             point:{
                  events:{
                      click: function (event) {
			var hitung_DOP1= <?php echo count($kategori_DOP1); ?>;
			var hitung_DOP2= <?php echo count($kategori_DOP1)+count($kategori_DOP2); ?>;
			var hitung_DOP3= <?php echo count($kategori_DOP1)+count($kategori_DOP2)+count($kategori_DOP3); ?>;
			var Kategori_one= <?php echo $list_kategori_1; ?>;
			var Kategori_two= <?php echo $list_kategori_2; ?>;
			var Kategori_three= <?php echo $list_kategori_3; ?>;
			if(this.id < hitung_DOP1)
			{
				var splite=Kategori_one[this.id].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP1&status=terendah&rkap=no&tabel=Sumber&statu="+splite[0].split(' ').join('%20'));
			}
			if(this.id >= hitung_DOP1 && this.id < hitung_DOP2)
			{
				var no_id=this.id-hitung_DOP1;
				var splite2=Kategori_two[no_id].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP2&status=terendah&rkap=no&tabel=Sumber&statu="+splite2[0].split(' ').join('%20'));		
			}
			if(this.id >= hitung_DOP2 && this.id < hitung_DOP3)
			{
				var no_id_one=this.id-hitung_DOP2;
				var splite3=Kategori_three[no_id_one].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP3&status=terendah&rkap=no&tabel=Sumber&statu="+splite3[0].split(' ').join('%20'));			
			}
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
			var hitung_DOP1= <?php echo count($kategori_DOP1); ?>;
			var hitung_DOP2= <?php echo count($kategori_DOP1)+count($kategori_DOP2); ?>;
			var hitung_DOP3= <?php echo count($kategori_DOP1)+count($kategori_DOP2)+count($kategori_DOP3); ?>;
			var Kategori_one= <?php echo $list_kategori_1; ?>;
			var Kategori_two= <?php echo $list_kategori_2; ?>;
			var Kategori_three= <?php echo $list_kategori_3; ?>;
			if(this.id < hitung_DOP1)
			{
				var splite=Kategori_one[this.id].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP1&status=terkontrak&rkap=no&tabel=Sumber&statu="+splite[0].split(' ').join('%20'));
			}
			if(this.id >= hitung_DOP1 && this.id < hitung_DOP2)
			{
				var no_id=this.id-hitung_DOP1;
				var splite2=Kategori_two[no_id].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP2&status=terkontrak&rkap=no&tabel=Sumber&statu="+splite2[0].split(' ').join('%20'));		
			}
			if(this.id >= hitung_DOP2 && this.id < hitung_DOP3)
			{
				var no_id_one=this.id-hitung_DOP2;
				var splite3=Kategori_three[no_id_one].split('<br>');
				$('#container').hide();
				$('#container2').show();
				$('#dem').show();
				$('#container2').load("function.php?dop2=DOP3&status=terkontrak&rkap=no&tabel=Sumber&statu="+splite3[0].split(' ').join('%20'));			
			}
                      }
                  }
              },
            color:'#8ecb60'
        }
        ]
    });
});
</script>
<script type="text/javascript">
function backon(){
	$('#container').show();
	$('#container2').hide();
	
	$('#dem').hide();
	}
</script>
	<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:right;padding-top:10px;padding-right:10px;background-color:#FFF;">
			<span style="color:#6483c3;"><b>Total Diperoleh : <?php echo $format_indonesia = number_format ($total_c/1000000, 2, ',', ','); ?></b> T</span>
		</div>
		<div id="container4" style="height:100%;"></div>
		<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
			<img src="../image/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
			<span style="color:#64b8df;"><b>Terendah : <?php echo $format_indonesia = number_format ($total_a/1000000, 2, ',', ','); ?></b> T</span>&nbsp;&nbsp;&nbsp;&nbsp;
  			<img src="../image/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
  			<span style="color:#8ecb60;"><b>Terkontrak : <?php echo $format_indonesia = number_format ($total_b/1000000, 2, ',', ','); ?></b> T</span></br>
  			&nbsp;
