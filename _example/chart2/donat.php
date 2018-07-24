<?php 
	error_reporting(0);
	include "my_json_list.php";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Wika</title>
                <link rel="stylesheet" href="../style.css" type="text/css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
				<script type="text/javascript">
		
 var data = [{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:18px;">Non JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_2/1000000, 2, ',', ','); ?> T</span>',y: <?php echo $persentaseone; ?>,id: 0,color:'#64b8df' },{name: '<span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:18px;">JO :</span><br> <span style="color:#999;font-family:Arial, Helvetica, sans-serif;font-size:12px;"><?php echo $format_indonesia = number_format ($total_3/1000000, 2, ',', ','); ?> T</span>',y: <?php echo $persentasetwo; ?>,id: 1,color:'#8ecb60' }];
 
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
            text: ''
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
                innerSize: 150,
                depth: 50
            }
        },
        series: [{
            type: 'pie',
               name: 'Persentase',
              "data": data,
               point:{
                  events:{
                      click: function (event) {
			 $('#container').hide();
			 $('#container2').show();
			 $('#dem').show();
			 $('#container2').load("function.php?status=ALL&departement=<?php echo $dop2; ?>&id="+this.id);
                      }
                  }
              }
        }]
    });
});
		</script>
		
		
		
		<script type="text/javascript">
                  function backon(){
	           $('#container').show();
	           $('#container2').hide();
	            $('#container3').hide();
	           $('#dem').hide();
	         }
</script>

		
	</head>
	<body>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div id="container" style="height:100%">
	
	<div id="container4" style="min-height:40%;"></div>
	
</div>


	<!---HighChart-->
			<div id="container2" style="background-color:#FFF;min-height:400px;"></div>
		<!------>
</body>
</html>
