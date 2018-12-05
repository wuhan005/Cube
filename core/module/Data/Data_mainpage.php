<div class="col-sm-12">
    <div class="card card-table">
    <div class="card-header">数据</div>
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
                <th>数据</th>
                <th style="width:10%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($storageDataList as $Item){?>
                <tr>
                    <td>
                    <label class="custom-control custom-control-sm custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label"></span>
                    </label>
                    </td>

                    <td class="cell-detail">
                        <span>
                        <?php echo($Item['Storage_ModuleName']);?>
                        </span>
                    </td>

                    <td class="cell-detail">
                    <?php echo($Item['Storage_Data']);?>
                    </td>

                    <td class="cell-detail">
                        <a href="/Data/CleanData?ModuleName=<?php echo($Item['Storage_ModuleName']);?>">删除所有</a>
                    </td>
                <?php } ?>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>