<div class="main-content container-fluid">
<div class="row">
    <div class="col-6 col-lg-3 col-xl-2">
        <div class="widget widget-tile">
            <div class="data-info">
            <div class="desc">小工具</div>
            <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span class="number"><?php echo count($moduleDetailList);?> 个</span>
            </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-xl-2">
        <div class="widget widget-tile">
            <div class="data-info">
            <div class="desc">发生错误的小工具</div>
            <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-right"></span><span class="number"><?php echo $errorModuleNumber;?> 个</span>
            </div>
            </div>
        </div>
    </div>
</div>
</div>