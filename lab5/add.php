<?php
    session_start();
    include ("module/modul-conectare.php");
    include ("module/modul-functii.php");
    include ("module/modul-setari.php");
    
  
    
    $clean = [
        //valorile primite cu post le punem aici si le escapuim
        'Author' => mysqli_real_escape_string($link, $_POST['author']),
        'Title' => mysqli_real_escape_string($link, $_POST['title']),
        'Nr.Pages' => intval($link, $_POST['nrpages']),
        'Format' => mysqli_real_escape_string($_POST['format']),
        'Type' => mysqli_real_escape_string($_POST['type'])
    ];
    $query = "insert INTO documents(author, title, nrpages, format, type) VALUES (
        '{$clean['Author']}',
        '{$clean['Title']}',
        '{$clean['Nr.Pages']}',
        '{$clean['Format']}',
        '{$clean['Type']}'
    )";//acest query il adaptezi in functie de nevoie
    
    mysqli_query($link, $query);
    
    header("Location: ./?page=index");
    