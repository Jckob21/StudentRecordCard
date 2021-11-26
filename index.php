<!DOCTYPE HTML>

<?php
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
        </style>
    </head>

    <body>
        <img src="SUmenubar.png" alt="S W A N S E A   U N I V E R S I T Y   M E N U   B A R">
        <h1>Student Record Card</h1>
        
        <form method="post">
            <label for="POST-studID">Query by Student ID #:</label>
            <input id="POST-studID" type="text" name="studID">
            <input type="submit" value="Submit">
        </form>
        
        <hr>

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
        
        <h3>Course Details</h3>
        <table>
            <tr>
                <td>UCAS Code</td>
                <td>G999</td>
            </tr>
            <tr>
                <td>Degree Scheme</td>
                <td>BSc...</td>
            </tr>
            <tr>
                <td>Department</td>
                <td>XXXXXX  XXXXXX</td>
            </tr>
        </table>

        <h3>Enrolment and Progress</h3>
        <table>
            <tr>
                <th>Academic Year</th>
                <th>Enrolment Status</th>
                <th>Programme</th>
                <th>Course Year</th>
            </tr>
            <tr>
                <td>XXX</td>
                <td>XXX</td>
                <td>XXX</td>
                <td>XXX</td>
            </tr>
        </table>

        <h3>Module Selection</h3>
        <table>
            <tr>
                <th>2001/2002</th>
            </tr>
            <tr>
                <td>X99</td>
                <td>XXX XXXX XXXXX</td>
            </tr>
            <tr>
                <td class="total-credits">Total Credits: XXX</td>
            </tr>

            <tr>
                <th>2000/2001</th>
            </tr>
            <tr>
                <td>X98</td>
                <td>XXX XXXX XXXXX</td>
            </tr>
            <tr>
                <td>Total Credits: XXX</td>
            </tr>
        </table>

        <img src="SUlogo.png" alt="S W A N S E A   U N I V E R S I T Y   L O G O">
    </body>
</html>