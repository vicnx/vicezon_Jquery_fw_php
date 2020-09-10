<nav id="menunav" class="navbar navbar-expand-lg navbar-dark transparent">
  <a class="navbar-brand" href="#">Vicezon</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a id="home" class="nav-link" data-tr="Home"></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" data-tr="Products"></a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" id="products">Products</a>
          <a class="dropdown-item" href="#">Tablets</a>
          <a class="dropdown-item disabled" href="#">Mobiles</a>
          <a class="dropdown-item disabled" href="#">TVs</a>
        </div>
      </li>
      <li class="nav-item">
        <a id="contact" class="nav-link">Contact</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li id="menu_li" class="nav-item dropdown">
        <!-- <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
          <img id="menu_avatar" class="menu_avatar" src="" alt=""><span id='username'></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right bg-dark"
            aria-labelledby="navbarDropdownMenuLink-333">
            <a id="profile" class="dropdown-item">Perfil</a>
            <a id="logout" class="dropdown-item">Desconectar</a>
        </div> -->
      </li>
      <li id="cart">
        <i id="cart_menu" class="fas fa-shopping-cart"></i>
        <span class="counter_cart"></span>
      </li>
      <li>
        <div id="lang" >
          <select id="la" class="form-control form-control-sm">
              <option id="en" value="en" data-tr="English"></option>
              <option  id="es" value="es" data-tr="Spanish"></option>
              <option  id="de" value="de" data-tr="German"></option>
          </select>
        </div>
      </li>
    </ul>
  </div>
</nav>