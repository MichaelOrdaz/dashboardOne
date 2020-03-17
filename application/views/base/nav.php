<div class="content ht-100v pd-0">
  <div class="content-header justify-content-end">
    <!-- <div class="content-search">
      <i data-feather="search"></i>
      <input type="search" class="form-control" placeholder="Search...">
    </div> -->
    <nav class="nav">
      <a href="#" class="nav-link"><i data-feather="help-circle" title="ayuda"></i></a>
      <a href="#" class="nav-link" id="logout"><i data-feather="log-out" title="cerrar sesión" ></i></a>
    </nav>
  </div><!-- content-header -->

  <div class="content-body">
    
    <div class="container-fluid pd-x-0">
      <div class="d-sm-flex align-items-center justify-content-between mb-1">
        <div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#"> <?= $breadcrumbMain ?> </a></li>
              <li class="breadcrumb-item active" aria-current="page"> <?= $breadcrumbSecondary ?> </li>
            </ol>
          </nav>
        </div>
      </div>
      
      <?= $body ?>
      
    </div><!-- container -->
  
  </div>

</div>