<?php 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=hasil-export.xls");
 
	error_reporting(0);
	$s;
	$json = null ;
	
	$id=$_GET["id"];
	$DOP=$_GET["dop3"];
	$stage=$_GET["status"];
	$stat=$_GET["statu"];
	$pilih=$_GET["year"];
	$pilih_2=$_GET["month"];
	
	if($DOP=="DOP1")
		{
			if($stage=="rkap")
			{
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=ALL&tahun='.$pilih.'');
			}
			else if($stage=="terendah")
			{
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=Terendah&tahun='.$pilih.'');
			}
			else if($stage=="terkontrak")
			{
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?status=Terkontrak&tahun='.$pilih.'');
			}
		}
	if($DOP=="DOP2")
		{
			if($stage=="rkap")
			{
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=ALL&tahun='.$pilih.'');
			}
			else if($stage=="terendah")
			{
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=Terendah&tahun='.$pilih.'');
			}
			else if($stage=="terkontrak")
			{
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?status=Terkontrak&tahun='.$pilih.'');
			}
		}
	if($DOP=="DOP3")
		{
			if($stage=="rkap")
			{
				$s="RKAP";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=ALL&tahun='.$pilih.'');
			}
			else if($stage=="terendah")
			{
				$s="Diperoleh";
				$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?status=Terendah&tahun='.$pilih.'');
			}
			else if($stage=="terkontrak")
			{
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

		if($json_data[$i]['Pemberi']==$stat)
		{
			$tangkap=$total_xx;
			$total_xx=$tangkap+$json_data[$i][$s];
		}
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
		<?php 
		for($i=0; $i<count($json_data); $i++)
		{
		$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
			if($month<=$pilih_2){
				if($json_data[$i]['Pemberi']==$stat)
				{	
			?>
	          		<tr class="table-row">
	           			<td><?php echo $json_data[$i]['Title']; ?></td>
	           			<td><?php echo $format_indonesia = number_format ($json_data[$i][$s], 0, ',', '.'); ?></td>
	           			<td><?php echo $json_data[$i]['Status']; ?></td>
	         		</tr>
			<?php
				 } 
			}
		}
		?>
        	</tbody>
        	<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="3" line-height="bold">Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total_xx, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
     </table>