<div class="col-sm-12">
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
            <?php foreach($moduleDetailList as $Item){
                echo('
                <tr>
                <td>
                <label class="custom-control custom-control-sm custom-checkbox">
                    <input class="custom-control-input" type="checkbox"><span class="custom-control-label"></span>
                </label>
                </td>
                <td class="cell-detail"><span><i class="icon mdi mdi-');
                //ICON
                echo($Item['Icon']);echo('"></i>');
                //NAME
                echo($Item['Name']);echo('</span></td>');
                echo('<td class="milestone"><span class="version">');
                //VERSION
                echo($Item['Version']);echo('</span></td>');
                echo('<td class="cell-detail"><a href="'. $Item['AuthorURI'] .'" target=_blank> <span>');
                //DEVELOPER
                echo($Item['Author']);echo('</span>');
                echo('<span class="cell-detail-description">');
                //DEVELOPER URL
                echo($Item['AuthorURI']);echo('</span></a></td>');
                echo('<td class="cell-detail"><span>');
                //DESCRIPTION
                echo($Item['Description']);echo('</span></td>');
                //Generate Dropdown UI.
                dropdown($Item['PathName'],$Item['isStart']);
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>