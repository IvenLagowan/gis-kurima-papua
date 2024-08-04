<?php

use App\Http\Livewire\Listwisata;
use App\Http\Livewire\Detailwisata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Category;
use App\Models\Category as ModelsCategory;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/tours', Listwisata::class)->name('list.wisata');
Route::get('/manage-category', Category::class)->name('kelola.kategori')->middleware('auth');
Route::get('/wisata/{id}', Detailwisata::class, 'mount')->name('detail.wisata');
Route::get('/category/{category:category_name}', function(ModelsCategory $category){
    return view('categories',[
        'wisata' => $category->tours,
        'category' => $category->category_name
    ]);
})->name('category.tour');
