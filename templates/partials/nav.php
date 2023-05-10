<nav class="navbar bg-body-tertiary sticky-top">
  <div class="container-fluid">
   <a class="navbar-brand" href="index.php">
      <img src="/CO551_CW2_BNU_PHP\img\logo2.jpg" alt="bucks_logo" width="200" height="100">
   </a>
   <a class="navbar-toggler" style="text-decoration:none;" href="https://www.bucks.ac.uk/life/our-campuses/uxbridge-campus">Uxbridge Campus</a>
   <a class="navbar-toggler" style="text-decoration:none;" href="https://www.bucks.ac.uk/life/our-campuses/aylesbury-campus">Aylesbury Campus</a>
   <a class="navbar-toggler" style="text-decoration:none;" href="https://www.bucks.ac.uk/life/our-campuses/missenden-abbey">Missenden Abbey Campus</a>
   <a class="navbar-toggler" style="text-decoration:none;" href="https://www.bucks.ac.uk/life/our-campuses/high-wycombe-campus">High Wycombe Campus</a>
   

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> Menu
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Buckinghamshire University</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Students
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="addstudent.php">Add new student</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="students.php">Students</a></li>
                <hr class="dropdown-divider">
              <li><a class="dropdown-item" href="seed.php">Seed database</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Modules
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="assignmodule.php">Assign Module</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="modules.php">Modules</a></li>
              
            </ul>
          </li>
      
          <li class="nav-item">
            <a class="nav-link" href="details.php">My details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>

          
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>