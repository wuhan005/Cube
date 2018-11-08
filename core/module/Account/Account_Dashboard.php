<div class="uk-card uk-width-1-3@m">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <img class="uk-border-circle" width="40" height="40" src="
                    <?php
                    //Judge the user is willing to use the gravatar.
                    if($db->getSetting('UseGravatar') == 'on') {
                        echo(Method::get_gravatar($db->getAccountData()['Account_Mail'], 150)['pic']);
                    }else {
                        echo('/static/img/avatar.png');
                    }
                    ?>
                ">
            </div>
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom">
                    <?php
                        if($db->getSetting('UseGravatar') == 'on') {
                            //Judge the user has the gravatar data.
                            if (Method::get_gravatar($db->getAccountData()['Account_Mail'])['name'] != null) {
                                echo(Method::get_gravatar($db->getAccountData()['Account_Mail'])['name']);
                            } else {
                                echo($db->getAccountData()['Account_Name']);
                            }
                        }else{
                            echo($db->getAccountData()['Account_Name']);
                        }
                    ?>
                </h3>
                <p class="uk-text-meta uk-margin-remove-top"><?php echo($db->getAccountData()['Account_Name']);?></p>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
        <p></p>
    </div>
    <div class="uk-card-footer">
        <a href="/Account/Profile" class="uk-button uk-button-text uk-margin-right">修改</a>
        <a href="/Account/LogoutAction" class="uk-button uk-button-text">登出</a>
    </div>
</div>