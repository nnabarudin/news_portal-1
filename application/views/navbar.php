<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url();?>">News Portal</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url()."news/rss";?>" target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
            <li><a href="<?php echo base_url();?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        </ul>
        <?php
        if (is_user_loggedin() == true){ ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href=""> <?php echo get_userdata($this->session->user_id)['name'];?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()."news/publish_article";?>"><i class="fa fa-plus" aria-hidden="true"></i> Publish</a></li>
                        <li><a href="<?php echo base_url()."news/show_articles";?>"><i class="fa fa-list" aria-hidden="true"></i> My Articles</a></li>
                        <li><a href="<?php echo base_url()."news/logout";?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>

        <?php
        }
        else{ ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url()."news/register_user";?>"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                <li><a href="<?php echo base_url()."news/login";?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
            </ul>
        <?php
        }?>

    </div>
</nav>



<?php
/**
 * Created by PhpStorm.
 * User: Umair
 * Date: 10/2/2016
 * Time: 6:24 PM
 */
