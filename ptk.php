<?php
include ("class-config.php");
$no = 1;

try	{
	$db = Config::getInstance();
	$query = "SELECT * FROM ptk order by nama";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_BOTH);
	} catch(PDOException $e) {
	echo $e->getMessage();
}
 
?>
<table border="1">
<tr>
	<th>No</th>
	<th>NUPTK</th>
	<th>NIP</th>
	<th>Nama</th>
	<th>Tanggal Lahir</th>
	<th>Tempat Lahir</th>
	<th>NIK</th>
	<th>RT</th>
	<th>RW</th>
	<th>Nama Dusun</th>
	<th>Nama Kelurahan</th>
	<th>No. Telp</th>
	<th>No. HP</th>
	<th>Update Terakhir</th>
	<th>Sinkron Terakhir</th>
</tr>
<?php while($row = $stmt->fetch()) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $row['nuptk'] ?></td>
		<td><?php echo $row['nip'] ?></td>
		<td><?php echo $row['nama'] ?></td>
		<td><?php echo $row['tempat_lahir'] ?></td>
		<td><?php echo $row['tanggal_lahir'] ?></td>
		<td><?php echo $row['nik'] ?></td>
		<td><?php echo $row['rt'] ?></td>
		<td><?php echo $row['rw'] ?></td>
		<td><?php echo $row['nama_dusun'] ?></td>
		<td><?php echo $row['desa_kelurahan'] ?></td>
		<td><?php echo $row['no_telepon_rumah'] ?></td>
		<td><?php echo $row['no_hp'] ?></td>
		<td><?php echo $row['last_update'] ?></td>
		<td><?php echo $row['last_sync'] ?></td>
	</tr>
<?php 
	$no++;
	}
?>
</table>
Jumlah Keseluruhan adalah <?php echo $stmt->rowCount() ?> PTK.
<?php
	$stmt->closeCursor();
	$db=null;
?>
