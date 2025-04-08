<?php
        require_once '../../Models/Admin/connexion.php';
        $db = getConnection();

        if (isset($_POST['carburant'])&& !empty($_POST['carburant'])) {
        	$query = $db->prepare("SELECT * FROM tbl_pompe where carburant_id = ?");
            $query->execute(array($_POST['carburant']));
        	$rc = $query->rowCount();
        	if ($rc>0) {
				echo "<option value=''>Choisie de carburant</option>";
        		while ($value=$query->fetchObject()) {
        			echo "<option value=".$value->pompe_id.">".$value->pompe."</option>";
               		}
        		# code...
        	}
        	else{

        		echo "<option> non disponible</option>";
        	}
       }
?>