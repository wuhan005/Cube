<form action="/Account/UpdateProfileAction" method="POST">
<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right">管理员电子邮箱</label>
    <div class="col-12 col-sm-8 col-lg-3">
    <input name="mail" class="form-control form-control-sm" id="mail" type="text" value="<?php echo($userMail);?>">
    </div>
</div>
<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right">管理员账号名</label>
    <div class="col-12 col-sm-8 col-lg-3">
    <input name="name" class="form-control form-control-sm" id="name" type="text" value="<?php echo($userName);?>">
    </div>
</div>
<div class="form-group row">
    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">管理员密码</label>
    <div class="col-12 col-sm-8 col-lg-3">
    <input type="password" name="password" class="form-control form-control-sm" id="password" type="text" value="<?php echo(@$_SESSION['AccountPasswd']);?>">
    </div>
</div>
<!-- 提交按钮 -->
<div class="row">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <p class="text-right pr-8">
        <button class="btn btn-space btn-primary" type="submit">更新设置</button>
        </p>
    </div>
</div>
</form>