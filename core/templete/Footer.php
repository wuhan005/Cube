</div>
        <!-- FOOTER -->
        <hr>
<footer class="footer text-center text-muted">

<?php
    if($db->getSetting('ModuleFooterInfo') == 'on'){
        echo($mLoader->module['Name'] . ' / Developed by <a href="' . $mLoader->module['AuthorURI'] . '" target="_blank"><b>' . $mLoader->module['Author'] . '</b></a><br>');
    }
?>

    Cube · Create everything you want!
    <br>
    Made with ❤️ by <a href="https://github.red">John Wu</a>.
    <br>
    <a href="http://www.miitbeian.gov.cn/" target="_black"><?php echo($db->getSetting('ICP'));?></a>
</footer>
        <!-- MODULE END HERE -->
    </div>
</div>

</body>

<script src="/static/lib/jquery.niftymodals/dist/jquery.niftymodals.min.js" type="text/javascript"></script>
<script src="/static/js/app.min.js" type="text/javascript"></script>
<script src="/static/js/app-ui-notifications.js" type="text/javascript"></script>

<script>
$.fn.niftyModal('setDefaults',{
    overlaySelector: '.modal-overlay',
    contentSelector: '.modal-content',
    closeSelector: '.modal-close',
    classAddAfterOpen: 'modal-show'
});

$(document).ready(function(){
    //-initialize the javascript
    App.init();
});
</script>
</html>