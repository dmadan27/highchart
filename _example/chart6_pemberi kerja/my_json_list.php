<?php
error_reporting(0);
$judul=$_GET["nama"];
$cari=$_GET["mencari"];
$cari2=$_GET["mencari2"];
$dop2=$_GET["dop2"];
$pilih=$_GET["year"];
$pilih_2=$_GET["month"];
$url =null;
// request API
if($dop2=="DOP1"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=ALL&tahun='.$pilih.'';}
if($dop2=='DOP2'){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=ALL&tahun='.$pilih.'';}
if($dop2=="DOP3"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=ALL&tahun='.$pilih.'';}
if($dop2=="ALL"){$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun='.$pilih.'';}
$json = file_get_contents($url);
 
// deserialize data from JSON
$json_data = json_decode($json,true);
//var_dump
$i=0;
$total = 0;
$total_terendah2 = 0;
$total_terkontrak2 = 0;
$total_RKAP2 = 0;
$kategori = array ();
$groups = array();
$terendah = array();
$tekontrak = array();
$RKAP = array();

	foreach ($json_data as $item) 
		{
		$tmpDate = $item['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		if($month<=$pilih_2){
		if($item['Pemberi'] && $item['Pemberi']!="-")
		{
    			$key = $item['Pemberi'];
	    		$lala=number_format($item['Diperoleh']/1000000,4);
    			$lala2=number_format($item['RKAP']/1000000,4);
    		
    			if (!isset($groups[$key]))
    			{
				$groups[$key] = array('y' => $lala,'id' => $i,);
				if($item['Status']=="Terkontrak")
				{
					$tekontrak[$key]=array('y'=>$lala,'id'=>$i);
					$terendah[$key]=array('y'=>0,'id'=>$i);
					$total_terkontrak2=$total_terkontrak2+$item['Diperoleh'];
					$total=$total+$item['Diperoleh'];	
				}
				else if($item['Status']=="Terendah")
				{
					$terendah[$key]=array('y'=>$lala,'id'=>$i);
					$tekontrak[$key]=array('y'=>0,'id'=>$i);
					$total_terendah2=$total_terendah2+$item['Diperoleh'];
					$total=$total+$item['Diperoleh'];	
				}
				else
				{	
					$tekontrak[$key]=array('y'=>0,'id'=>$i);
					$terendah[$key]=array('y'=>0,'id'=>$i);
				}
				$RKAP[$key] = array('y' => $lala2,'id' => $i);
				$kategori[$i]= $item['Pemberi'];
				$i++;
    			} 
				
			else if(isset($groups[$key]))
			{
        			$groups[$key]['y'] = $groups[$key]['y']+$lala;
				$RKAP[$key]['y']= $RKAP[$key]['y']+$lala2;					
				if($item['Status']=="Terendah")
				{
					$terendah[$key]['y']= $terendah[$key]['y']+$lala;
					$total_terendah2=$total_terendah2+$item['Diperoleh'];
					$total=$total+$item['Diperoleh'];
				}
				else if($item['Status']=="Terkontrak")
				{
					$tekontrak[$key]['y']= $tekontrak[$key]['y']+$lala;
					$total_terkontrak2=$total_terkontrak2+$item['Diperoleh'];
					$total=$total+$item['Diperoleh'];
				}	
			}
			
		}
		
		$total_RKAP2=$total_RKAP2+$item['RKAP'];
		}
	}


$filteredarray = array_values( array_filter($terendah));
$data = json_encode($filteredarray, JSON_NUMERIC_CHECK);

$filteredarray2 = array_values( array_filter($tekontrak) );
$data2 = json_encode($filteredarray2, JSON_NUMERIC_CHECK);

$filteredarray3 = array_values( array_filter($RKAP) );
$data3 = json_encode($filteredarray3, JSON_NUMERIC_CHECK);
$list_kategori = json_encode($kategori);
?>