<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="./assets/css/style.css" />
    <script src="./assets/js/script.js" defer></script>
    <!-- Load an icon library -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>


                </div>

            </div>
            <form class="d-flex" role="search" action="recherche.php" method="GET">
                <div class="input-group  ">
                    <span class="input-group-text  " id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input
                        type="search"
                        name="search"
                        id="search-input"
                        class="form-control me-2   "
                        autocomplete="off">
                    <div id="suggestions-dropdown"
                        class="dropdown-menu show">

                    </div>
                </div>

                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>
        </div>
    </nav>
    <div class="container mt-5 ">
        <h1 class="text-center">Bienvenue sur la page d'accueil</h1>
        <div class="d-flex mt-5 mb-5 justify-content-center">

            <img src="./assets/images/browser-icon.jpg" alt="logo navigateur">

        </div>
        <p class="text-center fs-5"> Vous pouvez faire votre recherche de voiture sur notre moteur de recherche </p>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>