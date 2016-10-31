<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
<script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!--Select2-->
<script src="<?php echo base_url();?>plugins/select2/js/select2.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#news-textarea').wysihtml5();
    } );
</script>

</body>
</html>