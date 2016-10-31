<?php include(VIEWPATH."_header.php") ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 " >

            <?php if($articles->result_id->num_rows > 0){
                foreach($articles->result() as $u){ ?>
                    <div class="col-md-8">
                        <h3><a href="<?php $article_link=base_url().'news/article/'.$u->id;echo $article_link;?>"><?php echo $u->title;?></a></h3>
                        <p class="help-block">Posted by: <?php echo get_username($u->published_by);?>     &nbsp; <span class="glyphicon glyphicon glyphicon-time" aria-hidden="true"></span> <?php echo time2str($u->created_dtm);?></p>
                        <p>
                            <?php
                            if (strlen($u->news_text) > 250){
                                echo getExcerpt($u->news_text,0,250);
                                echo "<a href=$article_link> Show More</a>";
                            }
                            else{
                                echo $u->news_text;
                            }
                            ?>
                        </p>
                        <a href="<?php echo base_url().'news/delete_article/'.$u->id;?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                    </div>
                    <div class="col-sm-4">
                        <img src="<?php echo base_url('uploads/'.$u->image);?>" alt="<?php echo $u->title; ?>" class="img-thumbnail" height="200" width="200">
                        <br/><br/><br/>
                    </div>
                    <br><br>
                    <?php
                }
            }

            ?>

        </div>


    </div>
</div>

<?php include(VIEWPATH."_footer.php") ?>
