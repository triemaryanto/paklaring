<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
session_start();
$id = $_POST['id'];
$query = mysqli_query($conn,"SELECT * FROM paklaring where id = $id");
$html = '<table id="cssTable" border="0" width="100%" height="100" >
 <tr>
 <th width="100px"><img src="dist/img/ksp.jpg" width="130px"/></th>
 <th  align="center" width="380px"><h3>RAT KSP DIAN MANDIRI<br/>Kehadiran Anggota</h3></th>
 <th align-text= "left"><h6>Tangerang,<br/> 11 Juni 2022</h6></th>
 </tr>
 </table><br><hr/><br>';
$html .= '<table border="0" width="100%">
<tr>
<th>#</th>
<th>Username</th>
<th>Nama</th>
<th>alamat</th>
<th>Status</th>
<th>Tgl</th>
<th>Jam</th>
<th>Ttd</th>
</tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr>
 <td>".$no."</td>
 <td>".$row['username']."</td>
 <td>".$row['nama']."</td>
 <td>".$row['alamat']."</td>
 <td>".$row['status']."</td>
 <td>".$row['tgl']."</td>
 <td>".$row['jam']."</td>
 <td><img src='../anggota/ttd/".$row['ttd']."' width='50px' height='50px'/></td>
 </tr>";
 $no++;
 
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Kehadiran.pdf');
?>