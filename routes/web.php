<?php

use Illuminate\Support\Facades\Route;
use App\Models\quiz;
use Illuminate\Support\Facades\Auth;
use App\Models\question;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (quiz $quiz) {
    if(Auth::check()){
        $quizzes = $quiz->get()->where('user', Auth::id())->sortBy('created_at');
        return view('welcome')->with('quizzes', $quizzes);
    }
});

Route::get('/test', function(quiz $quiz){
    $quizzes = $quiz->get()->where('accept', 1)->sortBy('created_at');
    return view('quizzes')->with('quizzes', $quizzes);
});

Route::get('/test/{id}', function($id){
    $quiz = quiz::find($id);
    return view('test')->with("quiz", $quiz);
});

Route::post('/', function (Request $request, quiz $quiz){
    $quiz->name = $request->name;
    $quiz->image = $request->image;
    $quiz->user = Auth::id();
    $quiz->description = $request->description;

    $quiz->save();

    return $quiz->id;
});

Route::get('/admin/quizzes', function(quiz $quiz){
    $quizzes = $quiz->get()->sortBy('created_at')->sortBy('accept');
    return view('admin')->with('quizzes', $quizzes);
});

Route::put('/admin/quizzes', function(Request $request){
    $quiz = quiz::find($request->id);
    $quiz->accept = 1;
    $quiz->save();
    return $request->id;
});


Route::post('/admin/quizzes', function(Request $request, quiz $quiz){
    $quiz->name = $request->name;
    $quiz->image = $request->image;
    $quiz->user = Auth::id();
    $quiz->description = $request->description;

    $quiz->save();

    return $quiz->id;
});


Route::get('admin/quiz/{id}', function(question $question, $id){
    if(Auth::check()){
        $questions = $question->get()->where('quiz_id', $id)->sortBy('no');
        return view('quiz')->with('questions', $questions);
    }
});
Route::get('admin/quiz/{id}', function(question $question, $id){
    if(Auth::id() == 1){
        $questions = $question->get()->where('quiz_id', $id)->sortBy('no');
        return view('quiz')->with('questions', $questions);
    }
});

Route::get('/quiz/{id}', function(question $question, $id){
    if(Auth::id()==$id){
        $questions = $question->get()->where('quiz_id', $id)->sortBy('no');
        return view('quiz')->with('questions', $questions);
    }
});

Route::post('/quiz/{id}', function(question $question, $id, Request $request){
    
});
Route::post('admin/quiz/{id}', function($id, Request $request){
    $question = new question;
    $question->fill($request->all());
    $question->quiz_id = $id;
    $question->answer = $request->answer;
    $question->save();
});


Route::get('admin/quiz/question/{id}', function(question $question, Request $request, $id){
    return view('question')->with('question', $question::find($id));
});

Route::post('admin/quiz/question/{id}', function(Request $request, $id){
    $question = question::find($id);
    $question->fill($request->all())->save();
    return redirect('quiz/'.$question->quiz_id);
});

Route::delete('admin/quiz/{id}', function(Request $request){
    $question = question::find($request->id);
    $question->delete();
});

Route::delete('quiz/{id}', function(Request $request){
    $question = question::find($request->id);
    $question->delete();
});


Route::get('quiz/question/{id}', function(question $question, Request $request, $id){
    return view('question')->with('question', $question::find($id));
});
Route::post('quiz/question/{id}', function(Request $request, $id){
    $question = question::find($id);
    $question->fill($request->all())->save();
    return redirect('quiz/'.$question->quiz_id);
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
