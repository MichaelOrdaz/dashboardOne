
<script src="<?= base_url('public/lib/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/lib/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/lib/feather-icons/feather.min.js') ?>"></script>
<script src="<?= base_url('public/lib/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>

<script src="<?= base_url('public/lib/sweetalert2/dist/sweetalert2.all.min.js')?>" ></script>

<!-- set Global variable -->
<script> 
  const _uri = "<?= base_url() ?>";
  $('[data-toggle="tooltio"]').tooltip();
</script>

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
<script src="<?= base_url('public/mgr/global.js') ?>"></script>


