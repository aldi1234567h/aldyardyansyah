<?php
include("../koneksi/koneksi.php");

// Set the appropriate headers for handling CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

$response = array(); // Initialize an array to store the response data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["new-username"]) && isset($data["new-password"]) && isset($data["confirm-password"]) && isset($data["telepon"])) {
        $username = $data["new-username"];
        $password = $data["new-password"];
        $confirmPassword = $data["confirm-password"];
        $telepon = $data["telepon"];

        // Check if passwords match
        if ($password != $confirmPassword) {
            $response["error"] = "Password and Confirm Password do not match.";
        } else {
            // Check if username exists
            $checkQuery = "SELECT * FROM `tbl_user` WHERE `username` = '$username'";
            $result = mysqli_query($koneksi, $checkQuery);

            if (mysqli_num_rows($result) > 0) {
                $response["error"] = "Username already exists. Please choose another username.";
            } else {
                // Use prepared statement to prevent SQL injection
                $query = "INSERT INTO `tbl_user`(`username`, `password`, `telepon`) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($koneksi, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $telepon);
                    mysqli_stmt_execute($stmt);

                    $response["message"] = "Registration successful.";
                } else {
                    $response["error"] = "Registration failed: " . mysqli_error($koneksi);
                }
            }
        }
    } else {
        $response["error"] = "Form fields are not set.";
    }
} else {
    $response["error"] = "Invalid request method.";
}

// Convert the response array to JSON format and echo it
echo json_encode($response);
?>
