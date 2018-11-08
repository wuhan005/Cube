<form action="/Setting/UpdateSettingAction" method="POST"  class="uk-form-horizontal">
    <legend class="uk-legend">通用</legend>
    <span>Cube 的一般设置</span>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">页面底部显示当前小工具信息</label>
        <div class="uk-form-controls">
            <input type="hidden" name="ModuleFooterInfo" value="off">
            <input class="uk-checkbox" type="checkbox" <?php echo($db->getSetting('ModuleFooterInfo') == 'on'?'checked':'');?> name="ModuleFooterInfo" id="ModuleFooterInfo">
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">向未登录用户显示管理选项</label>
        <div class="uk-form-controls">
            <input type="hidden" name="ShowLoginOptions" value="off">
            <input class="uk-checkbox" type="checkbox" <?php echo($db->getSetting('ShowLoginOptions') == 'on'?'checked':'');?>  name="ShowLoginOptions" id="ShowLoginOptions">
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">使用 Gravatar 头像<br>（关闭可提高页面加载速度）</label>
        <div class="uk-form-controls">
            <input type="hidden" name="UseGravatar" value="off">
            <input class="uk-checkbox" type="checkbox" <?php echo($db->getSetting('UseGravatar') == 'on'?'checked':'');?>  name="UseGravatar" id="UseGravatar">
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">ICP备案号<br>(留空则不显示)</label>
        <div class="uk-form-controls">
            <input name="ICP" value="<?php echo($db->getSetting('ICP')); ?>"  class="uk-input uk-form-width-medium" type="text" placeholder="中国服务器需备案">
        </div>
    </div>

    <div class="uk-margin">
        <button class="uk-button uk-button-primary" type="submit">保存设置</button>
    </div>
</form>