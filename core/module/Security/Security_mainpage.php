<div class="card card-border-color card-border-color-primary">
    <!-- Cube 登录验证 标题 -->
    <div class="card-header card-header-divider">登录验证<span class="card-subtitle">Cube 登录验证方式</span></div>
    <div class="card-body">
        当前使用 <b><?php echo($gaAuth === '' ? '账号密码' : 'Google Authenticator');?></b> 进行登录验证。



            <?php if($db->getSetting('GAAuth') === ''){?>
                    <a class="btn btn-space btn-primary btn-lg" href="/Security/OpenGoogleAuth">
                        <i class="icon icon-left mdi mdi-google"></i>
                        使用 Google Authenticator 验证
                    </a>

            <?php }else{?>


                <div class="form-group row">
                    <label class="col-12 col-sm-5 col-form-label text-sm-right">
                        <img src="<?php echo(json_decode($gaAuth, true)['url']) ?>" width="180px"/>
                    </label>
                    <div>
                        <h4>请使用 Google Authenticator App 扫描保存。</h4>
                        <h5>登录时请使用 App 中的六位随机数字进行登录，数字每 30 秒刷新一次。</h5>
                        <a class="btn btn-space btn-danger btn-lg" href="/Security/CloseGoogleAuth">
                            <i class="icon icon-left mdi mdi-google"></i>
                            关闭 Google Authenticator 验证
                        </a>
                    </div>
                </div>



            <?php }?>

    </div>
</div>
