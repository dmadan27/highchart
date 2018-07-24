<?php
session_start();

	error_reporting(0);
	mysql_connect("localhost","aarg5761_wikabpm","53r1p1kk1n6k0n6");
        mysql_select_db("aarg5761_wikabpm");
	$DOP=$_GET["dop"];
	$stage=$_GET["status"];
	$pilih;
if (empty($_SESSION[Thn])){$pilih="2017";}
else if (!empty($_SESSION[Thn])){$pilih=$_SESSION[Thn];}
	$pilih_2=$_GET["month"];
	$stat=$_GET["statu"];
	$query=null;
	$tabel=$_GET["tabel"];
	$s_rkap=$_GET["rkap"];
	$dop2=$_GET["dop2"];
	if($DOP){
			if($stage){
						if($tabel){
							if($dop2=="DOP1"){$query = "SELECT * from wika where " . $_GET["tabel"] . "='".$stat."' and Status = '".$stage."' and DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where " . $_GET["tabel"] . "='".$stat."' and Status = '".$stage."' and DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where " . $_GET["tabel"] . "='".$stat."' and Status = '".$stage."' and DOP = '".$DOP."' and user = '".$pilih."'";}

						}
						else{
							if($dop2=="DOP1"){$query = "SELECT * from wika where Status='".$stage."' and DOP = '".$DOP."'and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where Status='".$stage."' and DOP = '".$DOP."'and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where Status='".$stage."' and DOP = '".$DOP."'and user = '".$pilih."'";}
						}
					}
			else{
					if($tabel)
						{
							if($dop2=="DOP1"){$query = "SELECT * from wika where " . $_GET["tabel"] . "='".$stat."' and DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where " . $_GET["tabel"] . "='".$stat."' and DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where " . $_GET["tabel"] . "='".$stat."' and DOP = '".$DOP."' and user = '".$pilih."'";}
						}
						else{
							if($dop2=="DOP1"){$query = "SELECT * from wika where DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where DOP = '".$DOP."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where DOP = '".$DOP."' and user = '".$pilih."'";}
						}
				}
			}
	
	else{
			if($stage)
				{
					if($tabel)
						{
							if($dop2=="DOP1"){$query = "SELECT * from wika where " . $_GET["tabel"] . "='".$stat."' and Status='".$stage."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where " . $_GET["tabel"] . "='".$stat."' and Status='".$stage."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where " . $_GET["tabel"] . "='".$stat."' and Status='".$stage."' and user = '".$pilih."'";}
							
						}
						else{
							if($dop2=="DOP1"){$query = "SELECT * from wika where Status='".$stage."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where Status='".$stage."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where Status='".$stage."' and user = '".$pilih."'";}
						}
				}
			else
				{
					if($tabel)
						{
							if($dop2=="DOP1"){$query = "SELECT * from wika where " . $_GET["tabel"] . "='".$stat."' and user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where " . $_GET["tabel"] . "='".$stat."' and user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where " . $_GET["tabel"] . "='".$stat."' and user = '".$pilih."'";}
							
						}
						else{
							if($dop2=="DOP1"){$query = "SELECT * from wika where user = '".$pilih."'";}
							if($dop2=="DOP2"){$query = "SELECT * from wika_2 where user = '".$pilih."'";}
							if($dop2=="DOP3"){$query = "SELECT * from wika_3 where user = '".$pilih."'";}
						}
				}
		}
	
	$result = mysql_query($query) or die(mysql_error());
 	
	$arr = array();
	while ($row = mysql_fetch_assoc($result))
		{
			$temp = array(
			  	"ID" => $row["id"],
    		  		"Title" => $row["nama"],
    		  		"Jenis" => $row["proyek"], 
              			"Sumber" => $row["sumber"], 
              			"DOP" => $row["dop"],
			  	"Departement" => $row["owner"],
				"Pemberi" => $row["pemberi"],
			  	"Diperoleh" => $row["diperoleh"],
			  	"RKAP" => $row["rkap"],
			  	"Status" => $row["status"],
				"Date" => $row["tanggalperolehan"],
				"Tahun" => $row["user"]
			  );
			 array_push($arr, $temp);
		}
		$data = json_encode($arr);
// MENGOLAH DATA BERFORMAT JSON
// true untuk menjadikannya array
$json_data = json_decode($data,true);
$total = 0;
$s;
if($s_rkap=="yes"){$s="RKAP";}
else {$s="Diperoleh";}
for($i=0; $i<count($json_data); $i++){

	$total=$total+$json_data[$i][$s];

}	
	?>



<span id="tot" style="font-size:14px;color:#6483c3;padding:10px;float:right">
		Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total, 0, ',', '.'); ?>
<?php
echo "<a href='https://aarmindonesia.org/wikabpm/highchart/live%20Version/group_bar_per_sumber/download.php?dop=$DOP&status=$stage&month=$pilih_2&statu=$stat&tabel=$tabel&rkap=$s_rkap&dop2=$dop2'><i class='fa fa-download' style='padding-left:30px; padding-right=10px; font-size:20px;'></i></a>";
?>
	</span>
	<table class="tbl-qa">
		<thead>
			<tr>
				
				<th class="table-header" width="40%">Nama Proyek</th>
                                <th class="table-header" width="20%">Diperoleh</th>
                               
				<th class="table-header" width="10%">Keterangan</th>
			</tr>
		</thead>
		<tbody>
        
        
			<?php 	for($i=0; $i<count($json_data); $i++){
	
			?>
			<tr class="table-row">

                <td><?php echo $json_data[$i]['Title']; ?></td>
                <td><?php echo $format_indonesia = number_format ($json_data[$i]['Diperoleh'], 0, ',', '.'); ?></td>
               
                <td><?php echo $json_data[$i]['Status']; ?></td>
            </tr>
		<?php } ?>
            </tbody>
            </table>