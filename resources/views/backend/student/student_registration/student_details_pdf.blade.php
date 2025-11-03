<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <table id="customers">
        <tr>
            <td>
                <h2>Your Brand</h2>
            </td>
            <td>
                <h2>Your ERP</h2>
                <p>Address</p>
                <p>Phones</p>
                <p>Email</p>
            </td>
            <td>
                <h2>Your ERP</h2>
                <p>Address</p>
                <p>Phones</p>
                <p>Email</p>
            </td>
        </tr>

    </table>

    <table id="customers">
        <tr>
            <th width="10%">No.</th>
            <th width="45%">Student Details</th>
            <th width="45%">Student Data</th>
        </tr>
        <tr>
            <td>1</td>
            <td><b>Student Name</b></td>
            <td>{{ $details['student']['name'] }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td><b>Student ID</b></td>
            <td>{{ $details['student']['id_no'] }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td><b>Student Code</b></td>
            <td>{{ $details['student']['code'] }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td><b>Roll</b></td>
            <td>{{ $details->roll }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td><b>Gender</b></td>
            <td>{{ $details['student']['gender'] }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td><b>Religion</b></td>
            <td>{{ $details['student']['religion'] }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td><b>Birth</b></td>
            <td>{{ $details['student']['birth'] }}</td>
        </tr>
        <tr>
            <td>8</td>
            <td><b>Father's Name</b></td>
            <td>{{ $details['student']['father'] }}</td>
        </tr>
        <tr>
            <td>9</td>
            <td><b>Mother's Name</b></td>
            <td>{{ $details['student']['mother'] }}</td>
        </tr>
        <tr>
            <td>10</td>
            <td><b>Mobile Number</b></td>
            <td>{{ $details['student']['mobile'] }}</td>
        </tr>

        <tr>
            <td>11</td>
            <td><b>Address</b></td>
            <td>{{ $details['student']['address'] }}</td>
        </tr>

        <tr>
            <td>12</td>
            <td><b>Class</b></td>
            <td>{{ $details['student_class']['name'] }}</td>
        </tr>

        <tr>
            <td>13</td>
            <td><b>Year</b></td>
            <td>{{ $details['student_year']['name'] }}</td>
        </tr>

        <tr>
            <td>14</td>
            <td><b>Group Name</b></td>
            <td>{{ $details['group']['name'] }}</td>
        </tr>

        <tr>
            <td>15</td>
            <td><b>Shift Name</b></td>
            <td>{{ $details['shift']['name'] }}</td>
        </tr>

        <tr>
            <td>16</td>
            <td><b>Discount</b></td>
            <td>Rp. {{ $details['discount']['discount'] }}</td>
        </tr>

    </table>
    <br>
    <i style="font-size: 14px; float: right;">Printed Date: {{ date('d M Y') }}</i>

</body>

</html>
