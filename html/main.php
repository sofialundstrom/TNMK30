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
    <div class ="container-cookies">
    <div id="Cookiebox">
    <h2>We use cookies!</h2>
    <p id="cookietext">To provide you with personalized and customized content, we want to use cookies.
         We will also use cookies to be able to use and analyze the cookies we think you may use.
          By clicking "Accept Cookies!", you are agreeing to our use of cookies.</p>
    <div id="cookiebutton" class>
    <button id="accept-cookies-btn">Accept Cookies!</button> 
    </div>
    </div>
    </div>
   <?php


        
 include('../txt/footer.txt'); ?>
