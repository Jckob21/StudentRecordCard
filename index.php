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
        <table>
            <tr>
                <td>Student ID</td>
                <td>999999</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>Mr/Mrs</td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td>XXXXXXX</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>XX/XX/XXXX</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>M/F/U</td>
            </tr>
        </table>
        
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