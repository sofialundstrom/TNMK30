<?php include('../txt/header.txt'); ?>

        <div>
            <h1>LEGO BANK</h1>
        </div>
<div class="searchbackgroundbox">
        <div id="overlay-search">
                <form class="searchform" action="searchpage.php" method="POST">
                    <input type="search" name="search" id="search" placeholder="Search your lego piece">
                    <button class="button" type="submit">Search</button>
                    <div class="button" id="help_btn">?</div>
                </form>
        </div>
</div>        

    <div id="mymodal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="helpbox">Press HELP for help</p>
        </div>
    </div>
   <?php

        
 include('../txt/footer.txt'); ?>
