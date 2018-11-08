<form class="uk-form-horizontal" action="/Account/UpdateProfileAction" method="POST">
    <legend class="uk-legend">管理员信息修改</legend>
    <br>
    <div>
        <label class="uk-form-label">管理员电子邮箱</label>
        <div class="uk-form-controls">
            <input class="uk-input uk-form-width-medium" name="mail" type="mail" id="mail" value="<?php echo($userMail);?>">
        </div>
    </div>
    <div>
        <div class="uk-form-label">管理员账号名</div>
        <div class="uk-form-controls uk-form-controls-text">
            <input class="uk-input uk-form-width-medium" name="name" type="text" id="name" value="<?php echo($userName);?>">
        </div>
    </div>
    <div>
        <div class="uk-form-label">管理员密码</div>
        <div class="uk-form-controls uk-form-controls-text">
            <input class="uk-input uk-form-width-medium" name="password" type="password" id="password" value="<?php echo(@$_SESSION['AccountPasswd']);?>">
        </div>
    </div>
    <br>
    <button type="submit" class="uk-button uk-button-primary">更新设置</button>
</form>