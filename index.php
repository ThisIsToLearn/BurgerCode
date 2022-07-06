
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Burger Code</title>
</head>
<body>
    <div class="container site"> 
        <h1 class="text-logo"><span class="bi-shop"></span> Burger Code <span class="bi-shop"></span></h1>
       
 <?php
                require 'Admin/database.php';
                echo '<nav>
                        <ul class="nav nav-pills">';
                $db = Database::connect();
                $statement = $db->query('SELECT * FROM categories');
                $categories = $statement->fetchAll();
                foreach($categories as $category)
                {
                    if($category['id'] == '1')
                        echo '<li class="nav-item active" role="presentation"><a class="nav-link active" href="#' .$category['name'] . '" data-toggle="pill">' .$category['name']. '</a></li>';
                    else
                        echo '<li class="nav-item active" role="presentation"><a class="nav-link" href="#' .$category['name'] . '" data-toggle="pill">' .$category['name']. '</a></li>';
                }
                echo '</ul>
                    </nav>';

                    echo '<div class="tab-content">';
            
            foreach($categories as $category)
            {
                if($category['id'] == '1')
                    echo '<div class="tab-pane active" id="' . $category['name'] . '">';
                else
                    echo '<div class="tab-pane" id="' . $category['name'] . '">';
            
            echo '<div class="row row-cols-1 row-cols-md-3">';
            
            $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
            $statement->execute(array($category['id']));
            
            while($item = $statement->fetch())
            {
                echo '<div class="col mb-4">
                            <div class="card h-100">
                                <img src="images/' . $item['image'] . '" class="card-img-top" alt="...">
                                <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                                <div class="card-body">
                                    <h4 class="card-title">' . $item['name'] . '</h4>
                                    <p class="card-text">' . $item['description'] . '</p>
                                    <a href="#" class="btn btn-order" role="button"><span class="fas fa-shopping-cart"></span> Commander</a>
                                </div>
                            </div>
                        </div>';
            }
            echo '</div>
                </div>';
            
            }
            Database::disconnect();
            echo '</div>';
 ?>      
        
    
        </div>
    </body>
</html>
