<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show pace-done brand-minimized sidebar-minimized">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="vistas/img/logoatm.png" width="40" height="30" alt="ATM Logo">
        <img class="navbar-brand-minimized" src="vistas/img/logoatm.png" width="40" height="30" alt="ATM Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav ml-auto">
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="escritorio">
                <i class="nav-icon icon-speedometer"></i> Escritorio
              </a>
            </li>
            <li class="nav-title">OPCIONES</li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-pencil"></i> Ingresar</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="clientes">
                    <i class="nav-icon icon-people"></i> Clientes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="proveedores">
                    <i class="nav-icon icon-people"></i> Proveedores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="items">
                    <i class="nav-icon fa fa-shopping-bag"></i> Items</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="centro">
                    <i class="nav-icon icon-home"></i> Centro</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="formatos">
                    <i class="nav-icon fa fa-book"></i> Formatos</a>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon fa fa-cubes"></i> Requisiciones </a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="request_m">
                    <i class="nav-icon icon-control-play"></i> Crear Requisicion</a>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-control-forward"></i> Req. en Archivo</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="request_mtto">
                                <i class="nav-icon fa fa-wrench"></i> Req. MTTO
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="request_op">
                                <i class="nav-icon fa fa-ship"></i> Req. OP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="request_al">
                                <i class="nav-icon fa fa-home"></i> Req. AL
                            </a>
                        </li>
                    </ul>
                </li>     
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-calculator"></i> Presupuestos</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="pcs">
                    <i class="nav-icon icon-note"></i> Asignar Presupuesto</a>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-wrench"></i> Ordenes Compra</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-control-forward"></i> Ord. en Archivo </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="ordenesM">
                                <i class="nav-icon fa fa-wrench"></i> Ord. MTTO
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ordenesO">
                                <i class="nav-icon fa fa-ship"></i> Ord. OP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ordenesA">
                                <i class="nav-icon fa fa-home"></i> Ord. AL
                            </a>
                        </li>
                    </ul>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <!-- FIN DEL ASIDE -->