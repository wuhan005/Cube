<!DOCTYPE html>
<html lang="zh-Hans">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Cube - Create Everything You Like!">
    <meta name="author" content="John Wu">
    <link rel="shortcut icon" href="../static/img/logo-fav.png">
    <title>Cube</title>

    <link rel="stylesheet" href="/static/css/uikit.min.css" />
    <script src="/static/js/uikit.min.js"></script>
    <script src="/static/js/uikit-icons.min.js"></script>

    <script language='javascript'>
        function refresh(){
            document.location = '';
        }
    </script>

</head>

<body>
    <!-- Top NavBar -->
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="#">Logo</a>

            <ul class="uk-navbar-nav">
                <li>
                    <a href="#">
                        <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                        Features
                    </a>
                </li>
            </ul>

            <div class="uk-navbar-item">
                <div>Some <a href="#">Link</a></div>
            </div>

            <div class="uk-navbar-item">
                <form action="javascript:void(0)">
                <input class="uk-input uk-form-width-small" type="text" placeholder="Input">
                <button class="uk-button uk-button-default">Button</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="uk-grid">

        <!--Slider Bar -->
        <div class="uk-width-1-6@m ">
            <ul class="uk-margin-small-left uk-nav-default uk-nav-parent-icon" uk-nav>
                <li <?php echo $slider->active('Main');?>><a href="/Main"><span class="uk-margin-small-right" uk-icon="icon: home"></span> Home</a></li>
                
                <li class="uk-nav-header">Tools</li>
                <?php $slider->showSlider();?>

                <li class="uk-nav-header">Options</li>

                <li <?php echo $slider->active('Account');?>><a href="/Account"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Account</a></li>
                
                <?php if(!($db->getSetting('ShowLoginOptions') == 'off' AND $mod->isLogin() == false)){ ?>

                    <li <?php echo $slider->active('Manager');?>><a href="/Manager"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Manager</a></li>
                    <li <?php echo $slider->active('Data');?>><a href="/Data"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Data</a></li>
                    <li <?php echo $slider->active('Setting');?>><a href="/Setting"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Setting</a></li>
                
                <?php } ?>

                <li class="uk-nav-divider"></li>
            </ul>
        </div>

        <!-- Module Content -->
        <div class="uk-width-5-6@m">
            <!-- Module Name -->
            <h1 class="uk-text-lead"><a class="uk-link-reset" href=""><?php echo($mLoader->module['Name'])?></a></h1>

            <!-- Module Description -->
            <p class="uk-article-meta"><?php echo($mLoader->module['Description'])?></p>

            <!-- Breadcrumb -->
            <ul class="uk-breadcrumb">
                <li><a href="#">Item</a></li>
                <li><span>Active</span></li>
                <li><?php echo($slider->topPage($mLoader->module['PathName']));?></li>
                <li><a href="/<?php echo($mLoader->module['PathName']);?>"><?php echo($mLoader->module['Name']);?></a></li>
                    <?php if(Method::getChildPage() != null){?>
                        <li class="breadcrumb-item active"><a href="/<?php echo($mLoader->module['PathName'] . '/' . Method::getChildPage());?>"><?php echo(Method::getChildPage());?></a></li>
                    <?php }?>
            </ul>

            <!-- MODULE BEGIN HERE -->
            <div>