<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $academicyear = isset($_POST["academicyear"]) ? $_POST["academicyear"] : "";
    $firstname = isset($_POST["examplename1"]) ? $_POST["examplename1"] : "";
    $lastname = isset($_POST["examplename2"]) ? $_POST["examplename2"] : "";
    $number = isset($_POST["exampleno1"]) ? $_POST["exampleno1"] : "";
    $email = isset($_POST["exampleInputEmail1"]) ? $_POST["exampleInputEmail1"] : "";
    $dob = isset($_POST["date"]) ? $_POST["date"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $bloodGroup = isset($_POST["bloodGroup"]) ? $_POST["bloodGroup"] : "";
    $presentAddress = isset($_POST["presentAddress"]) ? $_POST["presentAddress"] : "";
    $permanentAddress = isset($_POST["permanentAddress"]) ? $_POST["permanentAddress"] : "";
    $age = isset($_POST["age"]) ? $_POST["age"] : "";
    $height = isset($_POST["height"]) ? $_POST["height"] : "";
    $weight = isset($_POST["weight"]) ? $_POST["weight"] : "";
    $eyesight = isset($_POST["eyeSight"]) ? $_POST["eyeSight"] : "";
    $previousMembership = isset($_POST["info1"]) ? $_POST["info1"] : "";
    $extraCurricular = isset($_POST["info2"]) ? $_POST["info2"] : "";
    $hobbies = isset($_POST["msg1"]) ? $_POST["msg1"] : "";
    $seriousIllness = isset($_POST["msg2"]) ? $_POST["msg2"] : "";
    $country = isset($_POST["country"]) ? $_POST["country"] : "";
    $state = isset($_POST["state"]) ? $_POST["state"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $branch = isset($_POST["branch"]) ? $_POST["branch"] : "";
    $section = isset($_POST["section"]) ? $_POST["section"] : "";
    $year = isset($_POST["year"]) ? $_POST["year"] : "";

 if ($_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
    $photoTmpName = $_FILES["photo"]["tmp_name"];
    $photoExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $photoNewName = $firstname . "_" . $lastname . "." . $photoExtension;
    $photoPath = "uploads/photos/" . $photoNewName; 

    if (move_uploaded_file($photoTmpName, $photoPath)) {
     
    } else {
        echo "Error moving uploaded photo.";
    }
} else {
    echo "Error uploading photo: " . $_FILES["photo"]["error"];
}

if ($_FILES["sign"]["error"] == UPLOAD_ERR_OK) {
    $signatureTmpName = $_FILES["sign"]["tmp_name"];
    $signatureExtension = pathinfo($_FILES["sign"]["name"], PATHINFO_EXTENSION);
    $signatureNewName = $firstname . "_" . $lastname . "." . $signatureExtension; 
    $signaturePath = "uploads/signatures/" . $signatureNewName; 

    if (move_uploaded_file($signatureTmpName, $signaturePath)) {
        
    } else {
        echo "Error moving uploaded signature.";
    }
} else {
    echo "Error uploading signature: " . $_FILES["sign"]["error"];
}


    if (!empty($academicyear)) {
        $sql = "INSERT INTO userdata (academicYear, firstname, lastname, number, email, dob, gender, bloodGroup, presentAddress, permanentAddress, age, height, weight, eyesight, previousMembership, extraCurricular, hobbies, seriousIllness, country, state, city, branch, section, year, photo_path, signature_path) 
        VALUES ('$academicyear', '$firstname', '$lastname', '$number', '$email', '$dob', '$gender', '$bloodGroup', '$presentAddress', '$permanentAddress', '$age', '$height', '$weight', '$eyesight', '$previousMembership', '$extraCurricular', '$hobbies', '$seriousIllness', '$country', '$state', '$city', '$branch', '$section', '$year', '$photoPath', '$signaturePath')";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "Error: " . $conn->error;
        } else {
            if ($stmt->execute()) {
                echo "";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } else {
        echo "Academic year is empty. Please select a valid academic year.";
    }

   



}



$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <style>
            p{
                margin: 0;
                padding: 0;
            }
            label p.form_space>span{
                display: inline-block;
                min-width: 200px;

            }
            .signstudent{
                float: right;
            }
            .dashedline{
                border-top: 1px dashed #000;
                width: 100%;
                height: 0;
            }
            .forward{
                display: flex;
                justify-content: space-between;
            }
            .fullform{
                font-size: 14px;
            }
            .photo{
                margin-right: 30px;
                margin-top: 15px;
            }
            .divphoto{
                display: flex;
                justify-content: space-between;
            }
            .phy .lista{
                display: flex;

            }
            .phy{
                display: flex;
            }
            
            .signature-container {
                float: right; 
            }
            #printButton {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #printButton:hover {
            background-color: #0056b3;
        }
        @media print {
            #printButton {
                display: none;
            }
        }
        </style>
    </head>
    <body>
        <div class="fullform">
            <center>
            <button type="button" id="printButton">Print</button>
            <h1 class="ramco"><b>RAMCO INSTITUTE OF TECHNOLOGY</b></h1>
            <h2 class="aca"><b>Academic Year: <?php echo $academicyear; ?></b></h2>
            <h2 class="ramco"><b>(NSS/NCC/YRC etc)</b></h2>
            
            <h2 class="ramco"><b>REGISTRATION FORM</b></h2>
            <br>
            </center>
        <form>
        <div class="divphoto">
        <div>
        <label for="Name"><p class="form_space"><span><b>Name of the Student</span>: </b><?php echo $firstname . ' ' . $lastname; ?></p></label><br>
        <label for="Branch"><p class="form_space"><span><b>Branch, Section & Year of Study</span>: </b><?php echo $branch . ', ' . $section . ', ' . $year; ?></p></label><br>
        <label for="Blood"><p class="form_space"><span><b>Blood Group</span>: </b><?php echo $bloodGroup; ?></p></label><br>
        <label for="dob"><p class="form_space"><span><b>Date of Birth and Age</span>: </b><?php echo $dob . ', ' . $age; ?></p></label><br>
        <label for="address"><p class="form_space"><span><b>Present Address</span>: </b><?php echo $presentAddress; ?></p></label><br>
        <label for="phone"><p class="form_space"><span><b>Contact Phone No</span>: </b><?php echo $number; ?></p></label><br>
        <label for="Email"><p class="form_space"><span><b>Email ID</span>: </b><?php echo $email; ?></p></label><br>
        <label for="Paddress"><p class="form_space"><span><b>Permanent Address</span>: </b><?php echo $permanentAddress; ?></p></label><br>
         <label for="Membership"><p class="form_space"><span><b>Details of previous Membership</span>: </b><?php echo $previousMembership; ?></p><p>(in NSS, YRC, NCC etc.)</p></label><br>

        <label for="Extra"><p class="form_space"><span><b>Membership Details in other<br>Extra Curricular Activities</span>: </b><?php echo $extraCurricular; ?></p></label><br>

    </div>
        <div class="photo">
            <p style="margin-top: 1px;"><b>Photo: </b></p>
            <?php
    $photoExtensions = ["jpg", "jpeg", "png"]; 

    $photoPath = "";
    foreach ($photoExtensions as $extension) {
        $path = "uploads/photos/" . $firstname . "_" . $lastname . "." . $extension;
        if (file_exists($path)) {
            $photoPath = $path;
            break; 
        }
    }

    if (!empty($photoPath)) {
        echo '<img src="' . $photoPath . '" alt="User Photo" width="150">';
    } else {
        echo 'Photo not found';
    }
    ?>
            </div>
        </div>
               <div class="phy">
            <div>
                <p><b>Physical standards:            </b></p>
            </div>
            <div class="lista">
                <p style="margin-left: 25px;">    <b> a) Height : </b><?php echo $height; ?></p>
                <p style="margin-left: 75px;"><b>b) Weight : </b><?php echo $weight; ?></p>
                <p style="margin-left: 75px;"><b>c) Eye sight : </b><?php echo $eyesight; ?></p>
            </div>
        
        </div>
        <br>
        <label for="Indicate"><p class="form_space"><span><b>Hobbies and Interest:</span>: </b><?php echo $hobbies; ?></p></label><br>
        <label for="hobbie"><p class="form_space"><span><b>Indicate/Report any serious illness</span>: </b><?php echo $seriousIllness; ?></p></label><br><br>
        
        <div class="signature-container">
            <p class="signstudent"><b>Signature of the Student</b></p><br><br>
            <?php
    $signatureExtensions = ["jpg", "jpeg", "png"]; 

    $signaturePath = "";
    foreach ($signatureExtensions as $extension) {
        $path = "uploads/signatures/" . $firstname . "_" . $lastname . "." . $extension;
        if (file_exists($path)) {
            $signaturePath = $path;
            break; 
        }
    }

    if (!empty($signaturePath)) {
        echo '<img src="' . $signaturePath . '" alt="User Signature" width="150">';
    } else {
        echo 'Signature not found';
    }
    ?>
</div>
<br><br>
<br>
<br><br>
<br><br>
<br>

        <div class="dashedline"></div>
        <br>
        <br><br>
        <div class="forward">
            <div>Forward by Class Advisor</div>
            <div>Recommendation of HOD</div>
        </div>
        <br>
        <div class="dashedline"></div>
        <center>
            <br>
        <p><b>For Office only</b></p>
        </center>
        <br>
        <div class="forward">
            <div>Remarks:</div>
            <div>Selected/Not selected</div>
        </div>
        <br>
        <label for="Name">Membership Details, if selected:</label><br>
        <p class="signstudent">Signature of the Faculty Coordinator</p><br><br>
        </form>
        </div>
       

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print();
        });
    </script>
    </body>
</html>
