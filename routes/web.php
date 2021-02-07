<?php

use App\Favorite;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Main\AjaxController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\PlayController;
use App\Http\Controllers\Main\QuestionController;
use App\Http\Controllers\Main\QuizController;
use App\Quizz;
use App\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', function () {
    return view('auth/register');
})->name('registerView');
Route::post('registerProcess',[RegisterController::class,'register'])->name('register');
Route::get('login', function () {
    return view('auth/login');
})->name("loginView");
Route::get('logout',[LogoutController::class,'logout'])->name('logout');
Route::post('loginProcess',[LoginController::class,'login'])->name('login');
Route::view('registerSuccess','registerSuccess');
Route::middleware('auth')->group(function(){
    Route::get('home',[HomeController::class,'home'])->name('home');
    Route::view('create','create');
    Route::get('detail/{slug}',[QuizController::class,'detail'])->name('detail');
    Route::get('edit/{quizz}/{question}',[QuizController::class,'edit'])->name('edit');
    Route::post('update/{quizz}/{question}',[QuizController::class,'update'])->name('update');
    Route::post('updateQuizz/{quizz}',[QuizController::class,'updateQuizz'])->name('updateQuizz');
    Route::post('storeTemp',[QuestionController::class,'storeTemp'])->name('storeTemp');
    Route::post('quiz/store',[QuizController::class,'store'])->name('quiz.store');
    Route::get('/index',function(){
        $user=User::find(auth()->user()->id);
        return $user->load('quizzs.questions.answers');
    })->name('index');
    Route::post('ajax/unfavorite',[AjaxController::class,'ajax_unfavorite']);
    Route::get('{quizz}/play',[PlayController::class,'play'])->name('play');
    Route::post('ajax/answer',[AjaxController::class,'ajax_answer']);
    Route::post('ajax/search',[AjaxController::class,'ajax_search'])->name('ajax.search');
    Route::post('ajax/favorite',[AjaxController::class,'ajax_favorite']);
    Route::get('play/result',[PlayController::class,'result'])->name('play.result');
    Route::get('test',function(){
        $quizz=Quizz::find(6);
        return $quizz->favorites[0]['quizz_id'];
    });
    
});
