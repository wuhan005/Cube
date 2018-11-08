<?php if($this->mod->isLogin()){?>
    <!-- UPLOAD FILE -->
    <form action="/Manager/UploadModule" method="POST" enctype="multipart/form-data">
        <div uk-form-custom>
            <input type="file" id="fileUploader" type="file" name="fileUploader">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">选择文件</button>
        </div>
        <button type="submit" class="uk-button uk-button-primary">上传</button>
    </form>
<?php }?>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th style="width:15%;">名称</th>
            <th style="width:5%;">版本</th>
            <th style="width:15%;">开发者</th>
            <th style="width:40%;">介绍</th>
            <th style="width:10%;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->moduleDetailList as $Item){?>
            <tr>
                <td>
                    <span>
                        <i class="icon mdi mdi-<?php echo($Item['Icon']);?>"></i> <?php echo($Item['Name']);?>
                    </span>
                </td>

                <td>
                    <span>
                        <?php echo($Item['Version']);?>
                    </span>
                </td>

                <td>
                    <a href="<?php $Item['AuthorURI']?>" target=_blank>
                        <span>
                            <?php echo($Item['Author']);?>
                        </span>
                        <br>
                        <span class="uk-text-small uk-text-muted">
                            <?php echo($Item['AuthorURI']);?>
                        </span>
                    </a>
                </td>

                <td>
                    <span class="uk-text-small">
                        <?php echo($Item['Description']);?>
                    </span>
                </td>

                <td>
                    <?php $this->dropdown($Item['PathName'],$Item['isStart']);}?>
                </td>
            </tr>
    </tbody>
</table>

<!-- MAKE SURE MODAL -->
<div id="SureDeleteModal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">注意！</h2>
        <p>你确定要删除小工具吗？<br>该操作将无法撤销！</p>
        <button class="uk-button uk-button-danger" type="button" onClick="DeleteAction()">确认删除</button>
        <button class="uk-modal-close uk-button uk-button-default" type="button">取消</button>
    </div>
</div>

<script>
    var moduleName = '';
    function reDelete(mName){
        moduleName = mName;
    }

    function DeleteAction(){
        window.location.href='/Manager?action=deleteModule&moduleName=' + moduleName; 
    }
</script>