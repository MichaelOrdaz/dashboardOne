
    <script src="<?= base_url('public/lib/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/jquery.flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('public/lib/jquery.flot/jquery.flot.stack.js') ?>"></script>
    <script src="<?= base_url('public/lib/jquery.flot/jquery.flot.resize.js') ?>"></script>
    <script src="<?= base_url('public/lib/chart.js/Chart.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('public/lib/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>

    <?php 
      //aqui mando una variable de mas estilos
      if( ! empty( $scripts ) ){
        foreach( $scripts as $js ){
          echo "<script src='".base_url($js)."'></script>";
        }
      }
    ?>
    
    <script src="<?= base_url('public/assets/js/dashforge.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/dashforge.aside.js') ?>"></script>


    <!-- append theme customizer -->
    <!-- <script src="../../lib/js-cookie/js.cookie.js"></script> -->
    <!-- <script src="../../assets/js/dashforge.settings.js"></script> -->


  </body>
</html>