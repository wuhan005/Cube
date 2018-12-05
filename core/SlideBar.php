<!DOCTYPE html>
<html lang="zh-Hans">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Cube - Create Everything You Like!">
    <meta name="author" content="John Wu">
    <link rel="shortcut icon" href="../static/img/logo-fav.png">
    <title>Cube</title>
    <link rel="stylesheet" type="text/css" href="/static/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/lib/jquery.gritter/css/jquery.gritter.css"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/static/css/app.min.css" type="text/css"/>

    <script src="/static/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="/static/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="/static/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="/static/lib/jquery.gritter/js/jquery.gritter.min.js" type="text/javascript"></script>
    <script src="/static/js/app.min.js" type="text/javascript"></script>
    <script src="/static/js/app-ui-notifications.js" type="text/javascript"></script>
    <script src="/static/js/functions.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	App.init();
      });
    </script>

    <script language='javascript'>
    function refresh(){
        document.location = '';
    }
    </script>
<<<<<<< HEAD:core/SlideBar.php

</head>

<body>
    <!-- Top NavBar -->
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="/"><img src="/static/img/logo-xx.png"/></a>

            <div class="uk-navbar-item uk-position-right">

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

                <li <?php echo $slider->active('Account');?>><a href="/Account"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Account</a></li>
                
                <?php if(!($db->getSetting('ShowLoginOptions') == 'off' AND $mod->isLogin() == false)){ ?>

                    <li <?php echo $slider->active('Manager');?>><a href="/Manager"><span class="uk-margin-small-right" uk-icon="icon: settings"></span> Manager</a></li>
                    <li <?php echo $slider->active('Data');?>><a href="/Data"><span class="uk-margin-small-right" uk-icon="icon: database"></span> Data</a></li>
                    <li <?php echo $slider->active('Setting');?>><a href="/Setting"><span class="uk-margin-small-right" uk-icon="icon: cog"></span> Setting</a></li>
=======
  </head>

  <body>
    <div class="be-wrapper">
      <nav class="navbar navbar-expand fixed-top be-top-header">
        <div class="container-fluid">
          <div class="be-navbar-header"><a href="Main" class="navbar-brand"></a>
          </div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav float-right be-user-nav">
              <li class="nav-item dropdown">
>>>>>>> parent of fea24c4... UI 更新，更换成 UIKit 框架:core/templete/Header.php
                
                <!--User Icon --> 
                  <a href="/Account" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                      <img src="
                    <?php
                      if($db->getSetting('UseGravatar') == 'on'){
                          if($mod->get_current_login_user()['isLogin']){
                              echo(Method::get_gravatar($mod->get_current_login_user()['mail'], 32)['pic']);
                          }else{
                              echo('/static/img/avatar.png');
                          }
                      }else{
                            echo('/static/img/avatar.png');
                      }
                    ?>" alt="Avatar">
                      <span class="user-name"><?php echo($mod->get_current_login_user()['name']);?></span>
                  </a>
                  
                <div role="menu" class="dropdown-menu"> 
                <!--User Info Box -->    
                  <div class="user-info">
                    <div class="user-name"><?php echo($mod->get_current_login_user()['name']);?></div>
                    <div class="user-position <?php if($mod->get_current_login_user()['isLogin']){ echo('online'); }else{ echo('offline');}?>">
                    <?php if($mod->get_current_login_user()['isLogin']){ echo('Available'); }else{ echo('Unavailable');}?>
                    </div>
                  </div>
                  <a href="/Account" class="dropdown-item">
                      <span class="icon mdi mdi-face"></span> Account
                  </a>
                  <?php if($mod->get_current_login_user()['isLogin']){ ?>
                  <a href="/Account/LogoutAction" class="dropdown-item">
                      <span class="icon mdi mdi-power"></span> Logout
                  </a>
                  <?php } ?>
                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav float-right be-icons-nav">
              <li class="nav-item dropdown">
                  <a href="Setting" role="button" aria-expanded="false" class="nav-link be-toggle-right-sidebar">
                      <span class="icon mdi mdi-settings"></span>
                  </a>
              </li>
            </ul>
          </div>
        </div>
<<<<<<< HEAD:core/SlideBar.php

        <!-- Module Content -->
        <div class="uk-width-5-6@m">
            <!-- Module Name -->
            <h1 class="uk-text-lead"><a class="uk-link-reset" href=""><?php echo($mLoader->module['Name'])?></a></h1>

            <!-- Module Description -->
            <p class="uk-article-meta"><?php echo($mLoader->module['Description'])?></p>

            <!-- Breadcrumb -->
            <ul class="uk-breadcrumb">
                <li><?php echo($slider->topPage($mLoader->module['PathName']));?></li>
                <li><a href="/<?php echo($mLoader->module['PathName']);?>"><?php echo($mLoader->module['Name']);?></a></li>
=======
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menu</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                <!--Slider Bar -->
                  <li <?php echo $slider->active('Main');?>><a href="/Main">
                      <i class="icon mdi mdi-home"></i><span>Home</span></a>
                  </li>
                  <li class="divider">Tools</li>

                  <?php $slider->showSlider();?>
                  
                  <li class="divider">Options</li>
                    <li <?php echo $slider->active('Account');?>><a href="/Account">
                        <i class="icon mdi mdi-face"></i><span>Account</span></a>
                    </li>
                  <?php if(!($db->getSetting('ShowLoginOptions') == 'off' AND $mod->isLogin() == false)){ ?>
                    
                    <li <?php echo $slider->active('Manager');?>><a href="/Manager">
                        <i class="icon mdi mdi-label"></i><span>Manager</span></a>
                    </li>
                    <li <?php echo $slider->active('Data');?>><a href="/Data">
                        <i class="icon mdi mdi-chart"></i><span>Data</span></a>
                    </li>
                    <li <?php echo $slider->active('Setting');?>><a href="/Setting">
                        <i class="icon mdi mdi-settings"></i><span>Setting</span></a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="be-content">
        <!--Page Title -->
        <div class="page-head">
          <h2 class="page-head-title"><?php echo($mLoader->module['Name'])?></h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
              <li class="breadcrumb-item"><?php echo($mLoader->module['Description'])?></li>
            </ol>
          </nav>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
            <?php
            ?>
              <li class="breadcrumb-item"><?php echo($slider->topPage($mLoader->module['PathName']));?></li>
              <li class="breadcrumb-item"><a href="/<?php echo($mLoader->module['PathName']);?>"><?php echo($mLoader->module['Name']);?></a></li>
>>>>>>> parent of fea24c4... UI 更新，更换成 UIKit 框架:core/templete/Header.php
                    <?php if(Method::getChildPage() != null){?>
                        <li class="breadcrumb-item active"><a href="/<?php echo($mLoader->module['PathName'] . '/' . Method::getChildPage());?>"><?php echo(Method::getChildPage());?></a></li>
                    <?php }?>
            </ol>
          </nav>
        </div>
        <!-- MODULE BEGIN HERE -->
          <div class="container">