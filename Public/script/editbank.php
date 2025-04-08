<?php
session_start();
require_once '../../Models/Admin/connexion.php';
$db = getConnection();


// var_dump($_POST);die();

$id = htmlspecialchars(trim($_POST['id']));
$bank = htmlspecialchars(trim($_POST['bank']));
$numero = htmlspecialchars(trim($_POST['numero']));

$sql2 = "UPDATE tbl_bank SET bank=?,numero_compte=? WHERE bank_id=?";
$req2 = $db->prepare($sql2);
$data2 = $req2->execute(array($bank, $numero, $id));
if ($data2) {
    echo '
		<strong style="color: green;">Succes:</strong> Banque modifiée avec succes .
		';
} else {
    echo '
		<strong style="color: red;">Erreur 401:</strong>.
		';
}
