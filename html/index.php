<!-- Include css, javascript, head and start of body -->
<?php include('../txt/header.txt'); ?>

<!-- Box areound search and search bar -->
<div class="searchBackgroundBox">
    <div id="searchContainer">
        <div class="legoText">
            <h1 id="mainHeader">LEGO BANK</h1>
        </div>
        <form class="indexSearchForm" action="searchpagepart.php" method="POST">
            <!-- Required makes sure you can't enter nothing and go to next page -->
            <input type="search" name="search" id="search" placeholder="Search your lego piece" required>
            <button class="button" id="submitButton" type="submit">Search</button>
            <button class="button" id="helpButton">?</button>
        </form>
    </div>
</div>        

<!-- For the box that shows what you can do if you need help -->
<div id="mymodal" class="modal">
    <div class="modalContent">
        <span class="close">&times;</span>
        <p id="modalHelpBox">Press HELP for help</p>
    </div>
</div>

<?php include('../txt/footer.txt'); ?>
