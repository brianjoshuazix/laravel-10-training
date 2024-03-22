<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // fetch all users
    $users = DB::select("select * from users");

    // create user
    // $user = DB::insert('insert into users (name, email, password) values (?,?,?)', [
    // 'Brian Joshua',
    // 'naruto@gmail.com',
    // 'password',
    // ]);

    // update user
    // $user = DB::update("update users set email=? where id=?", [
    //     'naruto@gmail.com',
    //     2,
    // ]);

    // delete user
    // $user = DB::delete("delete from users where id=2");
    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
