<?php
session_start();

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=hasil-export.xls");

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



	<table class="tbl-qa" border="1px solid black">
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
<tfoot>
<tr id="table-row">
<th class="table-footer" color="black" colspan="3" line-height="bold">Total <?php echo $s; ?>: <?php echo $format_indonesia = number_format ($total, 0, ',', '.'); ?>
</th>
</tr>
</tfoot>
            </table>