<?php
    session_start();
    include ("module/modul-conectare.php");
    include ("module/modul-functii.php");
    include ("module/modul-setari.php");
    $pagina = 'index';
    if (isset($_GET['page']))
        $pagina = $_GET['page'];
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Doc Management</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="./?pagina=index">Documents</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?=$pagina == "add"?"active":""?>">
                        <a class="nav-link" href="./?page=add">Add</a>
                    </li>
                    
                    <li class="nav-item <?=$pagina == "browse"?"active":""?>">
                        <a class="nav-link" href="./?page=browse">Browse</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <?php
            
            AfisareAlerta();
            
            $nf = "pages/page-{$pagina}.php";
            if (file_exists($nf))
                include $nf;
            else
            {
                print("Boo-hoo-hoo!");
                ?><img src="https://destepti.ro/wp-content/uploads/2014/04/Bufnita.jpg" height="auto" width="600"><?php 
            }
            
           
        ?>
    </div>
</body>
</html>
        