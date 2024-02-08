<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    // Retrieve the submitted data by querying your database
    $qry = $conn->query("SELECT * FROM userdata WHERE id=" . $_GET['id'])->fetch_array();

    // Check if data is found
    if ($qry) {
        // Assign retrieved data to variables
        $academicYear = $qry['academicYear'];
        $dob = $qry['dob'];
        $firstname = $qry['firstname'];
        $lastname = $qry['lastname'];
        $number = $qry['number'];
        $email = $qry['email'];
        // Add more fields as needed
    } else {
        // Handle the case where data is not found
        die("Data not found.");
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Receipt</title>
    <style>
        /* Add your CSS styles for the printable receipt here */
        /* For example, you can define styles for the receipt header, body, and footer */
        body {
            font-family: Arial, sans-serif;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-footer {
            text-align: center;
        }

        /* Define other styles as needed */
    </style>
</head>
<body>
    <div class="receipt-header">
        <h2><b>Registration Receipt</b></h2>
    </div>
    <div class="receipt-body">
        <p><b>Academic Year:</b> <?php echo $academicYear; ?></p>
        <p><b>Date of Birth:</b> <?php echo $dob; ?></p>
        <p><b>First Name:</b> <?php echo $firstname; ?></p>
        <p><b>Last Name:</b> <?php echo $lastname; ?></p>
        <p><b>Phone Number:</b> <?php echo $number; ?></p>
        <p><b>Email:</b> <?php echo $email; ?></p>
        <!-- Add more fields as needed -->
    </div>
    <!-- Rest of the receipt body content here -->
    <div class="receipt-footer">
        <p><i>This is not an official receipt.</i></p>
    </div>

    <!-- JavaScript to automatically trigger printing when the page is loaded -->
    <script>
        // Automatically trigger the print dialog when the page is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
