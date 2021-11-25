<!DOCTYPE HTML>

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
        

    </body>
</html>