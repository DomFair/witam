<?php

    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $pdo = getPDO();
    
    //setting all the variables to empty if there is currently no value set
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
    if(!isset($ESearchCompFName)){
        $ESearchCompFName = '';
    }
    if(!isset($ESearchCompLName)){
        $ESearchCompLName = '';
    }
    if(!isset($newComplaint)){
        $newComplaint = '';
    }
    if(!isset($DSearchCompFName)){
        $DSearchCompFName = '';
    }
    if(!isset($DSearchCompLName)){
        $DSearchCompLName = '';
    }
    // when posted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // each of these if statements is checking which form is being submitted so it knows what to process and how to do it
        // this if statement is when a new complaint it trying to be added
        if(isset($_POST['Add-Complaint-Form'])){
            // getting variables
            $isThereAnError = 'False';
            $CompFName = $_POST['CompFName'];
            $CompLName = $_POST['CompLName'];
            $Complaint = addslashes($_POST['complaint']);
            $date = $_POST['compdate'];
            

            //checking to make sure all of the user inputs are correct
            if(empty($CompFName)){
                $isThereAnError = 'True';
                $CompFName_error = 'Please enter worker first name';
            }elseif(strlen($CompFName) > 21){
                $isThereAnError = 'True';
                $CompFName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $CompFName)) {
                $isThereAnError = 'True';
                $CompFName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $CompFName)){
                $isThereAnError = 'True';
                $CompFName_error = 'Names can not contain special characters';
            }

            if(empty($CompLName)){
                $isThereAnError = 'True';
                $CompLName_error = 'Please enter worker first name';
            }elseif(strlen($CompLName) > 21){
                $isThereAnError = 'True';
                $CompLName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $CompLName)) {
                $isThereAnError = 'True';
                $CompLName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $CompLName)){
                $isThereAnError = 'True';
                $CompLName_error = 'Names can not contain special characters';
            }
            if(empty($Complaint)){
                $isThereAnError = 'True';
                $Complaint_error = 'Please enter worker first name';
            }elseif(strlen($Complaint) > 501){
                $isThereAnError = 'True';
                $Complaint_error = 'Worker name must be less than 501 characters long';
            }
            //once their are no errors in the values the user input, it will continue
            if($isThereAnError == 'False'){

                
                try{
                    //making sure there is a worker by this name
                    $who = "
                    SELECT fname, lname, id 
                    FROM workers
                    WHERE fname = '$CompFName'
                    AND lname = '$CompLName'
                    AND currentlyEmployed = 1
                    ";

                    $results = $pdo->query($who);
                    $numRows = $results->rowCount();

                    
                    
                    // if there are 0 rows returned, there was no worker found with this name
                    if($numRows==0){
                        $CompAddsuccess = 'Sorry, no worker of this name found';
                    }else{
                        while($row = $results->fetch()){
                            $tempFN = $row['fname'];
                            $tempLN = $row['lname'];
                            $id = $row['id'];
                        }
                    

                        // there was a worker of that name found, so we are inserting the new complaint
                        $insrt = "
                            INSERT INTO complaints
                            (worker\$id, date, complaint)
                            VALUES
                            ('$id', '$date', '$Complaint');
                        ";

                        $sql = $insrt;
                        $pdo->exec($sql);
                        $CompAddsuccess = 'Complaint successfully added!';
                    }

                }catch(PDOException $e){
                    die($e->getMessage());
                }
                $CompFName = '';
                $CompLName = '';
                $Complaint = '';
                
            }



        }
        // this if statement is to edit a complaint
        if(isset($_POST['Edit-Complaint-Form'])){
            $isThereAnError = 'False';
            $EsearchCompFName = $_POST['ESearchCompFName'];
            $EsearchCompLName = $_POST['ESearchCompLName'];
            $Esearchdate = $_POST['ESearchcompdate'];
            $newComplaint = addslashes($_POST['Newcomplaint']);

            //checking input
            if(empty($EsearchCompFName)){
                $isThereAnError = 'True';
                $ECompFName_error = 'Please enter worker first name';
            }elseif(strlen($EsearchCompFName) > 21){
                $isThereAnError = 'True';
                $ECompFName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $EsearchCompFName)) {
                $isThereAnError = 'True';
                $ECompFName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $EsearchCompFName)){
                $isThereAnError = 'True';
                $ECompFName_error = 'Names can not contain special characters';
            }

            if(empty($EsearchCompLName)){
                $isThereAnError = 'True';
                $ECompLName_error = 'Please enter worker first name';
            }elseif(strlen($EsearchCompLName) > 21){
                $isThereAnError = 'True';
                $ECompLName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $EsearchCompLName)) {
                $isThereAnError = 'True';
                $ECompLName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $EsearchCompLName)){
                $isThereAnError = 'True';
                $ECompLName_error = 'Names can not contain special characters';
            }
            if(empty($newComplaint)){
                $isThereAnError = 'True';
                $EComplaint_error = 'Please enter worker first name';
            }elseif(strlen($newComplaint) > 501){
                $isThereAnError = 'True';
                $EComplaint_error = 'Worker name must be less than 501 characters long';
            }

            if($isThereAnError == 'False'){
                try{
                    //searching for the worker
                    $searching = "
                    SELECT id
                    FROM workers
                    WHERE fname = '$EsearchCompFName'
                    AND lname = '$EsearchCompLName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();

                    //getting the id of the worker based on their name
                    while($row = $searchResults->fetch()){
                        
                        $id = $row['id'];
                    }
                    
                    // if === to 0, no workers of the entered name were found.
                    if($numRows==0){
                        $ECompsuccess = 'No worker of this name has a complaint';
                    }
                    else{
                            //searching for the complain they want to edit based on the search date and id, which is linked to the name that was entered.
                            $isthere="
                            SELECT date
                            FROM complaints
                            WHERE worker\$id = '$id'
                            AND date = '$Esearchdate'
                            ";
                            $searchResults = $pdo->query($isthere);
                            $numRows = $searchResults->rowCount();

                    
                    
                            // if there can not be any complaints found, it will be equal to 0
                            if($numRows==0){
                                $ECompsuccess = 'Sorry, no complaint found!';
                            }else{
                            

                            // there was a complaint found, so we are updating it with the new complaint
                            $EditInformation="
                            UPDATE complaints
                            SET complaint = '$newComplaint'
                            WHERE worker\$id = '$id'
                            AND date = '$Esearchdate'
                            ";

                            $pdo->exec($EditInformation);
                            
                        

                        $ECompsuccess = 'Successfully Edited the complaint!';
                        $EsearchCompFName = '';
                        $EsearchCompLName = '';
                            }
                        
                    }

                }catch(PDOException $e){
                    die ($e->getMessage() );
                }
                
            }

        }
        //this if statement is to delete a complaint
        if(isset($_POST['Delete-Complaint-Form'])){
            $isThereAnError = 'False';
            $DsearchCompFName = $_POST['DSearchCompFName'];
            $DsearchCompLName = $_POST['DSearchCompLName'];
            $Dsearchdate = $_POST['DSearchcompdate'];
            

            //checking input
            if(empty($DsearchCompFName)){
                $isThereAnError = 'True';
                $ECompFName_error = 'Please enter worker first name';
            }elseif(strlen($DsearchCompFName) > 21){
                $isThereAnError = 'True';
                $DCompFName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $DsearchCompFName)) {
                $isThereAnError = 'True';
                $DCompFName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $DsearchCompFName)){
                $isThereAnError = 'True';
                $DCompFName_error = 'Names can not contain special characters';
            }

            if(empty($DsearchCompLName)){
                $isThereAnError = 'True';
                $DCompLName_error = 'Please enter worker first name';
            }elseif(strlen($DsearchCompLName) > 21){
                $isThereAnError = 'True';
                $DCompLName_error = 'Worker name must be less than 21 letters long';
            }elseif(preg_match('~[0-9]+~', $DsearchCompLName)) {
                $isThereAnError = 'True';
                $DCompLName_error = 'Names can not contain numbers';
            }elseif(preg_match('/[^a-zA-Z\d]/', $DsearchCompLName)){
                $isThereAnError = 'True';
                $DCompLName_error = 'Names can not contain special characters';
            }

            if($isThereAnError == 'False'){
                try{
                    //looking for the worker
                    $searching = "
                    SELECT id
                    FROM workers
                    WHERE fname = '$DsearchCompFName'
                    AND lname = '$DsearchCompLName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();
                    // getting the id of the worker
                    while($row = $searchResults->fetch()){
                        $id = $row['id'];
                    }
                    

                    if($numRows==0){
                        $DCompsuccess = 'This worker was not found';
                    }
                    else{
                        

                            //checking to see if the complaint that wants to be deleted is found
                            $isthere="
                            SELECT date
                            FROM complaints
                            WHERE worker\$id = '$id'
                            AND date = '$Dsearchdate'
                            ";
                            $searchResults = $pdo->query($isthere);
                            $numRows = $searchResults->rowCount();

                    
                    
                            // if no complaint of this information is found, it be equal to 0
                            if($numRows==0){
                                $DCompsuccess = 'Sorry, no complaint found!';
                            }else{
                            // deleting the complaint with the given information
                            $delete="
                            DELETE FROM complaints
                            WHERE worker\$id = $id
                            AND date = '$Dsearchdate'
                            ";

                            $pdo->exec($delete);
                            $DCompsuccess = 'Complaint deleted successfully!';
                            $DsearchCompFName = '';
                            $DsearchCompLName = '';
                            }
                        

                        }

                }catch(PDOException $e){
                    die ($e->getMessage() );
                }
                
            }


        }
        // this if statement is to add a new worker
        if(isset($_POST['Add-Form'])){
            $isThereAnError = 'False';
            $Wname = $_POST['workerName'];
            $Wlastname = $_POST['workerLName'];
            $Wsex = $_POST['workerSex'];
            $Wage = $_POST['workerAge'];
            //checking input
            if(empty($Wname)){
                $isThereAnError = 'True';
                $Wname_error = 'Please enter worker first name';
            }elseif(strlen($Wname) > 21){
                $isThereAnError = 'True';
                $Wname_error = 'Worker name must be less than 21 letters long';
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
            }elseif(strlen($Wlastname) > 21){
                $isThereAnError = 'True';
                $Wlastname_error = 'Worker name must be less than 21 letters long';
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
            }elseif(strlen($Wage) > 4){
                $isThereAnError = 'True';
                $Wage_error = 'Worker age must be less than 4 letters long';
            }
            if($isThereAnError == 'False'){

                $success = 'You have successfully added a new worker!';
                try{
                    //adding new worker
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


        // this if statement is to edit a current worker
        if(isset($_POST['Edit-Form'])){

            $isThereAnError = 'False';

            $EditSeachFirstName = $_POST['SearchWorkerFName'];
            $EditSeachLastName = $_POST['SearchWorkerLName'];

            $NewFName = $_POST['NewWorkerFName'];
            $NewLName = $_POST['NewWorkerLName'];
            $NewSex = $_POST['NewWorkerSex'];
            $NewAge = $_POST['NewWorkerAge'];
            //checking input
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

            if(strlen($NewAge) > 4){
                $isThereAnError = 'True';
                $NAerror = 'Worker age must be less than 4 letters long';
            }

            if($isThereAnError == 'False'){
                try{
                    //searching for a worker by the given input
                    $searching = "
                    SELECT fname, lname, sex, age 
                    FROM workers
                    WHERE fname = '$EditSeachFirstName'
                    AND lname = '$EditSeachLastName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();

                    
                    
                    //if 0, no worker was found
                    if($numRows==0){
                        $Editsuccess = 'Sorry, no worker of this name found';
                    }
                    else{
                        while($row = $searchResults->fetch()){
                            $tempFN = $row['fname'];
                            $tempLN = $row['lname'];
                            $tempS = $row['sex'];
                            $tempA = $row['age'];
                            // any empty fields that were asked when updating the information will have the current information stay the same instead of being replaced with empty
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
                            //updating the worker with the new information
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
        // this is to 'delete' a worker, but it actually just changes the bool, it doesnt actually delete the worker. you can see all 'deleted' workers in the archive tab
        if(isset($_POST['Delete-Form'])){
            $isThereAnError = 'False';

            $DelSeachFirstName = $_POST['DeleteWorkerFName'];
            $DelSeachLastName = $_POST['DeleteWorkerLName'];
            // checking input
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
                    //searching for a worker
                    $searching = "
                    SELECT fname, lname, sex, age
                    FROM workers
                    WHERE fname = '$DelSeachFirstName'
                    AND lname = '$DelSeachLastName'
                    AND currentlyEmployed = 1
                    ";

                    $searchResults = $pdo->query($searching);
                    $numRows = $searchResults->rowCount();

                    
                    
                    // if equal to 0, no worker was found
                    if($numRows==0){
                        $Delsuccess = 'Sorry, no worker of this name found';
                    }
                    else{
                            // 'deleting the worker', which isnt actuall deleting the worker from the table, just changes the bool. the worker and all of their complaints will be shown in the archive tab
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


    // connecting to the database
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
    //building the workers table
    function buildWorkers($pdo){


        try{   
            //these if statements are checking on how to be sorted. whenever the page is first loaded, it is sorted just by id, but the user can click on the catagory names to sort them by that type
            if(isset($_POST['searchLN'])){
                $tempLname = $_POST['searchLast'];
                $workers = "
                SELECT fname, lname, sex, age FROM workers 
                WHERE currentlyEmployed = 1
                AND lname = '$tempLname'
                ";
            }
            elseif(isset($_POST['sort-name'])){

                $workers = "
                SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 1
                ORDER BY fname, lname
                ";

            }elseif(isset($_POST['sort-sex'])){

                $workers = "
                SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 1
                ORDER BY sex
                ";

            }elseif(isset($_POST['sort-age'])){

                $workers = "
                SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 1
                ORDER BY age
                ";
            
            }else{
                $workers = "
                SELECT fname, lname, sex, age FROM workers WHERE currentlyEmployed = 1
                ";
            }


            $rows = $pdo->query($workers);
            //creating the table and having the forms in them that allow for sorting when clicked.
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <form method='POST'>
                        <input type='text' name='searchLast' placeholder='Search Last Name'>
                        <input type='submit' name='searchLN' value='Search'>
                    </form>
                
                    <table id='workersTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#009879;color:#123;font-weight:bold;'>
                            <th style='padding:12px'>
                            
                            <form id='sort-name-form' method='POST'>
                                <input id='SortName' type='submit' name='sort-name' value='Full Name' style='padding:0;border:none;background:none;font-weight:bold;cursor:pointer;'>
                                
                            </form>
                            </th>
                            <th style='padding:12px'>
                            <form id='sort-Sex-form' method='POST'>
                                <input id='SortSex' type='submit' name='sort-sex' value='Sex' style='padding:0;border:none;background:none;font-weight:bold;cursor:pointer;'>
                                
                            </form>
                            </th>
                            <th style='padding:12px'>
                            <form id='sort-Age-form' method='POST'>
                            <input id='SortAge' type='submit' name='sort-age' value='Age' style='padding:0;border:none;background:none;font-weight:bold;cursor:pointer;'>
                            </form></th>
                        </tr>

                        
                        
                        <style>
                            table#workersTable tr:nth-child(even) { background-color:rgba(0, 152, 121, .1) }
                        </style>
                    
                
            ";
            //getting the data from the database table
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
    //similiar to the buildworkers function, except this only shows the ex-workers. this is shown in the archive tab
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
    // building the complaints table
    function buildComplaintsCurrent($pdo){
        try{
            //this is based on how the user wants the complaints sorted, defaulted by id
            if(isset($_POST['searchLN'])){
                $tempLname = $_POST['searchLast'];
                


                $complaints = "
                SELECT workers.fname, workers.lname, complaints.date, complaints.complaint
                FROM complaints, workers
                WHERE workers.lname = '$tempLname'
                AND complaints.worker\$id = workers.id
                AND workers.currentlyEmployed = 1
                ";


            }elseif(isset($_POST['sort-name-comp'])){
                $complaints = "
                    SELECT workers.fname, workers.lname, complaints.date, complaints.complaint
                    FROM complaints, workers
                    WHERE complaints.worker\$id = workers.id
                    AND workers.currentlyEmployed = 1
                    ORDER BY workers.fname, workers.lname
                ";

            }elseif(isset($_POST['sort-date-comp'])){
                $complaints = "
                    SELECT workers.fname, workers.lname, complaints.date, complaints.complaint
                    FROM complaints, workers
                    WHERE complaints.worker\$id = workers.id
                    AND workers.currentlyEmployed = 1
                    ORDER BY complaints.date
                ";
            }else{
            //getting the complaints
            $complaints = "
            SELECT workers.fname, workers.lname, complaints.date, complaints.complaint
            FROM complaints, workers
            WHERE complaints.worker\$id = workers.id
            AND workers.currentlyEmployed = 1
            ";

            }
            $rows = $pdo->query($complaints);
            //printing the table of complaints, has the forms in the first row that the user can click to sort the complaints 
            echo "
                
                <div style='border-collapse:collapse;margin:25px;overflow:hidden;text-align:left;'>
                    <table id='complaintsTable' class='table' style='border-bottom: 2px solid #ffffff;width:100%;height:100%;'>
                        
                        <tr style='background-color:#ff0000;color:#123;font-weight:bold;'>
                            <th style='padding:12px;min-width:30px'>
                                <form id='sort-name-Comp-form' method='POST'>
                                <input id='SortName' type='submit' name='sort-name-comp' value='Full Name' style='padding:0;border:none;background:none;font-weight:bold;cursor:pointer;'>
                                </form>
                            </th>
                            <th style='padding:12px;min-width:30px'>
                                <form id='sort-date-Comp-form' method='POST'>
                                <input id='SortDate' type='submit' name='sort-date-comp' value='Date' style='padding:0;border:none;background:none;font-weight:bold;cursor:pointer;'>
                                </form>
                            </th>
                            <th style='padding:12px;max-width:400px;'>Complaint</th>
                        </tr>

                        <style>
                            table#complaintsTable tr:nth-child(even) { background-color:rgba(255, 0, 0, .1) }
                        </style> 
            ";
            // getting the data to fill the table
            while($row = $rows->fetch()){
                $fname = $row['fname'];
                $lname = $row['lname'];
                $date = $row['date'];
                
                $complaint = $row['complaint'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$date</td>
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
    // simliar to the build complaints function, except this only shows the ex-workers complaints. this is shown in the archive tab
    function buildComplaintsEx($pdo){
        try{

            $complaints = "
            SELECT workers.fname, workers.lname, complaints.date, complaints.complaint
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
                $complaint = $row['complaint'];
                echo "
                    <tr style=''>
                        <td style='padding:12px'>$fname $lname</td>
                        <td style='padding:12px'>$date</td>
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
    <!-- the javascript and css pages -->
    <script src="script.js" defer></script>
    <link href="style.css" rel="stylesheet">
    <title>Assessment Home Page</title>
</head>

<body>
    <!-- tabs at the top that let you navigate between current workers and archive -->
    <ul class="tabs">
        <li data-tab-target="#tableOne" class = "active tab">Current Work Staff</li>
        <li data-tab-target="#tableTwo" class = "tab">Archived</li>
    </ul>



    
        
            <div class = "content" >
                <!-- this is the current workers tab -->
                <div id="tableOne" data-tab-content class="active">
                    <div id = "container">
                        <div class = "left">
                            <h1>Current Worker List</h1>
                            <!-- building the current worker table -->
                            <?php echo buildWorkers($pdo); ?>
                            <div class = "containerBot">
                            <div class = "botLeft">
                                <!-- this is the button and the div tha can be displayed when clicking on the botton. this let's you edit a current worker -->
                                <button id='EditWorkerButton'>Edit Worker</button>
                                <?php if(isset($Editsuccess)){ ?>
                                        <p><?php echo $Editsuccess ?><p>
                                <?php } ?>
                                <div id="EditWorkerDiv" style='padding: 10px;display:none;'>
                                    <form id="form-edit-Worker"name='editWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

                                        <h3>Please enter the first and last name of the person you want to edit</h3>
                                        <br>
                                        <input maxlength="20" name="SearchWorkerFName" placeholder = "First Name" value="<?php echo htmlspecialchars($EditSeachFirstName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($SFNerror)){ ?>
                                            <p><?php echo $SFNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="SearchWorkerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($EditSeachLastName) ?>" onkeyup="lettersOnly(this)" required>
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
                                <!-- button that lets you create new workers when clicked on. clicking on the button will display the form -->
                                <button id='addWorkerButton'>Add Worker</button>
                                    <?php if(isset($success)){ ?>
                                        <p><?php echo $success ?><p>
                                    <?php } ?>
                                <div id="addWorkerDiv" style='padding: 10px;display:none;'>
                                    <form id="form-add-Worker"name='addWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <br>
                                        <input maxlength="20" name="workerName" placeholder = "First Name" value="<?php echo htmlspecialchars($Wname) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($Wname_error)){ ?>
                                            <p><?php echo $Wname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="workerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($Wlastname) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($Wlastname_error)){ ?>
                                            <p><?php echo $Wlastname_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="25" name="workerSex" placeholder = "Sex" value="<?php echo htmlspecialchars($Wsex) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($Wsex_error)){ ?>
                                            <p><?php echo $Wsex_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input  type='number' maxlength="3" name="workerAge" placeholder = "Enter Age" value="<?php echo htmlspecialchars($Wage) ?>" required>
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
                                <!-- button that lets you create new workers when clicked on. clicking on the button will display the form to delete workers -->
                                <button id='DeleteWorkerButton'>Delete Worker</button>
                                    <?php if(isset($Delsuccess)){ ?>
                                        <p><?php echo $Delsuccess ?><p>
                                    <?php } ?>
                                <div id="DeletetWorkerDiv" style='padding: 10px;display:none;'>
                                <form id="form-Delete-Worker"name='deleteWorker' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                        <h3>Please enter the first and last name of the person you want to edit</h3>
                                        <br>
                                        <input maxlength="20" name="DeleteWorkerFName" placeholder = "First Name" value="<?php echo htmlspecialchars($DelSeachFirstName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($DFNerror)){ ?>
                                            <p><?php echo $DFNerror ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="DeleteWorkerLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($DelSeachLastName) ?>" onkeyup="lettersOnly(this)" required>
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
                            <!-- building the current workers complaints table -->
                            <?php echo buildComplaintsCurrent($pdo); ?>
                            <div class = "containerBot">
                                <div class = "botLeft">
                                    <!-- button that lets you edit a complain when it is clicked on -->
                                    <button id='EditCompButton'>Edit Complaint</button>
                                    <?php if(isset($ECompsuccess)){ ?>
                                        <p><?php echo $ECompsuccess ?><p>
                                    <?php } ?>
                                    <div id="EditCompDiv" style='padding: 10px;display:none;'>
                                    <form id="form-edit-complaint" name='editComplaint' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                    <br>
                                        <h3>Please enter the first and last name of the person, and the date of the complaint</h3>
                                        <input maxlength="20" name="ESearchCompFName" placeholder = "First Name" value="<?php echo htmlspecialchars($ESearchCompFName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($ECompFName_error)){ ?>
                                            <p><?php echo $ECompFName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="ESearchCompLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($ESearchCompLName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($ECompLName_error)){ ?>
                                            <p><?php echo $ECompLName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <label for="compdate">Date: </label>
                                        <input type="date" id="ESearchcompdate" name="ESearchcompdate" required>
                                        <br>
                                        
                                        <h4>Edit the complaint</h4>
                                        <br>
                                        <input maxlength="500" name="Newcomplaint" placeholder = "Enter new Complaint" value="<?php echo htmlspecialchars($newComplaint) ?>" required>
                                        <br>
                                        <?php if(isset($EComplaint_error)){ ?>
                                            <p><?php echo $EComplaint_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Edit-Complaint-Form' value='submit'>
                                        </form>
                                    </div>
                                </div>
                                <div class = "botMid">
                                    <!-- button that lets you add a complaint when it is clicked on -->
                                    <button id='addCompButton'>Add Complaint</button>
                                    <?php if(isset($CompAddsuccess)){ ?>
                                        <p><?php echo $CompAddsuccess ?><p>
                                    <?php } ?>
                                    <div id="AddCompDiv" style='padding: 10px;display:none;'>
                                    <form id="form-add-complaint" name='addComplaint' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                    <br>
                                        <input maxlength="20" name="CompFName" placeholder = "First Name" value="<?php echo htmlspecialchars($CompFName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($CompFName_error)){ ?>
                                            <p><?php echo $CompFName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="CompLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($CompLName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($CompLName_error)){ ?>
                                            <p><?php echo $CompLName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <label for="compdate">Date: </label>
                                        <input type="date" id="compdate" name="compdate" required>
                                        <br>
                                        <br>
                                        <input maxlength="500" name="complaint" placeholder = "Enter Complaint" value="<?php echo htmlspecialchars($Complaint) ?>" required>
                                        <br>
                                        <?php if(isset($Complaint_error)){ ?>
                                            <p><?php echo $Complaint_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input type='submit' name='Add-Complaint-Form' value='submit'>
                                        </form>
                                    </div>
                                </div>
                                <div class='botRight'>
                                    <!-- button that lets you delete a complaint when it is clicked on -->
                                    <button id='DeleteCompButton'>Delete Complaint</button>
                                    <?php if(isset($DCompsuccess)){ ?>
                                        <p><?php echo $DCompsuccess ?><p>
                                    <?php } ?>
                                    <div id="DeleteCompDiv" style='padding: 10px;display:none;'>
                                    <form id="form-delete-complaint" name='dditComplaint' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                    <br>
                                        <h3>Please enter the first and last name of the person, and the date of the complaint</h3>
                                        <input maxlength="20" name="DSearchCompFName" placeholder = "First Name" value="<?php echo htmlspecialchars($DSearchCompFName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($DCompFName_error)){ ?>
                                            <p><?php echo $DCompFName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <input maxlength="20" name="DSearchCompLName" placeholder = "Last Name" value="<?php echo htmlspecialchars($DSearchCompLName) ?>" onkeyup="lettersOnly(this)" required>
                                        <br>
                                        <?php if(isset($DCompLName_error)){ ?>
                                            <p><?php echo $DCompLName_error ?><p>
                                        <?php } ?>
                                        <br>
                                        <label for="compdate">Date: </label>
                                        <input type="date" id="DSearchcompdate" name="DSearchcompdate" required>
                                        <br>
                                        
                                        <input type='submit' name='Delete-Complaint-Form' value='submit'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>  
                    <!-- this is the archive tab -->
                <div id="tableTwo" data-tab-content>
                
                    <div id = "container">
                        <div class = "left">
                        
                            <!-- builds the ex workers table -->
                            <h1>Ex-Worker List</h1>
                            <?php echo buildExWorkers($pdo); ?>
                                <div class = "containerBot">
                                    
                                </div>
                        
                        </div>  
                        <div class = "right">
                            <!-- builds the complaints for the ex workers -->
                            <h1>Complaints about Ex-Workers</h1>
                            <?php echo buildComplaintsEx($pdo); ?>
                                <div class = "containerBot">
                                    
                                </div>
                        
                        </div>
                    
                    </div>
                
                </div>
            </div>
   
</body>
</html>