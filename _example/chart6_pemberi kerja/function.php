<?php 
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

    <span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
		Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total_xx, 0, ',', '.'); ?>
<?php
echo "<a href='https://aarmindonesia.org/wikabpm/highchart/live%20Version/bar_per_pemberi_kerja/download.php?id=$id&dop3=$DOP&status=$stage&statu=$stat&year=$pilih&month=$pilih_2'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>";
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
        	
     </table>