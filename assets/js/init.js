$(document).ready(function(){
	setBulan();
	setTahun();

	// $.blockUI.defaults.overlayCSS.backgroundColor = '#fff';
	$.blockUI.defaults.overlayCSS.opacity = 0; 
});
/**
*
*/
function setBulan(){
	var bulan = [
		{value: "01", text: "Januari"},
		{value: "02", text: "Februari"},
		{value: "03", text: "Maret"},
		{value: "04", text: "April"},
		{value: "05", text: "Mei"},
		{value: "06", text: "Juni"},
		{value: "07", text: "Juli"},
		{value: "08", text: "Agustus"},
		{value: "09", text: "September"},
		{value: "10", text: "Oktober"},
		{value: "11", text: "November"},
		{value: "12", text: "Desember"},
	];

	$.each(bulan, function(i, item){
		var option = new Option(item.text, item.value);
		$('#bulan').append(option);
	});
}

/**
*
*/
function setTahun(){
	var tahun = [
		{value: "2016", text: "2016"},
		{value: "2017", text: "2017"},
		{value: "2018", text: "2018"},
	];

	$.each(tahun, function(i, item){
		var option = new Option(item.text, item.value);
		$('#tahun').append(option);
	});

	$('#tahun').val('2018');
}