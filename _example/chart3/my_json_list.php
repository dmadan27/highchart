<?php
	// $pilih=$_GET["year"];
	// $pilih_2=$_GET["month"];

	$pilih='2018';
	$pilih_2='07';

	$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun='.$pilih.'');
	
	// deserialize data from JSON
	$json_data = json_decode($json,true);
	$json_datax = json_decode($json,true);
 
	// deserialize data from JSON
	$groups_1 = array();
	$groups_2 = array();
	$groups_3 = array();

	$groups_1_1 = array();
	$groups_2_1 = array();
	$groups_3_1 = array();

	$json_data = json_decode($json,true);

	$total_a=0;
	$total_b=0;
	$total_c=0;


	$kategori_DOP1 = array ();
	$kategori_DOP2 = array ();
	$kategori_DOP3 = array ();


	$ii=0;

	for($i=0; $i<count($json_data); $i++){
		$nilai=number_format($json_data[$i]['Diperoleh']/1000000,4);
	
		$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		
		if($month<=$pilih_2){
			if($json_data[$i]['Sumber'] && $json_data[$i]['Sumber']!="-"){
				$key = $json_data[$i]['Sumber'];
		
				$lala=number_format($json_data[$i]['Diperoleh']/1000000,2);
				$lalaa2=number_format($json_data[$i]['RKAP']/1000000,2);
	
				if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak"){
					
					if($json_data[$i]['DOP']=="DOP 1"){		
						if (!isset($groups_1[$key])){
							if($json_data[$i]['Status']=="Terendah"){
						
								$groups_1[$key]= array('y' => $nilai,'id'=>$ii,);
								$groups_1_1[$key]= array('y' => 0,'id'=>$ii,);
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}
							
							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_1[$key]= array('y' => 0,'id'=>$ii,);
								$groups_1_1[$key]= array('y' => $nilai,'id'=>$ii,);
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
						
							}
							
							$ii++;
							$sum=0;
							
							for($ix=0; $ix<count($json_datax); $ix++){
								if($json_datax[$ix]['Sumber']==$key && $json_datax[$ix]['DOP']=="DOP 1"){
									if($json_data[$ix]['Status']=="Terendah" || $json_data[$ix]['Status']=="Terkontrak"){
						        		$b=$sum;
										$sum=$b+$json_datax[$ix]['Diperoleh'];
								
									}
								}
						
							}

							$decimalsum=number_format($sum/1000000,2, ',', ',');
							$kategori_DOP1[$i]="$key<br>Total : $decimalsum";
							
						}
						else if(isset($groups_1[$key])){
							
							if($json_data[$i]['Status']=="Terendah"){
								$groups_1[$key]['y']= $groups_1[$key]['y']+$nilai;
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}
							
							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_1_1[$key]['y']= $groups_1_1[$key]['y']+$nilai;
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
							}			
						}		
					}
					
					if($json_data[$i]['DOP']=="DOP 2"){
						if (!isset($groups_2[$key])){
							if($json_data[$i]['Status']=="Terendah"){
								$groups_2[$key]= array('y' => $nilai,'id'=>$ii,);
								$groups_2_1[$key]= array('y' => 0,'id'=>$ii,);
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}

							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_2[$key]= array('y' => 0,'id'=>$ii,);
								$groups_2_1[$key]= array('y' => $nilai,'id'=>$ii,);
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
							}
							
							$sum2=0;
							
							for($ix=0; $ix<count($json_datax); $ix++){
								
								if($json_datax[$ix]['Sumber']==$key && $json_datax[$ix]['DOP']=="DOP 2"){
									if($json_data[$ix]['Status']=="Terendah" || $json_data[$ix]['Status']=="Terkontrak"){
						        		$b2=$sum2;
										$sum2=$b2+$json_datax[$ix]['Diperoleh'];
									}

								}
							}

							$decimalsum2=number_format($sum2/1000000,2, ',', ',');
							$kategori_DOP2[$i]="$key<br>Total : $decimalsum2";
							$ii++;
						}
						else if(isset($groups_2[$key])) {
							if($json_data[$i]['Status']=="Terendah"){
								$groups_2[$key]['y']= $groups_2[$key]['y']+$nilai;
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}
							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_2_1[$key]['y']= $groups_2_1[$key]['y']+$nilai;
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
							}			
						}
					}

					if($json_data[$i]['DOP']=="DOP 3"){
						if (!isset($groups_3[$key])){	
							if($json_data[$i]['Status']=="Terendah"){
								$groups_3[$key]= array('y' => $nilai,'id'=>$ii,);
								$groups_3_1[$key]= array('y' => 0,'id'=>$ii,);
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}

							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_3[$key]= array('y' => 0,'id'=>$ii,);
								$groups_3_1[$key]= array('y' => $nilai,'id'=>$ii,);
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
							}

							$sum3=0;
							
							for($ix=0; $ix<count($json_datax); $ix++){
								if($json_datax[$ix]['Sumber']==$key && $json_datax[$ix]['DOP']=="DOP 3"){
									if($json_data[$ix]['Status']=="Terendah" || $json_data[$ix]['Status']=="Terkontrak"){
						        		$b3=$sum3;
										$sum3=$b3+$json_datax[$ix]['Diperoleh'];
									}
								}
							}

							$decimalsum3=number_format($sum3/1000000,2, ',', ',');
							$kategori_DOP3[$i]="$key<br>Total : $decimalsum3";
							$ii++;
						}
						else if(isset($groups_3[$key])){
							if($json_data[$i]['Status']=="Terendah"){
								$groups_3[$key]['y']= $groups_3[$key]['y']+$nilai;
								$total_a=$total_a+$json_data[$i]['Diperoleh'];
							}
							if($json_data[$i]['Status']=="Terkontrak"){
								$groups_3_1[$key]['y']= $groups_3_1[$key]['y']+$nilai;
								$total_b=$total_b+$json_data[$i]['Diperoleh'];
							}		
						}
				
					}
			
				}
			}
		}
	}

	$total_c=$total_b+$total_a;
	$list_kategori_1 = json_encode(array_values($kategori_DOP1));
	$list_kategori_2 = json_encode(array_values($kategori_DOP2));
	$list_kategori_3 = json_encode(array_values($kategori_DOP3));

	$filter_1 = array_values( array_filter($groups_1));
	$filter_2 = array_values( array_filter($groups_2));
	$filter_3 = array_values( array_filter($groups_3));

	$filter_1_1 = array_values( array_filter($groups_1_1));
	$filter_2_1 = array_values( array_filter($groups_2_1));
	$filter_3_1 = array_values( array_filter($groups_3_1));


	$combine_1 = array_merge ($filter_1, $filter_2, $filter_3);
	$list_1 = json_encode($combine_1, JSON_NUMERIC_CHECK);

	$combine_2 = array_merge ($filter_1_1, $filter_2_1, $filter_3_1);

	$list_2 = json_encode($combine_2, JSON_NUMERIC_CHECK);


	echo '<pre>';
	
	echo 'Total :';
	var_dump($total_c);
	echo '<br>';
	
	echo 'List Kategori 1:';
	var_dump($list_kategori_1);
	echo '<br>';

	echo 'Filter 1 :';
	var_dump($filter_1);
	echo '<br>';

	echo 'Filter 1_1 :';
	var_dump($filter_1_1);
	echo '<br>';

	echo 'combine 1 :';
	var_dump($combine_1);
	echo '<br>';

	echo 'combine 2 :';
	var_dump($combine_2);
	echo '<br>';

	echo 'list 1 :';
	var_dump(json_decode($list_1, true));
	echo '<br>';

	echo 'list 2 :';
	var_dump($list_2);
	echo '<br>';
?>