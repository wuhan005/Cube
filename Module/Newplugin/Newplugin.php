<?php
/*
Module Name: test module
Description: 测试
Icon: ticket-star
Author: John Wu
Author URI: Link to the author's web site
Version: 1.0.0
*/
?>


<?php
$this->Storage->save('MyFirstData', 'OKOKssOKOK');
//$this->Storage->

function __SetUp(){
    $this->Storage->save('SetupData','ok');
}


?>
<div class="main-content container-fluid">
    <h3 class="text-center"></h3>
</div>