<?php
	require('config/config.php');
	require('config/db.php');

	//check for delete
    if(isset($_POST['delete'])){
        //Get Form data
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
        

        $query= "DELETE FROM posts WHERE id = {$delete_id}; 
                ";

        if(mysqli_query($conn, $query)){
            header('Location: '.ROOT_URL.'');

        } else {
            echo 'Error: '.mysqli_error($conn);
        }

      
    }

	// get ID
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// Create Query
	$query = 'SELECT * FROM posts WHERE id = '.$id;

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$post = mysqli_fetch_assoc($result);
	//var_dump($posts);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);
?>

	<?php include('inc/header.php'); ?>
		<div class="container">
			<a type="button" href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
			<div class="card bg-light mb-3" style="max-width: 20rem;">
				<div class="card-header"><?php echo $post['title']; ?></div>
				<div class="card-body">
					<p class="card-text"><small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small></p>
					<p class="card-text"><?php echo $post['body']; ?></p>
				</div>

				<form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
					<input type="submit" name="delete" value="Delete" class="btn btn-danger">
				</form>

				<a href="<?php echo ROOT_URL;?>editpost.php?id=<?php echo $post['id'];?>" class="btn btn-outline-info">Edit post</a>
			
			</div>
			
		</div>
	<?php include('inc/footer.php'); ?>