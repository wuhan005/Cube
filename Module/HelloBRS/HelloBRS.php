<?php
/*
Module Name: 你好，B★RS！
Description: 这不是普通的小工具，它代表着我高三后期时的精神支柱，浓缩成四个字：你好，B★RS。启用后，在本页面可以看到一句来自番剧《Black★Rock Shooter》的台词。
Icon: ticket-star
Author: John Wu
Author URI: https://wuhan5.cc/
Version: 1.1
*/

$dialogue = [
    '痛苦只是短暂的一瞬而已。 ',

    '小鸟飞翔在，蔚蓝的天空；海洋倒映着，天空的蔚蓝。<br>
    画中天空的蓝色，是天空的海洋；画中天空的蓝色，是天空的眼泪。<br>
    眼泪的蔚蓝中，小鸟在飞翔。',

    '如果不受伤的话，就无法看到各种世界了啊！',

    '会有人替你承受这份痛楚。不管有多痛多受伤，真正受伤的人一定不是你自己。',

    '我从一开始见到你，就这么觉得了：你的眼睛很漂亮。或许，这双眼瞳从没有厌恶过别人，也没有被别人讨厌过。不树立敌对关系是件好事，但是，人们总是在不知不觉之中树敌，这也是理所当然的事。<br>
    没错，不管是谁都是如此。 <br>
    理所当然的事，只要接受就好了。',

    '用我左眼的火焰，烧尽一切黑暗。',

    '好痛……<br>
    为什么会忘记呢？ <br>
    因为不知道和别人成为朋友的方法，我…… <br>
    好难受……一直很痛苦 <br>
    但是那是因为 <br>
    我想和她成为朋友啊！ <br>
    因为我想把痛苦和烦恼与别人连接起来。',

    '真正受伤的人，其实并不是自己。',

    '我……我要继续战斗，背负着痛苦和伤痕，我要继续在这个世界战斗。',
    
    '今天或许将是十分严峻的一天也说不定。要坚持下去不是容易的事。<br>
    没有任何事物能支持着我，因为自己不是坚强的人。<br>
    即使如此，剧幕还是拉了开来。无法再回头。<br>
    这时候请你回想起来。那些充满欢笑的日子。<br>
    故事现在开始了。Black★Rockshooter 就存在你的心中。'
    ];
?>

<div class="row">
        <div class="col-sm-6">
            <div class="content">
                <div class="alert alert-info alert-simple alert-dismissible" role="alert">
                <div class="icon"></div>
                <div class="message">
                    <strong><?php echo $dialogue[array_rand($dialogue,1)];?></strong>
                    <br>
                    <p class="text-right">——《Black★Rock Shooter》</p>
                </div>
                <div class='text-right'>
                    <button class="btn btn-space btn-primary" onclick="refresh()">我永远喜欢黑岩射手！</button>
                </div>
            </div>
        </div>
    </div>
</div>