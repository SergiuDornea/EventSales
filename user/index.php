<?php
// info conect
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gestionare_evenimente';

// ne conectam folosind informatiile de mai sus
$conectare = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


// isset verifica daca datele exista
    if(isset($_POST['submit'])){
        if(!empty($_POST['username'] && !empty($_POST['password']))){
            $_SESSION['username'][]=$_POST['username'];
            $_SESSION['password'][]=$_POST['password'];

        }else{
            exit('Completati datele din formular!');
        }
    }