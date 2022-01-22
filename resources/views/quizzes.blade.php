<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table, th, td {
            border:1px solid black;
        }
        table{
            width: 100%;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>number of question</th>
            <td>Image</td>
        </tr>
        @foreach ($quizzes as $quiz)
            <tr>
                <td>{{$quiz->id}}</td>
                <td>{{$quiz->name}}</td>
                <td>{{count($quiz->questions)}}</td>
                <td><img src={{$quiz->image}} alt="" width="200" height="200"></td>
                <td><button><a href={{'test/'.$quiz->id}}>See test</a></button></td>
            </tr>
        @endforeach
    </table>
</body>
</html>