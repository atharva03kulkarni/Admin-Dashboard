<!--Product page-->

<?php include('connection.php'); 
error_reporting(E_ERROR);

// add button clicked
if( isset($_POST["upload"])) {

    function validateFormData($formData) {
        $formData = trim(stripslashes(htmlspecialchars($formData)));
        return $formData;
    }

    //check to see if inputs are empty and wrap data with function
    $itemname = $itemprice = $itemquantity = $itemdesc = $itemCategory = "";

    if(!$_POST["itemname"]) {
        echo "<div class='alert alert-danger'>Please enter all the fields!<a class='close' data-dismiss='alert'>&times;</a></div>";
        $nameError = "Please enter Item Name <br>";
    } else {
        $itemname = validateFormData($_POST["itemname"]);
    }

    if(!$_POST["itemquantity"]) {
        $quanError = "Please enter Item Quantity <br>";
    } else {
        $itemquantity = validateFormData($_POST["itemquantity"]);
    }

    if(!$_POST["itemprice"]) {
        $priceError = "Please enter Item Price <br>";
    } else {
        $itemprice = validateFormData($_POST["itemprice"]);
    }

    if(!$_POST["itemdesc"]) {
        $descError = "Please enter Item Description <br>";
    } else {
        $itemdesc = validateFormData($_POST["itemdesc"]);
    } 

    // checking if image was selected
    if(!empty($_FILES['itemimg']['tmp_name']) && file_exists($_FILES['itemimg']['tmp_name'])) {
        $file = addslashes(file_get_contents($_FILES['itemimg']['tmp_name']));
    } else {
        $imgError = "Please upload an Image <br>";
    }

    // check if dropdown was selected, if selected add it to the database
    if($_POST['dropdown'] != '') {

        $itemCategory = $_POST['dropdown'];
        
      } 
    // adding item to database
    if( $itemname && $itemprice && $itemquantity && $itemdesc && $itemCategory ) {
        $query = "INSERT INTO products (id, category, name, price, description, image, quantity) VALUES (NULL,'$itemCategory', '$itemname', '$itemprice', '$itemdesc', '$file', '$itemquantity')";
    
    if(mysqli_query($db, $query)) {
        echo "<div class='alert alert-success'>Item added successfully!<a class='close' data-dismiss='alert'>&times;</a></div>";
    } else {
        echo "Error: ".$query ."<br>".mysqli_error($db);
    }
    } 

}


if( $_GET['alert'] == 'updatesuccess' ) {
    echo "<div class='alert alert-success'>Item updated successfully!<a class='close' data-dismiss='alert'>&times;</a></div>";

} elseif ( $_GET['alert'] == 'deleted') {
    echo "<div class='alert alert-success'>Item deleted successfully!<a class='close' data-dismiss='alert'>&times;</a></div>";

}

?>

