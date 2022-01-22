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
    </style>
</head>
<body>
    <form action="" method="POST">
            @csrf
            <label for="">QUESTION</label>
            <textarea name="question" id="" cols="30" rows="10">{{$question->question}}</textarea>
            <label for="">No</label>
            <input type="text" name="no" id="" value={{$question->no}}>
            <label for="">A</label>
            <input type="text" name="a" id="" value={{$question->a}}>
            <label for="">B</label>
            <input type="text" name="b" id="" value={{$question->b}}>
            <label for="">C</label>
            <input type="text" name="c" id="" value={{$question->c}}>
            <label for="">D</label>
            <input type="text" name="d" id="" value={{$question->d}}>
            <label for="answer">Answer</label>
            <select name="answer" id="">
                <option value="a">a</option>
                <option value="b">b</option>
                <option value="c">c</option>
                <option value="d">d</option>
            </select>
            <input type="submit" value="Change question">
        </form>
</body>
</html>