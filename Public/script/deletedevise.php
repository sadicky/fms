<?php
require_once('../../Models/Admin/tiers.class.php');
$devices = new Tiers();
$id = isset($_POST['id']) ? $_POST['id'] : '';

if ($id) {
	$delete = $devices->deleteDevise($id);
	if ($delete)
		echo "<script>window.location.href='index.php?page=devise'</script>";
	else echo "non ajoute";
}
