<?php
include 'include/element.php';

if (isset($_POST["recherche"])) {
    header("location:categorie.php?idcategorie=" . $_POST["categorie"] . "&recherche=" . $_POST["recherchetext"]);
    //envoie vers la page categorie.php avec l'id de la catégorie et la recherche
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Accueil Electro-Annonce</title>
    <?php include 'include/header.php'; ?>
    <style>
        .card {
            transition: box-shadow 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
        }
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .carousel {
            position: relative;
            width: 100%;
            max-height: 300px;
            overflow: hidden;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            min-width: 100%;
            transition: opacity 1s ease-in-out;
            display: none; /* hide all slides by default */
        }
        .carousel-item.active {
            display: block; /* show the active slide */
        }
        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-caption h5 {
            color: white;
            font-size: 2em;
            font-weight: bold;
            margin: 0;
        }
        .carousel-control-prev, .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            font-size: 2em;
        }
        .carousel-control-prev {
            left: 10px;
        }
        .carousel-control-next {
            right: 10px;
        }
    </style>
</head>
<body style="background-color: #f2edf3">
<div class="container-scroller">

    <?php include 'include/navigation.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper container">

                <!-- Carrousel -->
                <div id="carouselExampleIndicators" class="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($pdo->query("SELECT * from annonce order by vue desc LIMIT 20") as $index => $ligne): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="../<?= $ligne['photo'] ?>" class="d-block w-100" alt="...">
                                <div class="carousel-caption">
                                    <h5><?= $ligne['titre'] ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" onclick="prevSlide()">
                        <span aria-hidden="true">&lsaquo;</span>
                    </button>
                    <button class="carousel-control-next" onclick="nextSlide()">
                        <span aria-hidden="true">&rsaquo;</span>
                    </button>
                </div>

                <div class="row mt-4">
                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">Recherche</h2>

                                <form method="post" action="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <select class="form-select" name="categorie">
                                                    <?php
                                                    $req = $pdo->query("select * from categorie");
                                                    $resultat = $req->fetchAll();
                                                    foreach ($resultat as $categorie) {
                                                        echo "<option value='" . $categorie["idc"] . "'>" . $categorie["nomCat"] . "</option><br>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Entrer le titre de l'annonce" name="recherchetext" aria-label="Text input with dropdown button">
                                            <div class="input-group-append">
                                                <input type="submit" class="btn btn-success" name="recherche" value="Rechercher">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="text-center">
                                    <a class="btn btn-success" href="<?php if (isset($uid)): ?>nvAnnonces.php <?php else: ?>connexion.php <?php endif; ?>">
                                        <i class="fa-regular fa-square-plus "></i><span class="menu-title "> Nouvelle Annonce</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="text-center">Les 20 annonces les plus vues </h2>
                                <div class="row product-item-wrapper mt-4">
                                    <?php foreach ($pdo->query("SELECT * from annonce order by vue desc LIMIT 20") as $tableau): ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 product-item">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="action-holder">
                                                        <?php
                                                        $time = time();
                                                        $diff = $time - $tableau['time'];
                                                        if ($diff < 604800): ?>
                                                            <div class="sale-badge bg-gradient-success">New</div>
                                                        <?php endif; ?>
                                                        <span class="favorite-button">
                                                            <a href="<?php if (isset($uid)): ?> action_get.php?action=ajoutFavori&ida=<?= $tableau["ida"] ?>&idu=<?= $uid ?>&route=location:index.php<?php else: ?>connexion.php<?php endif; ?>">
                                                                <?php
                                                                if (isset($uid)) {
                                                                    $verif = $pdo->prepare("SELECT * from favoris where ida = ? and idu = ?");
                                                                    $verif->execute(array($tableau['ida'], $uid));
                                                                    if ($verif->rowCount() == 0) {
                                                                        echo '<i style="color: #ff0000" class="fa-regular fa-heart"></i>';
                                                                    } else {
                                                                        echo '<i style="color: #ff0000" class="fa-solid fa-heart"></i>';
                                                                    }
                                                                } else { ?>
                                                                    <i style="color: #ff0000" class="fa-regular fa-heart"></i>
                                                                <?php } ?>
                                                            </a>
                                                        </span>
                                                    </div>

                                                    <div class="product-img-outer text-center">
                                                        <img class="product_image rounded" style="height: 300px; width: 300px" src="../<?= $tableau["photo"] ?>" alt="prduct image">
                                                    </div>
                                                    <p class="product-title"><?= $tableau["titre"] ?></p>
                                                    <p class="product-price"><?= number_format($tableau["prix"], 0, ',', ' ') ?> €</p>
                                                    <p class="product-actual-price">
                                                        <?php if ($tableau["livraison"] == 1): ?>
                                                            <span class="badge badge-pill badge-success">Livraison <i class="fa-solid fa-truck"></i></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-pill badge-danger">Main propre <i class="fa-solid fa-handshake"></i></span>
                                                        <?php endif; ?>
                                                    </p>
                                                    <ul class="product-variation">
                                                        <?php if ($tableau["categorie"] == 1): ?>
                                                            <span class="badge badge-primary">Téléphones mobiles <i class="fa-solid fa-heart mx-2"></i></span>
                                                        <?php elseif ($tableau["categorie"] == 2): ?>
                                                            <span class="badge badge-warning">Ordinateurs portables<i class="fa-solid fa-user-secret mx-2"></i></span>
                                                        <?php elseif ($tableau["categorie"] == 3): ?>
                                                            <span class="badge badge-info">Ordinateurs de bureau <i class="fa-solid fa-rocket mx-2"></i></span>
                                                        <?php elseif ($tableau["categorie"] == 4): ?>
                                                            <span class="badge badge-danger">Tablettes <i class="fa-solid fa-feather-pointed mx-2"></i></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success">Accessoires électroniques<i class="fa-solid fa-earth-europe mx-2"></i></span>
                                                        <?php endif; ?>
                                                    </ul>
                                                    <a href="detail.php?ida=<?= $tableau["ida"] ?>" class="btn btn-success">Voir</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php include 'include/footer.php'; ?>

        </div>
    </div>
</div>

<?php include 'include/script.php'; ?>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides[currentSlide].classList.remove('active');
        currentSlide = (index + totalSlides) % totalSlides;
        slides[currentSlide].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    setInterval(nextSlide, 3000); // Change image every 3 seconds
</script>
</body>
</html>
