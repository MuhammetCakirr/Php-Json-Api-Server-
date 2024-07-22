<?php

namespace App\Providers;

use App\Models\Genre;
use App\Repositories\AuthorRepositoryInterface;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\BookUserRepositoryInterface;
use App\Repositories\EloquentAuthorRepository;
use App\Repositories\EloquentBookRepository;
use App\Repositories\EloquentBookUserRepository;
use App\Repositories\EloquentGenreRepository;
use App\Repositories\EloquentPermissionReporistory;
use App\Repositories\EloquentRoleReporistory;
use App\Repositories\EloquentStatusRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\GenreRepositoryInterface;
use App\Repositories\PermissionReporistoryInterface;
use App\Repositories\RoleReporistoryInterface;
use App\Repositories\StatusRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StatusRepositoryInterface::class, EloquentStatusRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, EloquentGenreRepository::class);
        $this->app->bind(BookRepositoryInterface::class, EloquentBookRepository::class);
        $this->app->bind(AuthorRepositoryInterface::class, EloquentAuthorRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(BookUserRepositoryInterface::class, EloquentBookUserRepository::class);
        $this->app->bind(RoleReporistoryInterface::class, EloquentRoleReporistory::class);
        $this->app->bind(PermissionReporistoryInterface::class, EloquentPermissionReporistory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('valid_genre_ids', function ($attribute, $value, $parameters, $validator) {
            // Gelen değeri virgülle ayırarak diziye çevir
            $genreIds = explode(',', $value);

            // Her bir elemanın sayısal olup olmadığını ve genres tablosunda var olup olmadığını kontrol et
            foreach ($genreIds as $genreId) {
                if (! is_numeric($genreId)) {
                    return false; // Her eleman sayısal değilse geçersiz
                }

                // genres tablosunda bu id var mı diye kontrol edelim
                if (! Genre::where('id', $genreId)->exists()) {
                    return false; // Herhangi bir genre_id geçersizse false döndür
                }
            }

            return true; // Tüm genre_id'ler geçerliyse true döndür
        });
    }
}
