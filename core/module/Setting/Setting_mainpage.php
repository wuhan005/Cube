<!-- 表单开始 -->
<form action="/Setting/UpdateSettingAction" method="POST" style="border-radius: 0px;">
<div class="card card-border-color card-border-color-primary">
<!-- 标题 -->
<div class="card-header card-header-divider">通用<span class="card-subtitle">Cube 的一般设置</span></div>
<div class="card-body">
    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">页面底部显示当前小工具信息</label>
        <div class="switch-button switch-button-lg">
            <input type="hidden" name="ModuleFooterInfo" value="off">
            <input type="checkbox" <?php echo($db->getSetting('ModuleFooterInfo') == 'on'?'checked':'');?> name="ModuleFooterInfo" id="ModuleFooterInfo"><span>
            <label for="ModuleFooterInfo"></label></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">向未登录用户显示管理选项</label>
        <div class="switch-button switch-button-lg">
            <input type="hidden" name="ShowLoginOptions" value="off">
            <input type="checkbox" <?php echo($db->getSetting('ShowLoginOptions') == 'on'?'checked':'');?>  name="ShowLoginOptions" id="ShowLoginOptions"><span>
            <label for="ShowLoginOptions"></label></span>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputDefault">ICP备案号(留空则不显示)</label>
        <div class="col-12 col-sm-8 col-lg-6">
        <input name="ICP" class="form-control form-control-sm" id="inputDefault" type="text" value="<?php echo($db->getSetting('ICP')); ?>" placeholder="中国服务器需备案">
        </div>
    </div>
   
</div>
</div>
<!-- 提交按钮 -->
<div class="row">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">
        <p class="text-right pr-8">
        <button class="btn btn-space btn-primary" type="submit">保存设置</button>
        </p>
    </div>
</div>
</form>