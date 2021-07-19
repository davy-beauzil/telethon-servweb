<?php

error_reporting(0);

  $data = file_get_contents('php://input');
  $myObj = json_decode($data);
  
  if(isset($myObj)){

    $bdd = new PDO('mysql:host=localhost;dbname=telethon;charset=utf8', 'root', 'root');
    $request = "INSERT INTO utilisateur (nom, prenom, dateNaissance, mail, mdp) VALUES (?, ?, ?, ?, ?);";
    $requestToVerify = "SELECT * FROM utilisateur WHERE mail = ?;";

    $stmt = $bdd->prepare($requestToVerify);
    $stmt->bindParam(1, $myObj->mail);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if($result[0]){
      $output['code'] = '0';
      $output['response'] = 'L\'utilisateur existe déjà';
    }else{
      $stmt = $bdd->prepare($request);
      $stmt->bindParam(1, $myObj->nom);
      $stmt->bindParam(2, $myObj->prenom);
      $stmt->bindParam(3, $myObj->dateNaissance);
      $stmt->bindParam(4, $myObj->mail);
      $stmt->bindParam(5, md5($myObj->mdp));
      $executed = $stmt->execute();
      
      if($executed){
        $output['code'] = '1';
        $output['response'] = 'Vous êtes maintenant inscrit';
      }else {
        $output['code'] = '0';
        $output['response'] = 'Une erreur s\'est produite';
      }
    }
    echo json_encode($output);

  }