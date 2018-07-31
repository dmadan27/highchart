<?php 
	error_reporting(0);
	include "my_json_list.php";
?>
	<script type="text/javascript">
			var data = <?php echo $data; ?>;
			var data2 = <?php echo $data2; ?>;
			var data3 = <?php echo $data3; ?>;
			var xnm=<?php echo $list_kategori ?>;
			$(function () {
			Highcharts.setOptions({
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
                    style: {fontFamily:'Arial, Helvetica, sans-serif',fontSize:12 },
                    formatter: function () {
     			   return Highcharts.numberFormat(this.y,2);
   			 }
                }
            }
        },
		credits: {
    	  enabled: false
  		},
        xAxis: {
            categories: <?php echo $list_kategori ?>,
            labels: {
            	formatter: function() {
	            	var index = this.axis.categories.indexOf(this.value),
	                hitunga= xnm.length,
	                sum = 0;
			
			for (i=0; i<hitunga;i++){
				if(index==i){
                      			sum = data[i]['y']+data2[i]['y'];
                      		} 				
			}
	              	var nilai = sum.toFixed(2);
                      	var angkaStr = nilai.toString().split('.').join(',');          
	                return this.value + '<br>Diperoleh : ' + angkaStr + ' T';
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
                	var hitunga= <?php echo $i; ?>;
			var categoriess = <?php echo $list_kategori ?>;
			for (i=0; i<hitunga;i++){
			if(this.id==i)
			{
				  	$('#container').hide();
				  	$('#container2').show();
				  	$('#dem').show();
				  	var thn = $('#year').val();
					var mnth = $('#month').val();
				  	$('#container2').load("function.php?dop3=<?php echo $dop2; ?>&status=rkap&statu="+categoriess[i].split(' ').join('%20')+"&year="+thn+"&month="+mnth);
			}
			}
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
                     var hitunga= <?php echo $i; ?>;
			var categoriess = <?php echo $list_kategori ?>;
			for (i=0; i<hitunga;i++){
			if(this.id==i)
			{
				  	$('#container').hide();
				  	$('#container2').show();
				  	$('#dem').show();
				  	var thn = $('#year').val();
					var mnth = $('#month').val();
				  	$('#container2').load("function.php?dop3=<?php echo $dop2; ?>&status=terendah&statu="+categoriess[i].split(' ').join('%20')+"&year="+thn+"&month="+mnth);
			}
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
                     var hitunga= <?php echo $i; ?>;
			var categoriess = <?php echo $list_kategori ?>;
			for (i=0; i<hitunga;i++){
			if(this.id==i)
			{
				  	$('#container').hide();
				  	$('#container2').show();
				  	$('#dem').show();
				  	var thn = $('#year').val();
					var mnth = $('#month').val();
				  	$('#container2').load("function.php?dop3=<?php echo $dop2; ?>&status=terkontrak&statu="+categoriess[i].split(' ').join('%20')+"&year="+thn+"&month="+mnth);
			}
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
	<span style="color:#6483c3;"><b>Total Diperoleh : <?php echo $format_indonesia = number_format ($total/1000000, 2, ',', ','); ?> T</b></span>
</div>
<div id="container4" ></div>
<div id="legendary" style="font-size:20px;color:#5c5c57;text-align:center;background-color:#FFF;">
	    	<img src="../image/merah.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
		<span style="color:#ed7d64;"><b>RKAP : <?php echo $format_indonesia = number_format ($total_RKAP2/1000000, 2, ',', ','); ?></b> T</span></br>
		<img src="../image/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
		<span style="color:#64b8df;"><b>Terendah : <?php echo $format_indonesia = number_format ($total_terendah2/1000000, 2, ',', ','); ?></b> T</span>&nbsp;&nbsp;&nbsp;&nbsp;
    		<img src="../image/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;
  		<span style="color:#8ecb60;"><b>Terkontrak : <?php echo $format_indonesia = number_format ($total_terkontrak2/1000000, 2, ',', ','); ?></b> T</span>
	</div>