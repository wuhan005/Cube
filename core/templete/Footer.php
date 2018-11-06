    <!-- MODULE END HERE -->
    <!-- FOOTER -->
    <hr>
    <div>

    <span class="uk-article-meta">
    <?php
        if($db->getSetting('ModuleFooterInfo') == 'on'){
            echo($mLoader->module['Name'] . ' / Developed by <a href="' . $mLoader->module['AuthorURI'] . '" target="_blank"><b>' . $mLoader->module['Author'] . '</b></a><br>');
        }
    ?>
    </span>

        <span class="uk-article-meta">Cube · Create everything you want!</span>

        <br>
        
        <a href="http://www.miitbeian.gov.cn/" target="_black"><?php echo($db->getSetting('ICP'));?></a>
    </div>

    </div>

</body>
</html>