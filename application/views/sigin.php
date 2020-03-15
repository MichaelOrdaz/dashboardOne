<!DOCTYPE html>
<html lang="es">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Dashboard Legal solutions">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>Login::LegalSolutions</title>

    <!-- vendor css -->
    <link href="<?= base_url('public/lib/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/dashforge.css')?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/dashforge.auth.css')?>">
  </head>
  <body>

    <header class="navbar navbar-header navbar-header-fixed">
      <div class="navbar-brand">
        <a href="<?= current_url() ?>" class="df-logo text-success"> Legal <span class="text-muted">Solutions</span></a>
      </div><!-- navbar-brand -->
    </header>

    <!-- navbar -->

    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
            <div class="wd-100p">
              <h3 class="text-muted mg-b-5 text-center">Entrar al Sistema</h3>
              
              <div class="row">
                <div class="col text-center">
                  <img src="<?= base_url('public/images/logo.png')?>" alt="Logo LegalSolutions" class="img-fluid">
                </div>
              </div>
              

              <?= form_open('', ['name'=> 'formLogin', 'id'=> 'formLogin'] )  ?>

                <div class="form-group">
                  <label> Nombre de Usuario </label>
                  <input type="username" name="username" class="form-control" placeholder="yourname@yourmail.com" value="<?=set_value('username')?>" >
                </div>
                <div class="form-group">
                  <div class="d-flex justify-content-between mg-b-5">
                    <label class="mg-b-0-f">Contraseña</label>
                  </div>
                  <input type="password" name="pass" class="form-control" value="" placeholder="Ingresa tu Contraseña">
                </div>
                <button class="btn btn-success btn-block" type="submit">Entrar</button>

              </form>

              <div class="row">
                <div class="col">
                    <a href="<?= current_url() ?>" class="tx-13">¿Olvidaste la Contraseña?</a>
                </div>
              </div>
              
              <div class="row mt-1">
                <div class="col">
                  <div class="alert alert-<?= @$type ?> <?= empty($msg) ? 'd-none' : '' ?>">
                    <?= $msg ?>

                    <?php 
                    //var_dump($user); 
                    ?>
                  </div>
                </div>
              </div>

              <div class="row mt-1">
                <div class="col">
                  <?= validation_errors('<div class="alert alert-danger">','</div>') ?>
                </div>
              </div>
              
            </div>
          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; <?= date('Y') ?> SIBEI </span>
      </div>
      <!-- <div>
        <nav class="nav">
          <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
          <a href="../../change-log.html" class="nav-link">Change Log</a>
          <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
        </nav>
      </div> -->
    </footer>

    <script src="<?= base_url('public/lib/jquery/jquery.min.js')?>"></script>
    <script src="<?= base_url('public/lib/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?= base_url('public/lib/perfect-scrollbar/perfect-scrollbar.min.js')?>"></script>

    <script src="<?= base_url('public/assets/js/dashforge.js')?>"></script>

    <!-- append theme customizer -->

  </body>
</html>
