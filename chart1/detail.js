/**
*
*/
function get_detail_data(id){
	alert('Data yang diklik adalah data dengan id company: '+id);

	$('.container-highchart').hide();


	// var data = {
	// 	'company': id,
	// 	'tahun': $('#tahun').val().trim(),
	// 	'bulan': $('#bulan').val().trim(),
	// };

	// $.ajax({
	// 	url: "chart1/detail.php",
	// 	type: "POST",
	// 	dataType: "JSON",
	// 	data: data,
	// 	beforeSend: function(){
	// 	},
	// 	success: function(output){
	// 		console.log(output);
	// 		// hide highchart
	// 		// show detail
	// 	},
	// 	error: function(jqXHR, textStatus, errorThrown){
	// 		alert("Koneksi Error");
 //            console.log(jqXHR, textStatus, errorThrown);
	// 	}
	// });
}