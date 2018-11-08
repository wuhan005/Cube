<?php
function back_error($msg='Error!'){
    echo($msg);
}

function refresh(){
    echo('<script>refresh();</script>');
}

function showNotice($type = 'success',$title = '通知',$context = ''){
    echo("<script>UIkit.notification({message: '<p>$title <br> $context</p>', pos: 'bottom-right', status: '$type'});</script>");
}

function redirect($url){
    echo('<script>window.location.href="' . $url . '"; </script>');
}