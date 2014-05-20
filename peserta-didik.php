<html>
<head>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","get-peserta-didik.php?periode="+str,true);
xmlhttp.send();
}
</script>
</head>
<body>

<?php
include ("class-config.php");

try	{
	$db = Config::getInstance();
	
	$cari_periode = "
SELECT 
  semester.nama, 
  semester.semester, 
  semester.semester_id
FROM 
  ref.semester
WHERE 
  semester.periode_aktif = 1";
	$periode = $db->prepare($cari_periode);
	$periode->execute();
	$periode->setFetchMode(PDO::FETCH_BOTH);
	} catch(PDOException $e) {
	echo $e->getMessage();
}
 
?>
<center>
<h2>Daftar Peserta Didik</h2>

<form>
Periode:
<select name="periode" onChange="showUser(this.value)">
	<option value="">Pilih Periode:</option>
	<?php while ($row = $periode->fetch()) { ?>
    <option value="<?php echo $row['semester_id'] ?>"><?php echo $row['nama']?></option>
<?php 
}
$periode->closeCursor();
$db=null;
?>
</select><br/>
</form>

<div id="txtHint">
	<!-- Hasil Pencarian -->
</div>

</center>

</body>
</html>
