<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOMNOM RECIPES</title>
    <link rel="stylesheet" href="indexstyle.css">
    <script src="script.js" defer></script>
</head>
<body>
    <?php
    require_once 'fun.php';
    require_once 'env.php';
    require_once 'database.php';

    // Find if the user typed anything into the search box
    $search = $_POST['search'];
    $filter = $_GET['filter'];
    $toCalories = $_POST['toCalories'];
    $fromCalories = $_POST['fromCalories'];
    $token = $_GET['token'];
    ?>

    <nav>
        <a class="logo" href="index.php">
            <img src="img/nomnom-logo.png" alt="NomNom Logo">
        </a>
        <div class="search-bar">
            <form action="index.php" method="POST" class="search-form">
                <input type="search" id="search" name="search" value="<?php echoSearchValue('search'); ?>" placeholder="Search your recipe!" class="search">
                <button class="search-button">
                    <img src="img/search-icon.svg" alt="Search Icon">
                </button>
            </form>
        </div>
    </nav>

    <div class="menu">
        <div class="heading">
            <h1>NOMNOM RECIPES</h1>
            <h3>&mdash; Precision Recipes: Crafted with Detail &mdash;</h3>
            <div class="filter-bar" id="filters">
                <a href="index.php?filter=" class="filter-button">ALL</a>
                <a href="index.php?filter=chicken" class="filter-button">CHICKEN</a>
                <a href="index.php?filter=beef" class="filter-button">BEEF</a>
                <a href="index.php?filter=fish" class="filter-button">FISH</a>
                <a href="index.php?filter=pork" class="filter-button">PORK</a>
                <a href="index.php?filter=steak" class="filter-button">STEAK</a>
                <a href="index.php?filter=turkey" class="filter-button">TURKEY</a>
                <a href="index.php?filter=vegitarian" class="filter-button">VEGETARIAN</a>
                <a type="button" class="filter-button" onclick="surpriseMe()">SURPRISE ME!</a>

            </div>

            <form action="index.php" method="POST" id="caloriesForm">
            <h3 class="caloriesHeading">Choose the calories for your dish! </h3>
                <div class="form_control">
                    <div class="form_control_container">
                        <div class="form_calories_controller">Min: </div>
                        <input class="form_calories_input" type="number" name="fromCalories" id="fromCalories" value="<?php echoSearchValue('fromCalories'); ?>" step= "50"onchange="submitForm()"/>
                    </div>
                    <div class="form_control_container">
                        <div class="form_calories_controller">Max: </div>
                        <input class="form_calories_input" type="number" name="toCalories" id="toCalories" value="<?php echoSearchValue('toCalories'); ?>" step= "50" onchange="submitForm()"/>
                    </div>
                    <div class ="form_control_container">
                    <button type="button" class="clear-button" onclick="clearForm()">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="menu">
        <?php
        consoleMsg("Search is:" . $search);
        consoleMsg("to Calories:" . $toCalories);
        consoleMsg("from Calories:" . $fromCalories);
        consoleMsg("filter string is " . $filter);

        // If the search is not empty, query based on $search
        if (!empty($search)) {
            $query = "SELECT * FROM recipes WHERE title LIKE '%$search%' OR subtitle LIKE '%$search%'";
        } elseif (!empty($filter)) {
           if ($filter == 'surprise') {
                $query = "SELECT * FROM recipes ORDER BY RAND() LIMIT 1";
            } else {
                $query = "SELECT * FROM recipes WHERE proteine LIKE '%$filter%'";
            }
        } elseif (!empty($fromCalories)) {
            if (!empty($toCalories)) {
                $query = "SELECT * FROM recipes WHERE `Cal/Serving` BETWEEN $fromCalories AND $toCalories";
            } else {
                $query = "SELECT * FROM recipes WHERE `Cal/Serving` > $fromCalories";
            }
        } elseif (!empty($toCalories)) {
            $query = "SELECT * FROM recipes WHERE `Cal/Serving` < $toCalories";
        } else {
            // Get all the recipes from the "recipes" table in the database
            $query = "SELECT * FROM recipes";
        }

        $results = mysqli_query($db_connection, $query);

        if ($results->num_rows > 0) {
            consoleMsg("Query successful! Number of rows: $results->num_rows");
            while ($oneRecipe = mysqli_fetch_array($results)) {
                $id = $oneRecipe['id']; // Add this line to get the ID
                ?>
                <a href="detail.php?recID=<?= $id ?>&filter=<?= urlencode($filter) ?>&token=<?= urlencode($token) ?>" class="link">
                    <figure class="food-item">
                        <img src="img/<?= $oneRecipe['Main IMG'] ?>" style="position: relative;
                            height: 50vh;
                            width:100%;
                            object-fit: cover;
                            border-radius: 15px 15px 15px 15px;" class="food-image">
                        <h2 class="title"><?= $oneRecipe['Title'] ?></h2>
                        <h3 class="subtitle"><?= $oneRecipe['Subtitle'] ?></h3>
                        <p class="description"><?= $oneRecipe['Description'] ?></p>
                    </figure>
                </a>
                <?php
            }
        } else {
            ?>
            <?php
            if(!empty($search)) {
                echo '<div class="fail">RECIPES NOT FOUND FOR ' . $search . '.<br> PLEASE SEARCH AGAIN!</div>';
            } elseif (!empty($fromCalories)) {
                if(!empty($toCalories)) {
                    echo '<div class="fail">RECIPES NOT FOUND FOR CALORIES BETWEEN ' . $fromCalories . ' AND '. $toCalories . '.<br> PLEASE SEARCH AGAIN!</div>';
                } else {
                    echo '<div class="fail">RECIPES NOT FOUND FOR CALORIES ABOVE' . $fromCalories . '.<br> PLEASE SEARCH AGAIN!</div>';
                }
            } elseif (!empty($toCalories)) {
                echo '<div class="fail">RECIPES NOT FOUND FOR CALORIES UNDER ' . $toCalories . '.<br> PLEASE SEARCH AGAIN!</div>';
            }
            consoleMsg("ERROR");
            ?>
            <?php
        }
        ?>
    </div>

    <div class="footer">
        <img src="img/nomnom-logo.png" alt="Logo">
        <span class="copyright">© 2023 NomNom Recipe</span>
        <p>THANK YOU!</p>
    </div>

</body>
</html>
