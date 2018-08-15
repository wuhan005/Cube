<div class="col-lg-5">
    <div class="user-display">
        <div class="user-display-bg"><img src="/static/img/user-profile-display.png" alt="Profile Background"></div>
        <div class="user-display-bottom">
        <div class="user-display-avatar"><img src="<?php echo(Method::get_gravatar($db->getAccountData()['Account_Mail'], 150 )['pic']);?>" alt="Avatar"></div>
        <div class="user-display-info">
            <div class="name"><?php echo( Method::get_gravatar( $db->getAccountData()['Account_Mail'] )['name'] );?></div>
            <div class="nick"><span class="mdi mdi-account"></span> <?php echo($db->getAccountData()['Account_Name']);?></div>
            <?php Method::get_gravatar($db->getAccountData()['Account_Mail']);?>
        </div>
        <div class="row user-display-details">
            <div class="col-4">
            <div class="title">Issues</div>
            <div class="counter">26</div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>