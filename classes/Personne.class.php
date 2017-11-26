<?php

class Personne{
	private $numero;
	private $nom;
	private $prenom;
	private $telephone;
	private $mail;
	private $admin;
	private $login;
	private $pwd;



	public function __construct($valeurs){
		$this->hydrate($valeurs);
	}

	public function hydrate($valeurs){
		foreach ($valeurs as $attribut => $valeur) {
			switch ($attribut) {
				case 'per_num':
					$this->setNumero($valeur);
					break;

				case 'per_nom':
					$this->setNom($valeur);
					break;

				case 'per_prenom':
					$this->setPrenom($valeur);
					break;

				case 'per_tel':
					$this->setTelephone($valeur);
					break;

				case 'per_mail':
					$this->setMail($valeur);
					break;

				case 'per_admin':
					$this->setAdmin($valeur);
					break;

				case 'per_login':
					$this->setLogin($valeur);
					break;

				case 'per_pwd':
					$this->setPassword($valeur);
					break;
			}
		}
	}


	public function getNumero(){
		return $this->numero;
	}

	public function setNumero($numero){
		$this->numero = $numero;
	}


	public function getNom(){
		return $this->nom;
	}

	public function setNom($nom){
		$this->nom = $nom;
	}


	public function getPrenom(){
		return $this->prenom;
	}

	public function setPrenom($prenom){
		$this->prenom = $prenom;
	}


	public function getTelephone(){
		return $this->telephone;
	}

	public function setTelephone($telephone){
		$this->telephone = $telephone;
	}


	public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail = $mail;
	}


	public function getAdmin(){
		return $this->admin;
	}

	public function setAdmin($admin){
		$this->admin = $admin;
	}


	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}


	public function getPassword(){
		return $this->pwd;
	}

	public function setPassword($password){
		$this->pwd = $password;
	}

	public function estValideMdp($mdp){
	    $salt = "48@!alsd";
		$password = $mdp;
		$passwordSaisiMD5 = md5(md5($password).$salt);

		return $passwordSaisiMD5 == $this->getPassword();
	}
}

?>