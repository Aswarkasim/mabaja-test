<style>
  .footer {
    /* position: absolute; */
    bottom: 0;
    width: 100%;
    height: 60px;
    /* Set the fixed height of the footer here */
    line-height: 60px;
    /* Vertically center the text there */
    background-color: #f5f5f5;
  }


  /* Custom page CSS
-------------------------------------------------- */
  /* Not required for template or sticky footer method. */

  /* .container {
    width: auto;
    max-width: 680px;
    padding: 0 15px;
  } */
</style>

<footer class="footer">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url('assets/'); ?>home/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets/admin/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/admin/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>




<!-- page script -->
<script>
  $(function() {
    $('.DataTable').DataTable();
  })
</script>

</body>

</html>