<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL RECIPE</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<nav>
    <div class="logo">
        <img src="img/nomnom-logo.png">
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search your recipe!" class="search-input">
        <button class="search-button">
            <img src="img/search-icon.svg" alt="Search Icon">
        </button>
    </div>    
</nav>

<body>
    <?php
    require_once 'fun.php';
    require_once 'env.php';
    require_once 'database.php';
    ?>

    <div class="menu">
        <div class="heading">
            <h1>DETAIL RECIPE</h1>
            <h3>&mdash; Explore your favorite dish &mdash;</h3>
            <a href="#" class="return-button"><i class="fas fa-arrow-left"></i></a>
            <?php
            $query = "SELECT * FROM recipes WHERE id = 1";
            $results = mysqli_query($db_connection, $query);

            // checking to see if the query returns any results
            if ($results->num_rows > 0) {
                consoleMsg("Query successful! Number of rows: $results->num_rows");
                while ($oneRecipe = mysqli_fetch_array($results)) {
                    echo '<div class="container">';
                    echo '<div class="image">';
                    echo '<img src="img/' . $oneRecipe['Main IMG'] . '" alt="Image">';
                    echo '</div>';
                    echo '<div class="column">';
                    echo '<p class="recipe-name">' . $oneRecipe['Title'] . '</p>';
                    echo '<p class="recipe-sub">' . $oneRecipe['Subtitle'] . '</p>';
                    echo '<p class="recipe-des">' . $oneRecipe['Description'] . '</p>';
                    echo '<p class="recipe-info">' . $oneRecipe['CookTime'] . '</p>';
                    echo '<p class="recipe-info">' . $oneRecipe['Cal/Serving'] . '</p>';
                    echo '<p class="recipe-info">' . $oneRecipe['Proteine'] . '</p>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="container">';
                    echo '<div class="image">';
                    echo '<img src="img/' . $oneRecipe['Ingredients IMG'] . '" alt="Image">';
                    echo '</div>';
                    echo '<div class="column">';
                    echo '<p class="recipe-name">ALL INGREDIENTS</p>';
                    $ingredients_Array = explode('*', $oneRecipe['All Ingredients']);
                    for ($i = 1; $i <= count($ingredients_Array); $i++) {
                            echo '<p class="recipe-des">' . $ingredients_Array[$i] . '</p>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    // convert string in database into array to parse through
                    $step_IMG = explode('*', $oneRecipe['Step IMGs']);
                    $step_Instructions = explode('*', $oneRecipe['All Steps']);
                    for ($f = 0; $f <= count($step_Instructions); $f++) {
                        $firstChar = substr($step_Instructions[$f], 0, 1);
                        if (is_numeric($firstChar)){
                            $stepTitle = 'Step Title #' . $firstChar;
                            $stepDesc = 'Step Desc #' . $firstChar;
                            $stepTitleInfo = substr($oneRecipe[$stepTitle],2);
                            $stepDescInfo = $oneRecipe[$stepDesc];
                            echo '<div class="step-items">';
                            echo '<img src="img/' . $step_IMG[$firstChar - 1] . '">';
                            echo '<div class="details">';
                            echo '<div class="details-sub">';
                            echo '<h5> STEP ' . $firstChar . '</h5>';
                            echo '<h6>' . $stepTitleInfo . '</h6>';
                            echo '</div>';
                            echo '<p>' . $stepDescInfo . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
            } else {
                consoleMsg("QUERY ERROR");
            }
            ?>
        </div>

        <!-- Rest of your HTML and PHP code for step items goes here -->

    </div>

    <div class="footer">
        <span class="copyright">© 2023 NomNom Recipe</span>
    </div>
</body>
</html>








