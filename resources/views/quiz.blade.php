<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        form{
            display: flex;
            flex-direction: column;
            width: 15rem;
            gap: 1rem;
        }

        .col{
            display: flex;
            justify-content: space-between;
            background-color: beige;
            padding-inline: 10rem;
        }

        table{
            border: 1px solid black;
            width: 50%;
        }

        td{
            border: 1px solid black;
        }
        
    </style>

</head>
<body>
    <div class="col">
        <form action="" method="POST">
            @csrf
            <label for="">QUESTION</label>
            <textarea name="question" id="" cols="30" rows="10"></textarea>
            <label for="">NO</label>
            <input type="number" name="no">
            <label for="">A</label>
            <input type="text" name="a" id="">
            <label for="">B</label>
            <input type="text" name="b" id="">
            <label for="">C</label>
            <input type="text" name="c" id="">
            <label for="">D</label>
            <input type="text" name="d" id="">
            <label for="answer">Answer</label>
            <select name="answer" id="">
                <option value="a">a</option>
                <option value="b">b</option>
                <option value="c">c</option>
                <option value="d">d</option>
            </select>
            <input type="submit" value="Add question">
        </form>
        <table>
            <tr>
                <th>NO</th>
                <th>Question</th>
                <th>Answwer</th>
            </tr>
            @foreach ($questions as $question)
                <tr>
                    <td>{{$question->no}}</td>
                    <td>{{$question->question}}</td>
                    <td style="text-transform: uppercase">{{$question->answer}}</td>
                    <td><button><a href={{'question/'.$question->id}}>Edit question</a></button></td>
                    <td><form method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button onclick="del(this)" id={{$question->id}}>DELETE QUESTION</button>
                    </form></td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        function del(e){
            axios({
            method: 'delete',
            url: '',
            data: {
                id: e.id
            }
            }).then((response) => console.log(response));
        }


    </script>


</body>


</html>