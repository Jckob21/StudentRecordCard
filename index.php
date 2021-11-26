<!DOCTYPE HTML>

<?php
//////////////////////////  CONNECTION TO DATABASE  ///////////////////////////
    //Database credentials
    $databaseID = "localhost";
    $databaseUser = "root";
    $databasePassword = "";
    $database_name = "student_record";

    $connection = mysqli_connect($databaseID, $databaseUser, $databasePassword);
    //check connection
    if(!$connection) {
        die("Error connecting to MySQL: " . mysqli_error($connection));
    }

    $connection_success = mysqli_select_db($connection, $database_name);
    //check if database was selected with success
    if(!$connection_success) {
        die("Error selecting database: ". mysqli_error($connection));
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Student Record Card</title>
        <meta name="description" content="Swansea University Student Record Card">
    
        <style>
            h1 {
                margin: 0px;
                padding: 2px;
            }

            h3 {
                margin: 0px;
                padding: 2px;
            }

            table {
                border: 1px solid black;
            }

            td {
                padding: 0 40px;
            }

            th {
                background-color: #8FFFFB;
            }

            .total-credits {
                text-align: right;
            }

            .module-title {
                text-align: left;
            }
        </style>
    </head>

    <body>
        <!--        HEADER      -->
        <img src="SUmenubar.png" alt="S W A N S E A   U N I V E R S I T Y   M E N U   B A R">
        <h1>Student Record Card</h1>
        
        <!--        FORM QUERY HOLDER       -->
        <form method="post">
            <label for="POST-studID">Query by Student ID #:</label>
            <input id="POST-studID" type="text" name="studID">
            <input type="submit" value="Submit">
        </form>
        
        <hr>

        <!--        PERSONAL DETAILS SECTION        -->
        <h3>Personal Details</h3>
<?php
///////////////////////////////  PERSONAL DATA  ///////////////////////////////
    if(isset($_POST["studID"]))
    {
        $query = "SELECT * FROM stud WHERE sid = ".$_POST["studID"];
        $result = mysqli_query($connection, $query);
        
        
        if($row = mysqli_fetch_array($result))
        {
            echo "<table>";

            //studentID
            echo "<tr>";
            echo    "<td>Student ID</td>";
            echo    "<td>".$row["sid"]."</td>";
            echo "</tr>";

            //title
            echo "<tr>";
            echo    "<td>Title</td>";
            echo    "<td>".$row["title"]."</td>";
            echo "</tr>";

            //full name
            echo "<tr>";
            echo    "<td>Full name</td>";
            echo    "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
            echo "</tr>";

            //date of birth
            echo "<tr>";
            echo    "<td>Date of Birth</td>";
            echo    "<td>".$row["dob"]."</td>";
            echo "</tr>";

            //gender
            echo "<tr>";
            echo    "<td>Gender</td>";
            if($row["gender"] == "m")
            {
                echo    "<td>Male</td>";
            } else
            {
                echo    "<td>Female</td>";
            }
            echo "</tr>";

            echo "</table>";
        } else
        {
            echo "Student number record not found.";
        }
    }
?>
        
        <!--        COURSE DETAILS SECTION        -->
        <h3>Course Details</h3>

<?php
///////////////////////////////  COURSE DETAILS  //////////////////////////////
    if(isset($_POST["studID"]))
    {
        //desc to get highest lvl?
        $query = "SELECT enrl.pid, paward, ptitle, prog.did, length, dname FROM enrl, prog, dept WHERE enrl.pid=prog.pid AND prog.did=dept.did AND sid=" . $_POST["studID"] . " GROUP BY pid";
        $result = mysqli_query($connection, $query);
        
        
        if($row = mysqli_fetch_array($result))
        {
            echo "<table>";

            //UCAS Code
            echo "<tr>";
            echo    "<td>UCAS Code</td>";
            echo    "<td>".$row["pid"]."</td>";
            echo "</tr>";

            //Degree Scheme
            echo "<tr>";
            echo    "<td>Degree Scheme</td>";
            echo    "<td>" . $row["paward"]. " " . $row["ptitle"] . " " . $row["length"] . "yr</td>";
            echo "</tr>";

            //Department
            echo "<tr>";
            echo    "<td>Department</td>";
            echo    "<td>".$row["dname"]."</td>";
            echo "</tr>";

            echo "</table>";
        } else
        {
            echo "Student number record not found.";
        }
    }
?>

        <hr>
        <!--        ENROLMENT AND PROGRESS SECTION        -->
        <h3>Enrolment and Progress</h3>

<?php
//////////////////////////  Enrolment and Progress  ///////////////////////////
    if(isset($_POST["studID"]))
    {
        
        $query = "SELECT * FROM enrl, stud, prog WHERE enrl.sid = stud.sid AND enrl.pid = prog.pid AND enrl.sid = " . $_POST["studID"] . " ORDER BY lvl DESC";
        $result = mysqli_query($connection, $query);
        
        echo "<table>";
        echo    "<tr>";
        echo        "<th>Academic Year</th>";
        echo        "<th>Enrolment Status</th>";
        echo        "<th>Programme</th>";
        echo        "<th>Course Year</th>";
        echo    "</tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo    "<td>" . $row["ayr"] . "</td>";

            // translate status shortcut into description
            switch($row["status"])
            {
                case "NE":
                    echo "<td>" . "Not Enrolled" . "</td>";
                    break;
                case "E":
                    echo "<td>" . "Enrolled" . "</td>";
                    break;
                case "ER":
                    echo "<td>" . "Enrolled Repeat" . "</td>";
                    break;
                case "T":
                    echo "<td>" . "Enrolled then Transferred" . "</td>";
                    break;
                case "W":
                    echo "<td>" . "Enrolled then Withdrawn" . "</td>";
                    break;
                case "S":
                    echo "<td>" . "Enrolled then Suspended" . "</td>";
                    break;
            }

            echo    "<td>" . $row["ptitle"] . "</td>";
            echo    "<td>" . $row["lvl"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
?>

        <hr>
        <!--        MODULE SELECTION SECTION        -->
        <h3>Module Selection</h3>
<?php
//////////////////////////  Enrolment and Progress  ///////////////////////////
    if(isset($_POST["studID"]))
    {
        
        $query =    "SELECT smod.ayr, smod.mid, mtitle, credits FROM enrl, smod, mods WHERE enrl.ayr = smod.ayr AND enrl.sid = smod.sid AND smod.mid = mods.mid AND enrl.sid = " . $_POST["studID"] . " ORDER BY smod.ayr desc, smod.mid desc";
        $result = mysqli_query($connection, $query);

        echo "<table>";

        $currentYear = "0000/00";
        $totalCreditsYear = 0;
        while($row = mysqli_fetch_array($result))
        {
            //if it is another year, print credits and year column
            if($currentYear != $row["ayr"])
            {
                //credits - first iteration should be omitted
                if($currentYear != "0000/00")
                {
                    echo    "<tr>";
                    echo        '<td class="total-credits" colspan="3">Total credits: ' . $totalCreditsYear . '</td>';
                    echo    "</tr>";
                }

                // year column
                echo    "<tr>";
                echo        '<th colspan="3">' . $row["ayr"] . '</th>';
                echo    "</tr>";

                //set variables for next year
                $currentYear = $row["ayr"];
                $totalCreditsYear = 0;
            }

            echo "<tr>";
            echo    "<td>" . $row["mid"] . "</td>";
            echo    "<td>" . $row["mtitle"] . "</td>";
            echo    "<td>" . $row["credits"] . "</td>";
            echo "</tr>";

            //increase the total credits with this row credits number
            $totalCreditsYear = $totalCreditsYear + $row["credits"];
        }

        //print last total credits
        echo    "<tr>";
        echo        '<td class="total-credits" colspan="3">Total credits: ' . $totalCreditsYear . '</td>';
        echo    "</tr>";
        
        echo "</table>";
    }
?>

        <!--        FOOTER        -->
        <img src="SUlogo.png" alt="S W A N S E A   U N I V E R S I T Y   L O G O">
    </body>
</html>