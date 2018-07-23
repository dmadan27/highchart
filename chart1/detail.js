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
		},
		success: function(output){
			console.log(output);

			// hide highchart
			$('.container-highchart').hide();

			// show detail dan load table
			$('.container-detail').show();
			$('.container-detail').load('chart1/table.php?jenis='+jenis);

		},
		error: function(jqXHR, textStatus, errorThrown){
			alert("Koneksi Error");
            console.log(jqXHR, textStatus, errorThrown);
		}
	});
}