<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">


        <div class="col-md-8 col-md-offset-2" >
            <img src="<?php echo base_url('uploads/'.$article->image);?>" alt="<?php echo $article->title; ?>" class="img-rounded"  style="max-height:330px;max-width:600px;" >
        </div>
        <div class="col-md-10 col-md-offset-1" >
            <br/>
            <p><?php echo $article->news_text;?></p>
        </div>

    </div>
</div>

<?php include(VIEWPATH."_footer.php") ?>
