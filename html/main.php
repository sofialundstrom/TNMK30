<?php include('../txt/header.txt'); ?>
    <h1>LEGO BANK</h1>
    <p class="undertext">Hej</p>
    <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
    <div class="hej">
        <div id="overlay-search">
                <form class="searchform" action="searchpage.php" method="POST">
                    <input type="search" name="search" id="search" placeholder="Search your lego piece">
                    <button class="button" type="submit">Search</button>
                    <div class="button" id="help_btn">? </div>
                </form>
        </div>
    </div>
           

    <div id="mymodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="helpbox">Press help for help</p>
            <img src="../bilder/pil.png" alt="bil">
        </div>
    </div>
   <?php

        
 include('../txt/footer.txt'); ?>
