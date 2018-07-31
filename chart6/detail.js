/**
*
*/
function get_detail_data(id, jenis, pemberi){
	// alert('Data yang diklik adalah data dengan id company: '+id+' dan jenis: '+jenis+' dan sumbernya: '+sumber);

	var data = {
		'company': id,
		'jenis': jenis, // rkap, terendah, terkontrak
		'pemberi': pemberi,
		'tahun': $('#tahun').val().trim(),
		'bulan': $('#bulan').val().trim(),
	};

	$.ajax({
		url: "chart6/detail.php",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function(){
			$('.container').block({message: "Please Wait.."});
		},
		success: function(output){
			$('.container').unblock();
			// console.log(output);
			// console.log(data);
			// hide highchart
			$('.container-highchart').hide();

			// show detail dan load table
			$('.container-detail').show();
			$('.container-detail').load('chart6/table.php', function(){
				var url_download = 'download=yes&company='+data.company+'&jenis='+
								data.jenis+'&pemberi='+data.pemberi+'&tahun='+data.tahun+'&bulan='+data.bulan;

				// set total
				$('#total-detail').append(
					output.total+"<a href='chart6/detail.php?"+url_download+"'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>"	
				);
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