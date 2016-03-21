<html>
<head>

    <style type="text/css">
        .load_box{
            display:none;
            width:300px;
            text-align:center;
            margin-left:auto;
            margin-right:auto;
        }

        .meter {
            margin-right:auto;
            margin-left:auto;
            width:290px;
            height: 20px;  /* Can be anything */
            position: relative;
            background: #555;
            padding: 10px;
            -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
            -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
            box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
        }
        .meter > span {
            display: block;
            height: 100%;
            background-color: rgb(43,194,83);
            background-image: -webkit-gradient(
                linear,
                left bottom,
                left top,
                color-stop(0, rgb(43,194,83)),
                color-stop(1, rgb(84,240,84))
            );
            background-image: -moz-linear-gradient(
                center bottom,
                rgb(43,194,83) 37%,
                rgb(84,240,84) 69%
            );
            -webkit-box-shadow:
                inset 0 2px 9px  rgba(255,255,255,0.3),
                inset 0 -2px 6px rgba(0,0,0,0.4);
            -moz-box-shadow:
                inset 0 2px 9px  rgba(255,255,255,0.3),
                inset 0 -2px 6px rgba(0,0,0,0.4);
            box-shadow:
                inset 0 2px 9px  rgba(255,255,255,0.3),
                inset 0 -2px 6px rgba(0,0,0,0.4);
            position: relative;
            overflow: hidden;
        }
        .meter > span:after, .animate > span > span {
            content: "";
            position: absolute;
            top: 0; left: 0; bottom: 0; right: 0;
            background-image:
                -webkit-gradient(linear, 0 0, 100% 100%,
                color-stop(.25, rgba(255, 255, 255, .2)),
                color-stop(.25, transparent), color-stop(.5, transparent),
                color-stop(.5, rgba(255, 255, 255, .2)),
                color-stop(.75, rgba(255, 255, 255, .2)),
                color-stop(.75, transparent), to(transparent)
                );
            background-image:
                -moz-linear-gradient(
                    -45deg,
                    rgba(255, 255, 255, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, .2) 50%,
                    rgba(255, 255, 255, .2) 75%,
                    transparent 75%,
                    transparent
                );
            z-index: 1;
            -webkit-background-size: 50px 50px;
            -moz-background-size: 50px 50px;
            -webkit-animation: move 2s linear infinite;
            overflow: hidden;
        }

        .animate > span:after {
            display: none;
        }

        @-webkit-keyframes move {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 50px 50px;
            }
        }

        .orange > span {
            background-color: #f1a165;
            background-image: -moz-linear-gradient(top, #f1a165, #f36d0a);
            background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f1a165),color-stop(1, #f36d0a));
            background-image: -webkit-linear-gradient(#f1a165, #f36d0a);
        }

        .red > span {
            background-color: #f0a3a3;
            background-image: -moz-linear-gradient(top, #f0a3a3, #f42323);
            background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f0a3a3),color-stop(1, #f42323));
            background-image: -webkit-linear-gradient(#f0a3a3, #f42323);
        }

        .nostripes > span > span, .nostripes > span:after {
            -webkit-animation: none;
            background-image: none;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="includes/jquery.ba-dotimeout.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            var xhr;

            $.ajaxSetup({
                // Disable caching of AJAX responses
                cache: false
            });

            $('.the_go_button').click(function() {
                $('.load_box').show();
                var manufacturer = $('.manu_website').children('option:selected').text();
                var prod_type = $('.product_type').children('option:selected').text();
                var data = manufacturer + ' ' + prod_type;

                var percent;

                $.doTimeout('loop', 250, function(){
                    $.get('progress.txt', function(data){
                        percent = Math.floor(data * 100);
                        $('.filter_num').html(percent);
                        $('.progress_bar').css('width', percent + '%');
                    })
                    return true;
                });

                 xhr = $.ajax({
                    url: 'scrap.php',
                    type: 'POST',
                    data: {'data':data},
                    success: function (result) {
                        $('.result_box').html(result);
                        $('.load_box').hide();
                        $.doTimeout('loop');
                    }

                });
            });


//            $('.the_abort_button').click(function(){
//                xhr.abort();
//            });

       });
    </script>

</head>
<body>
    <select class="manu_website">
        <option>Hoover</option>
        <option>Dirt Devil</option>
        <option>Bissell</option>
    </select>
    <select class="product_type">
        <option>Filters</option>
        <option>Bags</option>
    </select>
    <button class="the_go_button">Go</button>
    <div class="load_box">
        <h3>Scrape Scrape Scrappin till I die...</h3>
        <h4><span class="filter_num">0</span>% complete...</h4>
        <div class="meter">
            <span class="progress_bar" style="width: 0%"></span>
        </div>
    </div>
    <!--<button class="the_abort_button">Abort AJAX Request</button>-->
    <div class="result_box">
    </div>
</body>
</html>