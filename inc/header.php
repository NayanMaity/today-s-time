<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <header id="header">
        <div class="container-xl ">

            <div class="navbar-normal">
                <a class="logo" href="index.php">Today's Time</a>


                <div class="nav-inner">
                    <ul class="navbar-nav" id="menu">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="category-post.php">Food</a></li>
                                <li><a class="dropdown-item" href="category-post.php">Tech</a></li>
                                <li><a class="dropdown-item" href="category-post.php">Travel</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="nav-r">
                        <div class="avatar">
                            <a href="profile.php" class="profile">
                                <img src="https://picsum.photos/id/239/200/200" alt="">
                            </a>
                        </div>

                        <a href="logout.php" class="logout-btn">Logout</a>

                        <button id="menu-toggle">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>
                    </div>

                </div>
            </div>

            <nav class="mobile-nav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mobile-menu">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>

                        <ul class="dropdown-menu mobile-drop-menu">
                            <li><a class="dropdown-item" href="category-post.php">Food</a></li>
                            <li><a class="dropdown-item" href="category-post.php">Tech</a></li>
                            <li><a class="dropdown-item" href="category-post.php">Travel</a></li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="logout.php" class="logout-btn">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="clearfix "></div>