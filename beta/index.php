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
                    for ($i = 1; $i <= 13; $i++) {
                        $ingredientKey = 'Ingredient #' . $i;
                        $content = $oneRecipe[$ingredientKey];
                        if (!empty($content)) {
                            echo '<p class="recipe-des">' . $content . '</p>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    // convert string in database into array to parse through
                    $step_IMG = explode('*', $oneRecipe['Step IMGs']);
                    for ($f = 1; $f <= count($step_IMG); $f++) {
                        $stepTitle = 'Step Title #' . $f;
                        $stepDesc = 'Step Desc #' . $f;
                        $stepTitleInfo = $oneRecipe[$stepTitle];
                        $stepDescInfo = $oneRecipe[$stepDesc];
                        $imageSource = $step_IMG[$f - 1];
                    
                        echo '<div class="step-items">';
                        echo '<img src="img/' . $imageSource . '">';
                        echo '<div class="details">';
                        echo '<div class="details-sub">';
                        echo '<h5> STEP ' . $f . '</h5>';
                        echo '<h6>' . $stepTitleInfo . '</h6>';
                        echo '</div>';
                        echo '<p>' . $stepDescInfo . '</p>';
                        echo '</div>';
                        echo '</div>';
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
        <img src="img/nomnom-logo.png" alt="Logo">
        <span class="copyright">© 2023 NomNom Recipe</span>
        <p>THANK YOU!</p>
    </div>
</body>
</html>








