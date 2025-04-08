<?php
session_start();
define('WEBROOT', str_replace('index.php', "", $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', "", $_SERVER['SCRIPT_FILENAME']));
date_default_timezone_set('Africa/Bujumbura');

include 'Ctrl/Admin.php';

// var_dump($lang);die();
if (isset($_GET['p'])) {
	$params = explode('/', $_GET['p']);
	//die(print_r($params));
	$_SESSION['action'] = '';
	$action = $params[0];
	$d = preg_split("#[-]+#", $action);
	// var_dump($d);die();
	$n = count($d);
	if ($n > 1) {
		$action = $d[0];
	}

	if ($_GET['p'] == 'login') {
		Login();
	}

	//url pour le dashboard
	else if ($_GET['p'] == 'logout') {
		Logout();
	} //url pour le dashboard
	else if ($_GET['p'] == 'dashboard') {
		Dashboard();
	} else if ($_GET['p'] == 'users') {
		Users();
	} else if ($_GET['p'] == 'tiers') {
		Tiers();
	} else if ($_GET['p'] == 'devise') {
		Devise();
	} else if ($_GET['p'] == 'bank') {
		Bank();
	} else if ($_GET['p'] == 'staff') {
		Staff();
	} else if ($_GET['p'] == 'salaire') {
		Salaire();
	} else if ($_GET['p'] == 'carburants') {
		Carburants();
	} else if ($_GET['p'] == 'supplier') {
		Fournisseurs();
	} else if ($_GET['p'] == 'rlivraison') {
		RLivraison();
	} else if ($_GET['p'] == 'pompes') {
		Pompes();
	} else if ($_GET['p'] == 'ventes') {
		Vente();
	} else if ($_GET['p'] == 'order') {
		Order();
	} else if ($_GET['p'] == 'depenses') {
		Depenses();
	} else if ($_GET['p'] == 'cdepenses') {
		EtatDep();
	} else if ($_GET['p'] == 'rdepenses') {
		RDepenses();
	} else if ($_GET['p'] == 'rvente') {
		RVentes();
	} else if ($_GET['p'] == 'editVente') {
		EditVente();
	} else if ($_GET['p'] == 'cetat') {
		CEtat();
	} else if ($_GET['p'] == 'detailF') {
		DetailF();
	} else if ($_GET['p'] == 'rdettes') {
		Dettes();
	} else if ($_GET['p'] == 'rsalaires') {
		RSalaires();
	} else if ($_GET['p'] == 'transfert') {
		Transfert();
	} else if ($_GET['p'] == 'rtransfert') {
		RTransfert();
	}else if ($_GET['p'] == 'profile') {
		Profile();
	}
	//pour la page non trouvee
	else {
		error404();
	}
} else {
	Login();
}
