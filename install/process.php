<?php
ini_set('max_execution_time', 500); 

if (isset($_POST)) {
    $host = $_POST["host"];
    $dbuser = $_POST["dbuser"];
    $dbpassword = $_POST["dbpassword"];
    $dbname = $_POST["dbname"];
    $dbprefix = $_POST["dbprefix"];

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $login_password = $_POST["password"] ? $_POST["password"] : "";

    $purchase_code = $_POST["purchase_code"];

    $baseURL = $_SERVER['HTTP_HOST'];
    if (!empty($_SERVER['HTTPS'])) {
        $baseURL = 'https://' . $baseURL;
    } else {
        $baseURL = 'http://' . $baseURL;
    }

    //check required fields
    if (!($host && $dbuser && $dbname && $first_name && $last_name && $email && $login_password && $purchase_code)) {
        echo json_encode(array("success" => false, "message" => "Please input all fields."));
        exit();
    }

    //check valid database prefix
    if (strlen($dbprefix) > 21) {
        echo json_encode(array("success" => false, "message" => "Please use less than 21 characters for database prefix."));
        exit();
    }

    //check for valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo json_encode(array("success" => false, "message" => "Please input a valid email."));
        exit();
    }

    //check for valid database connection
    $mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);

    if (mysqli_connect_errno()) {
        echo json_encode(array("success" => false, "message" => $mysqli->connect_error));
        exit();
    }

    //check database file
    if (!is_file('database.sql')) {
        echo json_encode(array("success" => false, "message" => "The database.sql file could not found in install folder!"));
        exit();
    }

    //start installation
    $sql = file_get_contents("database.sql");

    //set admin information to database
    $now = date("Y-m-d H:i:s");
    $token = md5(uniqid(rand(), true));

    require_once ('libraries/PasswordHash.php');
    $phpass = new App\Libraries\PasswordHash(8, true);

    $sql = str_replace('admin_first_name', $first_name, $sql);
    $sql = str_replace('admin_last_name', $last_name, $sql);
    $sql = str_replace('admin_email', $email, $sql);
    $sql = str_replace('admin_password', $phpass->HashPassword($login_password), $sql);
    $sql = str_replace('admin_token', $token, $sql);
    $sql = str_replace('admin_created_at', $now, $sql);
    $sql = str_replace('admin_update_at', $now, $sql);
    $sql = str_replace('item_purchase_code', $purchase_code, $sql);

    //set database prefix
    $sql = str_replace('CREATE TABLE IF NOT EXISTS `', 'CREATE TABLE IF NOT EXISTS `' . $dbprefix, $sql);
    $sql = str_replace('INSERT INTO `', 'INSERT INTO `' . $dbprefix, $sql);

    //create tables in datbase

    $mysqli->multi_query($sql);
    do {
        
    } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));

    $mysqli->close();

    // ENV created
    // Set the ENV config file
    $envFile = "";
    $model = fopen ('.env', 'r');
    if($model){
        while (($line = stream_get_line($model, 1024 * 1024, "\n")) !== false) {
            $envFile .= $line."\n";
        }
    }else{
        echo json_encode(array("success" => false, "message" => "No standard model .ENV was found within the installation paste."));
        exit();
    }
    fclose($model);

    // Replace Data
    $envFile = str_replace("{{baseURL}}", $baseURL, $envFile);
    $envFile = str_replace("{{hostname}}", $host, $envFile);
    $envFile = str_replace("{{database}}", $dbname, $envFile);
    $envFile = str_replace("{{username}}", $dbuser, $envFile);
    $envFile = str_replace("{{password}}", $dbpassword, $envFile);
    $envFile = str_replace("{{DBPrefix}}", $dbprefix, $envFile);
    $envFile = str_replace("{{code}}", $purchase_code, $envFile);

    // Write New .ENV
    $env = fopen("../system/.env", "w") or die("Unable to open file!");
    fwrite($env, $envFile);
    fclose($env);

    echo json_encode(array("success" => true, "message" => "Installation successfull."));
    exit();
}
