<!-- set Global variable -->
<script> 
  const _uri = "<?= base_url() ?>"; 
</script>

<script src="<?= base_url('public/lib/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/lib/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('public/lib/feather-icons/feather.min.js') ?>"></script>
<script src="<?= base_url('public/lib/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.3/dist/sweetalert2.all.min.js" integrity="sha256-yZY1enw6vLTPtoUDCif8NZqOKW+OjdGOOeScgtUVg3w=" crossorigin="anonymous"></script>

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


