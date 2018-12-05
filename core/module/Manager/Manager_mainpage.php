<div class="col-sm-12">
    <?php if($this->mod->isLogin()){?>
    <form action="/Manager/UploadModule" method="POST" enctype="multipart/form-data">
    <input class="inputfile" id="fileUploader" type="file" name="fileUploader">
    <label class="btn-primary" for="fileUploader"> <i class="mdi mdi-upload"></i><span>选择小工具...</span></label>
        <button type="submit" class="btn btn-space btn-secondary">上传</button>
    </form>
    <?php }?>

    <div class="card card-table">
    <div class="card-header">小工具
        <div class="tools dropdown"><a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><span class="icon mdi mdi-more-vert"></span></a>
        <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
        </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive noSwipe">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width:4%;">
                <label class="custom-control custom-control-sm custom-checkbox">
                    <input class="custom-control-input" type="checkbox"><span class="custom-control-label"></span>
                </label>
                </th>
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
                <label class="custom-control custom-control-sm custom-checkbox">
                    <input class="custom-control-input" type="checkbox"><span class="custom-control-label"></span>
                </label>
                </td>
                <td class="cell-detail">
                    <span>
                    <i class="icon mdi mdi-<?php echo($Item['Icon']);?>"></i><?php echo($Item['Name']);?>
                    </span>
                </td>
                <td class="milestone">
                    <span class="version">
                    <?php echo($Item['Version']);?>
                    </span>
                </td>
                <td class="cell-detail">
                <a href="<?php $Item['AuthorURI']?>" target=_blank>
                    <span>
                    <?php echo($Item['Author']);?>
                    </span>
                    <span class="cell-detail-description">
                    <?php echo($Item['AuthorURI']);?>
                    </span>
                </a>
                </td>
                <td class="cell-detail">
                    <span>
                <?php echo($Item['Description']);?>
                    </span>
                </td>
                <td class="text-right">
                <?php $this->dropdown($Item['PathName'],$Item['isStart']);}?>
                </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<div class="modal-container modal-full-color modal-full-color-danger modal-effect-8" id="full-danger">
<div class="modal-content">
    <div class="modal-header">
    <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
    </div>
    <div class="modal-body">
    <div class="text-center"><span class="modal-main-icon mdi mdi-close-circle-o"></span>
        <h3>注意！</h3>
        <p>你确定要删除小工具吗？<br>该操作将无法撤销！</p>
        <div class="mt-8">
        <button class="btn btn-secondary btn-space modal-close" type="button" data-dismiss="modal">取消</button>
        <button class="btn btn-success btn-space modal-close" type="button" data-dismiss="modal" onClick="DeleteAction()">确认删除</button>
        </div>
    </div>
    </div>
    <div class="modal-footer"></div>
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