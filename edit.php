<?php

// get id
$productID = $_GET['id'];

include('connection.php');

include('functions.php');

// query the db with productID
$query = "SELECT * FROM products WHERE id='$productID'";
$result = mysqli_query($db, $query);

// if result is returned
if( mysqli_num_rows($result) > 0 ) {

    while( $row = mysqli_fetch_assoc($result)) {

        $itemName = $row['name'];
        $itemQuan = $row['quantity'];
        $itemPrice = $row['price'];
        $itemDesc = $row['description'];
        $image = '<img height="100px" width="100px" src="data:image;base64,' .base64_encode($row['image']).' " ';


    }

} else { // no results returned
    echo "<div class='alert alert-warning'>Nothing to see here. <a href='product.php'>Head back</a>.</div>";
}

//if update button is pressed
if( isset($_POST['update'])) {

    $itemName   = validateFormData($_POST["itemName"]);
    $itemQuan   = validateFormData($_POST["itemQuan"]);
    $itemPrice  = validateFormData($_POST["itemPrice"]);
    $itemDesc   = validateFormData($_POST["itemDesc"]);
    

    // checking if image was selected
    if(!empty($_FILES['itemimg']['tmp_name']) && file_exists($_FILES['itemimg']['tmp_name'])) {
        $file = addslashes(file_get_contents($_FILES['itemimg']['tmp_name']));
    } else {
        echo "<div class='alert alert-danger'>Please select an image! <a class='close' data-dismiss='alert'>&times;</a></div>";
    }


    $query = "UPDATE products
            SET name = '$itemName',
            price = '$itemPrice',
            description = '$itemDesc',
            image = '$file',
            quantity = '$itemQuan'
            WHERE id='$productID'";

    $result = mysqli_query($db, $query);

    if($result) {

        // redirect to product page
        header("Location: product.php?alert=updatesuccess");

    } else {
        echo "Error updating record: ". mysqli_error($db);
    }

}

if( isset($_POST['delete']) ) {

    echo "<div class='alert alert-danger'>
                <p>Are you sure you want to delete this product?</p><br>
                
                <form action='". htmlspecialchars($_SERVER["PHP_SELF"]) ."?id=$productID' method='post'>
                <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete!'>
                <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>Cancel</a>
                </form>
                </div>";

}

if( isset($_POST['confirm-delete']) ) {

    $query = "DELETE FROM products WHERE id='$productID'";
    $result = mysqli_query($db, $query);

    if($result) {
        //redirect to products page
        header("Location: product.php?alert=deleted");
    } else {
        echo "Error updating record: " .mysqli_error($db);
    }

}

mysqli_close($db);

?>


<html>
  <head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Product</title>
	<!-- BOOTSTRAP STYLES-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- CUSTOM STYLES-->
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  </head>
  <body>

<h1>Edit Item</h1><hr>  

<form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>?id=<?php echo $productID; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-sm-6">
        <label for="item-name">Edit Name</label>
        <input type="text" class="form-control input-lg" id="item-name" name="itemName" value="<?php echo $itemName; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="item-quantity">Edit Quantity</label>
        <input type="text" class="form-control input-lg" id="item-quantity" name="itemQuan" value="<?php echo $itemQuan; ?>">
    </div>
    <div class="form-group col-sm-6">
        <label for="item-price">Edit Price</label>
        <input type="text" class="form-control input-lg" id="item-price" name="itemPrice" value="<?php echo $itemPrice; ?>">
    </div>
    <div class="form-group col-sm-12">
        <label for="item-desc">Edit Description</label>
        <textarea type="text" class="form-control input-lg" id="item-desc" name="itemDesc"><?php echo $itemDesc; ?></textarea>
    </div>   
    <div class="form-group">
        <label>Add New Image</label>
        <div>
            <input type="file" name="itemimg" id="itemimg"> 
        </div>
    </div>
    <div class="col-sm-12">
        <hr>
        <button type="submit" class="btn btn-lg btn-danger pull-left" name="delete">Delete</button>
        <div class="pull-right">
            <a href="product.php" type="button" class="btn btn-lg btn-default">Cancel</a>
            <input type="submit" class="btn btn-lg btn-success" name="update" id="insert" value="Update">
        </div>
    </div>
</form> 

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