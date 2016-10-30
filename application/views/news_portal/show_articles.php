<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 " >
            <?php if($articles->result_id->num_rows > 0){
                foreach($articles->result() as $u){ ?>
                    <h3><?php echo $u->title;?></h3>
                    <p><?php echo $u->news_text;?></p>
                    <br><br>
                    <?php
                }
            }

            ?>

        </div>


    </div>
</div>

<?php include(VIEWPATH."_footer.php") ?>
