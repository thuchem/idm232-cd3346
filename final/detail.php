<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETAIL RECIPE</title>
    <link rel="stylesheet" href="detailstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
<nav>
    <a class="logo"  href="index.php">
        <img src="img/nomnom-logo.png" alt="Logo">
    </a>
</nav>

    <?php
    require_once 'fun.php';
    require_once 'env.php';
    require_once 'database.php';

    $filter = $_GET['filter'];
    $token = $_GET['token'];
    $search = $_GET['search'];
    $fromCalories = $_GET['fromCalories'];
    $toCalories = $_GET['toCalories'];
    ?>

    <div class="menu">
        <div class="heading">
            <h1>DETAIL RECIPE</h1>
            <h3>&mdash; Explore your favorite dish &mdash;</h3>
            <a href="index.php?search=<?php echo $search;?>&filter=<?php echo $filter; ?>&token=<?php echo $token; ?>&fromCalories=<?php echo $fromCalories; ?>&toCalories=<?php echo $toCalories; ?>" class="return-button"><i class="fas fa-arrow-left"></i></a>
            <?php
            // Capture passed in RecID number
            $recID = $_GET['recID'];
            $query = "SELECT * FROM recipes WHERE id =" . $recID;
            $results = mysqli_query($db_connection, $query);

            // checking to see if the query returns any results
            if ($results->num_rows > 0) {
                consoleMsg("Query successful! Number of rows: $results->num_rows");
                consoleMsg("index.php search is: index.php?search=" . urlencode($search) . "&filter=". $filter . "&token=" . $token);
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
                    echo '<p class="recipe-info">' . "Calories: " . $oneRecipe['Cal/Serving'] . '</p>';
                    echo '<p class="recipe-info">' . "Protein: " . $oneRecipe['Proteine'] . '</p>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="container">';
                    echo '<div class="image">';
                    echo '<img src="img/' . $oneRecipe['Ingredients IMG'] . '" alt="Image">';
                    echo '</div>';
                    echo '<div class="column">';
                    echo '<p class="recipe-name">ALL INGREDIENTS</p>';
                    $ingredients_Array = explode('*', $oneRecipe['All Ingredients']);
                    echo '<ul class="checklist">';
                    for ($i = 0; $i < count($ingredients_Array); $i++) {
                        // Use a checkbox input for each ingredient
                        echo '<li>';
                        echo '<input type="checkbox" id="ingredient' . $i . '" name="ingredient' . $i . '">';
                        echo '<label class = "recipe-des" for="ingredient' . $i . '">' . $ingredients_Array[$i] . '</label>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</div>'; 
                    echo '</div>';
                    echo '</div>';
                    echo '<h1 class="header_step">STEP-BY-STEP INSTRUCTION</h1>';
                    echo '<div class= menu>';
                    // convert string in database into array to parse through
                    $step_IMG = explode('*', $oneRecipe['Step IMGs']);                    
                    $step_Instructions = explode('*', $oneRecipe['All Steps']);
                    for ($f = 0; $f <= count($step_Instructions); $f++) {
                        $firstChar = substr($step_Instructions[$f], 0, 1);
                        if (is_numeric($firstChar)){
                            if (!str_ends_with($step_IMG[$firstChar - 1], '.jpg')) {
                                if(str_ends_with($step_IMG[$firstChar - 1], '.png')) {
                                    $step_IMG[$firstChar - 1] = substr($step_IMG[$firstChar - 1], 0, -4) .'.jpg';
                                } else {
                                     $step_IMG[$firstChar - 1] = $step_IMG[$firstChar - 1] .'.jpg';
                                }
                            }
                            $stepTitle = 'Step Title #' . $firstChar;
                            $stepDesc = 'Step Desc #' . $firstChar;
                            $stepTitleInfo = substr($oneRecipe[$stepTitle],2);
                            $stepDescInfo = $oneRecipe[$stepDesc];
                            echo '<div class="step-items">';
                            echo '<img src="img/' . $step_IMG[$firstChar - 1] . '" alt="Step_IMG">';
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

    <div class="footer">
        <span class="copyright">© 2023 NomNom Recipe</span>
    </div>
</body>
</html>