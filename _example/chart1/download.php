<?php 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=hasil-export.xls");

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

    <table class="tbl-qa" border="1px solid black">
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
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="3" line-height="bold">Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total_xx, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
     </table>