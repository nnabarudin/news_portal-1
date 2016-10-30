<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url();?>">News Portal</a>
        </div>
        <ul class="nav navbar-nav">

            <li><a href="<?php echo base_url();?>">Home</a></li>
            <li><a href="<?php echo base_url()."news/register_user";?>">Register</a></li>
            <li><a href="<?php echo base_url()."news/login";?>">Login</a></li>
            <?php
            if (is_user_loggedin() == true){
                //Show these menus if user is logged in
                ?>
                <li><a href="<?php echo base_url()."news/publish_article";?>">Publish Articles</a></li>
                <li><a href="<?php echo base_url()."news/show_articles";?>">Show Articles</a></li>
                <li><a href="<?php echo base_url()."news/logout";?>">Logout</a></li>
            <?php
            }
            ?>

        </ul>

    </div>
</nav>
<?php
/**
 * Created by PhpStorm.
 * User: Umair
 * Date: 10/2/2016
 * Time: 6:24 PM
 */
