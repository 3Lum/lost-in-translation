<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>viewer</title>
    <link rel="stylesheet" href="../styles/styles1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coda:wght@400;800&display=swap" rel="stylesheet">
</head>
    <body>
        <!--MAIN HEADER-->        
            <nav class="navbar">
                <div class="Lost">
                    <li><a href="../../index.html">Lost in Translation</a></li>
                </div>
                
                <div class="navbar-links">
                    <ul>
                        <!-- <li><a href="index.html">^</a></li> -->
                        <li><a href="#">-</a></li>
                    </ul>
                </div>
            </nav>

        <!--MAIN SECTION-->
            <div class="row">
                <!--LEFT COLUMN-->
                <div class="column sideL">
                    <button class="btn" id="btnL" onclick="LcolumnTgl()">></button>
                    <ol class="list" id="wishlist"></ol>
                    <form id="add-to-wishlist">
                        <label id="-ele">-</label>
                        <input type="textarea" name="wishlist-item" id="wishlist-item">
                        <button class="btn" id="btnS" type="submit">^</button>
                    </form>
                </div>
                
                <!--THREEjs Render-->
                <div class="column middle">
                    <canvas id="webgl">
                        Your browser does not support the HTML canvas tag.</canvas>
                </div>

                <!--RIGHT COLUMN-->
                <div class="column sideR" >
                    
                    <button class="btn" id="btn1" onclick="btnReset()">0</button>
                    <button class="btn" id="btn2" onclick="btnToggle2()">-</button>
                    <button class="btn" id="btn3" onclick="btnToggle3()">)</button>
                    <p id="render-nav" onclick="columnTgl()">controls</p>
                </div>
                <!--SWITCHER COLUMN-->
                <div class="column sideS" >
                    <button class="btn" id="btn4">0</button>
                </div>
                <!--INSTRUCTIONS-->
            </div>

        <!--SCRIPTS-->
            <!--COLUMNS-->
            <script>
                //RESET POSITION
                function btnReset(){
                    document.getElementById('btn1').innerHTML = "0";
                }
                //MODEL SWITCHER
                

                //PAUSE/PLAY ROTATION
                let clicked2 = false;
                function btnToggle2() {
                    if(clicked2){
                        document.getElementById('btn2').innerHTML = "-";
                        clicked2 = false;
                    }
                    else {
                        document.getElementById('btn2').innerHTML = "+";
                        clicked2 = true;
                    }
                }

                //CHANGE MODEL ROTATION
                let clicked3 = false;
                function btnToggle3() {
                    if(clicked3){
                        document.getElementById('btn3').innerHTML = ")";
                        clicked3 = false;
                    }
                    else {
                        document.getElementById('btn3').innerHTML = "(";
                        clicked3 = true;
                    }
                }

                //RIGHT UI SCALE
                let clickedOver = false;
                function columnTgl() {
                    if(clickedOver){
                        document.getElementById('render-nav').style.fontSize = "1rem";
                        document.getElementById('btn1').style.height = "40px";
                        document.getElementById('btn2').style.height = "40px";
                        document.getElementById('btn3').style.height = "40px";
                        document.getElementById('btn1').style.width = "25px";
                        document.getElementById('btn2').style.width = "25px";
                        document.getElementById('btn3').style.width = "25px";
                        clickedOver = false;
                    }
                    else {
                        document.getElementById('render-nav').style.fontSize = "3rem";
                        document.getElementById('btn1').style.height = "120px";
                        document.getElementById('btn2').style.height = "120px";
                        document.getElementById('btn3').style.height = "120px";
                        document.getElementById('btn1').style.width = "80px";
                        document.getElementById('btn2').style.width = "80px";
                        document.getElementById('btn3').style.width = "80px";
                        clickedOver = true;
                    }
                }

                //LEFT UI SCALE
                let clickedOverL = false;
                const col = document.querySelectorAll('.column.sideL');
                const words = document.querySelectorAll('.list');
                function LcolumnTgl(){
                    if(clickedOver){
                        document.getElementById('btnL').style.height = "40px";
                        document.getElementById('btnS').style.height = "40px";
                        document.getElementById('btnL').style.width = "30px";
                        document.getElementById('btnS').style.width = "30px";
                        document.getElementById('btnL').innerHTML = ">";
                        document.getElementById('wishlist-item').style.padding = '0';
                        document.getElementById('wishlist-item').style.fontSize = '.8rem';
                        col.forEach(items => {
                            items.style.width = '15%';
                            //items.style.height = '10vh';
                        });
                        document.getElementById('add-to-wishlist').style.left = '20%';
                        document.getElementById('-ele').style.fontSize = '1rem';
                        words.forEach(listitem => {
                            listitem.style.height = '95%'
                            listitem.style.fontSize = '1rem'
                        })
                        clickedOver = false;
                    }
                    else {
                        document.getElementById('btnL').style.height = "120px";
                        document.getElementById('btnS').style.height = "120px";
                        document.getElementById('btnL').style.width = "90px";
                        document.getElementById('btnS').style.width = "90px";
                        document.getElementById('btnL').innerHTML = "<";
                        document.getElementById('wishlist-item').style.padding = '1rem';
                        document.getElementById('wishlist-item').style.fontSize = '3rem';
                        col.forEach(items => {
                            items.style.width = '100%';
                            //items.style.height = '95vh';
                        });
                        document.getElementById('add-to-wishlist').style.left = '35%';
                        document.getElementById('-ele').style.fontSize = '3rem';
                        words.forEach(listitem => {
                            listitem.style.height = '85%'
                            listitem.style.fontSize = '3rem'
                        })
                        clickedOver = true;
                    }
                }
            </script>

            <!--THREEjs Render-->
            <script type="module" src="/viewer/loader.js"></script> 
            
            <!--ADDING TEXT-->
            <script>
                var addToWishList = document.querySelector('#add-to-wishlist');
                var wishlistItem = document.querySelector('#wishlist-item');
                var wishlist = document.querySelector('#wishlist');

                addToWishList.addEventListener('submit', function (event) {

                    // Don't submit the form
                    event.preventDefault();

                    // Ignore it if the wishlist item is empty
                    if (wishlistItem.value.length < 1) return;

                    // Add item to wishlist
                    wishlist.innerHTML += '<li id= "wlist">' + wishlistItem.value + '</li>';

                    // Clear input
                    wishlistItem.value = '';

                }, false);

            </script>

            <!--php file handling test-->   
            <?php
            $myfile = fopen("webtext.txt", "w") or die("Unable to open file!");
            $txt = "John Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            fclose($myfile);
            echo readfile("webtext.txt");
            ?>

    </body>
</html>