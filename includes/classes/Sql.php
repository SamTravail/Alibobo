<?php

class Sql
{
    private string $serverName = "localhost";
    private string $userName = "root";
    private string $userPassword = "";
    private string $database = "alibobo";
    private object $connexion;

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=$this->serverName;dbname=$this->database", $this->userName, $this->userPassword);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        if (isset($this->connexion))
            $this->connexion = null;
    }
}

// ----------------- fonction Insertion ---------------


class Utilisateur

{
    private string $nom = "";
    private string $prenom = "";
    private string $email = "";

    // ------------ getter / setter - nom---------------------------
    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    // ------------ getter / setter - prenom------------------------
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    // ------------ getter / setter - temail------------------------
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function insertion()
    {
        try {
            $this->connexion = new PDO("nom=$this->nom;prenom=$this->prenom;email=$this->email", $this->mdp);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}