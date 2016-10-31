<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 " >
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register User</h3>
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

                    <?php echo form_open('',array('name' => 'register_user','id' => 'register_user')); ?>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name" required>
                    </div>

                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required>
                    </div>

                    <button type="submit" name="btn_submit"  class="btn btn-primary pull-right">Register</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>


    </div>
</div>

<?php include(VIEWPATH."_footer.php") ?>
