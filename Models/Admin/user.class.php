<?php
require_once("connexion.php");

Class User
{
    public $email; 
    public $pwd;
    public $username;
    public $role;
    public $statut;
    public $phone;

   
    //ajouter un Admin
    public function setUser($username,$pwd,$role)
    {   
    //   PWD
        $pwd_encrypt=password_hash($pwd,PASSWORD_DEFAULT);

        $pwd = $this->pwd=$pwd_encrypt;
        $this->username=$username;
        $this->role=$role;
        $statut = $this->statut=1;

        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_users (username,password,statut,role) VALUES (?,?,?,?)");
        $addline = $add->execute(array($username,$pwd,$statut,$role));
        return $addline;
    }

    
    public function updateUser($username,$pwd,$id)
    {
        
        $pwd_encrypt=password_hash($pwd,PASSWORD_DEFAULT);

        $pwd = $this->pwd=$pwd_encrypt;
    $db = getConnection();
    $req=$db->prepare("UPDATE tbl_users SET username=?,password=? WHERE id_user=?");
    $d=$req->execute(array($username,$pwd,$id));
    return $d;
    }

    
    public function setStaff($noms,$tel,$adress,$role,$statut)
    {  
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_staff (noms,tel,adress,role,statut) VALUES (?,?,?,?,?)");
        $addline = $add->execute(array($noms,$tel,$adress,$role,$statut));
        return $addline;
    }
    
    public function setFournisseur($fournisseur,$tel,$adress,$email,$ceo,$statut)
    {  
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_fournisseur (fournisseur,tel,adresse,email,representant,statut) VALUES (?,?,?,?,?,?)");
        $addline = $add->execute(array($fournisseur,$tel,$adress,$email,$ceo,$statut));
        return $addline;
    }

    public function setStaffSalaire($staff,$devise,$salaire)
    {  
        $db = getConnection();
        $add = $db->prepare("INSERT INTO tbl_salaire (staff_id,devise_id,salaire) VALUES (?,?,?)");
        $addline = $add->execute(array($staff,$devise,$salaire));
        return $addline;
    }
    
    
    public function getStaff()
    {  
        $db = getConnection();
        $add = $db->prepare("SELECT * FROM tbl_staff");
        $add->execute();
        $tbP = array();
        while($data =  $add->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }
    
    public function getPompistes()
    {  
        $db = getConnection();
        $add = $db->prepare("SELECT * FROM tbl_staff where statut='1' and role='pompiste'");
        $add->execute();
        $tbP = array();
        while($data =  $add->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }

    public function getStaffSalaire()
    {  
        $db = getConnection();
        $add = $db->prepare("SELECT * FROM tbl_staff, tbl_salaire, tbl_devise 
        WHERE tbl_staff.staff_id = tbl_salaire.staff_id
        and tbl_devise.devise_id = tbl_salaire.devise_id 
        and tbl_staff.statut='1'");
        $add->execute();
        $tbP = array();
        while($data =  $add->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }

    
    public function SalaireExist($id)
    {  
        
        $db = getConnection();
        $stmt = $db->prepare("SELECT s.staff_id as staff FROM tbl_salaire as s,tbl_staff as st 
        WHERE s.staff_id=st.staff_id and s.staff_id=?");
        $stmt->execute([$id]);
        $tbP = $stmt->fetchObject();
        return $tbP;
    }


    public function getUsername($email)
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT username FROM tbl_users WHERE username = ?");
        $statement->execute([$email]);
        $tbP = $statement->fetchObject();
        return $tbP;
    }
    
    //afficher utilisateur
    public function getUsers()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_users WHERE statut = '1'");
        $statement->execute();
        $tbP = array();
        while($data =  $statement->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }

    public function getFournisseurs()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_fournisseur ");
        $statement->execute();
        $tbP = array();
        while($data =  $statement->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }
    
    public function getFournisseursActive()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_fournisseur WHERE statut = 'Active'");
        $statement->execute();
        $tbP = array();
        while($data =  $statement->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }

    public function getFournisseursPending()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_fournisseur WHERE statut = 'Pending'");
        $statement->execute();
        $tbP = array();
        while($data =  $statement->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }


    public function getFournisseursTerminated()
    {
        $db = getConnection();
        $statement = $db->prepare("SELECT * FROM tbl_fournisseur WHERE statut = 'Terminated'");
        $statement->execute();
        $tbP = array();
        while($data =  $statement->fetchObject()){
            $tbP[] = $data;
        }
         return $tbP;
    }


    public function deleteUser($id){
        $db = getConnection();
        $sql =$db->prepare( "DELETE FROM tbl_users WHERE id_user=?");
        $ok = $sql->execute(array($id));
       return $ok;
    }
    
    public function deleteStaff($id){
        $db = getConnection();
        $sql =$db->prepare( "DELETE FROM tbl_staff WHERE staff_id=?");
        $ok = $sql->execute(array($id));
       return $ok;
    }

    public function activUser($iduser)
    {
    $db = getConnection();
    $req=$db->prepare("UPDATE tbl_users SET statut='1' WHERE id_user=?");
    $d=$req->execute(array($iduser));
    return $d;
    }
    public function desactUser($iduser)
    {
    $db = getConnection();
    $req=$db->prepare("UPDATE tbl_users SET statut='0' WHERE id_user=?");
    $d=$req->execute(array($iduser));
    return $d;
    }
}
?>