<?php

require('phpagi/phpagi.php');

class connect_bdd{
          protected function dbconnect(){
    		$bdd = new PDO('mysql:host=localhost;dbname=Asterisk','server','server') or die ('Not connected');
        	return $bdd;
          }
}


class Query_bdd extends connect_bdd{
	public function consolde($num){
		$bdd = $this->dbconnect();
                $consulter =  $bdd->query( "SELECT Solde  FROM Utilisateurs where Numero = '$num' ");
		$sld = $consulter->fetchall();
		return $sld[0][0];
	}

	public function transaction($idexp, $iddest, $montant){
        	$bdd = $this->dbconnect();
		$res = $bdd->prepare("INSERT INTO Transactions(Daty, Num_Exp, Num_Dest, Somme) values( NOW(), ?, ?, ?)");
		$res->execute(array($idexp, $iddest, $montant));
        }
	
	public function isUser($num){
        	$bdd = $this->dbconnect();
		$res = $bdd->prepare("SELECT 1 FROM Utilisateurs WHERE Numero = ? ");
		$res->execute(array($num));
		if ($res->rowCount()==1){
			return true ;
		}
		return false;
        }


	public function moins($idexp, $montant){
                $bdd = $this->dbconnect();
		$res = $bdd->prepare("UPDATE Utilisateurs SET Solde = (Solde - ?)  WHERE Numero = ?");
		$res->execute(array($montant, $idexp));
        }

	public function plus($iddest, $montant){
                $bdd = $this->dbconnect();
		$res = $bdd->prepare("UPDATE Utilisateurs SET Solde = (Solde + ?) WHERE Numero = ?");
		$res->execute(array($montant, $iddest));
        }
}
$query = new Query_bdd();
$query->transaction(5001, 5002, 15000);
?>
