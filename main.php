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
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $isThereAnError = 'False';
        $Wname = $_POST['workerName'];
        $Wlastname = $_POST['workerLName'];
        $Wsex = $_POST['workerSex'];
        $Wage = $_POST['workerAge'];
        $phpScript = $_SERVER['PHP_SELF'];
        if(empty($Wname)){
            $isThereAnError = 'True';
            $Wname_error = 'Please enter worker name';
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
            $Wlastname_error = 'Please enter worker name';
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
            $Wage_error = 'Worker name must be less than 4 letters long';
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
                            <button id='addWorkerButton'>Add Worker</button>

                            <div id="addWorkerDiv" style='padding: 10px;'>
                                <form name='addWorker' action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <br>
                                    <input maxlength="20" name="workerName" placeholder = "First" value="<?php echo htmlspecialchars($Wname) ?>" onkeyup="lettersOnly(this)">
                                    <br>
                                    <?php if(isset($Wname_error)){ ?>
                                        <p><?php echo $Wname_error ?><p>
                                    <?php } ?>
                                    <br>
                                    <input maxlength="20" name="workerLName" placeholder = "Last" value="<?php echo htmlspecialchars($Wlastname) ?>" onkeyup="lettersOnly(this)">
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
                                    <input  type='number' maxlength="3" name="workerAge" placeholder = "Enter Age" >
                                    <br>
                                    <?php if(isset($Wage_error)){ ?>
                                        <p><?php echo $Wage_error ?><p>
                                    <?php } ?>
                                    <br>
                                    <input type='submit' value='submit'>
                                </form>
                                    <?php if(isset($success)){ ?>
                                        <p><?php echo $success ?><p>
                                    <?php } ?>
                            </div>
                        </div>
                        <div class = "right">
                            <h1>Complaints</h1>
                            <?php echo buildComplaintsCurrent($pdo); ?>
                        </div>
                        </div>
                    </div>  
                <div id="tableTwo" data-tab-content>
                <div id = "container">
                    <div class = "left">
                        <h1>Ex-Worker List</h1>
                        <?php echo buildExWorkers($pdo); ?>
                    </div>  
                    <div class = "right">
                        <h1>Complaints</h1>
                        <?php echo buildComplaintsEx($pdo); ?>
                    </div>
                </div>
                </div>
            </div>
   
</body>
</html>