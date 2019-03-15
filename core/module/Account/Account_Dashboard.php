<div class="col-lg-7">
    <div class="user-display">
        <div class="user-display-bg"><img src="/public/static/img/user-profile-display.png" alt="Profile Background"/></div>
        <div class="user-display-bottom">
            <div class="user-display-avatar"><img src="
            <?php
                //Judge the user is willing to use the gravatar.
                if($db->getSetting('UseGravatar') == 'on') {
                    echo(Method::get_gravatar($db->getAccountData()['Account_Mail'], 150)['pic']);
                }else {
                    echo('/static/img/avatar.png');
                }
                ?>" alt="Avatar"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="user-display-info">
                        <div class="name">
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
                        </div>
                        <div class="nick"><span class="mdi mdi-account"></span> <?php echo($db->getAccountData()['Account_Name']);?></div>
                    </div>
                </div>
                <div class="col-md-6 text-right pr-1">
                    <a href="/Account/Profile" class="btn btn-rounded btn-space btn-primary"><span class="mdi mdi-edit"></span></a>
                </div>
            </div>
                <?php Method::get_gravatar($db->getAccountData()['Account_Mail']);?>
        </div>
    </div>
</div>