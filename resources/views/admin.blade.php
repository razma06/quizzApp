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

        html{
            font-size: 25px;
        }
    </style>
</head>
<body>
    <form action="" method="POST" id="form">
        @csrf
        <input type="text" name="name" id="name" placeholder="name of quiz">
        <input type="text" name="image" id="image" placeholder="image link(optional)">
        <input type="text" name="description" id="description" placeholder="description">
        <input type="submit" value="Add quiz">
    </form>

    <table>
        <tr id="head">
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
                @if (!$quiz->accept)
                    <td><button style="background-color: greenyellow" onclick="accept(this)" id={{$quiz->id}}>ACCEPT</button></td> 
                @endif
                <td><button><a href={{'quiz/'.$quiz->id}}>ADD QUESTIONS</a></button></td>
            </tr>
        @endforeach
    </table>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        function accept(e){
            axios({
                method: 'put',
                url: '',
                data: {
                    id: e.id
                }
            }).then((response) => {
                e.parentElement.remove()
                console.log(e);
            });
        }
    </script>

    <script>
        const head = document.getElementById("head");

        document.getElementById('form').addEventListener("submit", (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value
            const image = document.getElementById('image').value
            const description = document.getElementById('description').value

            axios.post('',
            {
                name:name
                image: image
                description: description
            }
            ).then((response) => {
                console.log(response);
                head.after(`
                    <tr>
                        <td>${response.data.id}</td>
                        <td>${name}</td>
                        <td>${0}</td>
                        <td><img src=${image} alt="" width="200" height="200"></td>
                        <td><button><a href=${'quiz/'+response.data.id}>ADD QUESTIONS</a></button></td>
                    </tr>
                `)
            }).catch((response)=>console.log(response);)
        })
    </script>
</body>
</html>