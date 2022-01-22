<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            display: grid;
            place-items: center;
        }

        .block{
            background-color:coral;
        }
    </style>
</head>
<body>
    <div class="block" id="block">
        <h1>QUIZ: {{$quiz->name}}</h1>
        <img src={{$quiz->image}} width="400" height="400">
        <p>DESCRIPTION: {{$quiz->description}}</p>
        <button id="start">start test</button>
    </div>
    <button id="next">NEXT</button>
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var id = "<?php echo $quiz->id; ?>";
        var i = 0;

        var correctAnswers = 0;

        function fetchAndAdd(){
            axios.get('/api/questions', {
                params: {
                    id: id,
                    i: i
                }
            })
            .then(function (response) {
                document.getElementById('block').innerHTML = `
                    <h1>${i+1+'th question'}</h1>
                    <table>
                        <tr><td>QUESTION: ${response.data.question}</td></tr>
                        <tr>
                            <td>A: ${response.data.a}</td>
                            <td>B: ${response.data.b}</td>
                        </tr>
                        <tr>
                            <td>C: ${response.data.c}</td>
                            <td>D: ${response.data.d}</td>
                        </tr>
                        <tr><td>
                            <select id="ans">
                                <option value="a">a</option>
                                <option value="b">b</option>
                                <option value="c">c</option>
                                <option value="d">d</option>
                            </select>
                        </td></tr>
                        <tr><td><button id="submit">SUBMIT ANSWER</button></td></tr>
                    </table>
                `;

                document.getElementById('submit').addEventListener('click', ()=>{
                    if(response.data.answer == document.getElementById('ans').value){
                        correctAnswers++;
                    }
                    document.getElementById('block').innerHTML = `<p>
                        YOUR ANSWER: ${document.getElementById('ans').value}
                        ANSWER: ${response.data.answer}
                    </p>`
                })
                

                console.log(response);
            })
            .catch((response) => {
                document.getElementById('block').innerHTML = `<h1>correct: ${correctAnswers}</h1>`;
                document.getElementById('next').remove();
            })
        }

        document.getElementById('next').addEventListener('click', ()=>{
            i++;
            fetchAndAdd();
        })


        document.getElementById('start').addEventListener('click', () => {
            fetchAndAdd();

        }
        )
            
    </script>
</body>
</html>