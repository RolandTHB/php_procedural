<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="/public/">
    <img src="avatar.jpg" class="rounded-circle" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php echo ($page == "index" ? "active" : "") ?>">
        <a class="nav-link" href="/public/index.php">Home</a>
      </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown 1
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/public/variable.php">Variable</a>
                <a class="dropdown-item" href="/public/info.php">Info</a>
                <a class="dropdown-item" href="/public/structure.php">Structure</a>
                <a class="dropdown-item" href="/public/jeu.php">Jeu</a>
                <a class="dropdown-item" href="/public/function.php">Function</a>
            </div>
        </li>

        <li class="nav-item dropright">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown 2
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/public/post.php">Post</a>
                <a class="dropdown-item" href="/public/file.php">Files & Cookies</a>
                <a class="dropdown-item" href="/public/mail.php">Mail</a>
                <a class="dropdown-item" href="/public/gestion.php">Gestion des erreurs</a>
                <a class="dropdown-item" href="/public/chart.php">Chart</a>
            </div>
        </li>
        <li class="nav-item dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown 3
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/public/recursive.php">Récursive</a>
                <a class="dropdown-item" href="/public/xml.php">Xml</a>
                <a class="dropdown-item" href="/public/json.php">Json</a>
                <a class="dropdown-item" href="/public/randchart.php">Rand chart</a>
                <a class="dropdown-item" href="/public/fake.php">Fake test</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown 4
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/public/map.php">Map</a>
                <a class="dropdown-item" href="/public/revision.php">Revision</a>
                <a class="dropdown-item" href="/public/book.php">Book</a>
                <a class="dropdown-item" href="/public/book_pdo.php">Book_pdo</a>
                <a class="dropdown-item" href="/public/seed_pdo.php">Seed_pdo</a>
            </div>
        </li>
    </ul>
  </div>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    </ul>
    <?php
      echo '<span class="badge badge-info">User: ';
      if (isset($_SESSION['user'])) {
        echo $_SESSION['user'] . "</span>";
      } else {
        echo "anonymous</span>";
      }
      ?>
    </form>
    <form class="form-inline my-2 my-lg-0">
      <?php echo '<span class="badge badge-info">Visited: ' . $_SESSION['counter'] . '</span>'; ?>
    </form>
  </div>
</nav>

<div id="messages">
</div>
