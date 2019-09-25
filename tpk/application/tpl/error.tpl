<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>跳转提示</title>
    <style>
        body{
            perspective: 200px;
            color: #AAA;
            font-size: 16px;
        }
        a{text-decoration: none;color:green;}
        a:hover{color: #BBB;}
        .warp{position: relative;}
        .box{width: 300px;height:300px;margin:50px auto;background: #EEE;
            border-radius: 50%;
            line-height: 300px;
            font-size: 200px;
            color:#EEE;
            transform-origin:0% 0%;/*定义动画的旋转中心点*/
            font-family: "微软雅黑";
            -webkit-text-stroke: 2px #BBB;
            text-shadow: 5px 5px 5px #666;
        animation: fontcolor 3s ease-in,mybox 0.9s ease;
        transform: rotateX(0deg);
        }
        @keyframes fontcolor
        {
            from {color: #EEE;}
            to {color: green;}
        }
        @keyframes mybox
        {
            0%{
                transform: rotateX(90deg);
                background: red;
            }
            100%{
                transform: rotateX(0deg);
                background: #DDD;
            }
        }
    </style>
</head>
<body style="text-align:center">
<span class="ab"></span>
<div class="warp">
    <div class="box">
        <span id="wait"><?php echo($wait);?></span>
    </div>
</div>
<h3>【<?php echo(strip_tags($msg));?>】正在为您跳转，请稍后! </h3>
<p><a href="{$url}" id="href">立即跳转</a></p>

<script src="__COMMON__/js/jquery.min.js"></script>
<script>
    (function(){
        // var wait = document.getElementById('wait'),
        //     href = document.getElementById('href').href;
        var wait = $('#wait'),
            href = $('#href').attr('href');
        var interval = setInterval(function(){
            // var time = --wait.innerHTML;
            var time = wait.text()-1;
            wait.text(time);
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>