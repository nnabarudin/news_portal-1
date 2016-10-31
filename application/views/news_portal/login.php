<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 " >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">User Login</h3>
                </div>
                <div class="panel-body">

                    <?php
                    //Show Success or Error messages
                    $message = $this->session->flashdata('message');
                    $error = $this->session->flashdata('error');
                    if (isset($message)){ ?>
                        <div style="text-align:center;" class="alert alert-success" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <?php echo $message;?>
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>
                        <?php
                    }
                    else if (isset($error)){ ?>
                        <div style="text-align:center;" class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <?php echo $error; ?>
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>
                        <?php
                    }
                    ?>

                    <?php echo form_open('',array('name' => 'login','id' => 'login','data-toggle' => "validator")); ?>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <p class="help-block pull-left">Don't have an account? <a href="<?php echo base_url('/news/register_user'); ?>">Register</a></p>
                    <button type="submit" name="btn_submit"  class="btn btn-primary pull-right">Submit</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Bootstrap Validator -->
<script src="<?php echo base_url();?>plugins/bootstrap-validator/validator.min.js"></script>
<script>
    $('#login').validator()
</script>
<?php include(VIEWPATH."_footer.php") ?>
