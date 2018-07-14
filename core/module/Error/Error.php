<?php
//This is the error page of the tool.
//It will be loaded automatically if there is an error.
//It doesn't have the Module infomation as the normal module. It's just a page.
?>
<div class="col-sm-6">
    <div class="alert alert-danger" role="alert">
        <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
        <div class="message">
            <strong>注意！</strong>
            该小工具内部程序存在一个或多个错误，已被 Cube 停止加载。
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card card-border-color card-border-color-primary">
        <div class="card-header">可能的原因：</div>
        <div class="card-body">
        <ul>
            <li>小工具文件夹中没有相应的 PHP 主文件。</li>
            <li>小工具主文件中配置不全或填写不正确。<br>（若小工具标题为 “UNTITLED” 则小工具没有有效的标题）</li>
            <br>
        </ul>
        请联系此小工具的开发者协助解决。若你就是开发者，嘛，祝你 Debug 成功！
    </div>
</div>