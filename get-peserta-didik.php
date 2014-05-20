<?php
include ("class-config.php");

$periode=$_GET["periode"];

try	{
	$db = Config::getInstance();
	$query = "
SELECT 
  peserta_didik.peserta_didik_id, 
  peserta_didik.nama, 
  peserta_didik.jenis_kelamin, 
  peserta_didik.nisn, 
  peserta_didik.nik, 
  peserta_didik.tempat_lahir, 
  peserta_didik.tanggal_lahir, 
  rombongan_belajar.semester_id, 
  prasarana.nama as nama_kelas
FROM 
  public.peserta_didik, 
  public.anggota_rombel, 
  public.rombongan_belajar, 
  public.prasarana
WHERE 
  anggota_rombel.peserta_didik_id = peserta_didik.peserta_didik_id AND
  rombongan_belajar.rombongan_belajar_id = anggota_rombel.rombongan_belajar_id AND
  prasarana.prasarana_id = rombongan_belajar.prasarana_id AND
  rombongan_belajar.semester_id = :periode
ORDER BY
  rombongan_belajar.semester_id ASC, 
  prasarana.nama ASC,
  peserta_didik.nama ASC";
 
	$stmt = $db->prepare($query);
	$stmt->execute(array(':periode'=>$periode));
	$stmt->setFetchMode(PDO::FETCH_BOTH);
	} catch(PDOException $e) {
	echo $e->getMessage();
}
 
?>
<center>
<table border="1">
<tr>
<th>NISN</th>
<th>NIK</th>
<th>Nama Lengkap</th>
<th>Tanggal Lahir</th>
<th>Tempat Lahir</th>
<th>Kelas</th>
<th>Semester</th>
</tr>
<?php while($row = $stmt->fetch()) { ?>
	<tr>
	<td><?php echo $row['nisn'] ?></td>
	<td><?php echo $row['nik'] ?></td>
	<td><?php echo $row['nama'] ?></td>
	<td><?php echo $row['tempat_lahir'] ?></td>
	<td><?php echo $row['tanggal_lahir'] ?></td>
	<td><?php echo $row['nama_kelas'] ?></td>
	<td><?php echo $row['semester_id'] ?></td>
	</tr>
 
<?php 
}
$stmt->closeCursor();
$db=null;
?>
</table>
</center>
Jumlah Keseluruhan adalah <?php echo $stmt->rowCount() ?> Data.
