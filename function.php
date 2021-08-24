<?php

/*------------------function recup des articles--------------------*/

function getArticles(){
  

}





//je recupere mes articles stocké dans ma function getARticles puis je boucle sur la function pour les afficher a l'unité 
/*------------------function affichage des articles--------------------*/
function showArticles(){

    require "./db.php";
    $sql = "SELECT * FROM articles";
    $result = mysqli_query($con,$sql);


    foreach($result as $article){

       echo 
       "
                <div class=\"card shadow-sm \">
                    <div class=\"card \" style=\"width: 18rem;\">
                       <img class=\"card-img-top\" src=$article->image alt=\"photo\" $article->image \" width=\"\" height=\"\">
                    <div class=\"card-body\">
                                <h1>$article->nom</h1> 
                                <h2>$article->description</h2> 
                                <h3>$article->prix</h3> 
                        <form method=\"post\" action=\"produit.php/$article->id\">
                            <input type=\"hidden\" name=\"articleId\" value=\"$article->id\">
                            <button type=\"submit\" class=\"btn btn-sm btn-outline-secondary\">Description</button>
                        </form>
                            <form method=\"post\" action=\"panier.php/$article->id\">
                            <input type=\"hidden\" name=\"articlePanierId\" value=\"$article->id\">
                        <button type=\"submit\" class=\"btn btn-sm btn-outline-secondary\">Ajouter au panier</button>
                        </form>
                    </div>
                    </div>
                </div>"
        ;

   }
}

/*------------------function recup d'un seul article--------------------*/

function getArticleFromId($id){
    $articles = getArticles();
    foreach($articles as $article){
        if ($id == $article->id){
            return $article;
        }
    }
}

/*------------------function affichage d'un article--------------------*/

function showArticle($id){

    $article = getArticleFromId($id);

    echo "<img src=\".$article->image\" alt=\"photo $article->image\" width=\"\" height=\"\">
    <h1>$article->nom</h1> 
    <h2>$article->description_detaillee</h2> 
    <h3>$article->prix</h3> 
    <form method=\"post\" action=\"panier.php/$article->id>
            <input type=\"hidden\" name=\"articlePanierId\" value=$article->id>
        <button type=\"submit\" class=\"btn btn-primary\">Ajouter au panier</button>
    </form>"
    ;
}



function addToCart($id){
    $articleDejaLa = FALSE;
    $articleAjouté = getArticleFromId($id);
    for ($i = 0; $i < count($_SESSION['cart']); $i++){
        if($articleAjouté['id'] === $_SESSION['cart'][$i]['id']){
            $articleDejaLa = TRUE;
            echo "<scripy>alert(\"cet article est deja dans le panier\")</scripy>";
        }
    }
    if (!$articleDejaLa) {
        $articleAjouté['qty'] = 1;
        array_push($_SESSION['cart'],$articleAjouté);
    }

}

function showArticlePanier(){
    
    foreach($_SESSION['cart'] as $article)
    echo "
    <div>
    <img src=\"" .$article['img']. "\" alt=\"photo" .$article['name']. "\" width=\"50\" height=\"50\">
    <h1>" .$article['name']. "</h1> 
    <h2>" .$article['slogan']. "</h2> 
    <h3>" .$article['price']. "</h3>
    <form method=\"post\" action=\"panier.php\"\">
    <input type=\"hidden\" name=\"modifyArticleId\" value=\"" .$article['id']."\">
    <input type=\"text\" size=\"1\" name=\"newQantity\" value=\"".$article['qty']."\"/>
    <button type=\"submit\" class=\"btn btn-primary\">changer qantiter</button>
    </form>
    <form method=\"post\" action=\"panier.php\"\">
    <input type=\"hidden\" name=\"index_to_remove\" value=\"".$article['id']."\"/>
    <input type=\"submit\" name=\"deleteBtn\" value=\"X\"/>
    </form>
    </div>"
    ;
    

}

function changeQantity(){

    for ($i = 0; $i < count($_SESSION['cart']); $i++){
       
        if($_SESSION['cart'][$i]["id"] == $_POST['modifyArticleId']){
            $_SESSION['cart'][$i]["qty"] = $_POST['newQantity'];
        }

    }
}

function deleteArticle($itemRemove){
for($i = 0; $i < count($_SESSION['cart']); $i++){
    if ($itemRemove == $_SESSION['cart'][$i]['id']) {
        array_splice($_SESSION['cart'],$i,1);
        echo "article supprimé";
    }
}

function btnSupLePanier(){
    echo "<form method=\"post\" action=\"panier.php\"\">
    <input type=\"hidden\" name=\"supLePanier\"/>
    <button type=\"submit\">supprimer le panier</button>
    </form>"
    ;
}


function supLePanier(){
    $_SESSION['cart']=[];
}
}

function totalArticle(){
    $total = 0;
    foreach($_SESSION['cart'] as $article){
        $total += $article['price'] * $article['qty'];
    }
    return $total;
}

function fdp(){
    
    $totalFdp = 0;
    foreach($_SESSION['cart'] as $article){
        $totalFdp += 5 * $article['qty'];
    }
    return $totalFdp;
    
}

function totalArticlefdp(){
    return totalArticle() + fdp();
}


function validation(){
    echo "<form method=\"post\" action=\"index.php\"\">
    <input type=\"hidden\" name=\"validation\"/>
    <button type=\"submit\">valider la commande</button>
    </form>"
    ;
}

function check_login($con)
{
    
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from clients where id = '$id' limit 1";

        $result = mysqli_query($con,$query);

        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    die;

}

?>