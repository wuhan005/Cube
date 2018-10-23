<?php

//The type of the error.
define('ERROR', 0);
define('WARNING', 1);

class Alert
{

    private function __construct(){

    }

    public static function show($_message, $_type = ERROR){
        switch($_type){
            case ERROR:
                echo('<div class="alert alert-danger alert-icon alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                    <div class="message">
                        <strong>致命错误！</strong>'
                    .  $_message .
                    '</div>
                </div>'
                );

                die();

                break;

            case WARNING:
                echo('<div class="alert alert-warning alert-icon alert-dismissible" role="alert">
                    <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                    <div class="message">
                      <strong>警告！</strong>'
                     . $_message .
                    '</div>
                  </div>');

                break;


            default:
                //info
                echo('<div class="alert alert-info alert-icon alert-dismissible" role="alert">
                    <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                    <div class="message">
                      <strong>提示</strong>'
                      . $_message .
                    '</div>
                  </div>');
                break;
        }

    }
}