<?php
require "../../database.php";
session_start();
require "layout/admin _layout.html.php";
require "../../function.php";
?>


	<?php

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	if (isset($_POST['submit'])) {

		$stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id ');

		$criteria = [
			'name' => $_POST['name'],
			'id' => $_POST['id']
		];

		$stmt->execute($criteria);
		echo 'Category Saved';
	}
	else {
				$currentCategory = $pdo->query('SELECT * FROM category WHERE id = ' . $_GET['id'])->fetch();
			?>


				<h2>Edit Category</h2>

				<form action="" method="POST">

					<input type="hidden" name="id" value="<?php echo $currentCategory['id']; ?>" />
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $currentCategory['name']; ?>" />


					<input type="submit" name="submit" value="Save Category" />

				</form>


	<?php


		}
	}

	else {
			?>
			<h2>Log in</h2>

			<form action="index.php" method="post">

				<label>Password</label>
				<input type="password" name="password" />

				<input type="submit" name="submit" value="Log In" />
			</form>
		<?php
		}

	?>


</section>
<?php
// include the footer template
require '../include/footer.php';
?>