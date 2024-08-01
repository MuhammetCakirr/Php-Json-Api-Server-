<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookUserController;
use App\Http\Controllers\FilteredBookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckBookPermission;
use App\Http\Middleware\LogUnauthorizedAccess;
use Illuminate\Support\Facades\Route;

// Authenticated routes group
Route::middleware('auth:sanctum')->group(function () {

    /*Status Operations*/
    Route::prefix('Status')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateStatus', [StatusController::class, 'store']);
            Route::get('AllStatus', [StatusController::class, 'index']);
            Route::post('ShowStatusById/{id}', [StatusController::class, 'show']);
            Route::put('UpdateStatus/{id}', [StatusController::class, 'update']);
            Route::post('DeleteStatus/{id}', [StatusController::class, 'destroy']);
        });
    });

    /*Genre Operations*/
    Route::prefix('Genre')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateGenre', [GenreController::class, 'create']);
            Route::get('AllGenres', [GenreController::class, 'index']);
            Route::post('ShowGenreById/{id}', [GenreController::class, 'show']);
            Route::put('UpdateGenre/{id}', [GenreController::class, 'update']);
            Route::post('DeleteGenre/{id}', [GenreController::class, 'delete']);
        });
    });

    /*Book Operations*/
    Route::prefix('Book')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::middleware(CheckBookPermission::class)->post('CreateBook', [BookController::class, 'create']);
            Route::get('AllBooks', [BookController::class, 'index']);
            Route::post('ShowBookById/{id}', [BookController::class, 'show']);
            Route::middleware(CheckBookPermission::class)->put('UpdateBook/{id}', [BookController::class, 'update']);
            Route::middleware(CheckBookPermission::class)->post('DeleteBook/{id}', [BookController::class, 'delete']);
        });
    });

    /*Author Operations */
    Route::prefix('Author')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateAuthor', [AuthorController::class, 'create']);
            Route::get('AllAuthors', [AuthorController::class, 'index']);
            Route::post('ShowAuthorById/{id}', [AuthorController::class, 'show']);
            Route::put('UpdateAuthor/{id}', [AuthorController::class, 'update']);
            Route::post('DeleteAuthor/{id}', [AuthorController::class, 'delete']);
        });
    });

    /*User Operations*/
    Route::prefix('User')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateUser', [UserController::class, 'create']);
            Route::get('AllUsers', [UserController::class, 'index']);
            Route::post('ShowUserById/{id}', [UserController::class, 'show']);
            Route::put('UpdateUser/{id}', [UserController::class, 'update']);
            Route::post('DeleteUser/{id}', [UserController::class, 'delete']);
        });
    });

    /*Book User Operations*/
    Route::prefix('BookUser')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateBookUser', [BookUserController::class, 'create']);
            Route::get('AllBookUser', [BookUserController::class, 'index']);
            Route::post('ShowBookUserById/{id}', [BookUserController::class, 'show']);
            Route::put('UpdateBookUser/{id}', [BookUserController::class, 'update']);
            Route::post('DeleteBookUser/{id}', [BookUserController::class, 'delete']);
        });
    });

    /*Role Operations*/
    Route::prefix('Role')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateRole', [RoleController::class, 'create']);
            Route::get('AllRoles', [RoleController::class, 'index']);
            Route::post('ShowRoleById/{id}', [RoleController::class, 'show']);
            Route::put('UpdateRole/{id}', [RoleController::class, 'update']);
            Route::post('DeleteRole/{id}', [RoleController::class, 'delete']);
        });
    });

    /*Permission Operations*/
    Route::prefix('Permission')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreatePermission', [PermissionController::class, 'create']);
            Route::get('AllPermissions', [PermissionController::class, 'index']);
            Route::post('ShowPermissionById/{id}', [PermissionController::class, 'show']);
            Route::put('UpdatePermission/{id}', [PermissionController::class, 'update']);
            Route::post('DeletePermission/{id}', [PermissionController::class, 'delete']);
        });
    });

    /*Role-Permission Operations*/
    Route::prefix('RolePermission')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateRolePermission', [RolePermissionController::class, 'create']);
            // Route::post("AllPermissions",[BookUserController::class,'index']);
            // Route::post("ShowPermissionById/{id}",[BookUserController::class,'show']);
            // Route::post("UpdateRolePermission/{id}",[BookUserController::class,'update']);
            Route::post('DeleteRolePermission', [RolePermissionController::class, 'delete']);
        });
    });

    /*Role-User Operations */
    Route::prefix('UserRole')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::post('CreateUserRole', [RoleUserController::class, 'create']);
            Route::get('AllUserRoles', [RoleUserController::class, 'index']);
            // Route::post("ShowPermissionById/{id}",[BookUserController::class,'show']);
            // Route::post("UpdateUserRole/{id}",[RoleUserController::class,'update']);
            Route::post('DeleteUserRole', [RoleUserController::class, 'delete']);
        });
    });

    /* Statistics */
    Route::prefix('Statistics')->group(function () {
        Route::middleware(LogUnauthorizedAccess::class)->group(function () {
            Route::get('mostreceivedbook', [StatisticsController::class, 'getMostReceivedBook']);
            Route::get('mosttakebookuser', [StatisticsController::class, 'getMostTakeBookUser']);
            Route::get('dailystatistic', [StatisticsController::class, 'getDailyStatistics']);
            Route::get('weeklystatistic', [StatisticsController::class, 'getWeeklyStatistics']);
            Route::get('montlystatistic', [StatisticsController::class, 'getMonthlyStatistics']);
            Route::get('mostviewedbook', [StatisticsController::class, 'getMostViewedBook']);
        });
    });

    /* Filtered Books */
    Route::get('filtered-books', [FilteredBookController::class, 'getBookByFilter']);


});

/*Login Operations*/
Route::post('Login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

/*Gives Active User */
Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getUser']);
