<?php 
	error_reporting(0);
	$s;
	$json = null ;
	$stage=$_GET["status"];
	$id=$_GET["id"];
	$pilih=$_GET["year"];
	$pilih_2=$_GET["month"];
	if($id==1 || $id==2 || $id==3)
		{
			if($stage=="RKAP"){
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=ALL&tahun='.$pilih.'');
				}
			else if($stage=="Terendah"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=Terendah&tahun='.$pilih.'');
				}
			else if($stage=="Terkontrak"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=Terkontrak&tahun='.$pilih.'');
				}
		}
	if($id==4 || $id==5 || $id==6)
		{
			if($stage=="RKAP"){
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=ALL&tahun='.$pilih.'');
				}
			else if($stage=="Terendah"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=Terendah&tahun='.$pilih.'');
				}
			else if($stage=="Terkontrak"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=Terkontrak&tahun='.$pilih.'');
				}
		}
	if($id==7 || $id==8 || $id==9)
		{
			if($stage=="RKAP"){
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=ALL&tahun='.$pilih.'');
			}
			else if($stage=="Terendah"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=Terendah&tahun='.$pilih.'');
				}
			else if($stage=="Terkontrak"){
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=Terkontrak&tahun='.$pilih.'');
			}
		}
	$json_data = json_decode($json,true);
	$total_xx=0;
	for($i=0; $i<count($json_data); $i++)
	{
$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		if($month<=$pilih_2){
		$tangkap=$total_xx;
		$total_xx=$tangkap+$json_data[$i][$s];
}
	}
	
?>

    <span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
		Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total_xx, 0, ',', '.'); ?>
<?php
echo "<a href='https://aarmindonesia.org/wikabpm/highchart/live%20Version/bar_per_dop/download.php?status=$stage&id=$id&year=$pilih&month=$pilih_2'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>";
?> 
	</span>
    <table class="tbl-qa">
		<thead>
			<tr>			
				<th class="table-header" width="60%">Nama Proyek</th>
		                <th class="table-header" width="25%"><?php echo $s; ?></th>
				<th class="table-header" width="15%">Keterangan</th>
			</tr>
		</thead>
		<tbody>    
		<?php for($i=0; $i<count($json_data); $i++){
$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		
			if($month<=$pilih_2){		
			?>
          		<tr class="table-row">
           			<td><?php echo $json_data[$i]['Title']; ?></td>
           			<td><?php echo $format_indonesia = number_format ($json_data[$i][$s], 0, ',', '.'); ?></td>
           			<td><?php echo $json_data[$i]['Status']; ?></td>
         		</tr>
		<?php } }?>
        	</tbody>
     </table>