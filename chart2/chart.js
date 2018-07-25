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
		'company': $('#company').val().trim(),
	};

	$.ajax({
		url: "chart2/chart.php",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function(){
			$('.container').block({message: "Please Wait.."});
		},
		success: function(output){
			console.log(output);
			$('.container').unblock();
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

	// set total-highchart
	$('#total-highchart').html('<b>'+data.total_diperoleh+'</b>');

	// set legend-highchart
	setLegend(data.legend_highchart);

	// console.log(item);

	// generate chart
	var myChart = Highcharts.chart(container, {
		chart: {
			type: 'pie',
			// chart 3d
			options3d: {
				enabled: true,
	            alpha: 15,
	            beta: 0,
			}
		},
		title: {
			text: data.text,
			margin: 0,
			y: 0,
			x: 0,
			align: 'center',
			verticalAlign: 'middle',
			style: {
				color: '#4572A7',
				fontSize: '15px'
			}
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		subtitle: {
			text: ''
		},
		plotOptions: {
			pie: {
				cursor: 'pointer',
				innerSize: 120,
				depth: 25,
				dataLabels: {
					distance: 1
				}
			}
		},
		credits: {
			enabled: false
		},
		exporting: {
			enabled: false
		},
		series: [{
				type: 'pie',
				name: 'Persentase',
				data: data.data,
				point: {
					events:{
						click: function(event){
							get_detail_data(this.id, this.jenis);
						}
					}
				}
			}
		],
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
								dataLabels: false
							}
						}
					}
				}
			]
		}		
	});
}

/**
*
*/
function generate_chart_dinamis(container, data){
	// set option highchart
	Highcharts.setOptions({
		lang: {
    		decimalPoint: ',',
        	thousandsSep: ' '
		}
	});

	// // set total-highchart
	// $('#total-highchart').html('<b>'+data.total_highchart+'</b>');

	// // set legend-highchart
	// setLegend(data.legend_highchart);

	// lakukan perulangan
	$.each(data.data, function(i, item){
		var id_container = 'container'+(i+1);
		var div = '<div class="container-donat" id="'+id_container+'"></div>';
		var text = data.text[i];

		// append div container
		$('#body-highchart').append(div);

		// console.log(item);

		// generate chart
		var myChart = Highcharts.chart(id_container, {
			chart: {
				type: 'pie',
				// chart 3d
				options3d: {
					enabled: true,
		            alpha: 15,
		            beta: 0,
				}
			},
			title: {
				text: text,
				margin: 0,
				y: 0,
				x: 0,
				align: 'center',
				verticalAlign: 'middle',
				style: {
					color: '#4572A7',
					fontSize: '15px'
				}
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			subtitle: {
				text: ''
			},
			plotOptions: {
				pie: {
					cursor: 'pointer',
					innerSize: 120,
					depth: 25,
					dataLabels: {
						distance: 1
					}
				}
			},
			credits: {
				enabled: false
			},
			exporting: {
				enabled: false
			},
			series: [{
					type: 'pie',
					name: 'Persentase',
					data: item,
					point: {
						events:{
							click: function(event){
								get_detail_data(this.id, this.jenis);
							}
						}
					}
				}
			],
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
									dataLabels: false
								}
							}
						}
					}
				]
			}		
		});
	});
}

/**
*
*/
function setLegend(data){
	var legend_non_jo = '<img src="assets/image/image2/biru.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;'+
					'<span style="color:#64b8df;">'+data.non_jo+'</span></br>';
	var legend_jo = '<img src="assets/image/image2/hijau.png" style="width:10px;height:10px;border-radius:5px;" />&nbsp;'+
					'<span style="color:#8ecb60;">'+data.jo+'</span>&nbsp;&nbsp;&nbsp;&nbsp;';

	$('#legend-highchart').html(legend_non_jo+legend_jo);
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