<!DOCTYPE html>
<html lang="zh-Hans">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Cube - Create Everything You Like!">
    <meta name="author" content="John Wu">
    <link rel="shortcut icon" href="/static/img/logo-fav.png">
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
    <script src="/static/js/functions.js" type="text/javascript"></script>

    <script language='javascript'>
        function refresh(){
            document.location = '';
        }
    </script>
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
            <div class="page-title">
                <span>
                    <!-- 顶部副标题 -->
                </span>
            </div>
            <ul class="nav navbar-nav float-right be-icons-nav">
              <li class="nav-item dropdown">
                  <a href="Setting" role="button" aria-expanded="false" class="nav-link be-toggle-right-sidebar">
                      <span class="icon mdi mdi-settings"></span>
                  </a>
              </li>
            </ul>
          </div>
        </div>
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
                    <li <?php echo $slider->active('Security');?>><a href="/Security">
                          <i class="icon mdi mdi-key"></i><span>Security</span></a>
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
                    <?php if(Method::getChildPage() != null){?>
                        <li class="breadcrumb-item active"><a href="/<?php echo(htmlentities($mLoader->module['PathName'] . '/' . Method::getChildPage()));?>"><?php echo(htmlentities(Method::getChildPage()));?></a></li>
                    <?php }?>
            </ol>
          </nav>
        </div>
        <!-- MODULE BEGIN HERE -->
          <div class="container">