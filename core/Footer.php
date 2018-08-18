        <!-- FOOTER -->
        <hr>
<footer class="footer text-center text-muted">
<?php
    echo($mLoader->module['Name'] . ' / Developed by <a href="' . $mLoader->module['AuthorURI'] . '"><b>' . $mLoader->module['Author'] . '</b></a>');?>
<br>
    Cube · Create everything you want!
</footer>
        <!-- MODULE END HERE -->
    </div>
</div>

</body>
<script src="/static/lib/jquery.niftymodals/js/jquery.niftymodals.js" type="text/javascript"></script>
<script>
$.fn.niftyModal('setDefaults',{
    overlaySelector: '.modal-overlay',
    contentSelector: '.modal-content',
    closeSelector: '.modal-close',
    classAddAfterOpen: 'modal-show'
});
</script>
</html>