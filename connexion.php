<?php

error_reporting(0);

  $data = file_get_contents('php://input');
  $myObj = json_decode($data);
  
  if(isset($myObj)){

    $bdd = new PDO('mysql:host=localhost;dbname=telethon;charset=utf8', 'root', 'root');
    $request = "SELECT id, nom, prenom, mail, dateNaissance FROM utilisateur WHERE mail = ? AND mdp = ? LIMIT 1;";

    
    $stmt = $bdd->prepare($request);
    $stmt->bindParam(1, $myObj->mail);
    $stmt->bindParam(2, md5($myObj->mdp));
    $stmt->execute();

    $result = $stmt->fetchAll();

    if($result[0]){
      $output['code'] = '1';
      $output['id'] = $result[0]['id'];
      $output['nom'] = $result[0]['nom'];
      $output['prenom'] = $result[0]['prenom'];
      $output['dateNaissance'] = $result[0]['dateNaissance'];
      $output['mail'] = $result[0]['mail'];
    }else{
      $output['code'] = '0';
    }

    echo json_encode($output);
    

  }