<html>
  <head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products</title>
	<!-- BOOTSTRAP STYLES-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- CUSTOM STYLES-->
    <link href="assets/css/product.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  </head>
  <body>
    

    <nav class="navbar navbar-expand-sm navigation">
        <!--Logo-->
        <img src="assets/img/Logo.png" alt="logo">
        <a href="index.php" class="nav-link">
            Home
        </a>
                
        <h1 class="heading">Products</h1> 
        <button type="button" class="btn btn-default btn-lg addButton" data-toggle="modal" data-target="#addItems">Add Items</button> 
    </nav>

    <!-- Filter -->
    <div class="dropdown filter">
        <button type="button" id="filterBtn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            Choose category
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="product.php?id=all">All</a>
            <a class="dropdown-item" href="product.php?id=vegetable">Vegetables</a>
            <a class="dropdown-item" href="product.php?id=fruit">Fruits</a>
        </div>
    </div>


    <!--Add items Modal -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="modal fade" enctype="multipart/form-data" id="addItems" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">                          
              <h4 class="modal-title"> Add an Item</h4>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>

                <div class="modal-body">                    

                    <label for="category">Choose category:</label>
                    <select name="dropdown" id="category">
                        <option value="Vegetable">Vegetable</option>
                        <option value="Fruit">Fruit</option>
                    </select>
                
                    <div class="form-group"><br>
                        <small class="text-danger">* <?php echo $nameError; ?></small>
                        <label>Name of the item</label>
                        <input type="text" name="itemname" placeholder="Item Name" class="form-control">
                    </div>

                    <div class="form-group">
                    <small class="text-danger">* <?php echo $quanError; ?></small>
                        <label>Item Quantity</label>
                        <input type="text" name="itemquantity" placeholder="Add Quantity" class="form-control">
                    </div>

                    <div class="form-group">
                    <small class="text-danger">* <?php echo $priceError; ?></small>
                        <label>Price of the item</label>
                        <input type="text" name="itemprice" placeholder="Item Price" class="form-control">
                    </div>

                    <div class="form-group">
                    <small class="text-danger">* <?php echo $descError; ?></small>
                        <label>Item Description</label>
                        <input type="text" name="itemdesc" placeholder="Add Description" class="form-control">
                    </div>
                    
                    <div class="form-group">
                    <small class="text-danger">* <?php echo $imgError;  ?></small>
                    <label>Add Image</label>
                    
                    <div>
                        <input type="file" name="itemimg" id="itemimg">
                    </div>
                    </div>

                    <div>
                        <input type="submit" name="upload" id="insert" value="Add item">
                    </div>

                </div>
            </div>

        </div>

    </form>

    
    <!-- Displaying exisiting products -->
    <?php
    
    $categoryID = $_GET['id'];

    if($categoryID == 'all') {

    echo "<script>document.getElementById('filterBtn').innerHTML='All';</script>";

    $query = "SELECT * FROM products";
    $result = mysqli_query( $db, $query );

        if( mysqli_num_rows($result) > 0 ) {
            // output the data
    
            echo "<div class='table-responsive-md'><table class='table table-bordered'><thead class='thead-dark'><tr><th>Product Image</th><th>Product</th><th>Quantity</th><th>Price (in &#8377;)</th><th>Description</th><th>Update</th></tr>";
    
            while( $row = mysqli_fetch_assoc($result)) {
                // echo $row["id"] ." ".$row["productname"]." ".$row["price"]." ".$row["Description"]."<br>";
                 $id = $row["id"];
                 $name = $row["name"];
                 $price = $row["price"];    
                 $image = '<img height="100px" width="100px" src="data:image;base64,' .base64_encode($row['image']).' " ';
                 $desc = $row["description"];
                 $quan = $row["quantity"];
    
                 echo "<tr><td>". $image ."</td><td>". $name ."</td><td>". $quan ."</td><td>". $price. "</td><td>". $desc. "</td><td><a href='edit.php?id=" . $id . "' role='button' class='btn btn-primary'>Edit</a></td></tr>";
            }
    
            echo "</thead></table></div>";
    
            
    
        } else {
            echo "<div class='alert alert-warning'>No results.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }

    } elseif($categoryID == 'vegetable') {
        
        echo "<script>document.getElementById('filterBtn').innerHTML='Vegetables';</script>";
        $query = "SELECT * FROM products WHERE category='Vegetable'";
        $result = mysqli_query( $db, $query );

        if( mysqli_num_rows($result) > 0 ) {
            // output the data
    
            echo "<div class='table-responsive-md'><table class='table table-bordered'><thead class='thead-dark'><tr><th>Product Image</th><th>Product</th><th>Quantity</th><th>Price (in &#8377;)</th><th>Description</th><th>Update</th></tr>";
    
            while( $row = mysqli_fetch_assoc($result)) {
                // echo $row["id"] ." ".$row["productname"]." ".$row["price"]." ".$row["Description"]."<br>";
                 $id = $row["id"];
                 $name = $row["name"];
                 $price = $row["price"];    
                 $image = '<img height="100px" width="100px" src="data:image;base64,' .base64_encode($row['image']).' " ';
                 $desc = $row["description"];
                 $quan = $row["quantity"];
    
                 echo "<tr><td>". $image ."</td><td>". $name ."</td><td>". $quan ."</td><td>". $price. "</td><td>". $desc. "</td><td><a href='edit.php?id=" . $id . "' role='button' class='btn btn-primary'>Edit</a></td></tr>";
            }
    
            echo "</thead></table></div>";
    
            
    
        } else {
            echo "<div class='alert alert-warning'>No results.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
    }elseif($categoryID == 'fruit') {
        
        echo "<script>document.getElementById('filterBtn').innerHTML='Fruits';</script>";

        $query = "SELECT * FROM products WHERE category='Fruit'";
        $result = mysqli_query( $db, $query );

        if( mysqli_num_rows($result) > 0 ) {
            // output the data
    
            echo "<div class='table-responsive-md'><table class='table table-bordered'><thead class='thead-dark'><tr><th>Product Image</th><th>Product</th><th>Quantity</th><th>Price (in &#8377;)</th><th>Description</th><th>Update</th></tr>";
    
            while( $row = mysqli_fetch_assoc($result)) {
                // echo $row["id"] ." ".$row["productname"]." ".$row["price"]." ".$row["Description"]."<br>";
                 $id = $row["id"];
                 $name = $row["name"];
                 $price = $row["price"];    
                 $image = '<img height="100px" width="100px" src="data:image;base64,' .base64_encode($row['image']).' " ';
                 $desc = $row["description"];
                 $quan = $row["quantity"];
    
                 echo "<tr><td>". $image ."</td><td>". $name ."</td><td>". $quan ."</td><td>". $price. "</td><td>". $desc. "</td><td><a href='edit.php?id=" . $id . "' role='button' class='btn btn-primary'>Edit</a></td></tr>";
            }
    
            echo "</thead></table></div>";
    
            
    
        } else {
            echo "<div class='alert alert-warning'>No results.<a class='close' data-dismiss='alert'>&times;</a></div>";
        }
    } elseif($categoryID == '') {

        $query = "SELECT * FROM products";
        $result = mysqli_query( $db, $query );

        if( mysqli_num_rows($result) > 0 ) {
            // output the data
    
            echo "<div class='table-responsive-md'><table class='table table-bordered'><thead class='thead-dark'><tr><th>Product Image</th><th>Product</th><th>Quantity</th><th>Price (in &#8377;)</th><th>Description</th><th>Update</th></tr>";
    
            while( $row = mysqli_fetch_assoc($result)) {
                // echo $row["id"] ." ".$row["productname"]." ".$row["price"]." ".$row["Description"]."<br>";
                 $id = $row["id"];
                 $name = $row["name"];
                 $price = $row["price"];    
                 $image = '<img height="100px" width="100px" src="data:image;base64,' .base64_encode($row['image']).' " ';
                 $desc = $row["description"];
                 $quan = $row["quantity"];
    
                 echo "<tr><td>". $image ."</td><td>". $name ."</td><td>". $quan ."</td><td>". $price. "</td><td>". $desc. "</td><td><a href='edit.php?id=" . $id . "' role='button' class='btn btn-primary'>Edit</a></td></tr>";
            }
    
            echo "</thead></table></div>";

    }else {
        echo "<div class='alert alert-warning'>No results.<a class='close' data-dismiss='alert'>&times;</a></div>";
    }

    } 
        
    mysqli_close($db);
    ?>
    
  </body>
</html>

<!-- Uploading image-->
<script>
$(document).ready(function(){
    $('#insert').click(function()) {
        var image_name = $('#itemimg').val();
        if(image_name == '' ) {
            alert("Please select an image");
            return false;
        } else {
            var extension = $('#itemimg').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                alert('Invalid Image File');
                $('#itemimg').val('');
                return false;
            }
        }
    });
});
</script>