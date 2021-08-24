<?php
session_start();
include('db.php');
include('function.php');
$user_data = check_login($con);
$article = getArticles();
print getArticles();

$title = "Accueil | GAMERCASH";
include('./components/header.php'); 
?>

<section class="sessionPerso">
<a href="logout.php">Logout</a>
    Hello, <?= $user_data['nom'] ?>
</section>
<section class="showcase">
  <video src="./images/ff7.mp4" muted loop autoplay></video>
       
  <h1 class="fw-light text-white">Bienvenu chez GAMERCASH</h1>
  <p class="lead text-white">Votre spécialiste consoles de jeux next generation, livraison rapide et frais de port imbatable!</p>
  <p>
    <a href="panier.php" class="btn btn-light my-2">Voir mon panier</a>       
  </p>
</section>

<section class="produits">
  <div class="container">
    <div class="row ">
      <div class="col d-flex justify-content-between">
        <?php showArticles(); ?>
      </div>
    </div>
  </div>
</section>
                  
                        

<?php require "./components/footer.php"; ?>