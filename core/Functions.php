<?php
function back_error($msg='Error!'){
    echo($msg);
}

function refresh(){
    echo('<script>refresh();</script>');
}

function alert($type = 'success',$title = '通知',$context = ''){
    echo('<div class="alert alert-contrast alert-' . $type . ' alert-dismissible" role="alert">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span class="mdi mdi-close" aria-hidden="true"></span>
            </button>
                <strong>' . $title . '</strong>'
                . $context .
            '</div>
        </div>');
}