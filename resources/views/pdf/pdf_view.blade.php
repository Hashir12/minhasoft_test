<?php ?>
    <!DOCTYPE html>

<html>

<head>

    <title>Consignment Pdf</title>

</head>

<body>
<table>
    <tr>
        <th>Name</th>
        <th>Contact</th>
        <th>Address line 1</th>
        <th>Address line 2</th>
        <th>Address line 3</th>
        <th>City</th>
        <th>Country</th>
    </tr>
    @foreach($records as $record)
        <tr>
            <td>{{$record['Name']}}</td>
            <td>{{$record['Contact']}}</td>
            <td>{{$record['Address line 1']}}</td>
            <td>{{$record['Address line 2']}}</td>
            <td>{{$record['Address line 3']}}</td>
            <td>{{$record['City']}}</td>
            <td>{{$record['Country']}}</td>
        </tr>
    @endforeach
</table>
</body>

</html>
