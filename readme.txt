=> Highchart
	
	# requirement:
	-> Xampp versi 5 atau 7 keatas
	-> Browser chrome/firefox
	-> Code Editor bebas (atom, sublime, notepad++, etc)

	# bahasa / teknologi yang dipakai:
	-> bahasa pemrograman php 5 >
	-> bahasa pemrograman js (jQuery)
	-> html + css
	-> plugin highchart

	# apa yang dibuat?
	-> Highchart colomn bar 3d
	-> Highchart pie berbentuk donat 3d

	# apa yang ditampilkan di chart tsb?
	-> Semua Chart memiliki 3 Fungsi utama:
		1. chart
		2. Detail Data
		3. Download / export to excel

	-> Chart 1 - Column Bar Per Anak Perusahaan (OK Terendah dan Terkontrak per Departement (Dalam Trilyun))
		-> url: https://aarmindonesia.org/wikabpm/highchart/live Version/bar_per_dop
		-> menampilkan data RKAP, Terendah, dan Terkontrak per anak perusahaan
		-> data RKAP warna merah (#ed7d64)
		-> data Terendah warna biru (#64b8df)
		-> data Terkontrak warna hijau (#8ecb60)
		-> saat di klik salah satu bar maka akan menampilkan detail data berupa list proyek sesuai dengan rkap/terendah/terkontrak
		-> detail list data proyek menampilkan kolom nama proyek, rkap/diperoleh, dan keterangan
		-> jika rkap yang diklik, tampilkan semua data baik itu terkontrak/terendah
		-> jika terendah/terkontrak diklik, tampilkan data yg terkontrak/terendahnya saja
		-> menampilkan data total diperoleh (total secara keseluruhan dari setiap anak perusahaan yang Terendah dan Terkontrak)
		-> menampilkan data total diperoleh tiap anak perusahaan
		-> menampilkan total RKAP, Terendah, Terkontrak semua anak perusahaan

	-> Chart 2 - Pie Donut Per Anak Perusahaan (JO vs Non JO (Dalam Trilyun))
		-> url: https://aarmindonesia.org/wikabpm/highchart/live Version/group_donat
		-> menampilkan data JO dan NON JO per anak perusahaan
		-> data JO warna hijau (#8ecb60)
		-> data NON JO warna biru (#64b8df)
		-> saat di klik salah satu maka akan menampilkan detail data berupa list proyek sesuai dengan JO/Non JO
		-> detail list data proyek menampilkan kolom pemberi kerja, nama proyek, diperoleh, dan keterangan
		-> menampilkan data total diperoleh (total secara keseluruhan dari setiap anak perusahaan yang jo dan non jo)
		-> menampilkan data total diperoleh per anak perusahaan
		-> menampilkan data JO dan Non JO per anak perusahaan dalam bentuk data aktual dan persentase
		-> menampilkan total keseluruhan data jo dan non jo dalam bentuk persentase

	-> Chart 3 - Column Bar Sumber Dana (OK Terendah dan Terkontrak per Sumbe Dana (Dalam Trilyun)) 
		-> url: https://aarmindonesia.org/wikabpm/highchart/live%20Version/group_bar_per_sumber/
		-> menampilkan data terendah dan terkontrak per sumber per anak perusahaan
		-> data Terkontrak warna hijau (#8ecb60)
		-> data Terendah warna biru (#64b8df)
		-> saat di klik salah satu maka akan menampilkan detail data berupa list proyek sesuai dengan sumbernya per anak perusahaan
		-> detail list data proyek menampilkan kolom nama proyek, diperoleh, dan keterangan
		-> menampilkan total diperoleh secara keseluruhan
		-> menampilkan data total diperoleh per sumber per anak perusahaan
		-> menampilkan total terendah dan terkontrak secara keseluruhan

	-> Chart 4 - Column Bar per anak perusahaan (Competitive Index Berdasarkan Jumlah Proyek)
		-> url: https://aarmindonesia.org/wikabpm/highchart/live%20Version/group_Collum_CI_Jumlah/
		-> data Jumlah Proyek warna ungu (#8e8eb7)
		-> data Terendah & Terkontrak warna orange (#eeaf4b)
		-> saat di klik salah satu maka akan menampilkan detail data berupa list proyek sesuai dengan jumlah proyek / jumlah terkontrak dan terendah per anak perusahaan
		-> detail list data proyek menampilkan kolom nama proyek, diperoleh, dan keterangan
		-> menampilkan data CI (persentase (terendah&terkontrak) / jumlah proyek * 100) per anak perusahaan
		-> menampilkan data jumlah penawaran secara menyeluruh
		-> menampilkan data jumlah terendah & terkontrak secara menyeluruh

	-> Chart 5 - Column Bar per anak perusahaan (Competitive Index Berdasarkan Nilai Proyek (Dalam Trilyun))
		-> url: https://aarmindonesia.org/wikabpm/highchart/live%20Version/group_Collum_CI_Nilai/
		-> data Nilai Proyek warna ungu (#8e8eb7)
		-> data Terendah & Terkontrak warna orange (#eeaf4b)
		-> saat di klik salah satu maka akan menampilkan detail data berupa list proyek sesuai dengan nilai proyek / nilai terkontrak dan terendah per anak perusahaan
		-> detail list data proyek menampilkan kolom nama proyek, penawaran/diperoleh, dan keterangan
		-> menampilkan data CI (persentase (terendah&terkontrak) / jumlah proyek * 100) per anak perusahaan
		-> menampilkan data jumlah penawaran secara menyeluruh
		-> menampilkan data jumlah terendah & terkontrak secara menyeluruh