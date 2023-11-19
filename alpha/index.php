<!DOCTYPE html>
<html
lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOMNOM RECIPES</title>
    <link rel="stylesheet" href="style.css">
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
            <h1>NOMNOM RECIPES</h1>
            <h3>&mdash; Precision Recipes: Crafted with Detail &mdash; </h3>
            <div class="filter-bar">
                <button class="filter-button" data-category="all">ALL</button>
                <button class="filter-button" data-category="chicken">CHICKEN</button>
                <button class="filter-button" data-category="beef">BEEF</button>
                <button class="filter-button" data-category="fish">FISH</button>
                <button class="filter-button" data-category="pork">PORK</button>
                <button class="filter-button" data-category="steak">STEAK</button>
                <button class="filter-button" data-category="turkey">TURKEY</button>
                <button class="filter-button" data-category="vegetarian">VEGITARIAN</button>
            </div>
        </div>
    </div>
    <div class="menu">
  <?php
  // Get all the recipes from the "recipes" table in the database
  $query = "SELECT * FROM recipes";
  $results = mysqli_query($db_connection, $query);
  if ($results->num_rows >0) {
    consoleMsg("Query successful! number of rows; $results->num_rows");
    while($oneRecipe = mysqli_fetch_array($results)) {
      echo '<figure class="food-item">';
      echo '<h2 class="title">' .$oneRecipe['Title']. '</h2>';
      echo '<h3 class="subtitle">' .$oneRecipe['Subtitle']. '</h3>';
      echo '<img src="img/' . $oneRecipe['Main IMG'] . '" style= "position: relative;
      height: 50vh;
      width:100%;
      object-fit: cover;
      border-radius: 15px 15px 15px 15px;" class="food-image">';
      echo '<p class="description">' .$oneRecipe['Description']. '</p>';
      echo '</figure>';
    }
  } else {
    consoleMsg("QUERY ERROR");
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
