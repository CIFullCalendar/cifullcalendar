<?php

class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);

		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Open the default SQL file
		$query = file_get_contents('db/install.sql');

		// Execute a multi query
		$mysqli->multi_query($query);
		
		// Close the connection
		$mysqli->close();

		return true;
	}
	
	function update_tables($data)
	{	
		session_start();
		// Connect to the database
		$conn= new mysqli($_SESSION['hostname'],$_SESSION['username'],$_SESSION['password'],$_SESSION['database']); 
			
		// Check for errors
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error); exit();
		} 

		$sql ='UPDATE ic_users SET first_name="'.$data['first_name'].'", last_name="'.$data['last_name'].'",email="'.$data['email'].'" WHERE id=1';
		$conn->query($sql); 
		
		if ($conn->query($sql) === TRUE) { 
			$conn->close();
			return true;
		} else {
			$conn->close();
			return false;
		}
		
		session_destroy(); 
	}
	
	
}