<?php include ('inc/header.php') ?>


	<div data-role="content">	
		<p>
		
		<!-- form -->
		<div data-role="fieldcontain">
    <form action="setcookie.php" method="post">
    <label for="name">Text Input:</label>
    <input type="text" name="name" id="name" value=""  />

    <label for="password">Password Input:</label>
    <input type="password" name="password" id="password" value="" />
    <input type="submit" value="Přihlásit" />
    </form>
    </div>	
		
		

</p>		
	</div><!-- /content -->


<?php include ('inc/footer.php') ?>