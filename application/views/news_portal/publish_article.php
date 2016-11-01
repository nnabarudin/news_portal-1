<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 " >

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Publish Article</h3>
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

                    <?php echo form_open_multipart('',array('name' => 'publish_news','id' => 'publish_news','data-toggle' => "validator")); ?>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter News Title" required>
                    </div>

                    <div class="form-group">
                        <label>Text</label>
                        <textarea class="form-control" id="news-textarea" name="news_text" rows="5" ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fileToUpload">Image:</label>
                        <input type="file" name="fileToUpload" accept="image/*" id="fileToUpload" required>
                        <p class="help-block">Max file size : 2MiB</p>
                    </div>

                    <button type="submit" name="btn_submit"  class="btn btn-primary pull-right">Publish</button>
                    <?php echo form_close(); ?>

                </div>
            </div>

        </div>


    </div>
</div>


<!-- Bootstrap Validator -->
<script src="<?php echo base_url();?>plugins/bootstrap-validator/validator.min.js"></script>
<script>
    $('#publish_news').validator()
</script>
<?php include(VIEWPATH."_footer.php") ?>
