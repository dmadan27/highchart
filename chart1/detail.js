/**
*
*/
function get_detail_data(id, jenis){
	// alert('Data yang diklik adalah data dengan id company: '+id+' dan jenis: '+jenis);

	var data = {
		'company': id,
		'jenis': jenis, // rkap, terendah, terkontrak
		'tahun': $('#tahun').val().trim(),
		'bulan': $('#bulan').val().trim(),
	};

	$.ajax({
		url: "chart1/detail.php",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function(){
			$('.container').block({message: "Please Wait.."});
		},
		success: function(output){
			$('.container').unblock();
			console.log(output);

			// hide highchart
			$('.container-highchart').hide();

			// show detail dan load table
			$('.container-detail').show();
			$('.container-detail').load('chart1/table.php?jenis='+jenis, function(){
				generate_table_detail(output);	
			});
			
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
function generate_table_detail(data){
	// set total
	$('#total-detail').append(
		data.total+"<a href='chart1/download.php'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>"	
	);

	$.each(data.data, function(i, item){
		// body tabel
		$('.table-detail > tbody:last-child').append(
			'<tr>'+
				// nama proyek
				'<td>'+item.title+'</td>'+
				// nilai diperoleh / rkap
				'<td>'+item.nilai+'</td>'+
				// keterangan
				'<td>'+item.keterangan+'</td>'+
			'</tr>'
		);
		// console.log(item);
	});
}