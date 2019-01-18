<?php
	require('config/config.php');
	require('config/db.php');

    //check for submit
    if(isset($_POST['submit'])){
        //Get Form data
        $title = mysqli_real_escape_string($conn, $_POST['title']);  //mysqli_real_escape_string for more secure
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);

        $query= "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";

        if(mysqli_query($conn, $query)){
            header('Location: '.ROOT_URL.'');

        } else {
            echo 'Error: '.mysqli_error($conn);
        }
    }
	
?>

<?php include('inc/header.php'); ?>
	<div class="container">
        <a type="button" href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
		<legend>Add Post</legend>
		<form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">

            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control">

            </div>

            <div class="form-group">
                <label>Body</label>
                <textarea type="text" name="body" class="form-control" rows="3"></textarea>

            </div>

            <input type="submit" name="submit" value="submit" class="btn btn-primary">


        </form>
	</div>
<?php include('inc/footer.php'); ?>