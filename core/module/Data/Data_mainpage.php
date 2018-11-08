<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th style="width:15%;">名称</th>
            <th>数据</th>
            <th style="width:15%;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($storageDataList as $Item){?>
        <tr>
            <td class="cell-detail">
                <span>
                <?php echo($Item['Storage_ModuleName']);?>
                </span>
            </td>

            <td class="cell-detail">
            <?php echo($Item['Storage_Data']);?>
            </td>

            <td class="cell-detail">
                <a class="uk-button uk-button-danger" href="/Data/CleanData?ModuleName=<?php echo($Item['Storage_ModuleName']);?>">删除所有</a>
            </td>
        <?php } ?>
        </tr>
    </tbody>
</table>