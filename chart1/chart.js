$(document).ready(function(){
	get_data_chart(function(data){
		generate_chart('body-highchart', data);
	});

	// on click btn highchart
	$('#btn_highchart').on('click', function(){
		back_highchart();
	});

	// onChange tahun dan bulan
	$('#tahun').on('change', function(){
		// reload highchart
		get_data_chart(function(data){
			generate_chart('body-highchart', data);
		});		
	});
	$('#bulan').on('change', function(){
		// reload highchart
		get_data_chart(function(data){
			generate_chart('body-highchart', data);
		});		
	});
});

/**
*
*/
function get_data_chart(handleData){
	var data = {
		'tahun': $('#tahun').val().trim(),
		'bulan': $('#bulan').val().trim(),
	};

	$.ajax({
		url: "chart1/chart.php",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function(){
		},
		success: function(output){
			console.log(output);
			handleData(output);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert("Koneksi Error");
            console.log(jqXHR, textStatus, errorThrown);
		}
	});
}

/**
*
*/
function generate_chart(container, data){
	// set option highchart
	Highcharts.setOptions({
		lang: {
    		decimalPoint: ',',
        	thousandsSep: ' '
		}
	});

	// add event onclick pada tiap bar
	data = addEvent_onClick(data);

	// set total-highchart
	$('#total-highchart').html('<b>'+data.total_highchart+'</b>');

	// set legend-highchart
	setLegend(data.legend_highchart);

	// generate chart
	var myChart = Highcharts.chart(container, {
		chart: {
			type: 'column',
			// chart 3d
			options3d: {
				enabled: true,
	            alpha: 10,
	            beta: 0,
	            depth: 75,
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
				allowPointSelect: false,
				cursor: 'pointer',
				depth: 35,
			 	dataLabels: {
					enabled: true,
					color:'#999',
					allowOverlap: true,
					style: {
						fontFamily:'Arial, Helvetica, sans-serif', 
						fontSize:12 
					},
					formatter: function() {
					    if(this.y > 0) return Highcharts.numberFormat(this.y, 3);
					    else return '';
				 	}
				}
			}
		},
		credits: {
			enabled: false
		},
		// label xAxis chart
		xAxis: {
			categories: data.xAxis.categories,
            labels: {
            	formatter: function(){
            		var value = this.value.split(' | ');
            		return value[0]+'<br/>'+value[1];
            	}
            }
		},
		// label yAxis chart
		yAxis: {
			title: {
				text: null
			},
			labels: {
				formatter: function(){
            		return(this.value)+" T"
            	}
			},
		},
		legend: {
			enabled: false
		},
		series: data.series
	});
}

/**
*
*/
function addEvent_onClick(data){
	// add event on click pada bar
	$.each(data.series, function(i, item){
		data.series[i].point = {
			events: {
				click: function(event){
					get_detail_data(this.id, this.jenis);
				}
			}
		}
	});

	return data;
}

/**
*
*/
function setLegend(data){
	var legend_rkap = '<img src="assets/image/image2/merah.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;'+
					'<span style="color:#ed7d64;">'+data.rkap+'</span></br>';
	var legend_terendah = '<img src="assets/image/image2/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;'+
					'<span style="color:#64b8df;">'+data.terendah+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
	var legend_terkontrak = '<img src="assets/image/image2/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;'+
					'<span style="color:#8ecb60;">'+data.terkontrak+'</span>';

	$('#legend-highchart').html(legend_rkap+legend_terendah+legend_terkontrak);
}

/**
*
*/
function back_highchart(){
	// hide detail
	$('.container-detail').hide();

	// show highchart
	$('.container-highchart').show();
}