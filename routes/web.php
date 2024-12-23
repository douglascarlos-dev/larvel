<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {     return 'Hello World'; });

Route::get('/helloview', function () {
    return view('hello');
});

Route::get('/empresa', function(){
    return view('site/empresa');
});
//Route::view('/empresa', 'site/empresa');

Route::any('/any', function(){
    return "Permite todo tipo de acesso http (put, delete, get, post)";
});

Route::match(['get', 'post'], '/match', function(){
    return "Permite apenas acessos definidos";
});
/*
Route::get('/produto/{id}/{cat?}', function($id, $cat = ''){
    return "O id do produto é: " . $id . "<br>" . "A categoria é: " . $cat;
});
*/
Route::get('/sobre', function(){
    return redirect('/empresa');
});
//Route:redirect('/sobre', '/empresa');

Route::get('/news', function(){
    return view('news');
})->name('noticias');

Route::get('/novidades', function(){
    return redirect()->route('noticias');
});

Route::prefix('admin')->group(function(){
    Route::get('dashboard', function(){
        return "dashboard";
    });
    Route::get('users', function(){
        return "users";
    });
});

Route::name('admin.')->group(function(){
    Route::get('admin/dashboard', function(){
        return "dashboard";
    })->name('dashboard');
    Route::get('admin/users', function(){
        return "users";
    })->name('clientes');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', function(){
        return "dashboard";
    })->name('dashboard');
    Route::get('users', function(){
        return "users";
    })->name('clientes');
});

Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');

Route::get('/produto/{id?}', [ProdutoController::class, 'show'])->name('produto.show');