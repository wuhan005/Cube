<?php
    //Make it easy to ues.
    $Module = $this->module;
?>

<h1><?php echo $Module['Name'] ?></h1>
<h5><?php echo $Module['Description'] ?></h5>

<?php 
    //Load the main file.
    include($Module['Path']);
?>