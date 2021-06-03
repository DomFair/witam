<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $pdo = getPDO();

    if(!isset($Wname)){
        $Wname = '';
    }
    if(!isset($Wlastname)){
        $Wlastname = '';
    }
    if(!isset($Wsex)){
        $Wsex = '';
    }
    if(!isset($Wage)){
        $Wage = '';
    }
    if(!isset($EditSeachFirstName)){
        $EditSeachFirstName = '';
    }
    if(!isset($EditSeachLastName)){
        $EditSeachLastName = '';
    }
    if(!isset($NewFName)){
        $NewFName = '';
    }
    if(!isset($NewLName)){
        $NewLName = '';
    }
    if(!isset($NewSex)){
        $NewSex = '';
    }
    if(!isset($NewAge)){
        $NewAge = '';
    }
    if(!isset($DelSeachFirstName)){
        $DelSeachFirstName = '';
    }
    if(!isset($DelSeachLastName)){
        $DelSeachLastName = '';
    }
    if(!isset($CompFName)){
        $CompFName = '';
    }
    if(!isset($CompLName)){
        $CompLName = '';
    }
    if(!isset($Complaint)){
        $Complaint = '';
    }

        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){


        if(isset($_POST['Add-Form'])){
            $isThereAnError = 'False';
            $Wname = $_POST['workerName'];
            $Wlastname = $_POST['workerLName'];
            $Wsex = $_POST['workerSex'];
            $Wage = $_POST['workerAge'];
            if(empty($Wname)){
                $isThereAnError = 'True';
                $Wname_error = 'Please enter worker first name';
            }elseif(strlen($Wname) > 25){
                $isThereAnError = 'True';
                $Wname_error = 'Worker name must be less than 26 letters long';
            }elseif(preg_match('~[0-9]+~', $Wname)) {
                $isThereAnError = 'True';
                $Wname_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $Wname)){
                $isThereAnError = 'True';
                $Wname_error = 'Names can not contain special characters';
            }

            
            if(empty($Wlastname)){
                $isThereAnError = 'True';
                $Wlastname_error = 'Please enter worker last name';
            }elseif(strlen($Wlastname) > 25){
                $isThereAnError = 'True';
                $Wlastname_error = 'Worker name must be less than 26 letters long';
            }elseif(preg_match('~[0-9]+~', $Wlastname)) {
                $isThereAnError = 'True';
                $Wlastname_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $Wlastname)){
                $isThereAnError = 'True';
                $Wlastname_error = 'Names can not contain special characters';
            }
        
            if(empty($Wsex)){
                $isThereAnError = 'True';
                $Wsex_error = 'Please enter worker sex';
            }elseif(strlen($Wsex) > 25){
                $isThereAnError = 'True';
                $Wsex_error = 'input is too long';
            }elseif(preg_match('~[0-9]+~', $Wsex)) {
                $isThereAnError = 'True';
                $Wsex_error = 'Can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $Wsex)){
                $isThereAnError = 'True';
                $Wname_error = 'Can not contain special characters';
            }

        
            if(empty($Wage)){
                $isThereAnError = 'True';
                $Wage_error = 'Please enter worker age';
            }elseif(strlen($Wage) > 3){
                $isThereAnError = 'True';
                $Wage_error = 'Worker age must be less than 4 letters long';
            }
            if($isThereAnError == 'False'){

                $success = 'You have successfully added a new worker!';
                try{

                    $newWorker = "
                        INSERT INTO workers
                        (fname, lname, sex, age, currentlyEmployed)
                        VALUES
                        ('$Wname', '$Wlastname', '$Wsex', '$Wage', 1);
                    ";

                    $sql = $newWorker;
                    $pdo->exec($sql);

                }catch(PDOException $e){
                    die($e->getMessage());
                }
                $Wname = '';
                $Wlastname = '';
                $Wsex = '';
                $Wage = '';
            }
        }


        if(isset($_POST['Edit-Form'])){

            $isThereAnError = 'False';

            $EditSeachFirstName = $_POST['SearchWorkerFName'];
            $EditSeachLastName = $_POST['SearchWorkerLName'];

            $NewFName = $_POST['NewWorkerFName'];
            $NewLName = $_POST['NewWorkerLName'];
            $NewSex = $_POST['NewWorkerSex'];
            $NewAge = $_POST['NewWorkerAge'];

            if(empty($EditSeachFirstName)){
                $isThereAnError = 'True';
                $SFNerror = 'Please enter worker first name';
            }elseif(strlen($EditSeachFirstName) > 21){
                $isThereAnError = 'True';
                $SFNerror = 'Worker first name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $EditSeachFirstName)) {
                $isThereAnError = 'True';
                $SFNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $EditSeachFirstName)){
                $isThereAnError = 'True';
                $SFNerror = 'Names can not contain special characters';
            }


            if(empty($EditSeachLastName)){
                $isThereAnError = 'True';
                $SLNerror = 'Please enter worker last name';
            }elseif(strlen($EditSeachLastName) > 21){
                $isThereAnError = 'True';
                $SLNerror = 'Worker last name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $EditSeachLastName)) {
                $isThereAnError = 'True';
                $SLNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $EditSeachLastName)){
                $isThereAnError = 'True';
                $SLNerror = 'Names can not contain special characters';
            }

            if(strlen($NewFName) > 21){
                $isThereAnError = 'True';
                $NFNerror = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $NewFName)) {
                $isThereAnError = 'True';
                $NFNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $NewFName)){
                $isThereAnError = 'True';
                $NFNerror = 'Names can not contain special characters';
            }

            if(strlen($NewLName) > 21){
                $isThereAnError = 'True';
                $NLNerror = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $NewLName)) {
                $isThereAnError = 'True';
                $NLNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $NewLName)){
                $isThereAnError = 'True';
                $NLNerror = 'Names can not contain special characters';
            }

            if(strlen($NewSex) > 25){
                $isThereAnError = 'True';
                $NSerror = 'input is too long';
            }elseif(preg_match('~[0-9]+~', $NewSex)) {
                $isThereAnError = 'True';
                $NSerror = 'Can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $NewSex)){
                $isThereAnError = 'True';
                $NSerror = 'Can not contain special characters';
            }

            if(strlen($NewAge) > 3){
                $isThereAnError = 'True';
                $NAerror = 'Worker age must be less than 4 letters long';
            }

            if($isThereAnError == 'False'){
                try{

                    $searching = "
                    SELECT fname, lname, sex, age 
                    FROM workers
                    WHERE fname = '$EditSeachFirstName'
                    AND lname = '$EditSeachLastName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();

                    
                    

                    if($numRows==0){
                        $Editsuccess = 'Sorry, no worker of this name found';
                    }
                    else{
                        while($row = $searchResults->fetch()){
                            $tempFN = $row['fname'];
                            $tempLN = $row['lname'];
                            $tempS = $row['sex'];
                            $tempA = $row['age'];

                            if(empty($NewFName)){
                                $NewFName = $tempFN;
                            }
                            if(empty($NewLName)){
                                $NewLName = $tempLN;
                            }
                            if(empty($NewSex)){
                                $NewSex = $tempS;
                            }
                            if(empty($NewAge)){
                                $NewAge = $tempA;
                            }
                            $newInformation="
                            UPDATE workers
                            SET fname = '$NewFName', lname = '$NewLName', sex = '$NewSex', age ='$NewAge'
                            WHERE fname = '$EditSeachFirstName'
                            AND lname = '$EditSeachLastName'
                            AND currentlyEmployed = 1
                            ";

                            $pdo->exec($newInformation);
                            
                        }

                        $Editsuccess = 'Worker updated successfully!';
                        $NewFName = '';
                        $NewLName = '';
                        $NewSex = '';
                        $NewAge = '';
                    }

                }catch(PDOException $e){
                    die ($e->getMessage() );
                }
                
            }

        }

        if(isset($_POST['Delete-Form'])){
            $isThereAnError = 'False';

            $DelSeachFirstName = $_POST['DeleteWorkerFName'];
            $DelSeachLastName = $_POST['DeleteWorkerLName'];

            if(empty($DelSeachFirstName)){
                $isThereAnError = 'True';
                $DFNerror = 'Please enter worker first name';
            }elseif(strlen($DelSeachFirstName) > 21){
                $isThereAnError = 'True';
                $DFNerror = 'Worker first name must be less than 20 letters long';
            }elseif(preg_match('~[0-9]+~', $DelSeachFirstName)) {
                $isThereAnError = 'True';
                $DFNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $DelSeachFirstName)){
                $isThereAnError = 'True';
                $DFNerror = 'Names can not contain special characters';
            }

            if(empty($DelSeachLastName)){
                $isThereAnError = 'True';
                $DLNerror = 'Please enter worker last name';
            }elseif(strlen($DelSeachLastName) > 21){
                $isThereAnError = 'True';
                $DLNerror = 'Worker last name must be less than 20 letters long';
            }elseif(preg_match('~[0-9]+~', $DelSeachLastName)) {
                $isThereAnError = 'True';
                $DLNerror = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $DelSeachLastName)){
                $isThereAnError = 'True';
                $DLNerror = 'Names can not contain special characters';
            }

            if($isThereAnError == 'False'){
                try{

                    $searching = "
                    SELECT fname, lname, sex, age
                    FROM workers
                    WHERE fname = '$DelSeachFirstName'
                    AND lname = '$DelSeachLastName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();

                    
                    

                    if($numRows==0){
                        $Delsuccess = 'Sorry, no worker of this name found';
                    }
                    else{

                            $delete="
                            UPDATE workers
                            SET currentlyEmployed = 0
                            WHERE fname = '$DelSeachFirstName'
                            AND lname = '$DelSeachLastName'
                            ";

                            $pdo->exec($delete);

                        $Delsuccess = 'Worker Deleted successfully!';
                        
                        }

                }catch(PDOException $e){
                    die ($e->getMessage() );
                }
                
            }
        }

       
    }



    function getPDO(){
        require_once 'inc.db.php';

        try {
            $pdo = new PDO(CONNECT_MYSQL, USER, PWD);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        return $pdo;

        } catch (PDOException $e) {
            die($e->getMessage());
        
        }
    }

    function buildWorkers($pdo){


        try{
            $workers = "
            SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 1
            ";


            $rows = $pdo->query($workers);
            
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <table id='workersTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#009879;color:#123;font-weight:bold;'>
                            <th style='padding:12px'>Name</th>
                            <th style='padding:12px'>Sex</th>
                            <th style='padding:12px'>Age</th>
                        </tr>

                        <style>
                            table#workersTable tr:nth-child(even) { background-color:rgba(0, 152, 121, .1) }
                        </style>
                    
                
            ";
        
            while($row = $rows->fetch()){
                $fname = $row['fname'];
                $lname = $row['lname'];
                $sex = $row['sex'];
                $age = $row['age'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$sex</td>
                        <td style='padding:12px'>$age</td>
                    </tr>
        
        
                ";
        
        
        
            }
            echo "
                </table>
                </div>
            ";

        }catch(PDOException $e){
            die ($e -> getMessage());
        }



    }

    function buildExWorkers($pdo){

        try{
            $workers = "
                SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 0
            ";


            $rows = $pdo->query($workers);
            
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <table id='workersTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#009879;color:#123;font-weight:bold;'>
                            <th style='padding:12px'>Name</th>
                            <th style='padding:12px'>Sex</th>
                            <th style='padding:12px'>Age</th>
                        </tr>

                        <style>
                            table#workersTable tr:nth-child(even) { background-color:rgba(0, 152, 121, .1) }
                        </style>
                    
                
            ";
        
            while($row = $rows->fetch()){
                $fname = $row['fname'];
                $lname = $row['lname'];
                $sex = $row['sex'];
                $age = $row['age'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$sex</td>
                        <td style='padding:12px'>$age</td>
                    </tr>
        
        
                ";
        
        
        
            }
            echo "
                </table>
                </div>
            ";

        }catch(PDOException $e){
            die ($e -> getMessage());
        }



    }

    function buildComplaintsCurrent($pdo){
        try{

            $complaints = "
            SELECT workers.fname, workers.lname, complaints.date, complaints.time, complaints.complaint
            FROM complaints, workers
            WHERE complaints.worker\$id = workers.id
            AND workers.currentlyEmployed = 1
            ";


            $rows = $pdo->query($complaints);
            
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <table id='complaintsTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#ff0000;color:#123;font-weight:bold;'>
                            <th style='padding:12px;min-width:30px'>Worker Name</th>
                            <th style='padding:12px;min-width:30px'>Date</th>
                            <th style='padding:12px;min-width:30px'>Time</th>
                            <th style='padding:12px;max-width:400px;'>Complaint</th>
                        </tr>

                        <style>
                            table#complaintsTable tr:nth-child(even) { background-color:rgba(255, 0, 0, .1) }
                        </style> 
            ";

            while($row = $rows->fetch()){
                $fname = $row['fname'];
                $lname = $row['lname'];
                $date = $row['date'];
                $time = $row['time'];
                $complaint = $row['complaint'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$date</td>
                        <td style='padding:12px'>$time</td>
                        <td style='padding:12px;max-width:400px'>$complaint</td>
                    </tr>
        
        
                ";
        
        
        
            }
            echo "
                </table>
                </div>
            ";

        }catch(PDOException $e){
            die ($e->getMessage());
        }
    }
    function buildComplaintsEx($pdo){
        try{

            $complaints = "
            SELECT workers.fname, workers.lname, complaints.date, complaints.time, complaints.complaint
            FROM complaints, workers
            WHERE complaints.worker\$id = workers.id
            AND workers.currentlyEmployed = 0
            ";


            $rows = $pdo->query($complaints);
            
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <table id='complaintsTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#ff0000;color:#123;font-weight:bold;'>
                            <th style='padding:12px;min-width:30px'>Worker Name</th>
                            <th style='padding:12px;min-width:30px'>Date</th>
                            <th style='padding:12px;min-width:30px'>Time</th>
                            <th style='padding:12px;max-width:400px;'>Complaint</th>
                        </tr>

                        <style>
                            table#complaintsTable tr:nth-child(even) { background-color:rgba(255, 0, 0, .1) }
                        </style> 
            ";

            while($row = $rows->fetch()){
                $fname = $row['fname'];
                $lname = $row['lname'];
                $date = $row['date'];
                $time = $row['time'];
                $complaint = $row['complaint'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$date</td>
                        <td style='padding:12px'>$time</td>
                        <td style='padding:12px;max-width:400px'>$complaint</td>
                    </tr>
        
        
                ";
        
        
        
            }
            echo "
                </table>
                </div>
            ";

        }catch(PDOException $e){
            die ($e->getMessage());
        }
    }
    
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link href="style.css" rel="stylesheet">
    <title>Assessment Home Page</title>
</head>

<body>
    
    <ul class="tabs">
        <li data-tab-target="#tableOne" class = "active tab">Current Work Staff</li>
        <li data-tab-target="#tableTwo" class = "tab">Old Work Staff</li>
    </ul>



    
        
            <div class = "content" >
                <div id="tableOne" data-tab-content class="active">
                    <div id = "container">
                        <div class = "left">
                            <h1>Current Worker List</h1>
                            <?php echo buildWorkers($pdo); ?>
                            <div class = "containerBot">
                            <div class = "botLeft">
                                <button id='EditWorkerButton'>Edit Worker</button>
                                <?php if(isset($Editsuccess)){ ?>
                                        <p><?php echo $Editsuccess ?><p>
                                <?php } ?>
                                <div id="EditWorkerDiv" style='padding: 10px;display:none;'>
                                    <form id="form-edit-Worker"name='editWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <h3>Please enter the first and last name of the person you want to edit</h3>
                                        <br>
                                        <input maxlength="20" name="SearchWorkerFName" placeholder = "First Name" value="<?php echo htmlspecialchars($EditSeachFirstName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($SFNerror)){ ?>
                                            <p><?php echo $SFNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="SearchWorkerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($EditSeachLastName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($SLNerror)){ ?>
                                            <p><?php echo $SLNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <h4>Enter new Information</h4>
                                        <p>All information left empty will not be updated!</p>
                                        <br>
                                        <input maxlength="20" name="NewWorkerFName" placeholder = "Update First Name" value="<?php echo htmlspecialchars($NewFName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($NFNerror)){ ?>
                                            <p><?php echo $NFNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="NewWorkerLName" placeholder = "Update Last Name" value="<?php echo htmlspecialchars($NewLName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($NLNerror)){ ?>
                                            <p><?php echo $NLNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="25" name="NewWorkerSex" placeholder = "Update Sex" value="<?php echo htmlspecialchars($NewSex) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($NSerror)){ ?>
                                            <p><?php echo $NSerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input  type='number' maxlength="3" name="NewWorkerAge" placeholder = "Update Age" value="<?php echo htmlspecialchars($NewAge) ?>">
                                        <br>
                                        <?php if(isset($NAerror)){ ?>
                                            <p><?php echo $NAerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Edit-Form' value='submit'>
                                    </form>
                                    
                                
                                </div>  
                            </div>
                            <div class = "botMid">
                                <button id='addWorkerButton'>Add Worker</button>
                                    <?php if(isset($success)){ ?>
                                        <p><?php echo $success ?><p>
                                    <?php } ?>
                                <div id="addWorkerDiv" style='padding: 10px;display:none;'>
                                    <form id="form-add-Worker"name='addWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <br>
                                        <input maxlength="20" name="workerName" placeholder = "First Name" value="<?php echo htmlspecialchars($Wname) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($Wname_error)){ ?>
                                            <p><?php echo $Wname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="workerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($Wlastname) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($Wlastname_error)){ ?>
                                            <p><?php echo $Wlastname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="25" name="workerSex" placeholder = "Sex" value="<?php echo htmlspecialchars($Wsex) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($Wsex_error)){ ?>
                                            <p><?php echo $Wsex_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input  type='number' maxlength="3" name="workerAge" placeholder = "Enter Age" value="<?php echo htmlspecialchars($Wage) ?>">
                                        <br>
                                        <?php if(isset($Wage_error)){ ?>
                                            <p><?php echo $Wage_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Add-Form' value='submit'>
                                    </form>
                                        
                                </div>
                            </div>
                            <div class='botRight'>
                                <button id='DeleteWorkerButton'>Delete Worker</button>
                                    <?php if(isset($Delsuccess)){ ?>
                                        <p><?php echo $Delsuccess ?><p>
                                    <?php } ?>
                                <div id="DeletetWorkerDiv" style='padding: 10px;display:none;'>
                                <form id="form-Delete-Worker"name='deleteWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <h3>Please enter the first and last name of the person you want to edit</h3>
                                        <br>
                                        <input maxlength="20" name="DeleteWorkerFName" placeholder = "First Name" value="<?php echo htmlspecialchars($DelSeachFirstName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($DFNerror)){ ?>
                                            <p><?php echo $DFNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="DeleteWorkerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($DelSeachLastName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($DLNerror)){ ?>
                                            <p><?php echo $DLNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Delete-Form' value='submit'>
                                    </form>
                                </div> 
                            </div>
                        </div>
                        </div>
                        <div class = "right">
                            <h1>Complaints</h1>
                            <?php echo buildComplaintsCurrent($pdo); ?>
                            <div class = "containerBot">
                                <div class = "botLeft">
                                    <button id='EditCompButton'>Edit Complaint</button>
                                    <div id="EditCompDiv" style='padding: 10px;display:none;'>
                                        <p>edit</p>
                                    </div>
                                </div>
                                <div class = "botMid">
                                    <button id='addCompButton'>Add Complaint</button>
                                    <div id="AddCompDiv" style='padding: 10px;display:none;'>
                                    <br>
                                        <input maxlength="20" name="CompFName" placeholder = "First Name" value="<?php echo htmlspecialchars($CompFName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($Wname_error)){ ?>
                                            <p><?php echo $Wname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="CompLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($CompLName) ?>" onkeyup="lettersOnly(this)">
                                        <br>
                                        <?php if(isset($Wlastname_error)){ ?>
                                            <p><?php echo $Wlastname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type="date" name="date">
                                        <br>
                                        <br>
                                        <input maxlength="500" name="complaint" placeholder = "Enter Complaint" value="<?php echo htmlspecialchars($Complaint) ?>">
                                        <br>
                                        <?php if(isset($Wsex_error)){ ?>
                                            <p><?php echo $Wsex_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Delete-Form' value='submit'>
                                    </div>
                                </div>
                                <div class='botRight'>
                                    <button id='DeleteCompButton'>Delete Complaint</button>
                                    <div id="DeleteCompDiv" style='padding: 10px;display:none;'>
                                        <p>del</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>  
                <div id="tableTwo" data-tab-content>
                <div id = "container">
                    <div class = "left">
                        <h1>Ex-Worker List</h1>
                        <?php echo buildExWorkers($pdo); ?>
                            <div class = "containerBot">
                                <div class = "botLeft">
                                    
                                </div>
                                <div class = "botMid">
                                    
                                </div>
                                <div class='botRight'>
                                    
                                </div>
                            </div>
                    </div>  
                    <div class = "right">
                        <h1>Complaints</h1>
                        <?php echo buildComplaintsEx($pdo); ?>
                            <div class = "containerBot">
                                <div class = "botLeft">
                                    
                                </div>
                                <div class = "botMid">
                                    
                                </div>
                                <div class='botRight'>
                                    
                                </div>
                            </div>
                    </div>
                </div>
                </div>
            </div>
   
</body>
</html>