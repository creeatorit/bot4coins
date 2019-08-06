<!-- partial:partials/_sidebar.html -->
<br /><br /><br />
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <span class="nav-link" href="#">
        <div class="profile-image online">
          <img src="images/faces/user1.jpg"/>
        </div>
        <p>
          <?php echo $_SESSION['UsuarioNome']; ?>
        </p>
        <div class="d-flex justify-content-center mt-4 mb-2">
          <!-- <i class="mdi mdi-gmail mr-3"></i> -->
          <!-- <i class="mdi mdi-account"></i> -->
        </div>
      </span>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Geral</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="dashboard">
        <i class="mdi mdi-compass-outline menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="clientes">
        <i class="mdi mdi-account-multiple menu-icon"></i>
        <span class="menu-title">Clientes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="promissoria" target="_blank">
        <i class="mdi mdi-content-duplicate menu-icon"></i>
        <span class="menu-title">Nota Promissoria</span>
      </a>
    </li>

    <li class="nav-item nav-category">
      <span class="nav-link">Configurações</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="usuarios">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">Usuários</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="credor">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Credor</span>
      </a>
    </li>
  </ul>
</nav>