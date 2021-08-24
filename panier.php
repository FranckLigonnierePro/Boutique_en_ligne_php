<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$title = "Panier | GAMERCASH";
include('function.php');
include('./components/header.php'); 
if(isset($_POST['newQantity'])){
    changeQantity();
}
if(isset($_POST['articlePanierId'])){
    $id = $_POST['articlePanierId'];
    addToCart($id);
}
if(isset($_POST['modifyArticleId'])){
    changeQantity();
}

if(isset($_POST['index_to_remove'])){
    deleteArticle($_POST['index_to_remove']);
}

if(isset($_POST['supLePanier'])){
    $_SESSION['cart']=[];
}

if(isset($_POST['validation'])){
    $_SESSION['cart']=[];
    header('location:/boutiquephp/index.php');
}


?>

<body>
<?php
    showArticlePanier();
    echo "<h1>total panier:" .totalArticle(). "</h1>";
    echo "<h1>total frais de port:" .fdp(). "</h1>";
    echo "<h1>total:" .totalArticlefdp(). "</h1>";
    
    ?>
    <form method="post" action="panier.php">
    <input type="hidden" name="supLePanier"/>
    <button type="submit">supprimer le panier</button>
    <form method="post" action="index.php">
    <input type="hidden" name="validation"/>
    <button type="submit">valider la commande</button>
    </form>"
    ;
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>