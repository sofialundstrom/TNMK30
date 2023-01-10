<!-- Include css, javascript, head and start of body -->
<?php include('../txt/header.txt'); ?>

<!-- Box areound search and search bar -->
<div class="searchbackgroundbox">
    <div id="overlay-search">
        <div class="legotext">
            <h1 id="header_main">LEGO BANK</h1>
        </div>
        <form class="searchform" action="searchpagepart.php" method="POST">
            <!-- Required makes sure you can't enter nothing and go to next page -->
            <input type="search" name="search" id="search" placeholder="Search your lego piece" required>
            <button class="button" type="submit">Search</button>
            <div class="button" id="help_btn">?</div>
        </form>
    </div>
</div>        

<!-- For the box that shows what you can do if you need help -->
<div id="mymodal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="helpbox">Press HELP for help</p>
    </div>
</div>

<?php include('../txt/footer.txt'); ?>
