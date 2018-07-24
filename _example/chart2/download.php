<?php 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=hasil-export.xls");
 
error_reporting(0);
$dop2=$_GET["dop2"];
$url =null;
$pilih=$_GET["year"];
$pilih_2=$_GET["month"];
$pilih_3=$_GET["id"];
// request API
$url='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop1.php?tahun='.$pilih.'';
$url2='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop2.php?tahun='.$pilih.'';
$url3='https://aarmindonesia.org/wikabpm/highchart/live%20Version/json/json_dop3.php?tahun='.$pilih.'';
$json = file_get_contents($url);
$json2 = file_get_contents($url2);
$json3 = file_get_contents($url3);
// deserialize data from JSON
$json_data = json_decode($json,true);
$json_data2 = json_decode($json2,true);
$json_data3 = json_decode($json3,true);

//var_dump
$i=0;
$total = 0;
$total_2 = 0;
$total_3 = 0;

for($i=0; $i<count($json_data); $i++){
			$tmpDate = $json_data[$i]['Create'];
			$date = substr($tmpDate,0,-8);
			$month = substr($date,5,-4);
			if($month<=$pilih_2){
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
	}
				$total=$total_2+$total_3;
				$persentaseone=($total_2/$total)*100;
				$persentasetwo=($total_3/$total)*100;



//var_dump
$ii=0;
$total_B = 0;
$total_2_B = 0;
$total_3_B = 0;

for($ii=0; $ii<count($json_data2); $ii++){
		if($json_data2[$ii]['Status']=="Terendah"||$json_data2[$ii]['Status']=="Terkontrak")
		{
		$tmpDatex = $json_data2[$ii]['Create'];
		$datex = substr($tmpDatex,0,-8);
		$monthx = substr($datex,5,-4);
			if($monthx<=$pilih_2){
			if($json_data2[$ii]['Jenis']=="Non JO")
			{
				$total_2_B=$total_2_B+$json_data2[$ii]['Diperoleh'];
			}
			if($json_data2[$ii]['Jenis']=="JO")
			{
				$total_3_B=$total_3_B+$json_data2[$ii]['Diperoleh'];
			}
		}
		}	
	}
				$total_B=$total_2_B+$total_3_B;
				$persentaseone_B=($total_2_B/$total_B)*100;
				$persentasetwo_B=($total_3_B/$total_B)*100;


//var_dump
$iii=0;
$total_C = 0;
$total_2_C = 0;
$total_3_C = 0;

for($iii=0; $iii<count($json_data3); $iii++){
		$tmpDatexx = $json_data3[$iii]['Create'];
		$datexx = substr($tmpDatexx,0,-8);
		$monthxx = substr($datexx,5,-4);
			if($monthxx<=$pilih_2){
		if($json_data3[$iii]['Status']=="Terendah"||$json_data3[$iii]['Status']=="Terkontrak")
		{
			if($json_data3[$iii]['Jenis']=="Non JO")
			{
				$total_2_C=$total_2_C+$json_data3[$iii]['Diperoleh'];
			}
			if($json_data3[$iii]['Jenis']=="JO")
			{
				$total_3_C=$total_3_C+$json_data3[$iii]['Diperoleh'];
			}
		}
		}	
	}
				$total_C=$total_2_C+$total_3_C;
				$persentaseone_C=($total_2_C/$total_C)*100;
				$persentasetwo_C=($total_3_C/$total_C)*100;
				
$kill=$total+$total_B+$total_C;
$persentaseone_kill=(($total_2+$total_2_B+$total_2_C)/$kill)*100;
$persentasetwo_kill=(($total_3+$total_3_B+$total_3_C)/$kill)*100;
?>
<!--<div id="head4" style="padding:2px 0px 2px 0px;font-size:20px;"></div>-->

<?php if($pilih_3=="03"){ ?>
<div id="container3" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                                <th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
			  </tr>
		  </thead>
		  <tbody>
		 <?php for($i=0; $i<count($json_data); $i++){
		 if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak")
		{
					   if($json_data[$i]['Jenis']=="JO"  && $json_data[$i]['Diperoleh']!=0){
				   ?>  
		<tr class="table-row">
		<td><?php echo $json_data[$i]['Pemberi']; ?></td>
                		<td><?php echo $json_data[$i]['Title']; ?></td>
                		<td><?php echo $format_indonesia = number_format ($json_data[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                		
                		<td><?php echo $json_data[$i]['Status']; ?></td>
           	 </tr>
           	 <?php }}} ?>
            </tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total JO : <?php echo $format_indonesia = number_format ($total_3, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>
<?php } ?>
<?php if($pilih_3=="02"){ ?>
<div id="container2" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                 		<th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
                
			  </tr>
		  </thead>
		  <tbody>
		   <?php for($i=0; $i<count($json_data); $i++){
		   if($json_data[$i]['Status']=="Terendah"||$json_data[$i]['Status']=="Terkontrak")
				{
				if($json_data[$i]['Jenis']=="Non JO"  && $json_data[$i]['Diperoleh']!=0 ){
				   ?>  

			<td><?php echo $json_data[$i]['Pemberi']; ?></td>
                		<td><?php echo $json_data[$i]['Title']; ?></td>
                		<td><?php echo $format_indonesia = number_format ($json_data[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                		
                		<td><?php echo $json_data[$i]['Status']; ?></td>
           		 </tr>
                     <?php }}}?>
		</tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total Non JO : <?php echo $format_indonesia = number_format ($total_2, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>

<?php } if($pilih_3=="B"){ ?>
<div id="containerB" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                                <th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
			  </tr>
		  </thead>
		  <tbody>
		 <?php 
		 for($i=0; $i<count($json_data2); $i++){
		 if($json_data2[$i]['Status']=="Terendah"||$json_data2[$i]['Status']=="Terkontrak")
		{
			if($json_data2[$i]['Jenis']=="JO"  && $json_data2[$i]['Diperoleh']!=0){		   ?>  
			<tr class="table-row">
			<td><?php echo $json_data2[$i]['Pemberi']; ?></td>
               		<td><?php echo $json_data2[$i]['Title']; ?></td>
               		<td><?php echo $format_indonesia = number_format ($json_data2[$i]['Diperoleh'], 0, ',', '.'); ?></td>                		
                	<td><?php echo $json_data2[$i]['Status']; ?></td>
           	 </tr>
           	 <?php }}} ?>
            </tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total JO : <?php echo $format_indonesia = number_format ($total_3_B, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>

<?php } if($pilih_3=="A"){ ?>
<div id="containerA" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                 		<th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
                
			  </tr>
		  </thead>
		  <tbody>
		   <?php for($i=0; $i<count($json_data2); $i++){
		   if($json_data2[$i]['Status']=="Terendah"||$json_data2[$i]['Status']=="Terkontrak")
				{
				if($json_data2[$i]['Jenis']=="Non JO"  && $json_data2[$i]['Diperoleh']!=0 ){
				   ?>  

			<td><?php echo $json_data2[$i]['Pemberi']; ?></td>
                		<td><?php echo $json_data2[$i]['Title']; ?></td>
                		<td><?php echo $format_indonesia = number_format ($json_data2[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                		
                		<td><?php echo $json_data2[$i]['Status']; ?></td>
           		 </tr>
                     <?php }}}?>
		</tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total Non JO : <?php echo $format_indonesia = number_format ($total_2_B, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>

<?php } if($pilih_3=="D"){ ?>
<div id="containerD" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                                <th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
			  </tr>
		  </thead>
		  <tbody>
		 <?php for($i=0; $i<count($json_data3); $i++){
		 if($json_data3[$i]['Status']=="Terendah"||$json_data3[$i]['Status']=="Terkontrak")
		{
					   if($json_data3[$i]['Jenis']=="JO"  && $json_data3[$i]['Diperoleh']!=0){
				   ?>  
		<tr class="table-row">
		<td><?php echo $json_data3[$i]['Pemberi']; ?></td>
                		<td><?php echo $json_data3[$i]['Title']; ?></td>
                		<td><?php echo $format_indonesia = number_format ($json_data3[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                		
                		<td><?php echo $json_data3[$i]['Status']; ?></td>
           	 </tr>
           	 <?php }}} ?>
            </tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total JO : <?php echo $format_indonesia = number_format ($total_3_C, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>

<?php } if($pilih_3=="C"){ ?>
<div id="containerC" style="background-color:#FFF;min-height:400px;">
<table class="tbl-qa" border="1px solid black">
		  <thead>
			  <tr>
				<th class="table-header" width="30%">Pemberi Kerja</th>
				<th class="table-header" width="30%">Nama Proyek</th>
                 		<th class="table-header" width="20%">Diperoleh</th>
				<th class="table-header" width="20%">Keterangan</th>
                
			  </tr>
		  </thead>
		  <tbody>
		   <?php for($i=0; $i<count($json_data3); $i++){
		   if($json_data3[$i]['Status']=="Terendah"||$json_data3[$i]['Status']=="Terkontrak")
				{
				if($json_data3[$i]['Jenis']=="Non JO"  && $json_data3[$i]['Diperoleh']!=0 ){
				   ?>  

			<td><?php echo $json_data3[$i]['Pemberi']; ?></td>
                		<td><?php echo $json_data3[$i]['Title']; ?></td>
                		<td><?php echo $format_indonesia = number_format ($json_data3[$i]['Diperoleh'], 0, ',', '.'); ?></td>
                		
                		<td><?php echo $json_data3[$i]['Status']; ?></td>
           		 </tr>
                     <?php }}}?>
		</tbody>
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="4" line-height="bold">Total Non JO : <?php echo $format_indonesia = number_format ($total_2_C, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>
</div>

<?php } ?>
