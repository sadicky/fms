<?php
require_once("connexion.php");
$db = getConnection();
$msg = "";
$username = isset($_POST['username']) ? $_POST['username'] : "";
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
if (isset($_POST['login'])) {
  $sql = $db->prepare("SELECT * FROM tbl_users WHERE statut='1' and username= :username");
  $sql->bindValue('username', $username);
  $sql->execute();
  $res = $sql->fetchObject();
  // var_dump($res);die();
  if ($res) {
    $pwdHash = $res->password;
    if (password_verify($pwd, $pwdHash)) {
      $_SESSION['id'] = $res->id_user;
      $_SESSION['username'] = $res->username;
      $_SESSION['role'] = $res->role;
      $_SESSION['logged'] = true;
      $isLogged = $_SESSION['logged'];
      // var_dump($_SESSION['role']);die();
      if ($_SESSION['role'] == "admin") header("location:" . WEBROOT . "dashboard");
      else if ($_SESSION['role'] == "caissier") header("location:" . WEBROOT . "dashboard");
      else if ($_SESSION['role'] == "station") header("location:" . WEBROOT . "dashboard");
      else header("location:" . WEBROOT . "login");
    } else {
      $msg = "<strong style='color:red'>Error</strong>: Mot de passe incorrect ";
    }
  } else {
    $msg = "<strong style='color:red'>Erreur:</strong> Username et Password incorrects";
  }
}
