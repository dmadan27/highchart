<?php
//header('Content-Type: application/json');
$pilih=$_GET["year"];
$pilih_2=$_GET["month"];
$jsonData = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun='.$pilih.'');
$json_a = json_decode($jsonData, true);
/* $current_year = date('Y');*/
$current_year = $_GET["year"];

$terendah = 0;
$terkontrak = 0;
$RKAP = 0;

$terendah1 = 0;
$terkontrak1 = 0;
$RKAP1 = 0;

$terendah2 = 0;
$terkontrak2 = 0;
$RKAP2 = 0;

$terendah3 = 0;
$terkontrak3 = 0;
$RKAP3 = 0;

foreach ($json_a as $key => $val) {
			$status = $val["Status"];
			$tmpDate = $val["Create"];
			$DOP = $val["DOP"];
			$date = substr($tmpDate,0,-8);
			$year = $val["Tahun"];
			$month = substr($date,5,-4);
			//echo $val["DOP"]." - ".$val["Diperoleh"]." - ".$year."<br/>";
			if($month<=$pilih_2){
				if($DOP == "DOP 1"){
					if($status == "Terendah"){
						$terendah+=$val["Diperoleh"];
					}
					if($status == "Terkontrak"){
						$terkontrak+=$val["Diperoleh"];
					}
						$RKAP+=$val["RKAP"];	
				}
				if($DOP == "DOP 2"){
					if($status == "Terendah"){
						$terendah1+=$val["Diperoleh"];
					}
					if($status == "Terkontrak"){
						$terkontrak1+=$val["Diperoleh"];
					}
						$RKAP1+=$val["RKAP"];
				}
				if($DOP == "DOP 3"){
					if($status == "Terendah"){
						$terendah2+=$val["Diperoleh"];
					}
					if($status == "Terkontrak"){
						$terkontrak2+=$val["Diperoleh"];
					}
						$RKAP2+=$val["RKAP"];
				}
				if($DOP == "DOP 4"){
					if($status == "Terendah"){
						$terendah2+=$val["Diperoleh"];
					}
					if($status == "Terkontrak"){
						$terkontrak2+=$val["Diperoleh"];
					}
						$RKAP2+=$val["RKAP"];
				}
				
			}
			
			
}
$DOP1 = array(
			1=>$terendah,
			2=>$terkontrak,
			3=>$RKAP
		);
$DOP2 = array(
			1=>$terendah1,
			2=>$terkontrak1,
			3=>$RKAP1
		);
$DOP3 = array(
			1=>$terendah2,
			2=>$terkontrak2,
			3=>$RKAP2
		);
$DOP4 = array(
			1=>$terendah2,
			2=>$terkontrak2,
			3=>$RKAP2
		);
			
	$tmp_dop1 = array_values($DOP1);
	$tmp_dop2 = array_values($DOP2);
	$tmp_dop3 = array_values($DOP3);
	$tmp_dop4 = array_values($DOP4);
	
	$final_dop1=json_encode($tmp_dop1, JSON_NUMERIC_CHECK);
	$final_dop2=json_encode($tmp_dop2, JSON_NUMERIC_CHECK);
	$final_dop3=json_encode($tmp_dop3, JSON_NUMERIC_CHECK);
	$final_dop4=json_encode($tmp_dop4, JSON_NUMERIC_CHECK);
/* 	echo $final_dop1."<br/>";
	echo $final_dop2."<br/>";
	echo $final_dop3; */
?>