<?php 
error_reporting(0);
$dop2="DOP1";
$url =null;

// request API
if($dop2=="DOP1"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=ALL&tahun=2016';}
if($dop2=='DOP2'){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=ALL&tahun=2016';}
if($dop2=="DOP3"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=ALL&tahun=2016';}
if($dop2=="ALL"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun=2016';}
$json = file_get_contents($url);
// deserialize data from JSON
$json_data = json_decode($json,true);

//var_dump
$i=0;
$total = 0;
$total_2 = 0;
$total_3 = 0;

for($i=0; $i<count($json_data); $i++){
		$total=$total+$json_data[$i]['RKAP'];
		if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak")
		{
			if($json_data[$i]['Jenis']=="Non JO")
			{
				$total_2=$total_2+$json_data[$i]['Diperoleh'];
			}
			if($json_data[$i]['Jenis']=="JO")
			{
				$total_3=$total_3+$json_data[$i]['Diperoleh'];
			}
		}	
	}
				$total=$total_2+$total_3;
				$persentaseone=($total_2/$total)*100;
				$persentasetwo=($total_3/$total)*100;
				

?>