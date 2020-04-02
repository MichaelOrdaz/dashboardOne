<aside class="aside aside-fixed">
  <div class="aside-header">
    <a href="<?= current_url() ?>" class="aside-logo">Legal<span>Solutions</span></a>
    <a href="" class="aside-menu-link">
      <i data-feather="menu"></i>
      <i data-feather="x"></i>
    </a>
  </div>
  <div class="aside-body">
    <div class="aside-loggedin">
      <div class="d-flex align-items-center justify-content-start">
        <a href="" class="avatar"><img src="<?= base_url('public/images/favicon.png') ?>" class="rounded-circle" alt=""></a>
        <!-- <div class="aside-alert-link">
          <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a>
          <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a>
          <a href="" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
        </div> -->
      </div>
      <div class="aside-loggedin-user">
        <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
          <h6 class="tx-semibold mg-b-0"> <?= ucwords("{$_SESSION['dash_nombre']}") ?> </h6>
          <i data-feather="chevron-down"></i>
        </a>
        <p class="tx-color-03 tx-12 mg-b-0">Rol</p>
      </div>
      <div class="collapse" id="loggedinMenu">
        <ul class="nav nav-aside mg-b-0">
          <li class="nav-item"><a href="" class="nav-link"><i data-feather="user"></i> <span>Ver Perfil</span></a></li>
        </ul>
      </div>
    </div><!-- aside-loggedin -->
    <ul class="nav nav-aside">
      
      <li class="nav-label">Dashboard</li>
      
      <li class="nav-item <?= $home ?? '' ?>">
        <a href="<?= base_url('mgr/main') ?>" class="nav-link"><i data-feather="pie-chart"></i> <span>Resumen</span></a>
      </li>


      <!-- <li class="nav-item <?= $otherModule ?? '' ?>">
        <a href="dashboard-two.html" class="nav-link"><i data-feather="globe"></i> <span>Other Module</span></a>
      </li> -->

      <li class="nav-item with-sub <?= $adminSistemas ?? '' ?>">
        <a href="" class="nav-link"> <i data-feather="list"></i> <span>Admin Sistema</span> </a>
        <ul>
          <li><a href="<?= base_url('mgr/gestion/usuarios') ?>"> </i> Usuarios</a></li>
          <li><a href="<?= base_url('mgr/gestion/instancias') ?>"> </i> Instancias</a></li>
        </ul>
      </li>

      <li class="nav-item with-sub <?= $instanciasLink ?? '' ?> <?= isset($instanciasLink) ? 'show' : '' ?>">
        <a href="" class="nav-link"> <i data-feather="terminal"></i> <span>Instancias</span> </a>
        <ul>
          
          <?php
            if( empty( $instancias ) ){
              echo "<li><a href='javascript://' > No hay instancias </a></li>";
            }
            else{
              foreach ($instancias as $instancia) {
                // $segmentIp = explode('.', $instancia->host);
                  // <a href='".base_url('mgr/instancia/index/'. end( $segmentIp ) )."' > {$instancia->host} </a>
                echo "<li>
                  <a href='".base_url('mgr/instancia/index/'.$instancia->id)."' title='{$instancia->descripcion}' data-toggle='tooltip' > {$instancia->host} </a>
                </li>";
                
              }
            }
          ?>

        </ul>
      </li>


    </ul>
  </div>
</aside>