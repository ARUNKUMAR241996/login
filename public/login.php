<?php
   include("../config.php");
   session_start();
   
   if(isset($_POST['submit']))
   {
    $uname =$_POST['firstname'];
	$_SESSION['loginuser']=$uname;
    $email =$_POST['email'];
    if ($uname != "" && $email != "")
	{
		
		try
		{
			
	$connection = new PDO($dsn, $username, $password, $options);
	
	$sql = "SELECT * 
                        FROM users
                        WHERE firstname = :firstname and email= :email";

        $firstname = $_POST['firstname'];
		$email = $_POST['email'];
		
		$statement = $connection->prepare($sql);
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
		$result = $statement->fetchAll();
	    
		if ($result && $statement->rowCount() > 0)
			{
				
				echo $_SESSION['loginuser']."<br>";
			    echo "logged in successfully";
				?><a href="home.php"></a><?php
				
				
				
			}
			
			else
			{
				echo"incorrect username or password";
			}
		}
	
	
	catch(PDOException $error) 
		{
        echo $sql . "<br>" . $error->getMessage();
		}
	
   }
   
   
	else
	{
		echo "server side error";
	}
}
?>


      

<div class="container">
    <form method="post" action="">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="firstname" name="firstname" placeholder="Username" />
            </div>
            <div>
                <input type="text" class="textbox" id="email" name="email" placeholder="email"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="submit" id="submit" />
            </div>
        </div>
    </form>
</div>