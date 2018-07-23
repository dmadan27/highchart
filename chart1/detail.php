<?php
	// inisialisasi get data post dari client
	$get_company = isset($_POST['company']) ? $_POST['company'] : false;
	$get_jenis = isset($_POST['jenis']) ? $_POST['jenis'] : false;
	$get_tahun = isset($_POST['tahun']) ? $_POST['tahun'] : false;
	$get_bulan = isset($_POST['bulan']) ? $_POST['bulan'] : false;

	// load list anak perusahaan
	require_once '../assets/list_anak_perusahaan.php';