<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Databases\Login;
use App\Http\Controllers\Image;
use App\Http\Databases\Invoice;

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

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get("/", function () {
        return view("dashboard");
    });
    Route::get("handys", function () {
        return view("handys");
    });

    Route::get("calendar", function () {
        return view("calendar");
    });

    Route::get("invoice", [Invoice::class, "get"]);
    Route::get("invoice/get/{id}", [Invoice::class, "view"]);
    Route::post("invoice/create/{id}/company/{company}", [Invoice::class, "create"]);

    Route::get("invoice/create", [Invoice::class, "createNewInvoiceView"]);
    Route::post("invoice/create/company/{company}", [Invoice::class, "createNewInvoiceCompany"]);

    Route::get("image/get/{handyOwner}", [Image::class, "get"]);
    Route::post("image/save", [Image::class, "save"]);
});

Route::post("login/auth", [Login::class, "auth"]);