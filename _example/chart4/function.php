<?php
error_reporting(0);
$pilih=$_GET["year"];
$pilih_2=$_GET["month"];
$pilih_3=$_GET["id"];
$kl=$_GET["kl"]; 
$json = file_get_contents('https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_ALL.php?tahun='.$pilih.'');
// deserialize data from JSON
$json_data = json_decode($json,true);
//var_dump
$i=0;
$total = 0;
$total_2 = 0;
$total_DOP1 = 0;
$total_DOP2 = 0;
$total_DOP3 = 0;

$jum_DOP1 = 0;
$jum_DOP2 = 0;
$jum_DOP3 = 0;

foreach ($json_data as $item) 
	{
			$tmpDate = $item["Create"];
			$date = substr($tmpDate,0,-8);
			$month = substr($date,5,-4);

		if($item['Tactic'] && $month<=$pilih_2)
		{
		
			if($item['DOP']=="DOP 1"){
	                $total_DOP1++;

				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP1++;
				}	
	               	}
			if($item['DOP']=="DOP 2"){
	                	 $total_DOP2++;
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP2++;
				}	
	               }
	               if($item['DOP']=="DOP 3"){
	                	 $total_DOP3++;
				if($item['Status']=="Terkontrak" || $item['Status']=="Terendah")
				{
					$jum_DOP3++;
				}	
	               }
	      }    
	}
	$total_x=$jum_DOP1/$total_DOP1*100;
	$total_xx=$jum_DOP2/$total_DOP2*100;
	$total_xxx=$jum_DOP3/$total_DOP3*100;
?>
<?php if($pilih_3=="02"){ ?>
<div id="container2" style="background-color:#FFF;min-height:400px;">
		<span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
<?php
echo "<a href='https://aarmindonesia.org/wikabpm/highchart/live%20Version/testing/download.php?year=$pilih&month=$pilih_2&id=$pilih_3&kl=$kl'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>";
?></span>
		  <table class="tbl-qa">
		  <thead>
		    <tr>
			<th class="table-header" width="50%">Nama Proyek</th>
                        <th class="table-header" width="20%">Diperoleh</th>
			<th class="table-header" width="30%">Keterangan</th>
		    </tr>
		  </thead>
		  <tbody>
		  <?php for($i=0; $i<count($json_data); $i++){
		$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		if($json_data[$i]['Tactic'] && $month<=$pilih_2){	
		  if($json_data[$i]['DOP']==$kl){
?>
                   <tr class="table-row">
                	<td><?php echo $json_data[$i]['Title']; ?></td>
                	<td><?php echo $format_indonesia = number_format ($json_data[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                	<td><?php echo $json_data[$i]['Status']; ?></td>
              	   </tr>
              	  <?php }}} ?>
	        </tbody>
            </table>
	</div>
<?php } if($pilih_3=="03"){ ?>
	<div id="container3" style="background-color:#FFF;min-height:400px;">
	<span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
<?php
echo "<a href='https://aarmindonesia.org/wikabpm/highchart/live%20Version/group_Collum_CI_Jumlah/download.php?year=$pilih&month=$pilih_2&id=$pilih_3&kl=$kl'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>";
?></span>
		<table class="tbl-qa">
		  <thead>
			<tr>
			   <th class="table-header" width="50%">Nama Proyek</th>
                	   <th class="table-header" width="20%">Diperoleh</th>
			   <th class="table-header" width="30%">Keterangan</th>
			</tr>
		  </thead>
		  <tbody>
		 <?php for($i=0; $i<count($json_data); $i++){
		$tmpDate = $json_data[$i]['Create'];
		$date = substr($tmpDate,0,-8);
		$month = substr($date,5,-4);
		if($json_data[$i]['Tactic'] && $month<=$pilih_2){
		  if($json_data[$i]['DOP']==$kl){
		  if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak"){
?>
                   <tr class="table-row">
                	<td><?php echo $json_data[$i]['Title']; ?></td>
                	<td><?php echo $format_indonesia = number_format ($json_data[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                	<td><?php echo $json_data[$i]['Status']; ?></td>
              	   </tr>
              	  <?php }}}}?>
		</tbody>
            	</table>
	</div>
<?php } ?>