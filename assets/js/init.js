$(document).ready(function(){
	setBulan();
	setTahun();
});
/**
*
*/
function setBulan(){
	var bulan = [
		{value: "1", text: "Januari"},
		{value: "2", text: "Februari"},
		{value: "3", text: "Maret"},
		{value: "4", text: "April"},
		{value: "5", text: "Mei"},
		{value: "6", text: "Juni"},
		{value: "7", text: "Juli"},
		{value: "8", text: "Agustus"},
		{value: "9", text: "September"},
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