</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <p><strong><a href="#" target="_blank">iLottWeb</a></strong></p>
    </div>
    <div class="footer-text">
        <?= $system['systemFooter'] ?>
    </div>
</footer>



<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js" type="text/javascript"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/pt.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".selectized").select2({
            allowClear: false,
            language: "pt"
        });
    });

    $(function() {
        $("#example1").DataTable();
        $(".example1").DataTable({
            "iDisplayLength": 100,
            "language": {
                "url": "plugins/datatables/dataTables.portuguese.lang"
            }
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>






</body>

</html>