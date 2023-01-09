<?php include('../txt/header.txt'); ?>

<div class="searchbackgroundbox">
    
     <div id="overlay-search">
        <div class="legotext">
          <h1 id="header_main">LEGO BANK</h1>
        </div>
            <form class="searchform" action="searchpagepart.php" method="POST">
                <input type="search" name="search" id="search" placeholder="Search your lego piece" required>
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
