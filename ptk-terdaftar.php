<?php
include ("class-config.php");
$no = 1;

try	{
	$db = Config::getInstance();
	$query = "
SELECT 
  ptk.ptk_id, 
  ptk.nama, 
  ptk_terdaftar.tahun_ajaran_id, 
  ptk_terdaftar.nomor_surat_tugas, 
  ptk_terdaftar.tanggal_surat_tugas, 
  ptk_terdaftar.ptk_induk, 
  ptk_terdaftar.tmt_tugas, 
  ptk_terdaftar.aktif_bulan_01, 
  ptk_terdaftar.aktif_bulan_02, 
  ptk_terdaftar.aktif_bulan_03, 
  ptk_terdaftar.aktif_bulan_12, 
  ptk_terdaftar.aktif_bulan_11, 
  ptk_terdaftar.aktif_bulan_10, 
  ptk_terdaftar.aktif_bulan_09, 
  ptk_terdaftar.aktif_bulan_08, 
  ptk_terdaftar.aktif_bulan_07, 
  ptk_terdaftar.aktif_bulan_06, 
  ptk_terdaftar.aktif_bulan_05, 
  ptk_terdaftar.aktif_bulan_04, 
  ptk_terdaftar.last_update, 
  ptk_terdaftar.last_sync, 
  ptk_terdaftar.tgl_ptk_keluar, 
  ptk_terdaftar.jenis_keluar_id
FROM 
  public.ptk_terdaftar, 
  public.ptk
WHERE 
  ptk_terdaftar.ptk_id = ptk.ptk_id
  AND ptk_terdaftar.tahun_ajaran_id = 2013
  AND ptk_terdaftar.jenis_keluar_id is null
ORDER BY
  ptk.nama ASC";
  
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
	<th>Nama</th>
	<th>No. Surat</th>
	<th>Tgl. Surat</th>
	<th>Tahun Pelajaran</th>
	<th>PTK Induk</th>
	<th>Jan</th>
	<th>Feb</th>
	<th>Mar</th>
	<th>Apr</th>
	<th>Mei</th>
	<th>Jun</th>
	<th>Jul</th>
	<th>Ags</th>
	<th>Sep</th>
	<th>Okt</th>
	<th>Nov</th>
	<th>Des</th>
	<th>Update Terakhir</th>
	<th>Sinkron Terakhir</th>
</tr>
<?php while($row = $stmt->fetch()) { ?>
	<tr>
		<td><?php echo $no ?></td>
		<td><?php echo $row['nama'] ?></td>
		<td><?php echo $row['nomor_surat_tugas'] ?></td>
		<td><?php echo $row['tanggal_surat_tugas'] ?></td>
		<td align="center"><?php echo $row['tahun_ajaran_id'] ?></td>
		<td align="center"><?php 
					if ($row['ptk_induk'] = 1) {
						$status = "Ya";
					} Else {
						$status = "Tidak";
					}
					echo $status;
					//echo $row['ptk_induk'] ?>
		</td>
		<td align="center"><?php echo $row['aktif_bulan_01'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_02'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_03'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_04'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_05'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_06'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_07'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_08'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_09'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_10'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_11'] ?></td>
		<td align="center"><?php echo $row['aktif_bulan_12'] ?></td>
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
