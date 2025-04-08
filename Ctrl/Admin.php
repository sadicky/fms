<?php

function login()
{
	include('Models/Admin/auth.php');
	include('Vues/Admin/login.php');
}

function forgot()
{
	require_once('Models/Admin/forgot.php');
	include('Vues/forgot-password.php');
}

//Fonction Login
function error404()
{
	// include('Vues/Admin/error404.php');
	if (@$_SESSION['logged']) {
		$title = 'Error 404';
		include('Vues/Admin/error404.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

//Fonction de la page non trouvée
function error500()
{
	if (@$_SESSION['logged']) {
		include('Vues/Admin/error500.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}
function Logout()
{
	session_start();
	session_destroy();
	header("location:" . WEBROOT);
}

//Fonction du tableua de Board
function Dashboard()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/vente.class.php');

		$title = "Tableau de board";

		ob_start();
		$carburant = new Carburant();
		$vente = new Vente();

		$carburants = $carburant->getCarburants();
		$ventes = $vente->getVentes();

		include('Vues/Admin/home.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

//Fonction du tableua de Board
function Devise()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/tiers.class.php');

		$title = "Dévise";

		ob_start();
		$tier = new Tiers();
		$data = $tier->getDevises();
		include('Vues/Admin/devise.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Bank()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/bank.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Banques";

		ob_start();
		$bank = new Bank();
		$data = $bank->getBanks();

		$tier = new Tiers();
		$getDevise = $tier->getDevises();
		include('Vues/Admin/bank.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Tiers()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/tiers.class.php');

		$title = "Gestion des Clients";

		ob_start();
		$tier = new Tiers();
		$tiers = $tier->getTiers();
		include('Vues/Admin/tiers.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Users()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/user.class.php');

		$title = "Gestion des Utilisateurs";
		$msg = "";

		ob_start();
		$user = new User();
		$users = $user->getUsers();
		include('Vues/Admin/users.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Staff()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/user.class.php');

		$title = "Gestion du Staff";

		ob_start();
		$user = new User();
		$users = $user->getStaff();
		include('Vues/Admin/staff.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Salaire()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/user.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Gestion de Salaire";

		ob_start();
		$user = new User();
		$tier = new Tiers();
		$data = $user->getStaffSalaire();
		$users = $user->getStaff();
		$devises = $tier->getDevises();
		include('Vues/Admin/salaire.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Carburants()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');

		$title = "Gestion de Carburants";

		ob_start();
		$user = new User();
		$fournisseurs = $user->getFournisseurs();
		$carburant = new Carburant();
		$carburants = $carburant->getCarburants();
		include('Vues/Admin/carburant.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Pompes()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');

		$title = "Gestion de Pompes";

		ob_start();
		$user = new User();
		$staff = $user->getPompistes();
		$carburant = new Carburant();
		$getActivePump = $carburant->getPompeActif();
		$carburants = $carburant->getCarburants();
		$pompes = $carburant->getPompes();
		include('Vues/Admin/pompe.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Fournisseurs()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/user.class.php');

		$title = "Gestion de Fournisseurs";

		ob_start();
		$user = new User();
		$fournisseurs = $user->getFournisseurs();
		include('Vues/Admin/fournisseur.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Vente()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/vente.class.php');
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Gestion de Vente";

		ob_start();
		$user = new User();
		$tier = new Tiers();
		$carburant = new Carburant();
		$vente = new Vente();

		$tiers = $tier->getTiers();
		$getF = $user->getFournisseurs();
		$devises = $tier->getDevises();
		$carburants = $carburant->getCarburants();
		$ventes = $vente->getVentes();

		include('Vues/Admin/vente.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function EditVente()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/vente.class.php');
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Modifier la Vente";

		ob_start();
		$user = new User();
		$tier = new Tiers();
		$carburant = new Carburant();
		$vente = new Vente();
		$id = $_GET['id'];
		$tiers = $tier->getTiers();
		$getF = $user->getFournisseurs();
		$devises = $tier->getDevises();
		$carburants = $carburant->getCarburants();
		$pompes = $carburant->getPompeActif();
		$getVenteId = $vente->getVenteId($id);
		$venteId = $vente->venteId($id);
		$getCarburant = $carburant->getCarburant($venteId->carburant_id);

		include('Vues/Admin/editvente.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Order()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/vente.class.php');
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Nouvelle Vente";

		ob_start();
		$user = new User();
		$tier = new Tiers();
		$carburant = new Carburant();
		$vente = new Vente();

		$pompes = $carburant->getPompeActif();
		$pompistes = $user->getPompistes();
		$devises = $tier->getDevises();
		$tiers = $tier->getTiers();
		$carburants = $carburant->getCarburants();
		$ventes = $vente->getVentes();

		include('Vues/Admin/order.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}


function RLivraison()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');

		$title = "Rapport de Livraison";

		ob_start();
		$user = new User();
		$getF = $user->getFournisseurs();
		$carburant = new Carburant();
		$carburants = $carburant->getCarburants();
		include('Vues/Admin/rlivraison.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Depenses()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/caisse.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Gestion de Dépenses";

		ob_start();
		$caisse = new Caisse();
		$tier = new Tiers();
		$depenses = $caisse->getDepenses();
		$devises = $tier->getDevises();
		include('Vues/Admin/depense.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}
function RDepenses()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/caisse.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Rapport de Dépenses";

		ob_start();
		$caisse = new Caisse();
		$tier = new Tiers();

		$depenses = $caisse->getDepenses();
		$devises = $tier->getDevises();
		include('Vues/Admin/rdepenses.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function RVentes()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/vente.class.php');
		require_once('Models/Admin/carburant.class.php');
		require_once('Models/Admin/user.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Rapport de Vente";

		ob_start();
		$user = new User();
		$tier = new Tiers();
		$carburant = new Carburant();
		$vente = new Vente();

		$getClients = $tier->getTiers();
		$getPompes = $carburant->getPompeActif();
		$getDevises = $tier->getDevises();
		$pompistes = $user->getPompistes();
		$carburants = $carburant->getCarburants();
		$ventes = $vente->getVentes();

		include('Vues/Admin/rvente.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function RSalaires()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/user.class.php');

		$title = "Rapport de Salaires";

		ob_start();
		$tier = new User();

		$staffs = $tier->getStaff();

		include('Vues/Admin/rsalaires.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function EtatDep()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/caisse.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Etat Dépense";

		ob_start();
		$caisse = new Caisse();
		$tier = new Tiers();
		$getDevise2 = $tier->getDevises2();
		$getDevise3 = $tier->getDevises3();
		$depenses = $caisse->getDepenses();
		$devises = $tier->getDevises();
		include('Vues/Admin/etatdep.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function CEtat()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/caisse.class.php');
		require_once('Models/Admin/tiers.class.php');

		$title = "Etat de la Caisse";

		ob_start();
		$caisse = new Caisse();
		$tier = new Tiers();
		$getDevise2 = $tier->getDevises2();
		$getDevise3 = $tier->getDevises3();
		$depenses = $caisse->getDepenses();
		$devises = $tier->getDevises();
		include('Vues/Admin/cetat.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}


function DetailF()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/tiers.class.php');
		require_once('Models/Admin/vente.class.php');

		$title = "Détail du Client";

		ob_start();
		$vente = new Vente();
		$id = $_GET['id'];
		$getVente = $vente->getVenteC($id);
		$getDette = $vente->getDette($id);
		$getDette2 = $vente->getDette2($id);
		$getTot = $vente->getTotal($id);
		$getTot2 = $vente->getTotal2($id);
		$getLittre = $vente->getTotalLittreDette($id);
		$tiers = new Tiers();
		$data = $tiers->getTierId($id);

		include('Vues/Admin/detailF.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Dettes()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/tiers.class.php');
		require_once('Models/Admin/vente.class.php');
		require_once('Models/Admin/caisse.class.php');


		ob_start();
		$vente = new Vente();
		$tier = new Tiers();
		$caise = new Caisse();

		$totalD1 = $caise->getDette1();
		$totalD2 = $caise->getDette2();
		$tiers = $tier->getTiers();

		$title = "Dettes totales (" . number_format($totalD1->DETTE, 0, ',', ' ') . " " . $totalD1->SHORT . " - " .
			number_format($totalD2->DETTE, 0, ',', ' ') . " " . $totalD2->SHORT . ")";

		include('Vues/Admin/rdettes.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Transfert()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/bank.class.php');
		require_once('Models/Admin/caisse.class.php');

		ob_start();
		$bank = new Bank();
		$caise = new Caisse();

		$id = $_GET['bank_id'];
		$data = $bank->getBank($id);
		$getBank = $bank->getBankId($id, $data->devise_id);

		$title = 'Transferer depuis(' . $data->bank . ')';

		include('Vues/Admin/transfert.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}


function RTransfert()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/bank.class.php');

		$title = "Rapport de Transfert d'argent";

		ob_start();
		$banks = new Bank();
		$data = $banks->getHistoricTransfert();
		include('Vues/Admin/rtransfert.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}

function Profile()
{
	if (@$_SESSION['logged']) {
		require_once('Models/Admin/bank.class.php');

		$title = "Profile";

		ob_start();
		// $banks = new Bank();
		// $data = $banks->getHistoricTransfert();
		include('Vues/Admin/profile.php');
		$contents = ob_get_contents();
		ob_get_clean();

		include('Vues/Admin/template.php');
	} else {
		include('Vues/Admin/error500.php');
	}
}