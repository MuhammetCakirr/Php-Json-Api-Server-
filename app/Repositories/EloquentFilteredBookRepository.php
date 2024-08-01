<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;


class EloquentFilteredBookRepository
{
    /**
     * Get books by book properties.
     * @param  array  $filter
     * @return Collection<Book>
     */
    public function getOnlyBookData(string $key, string $value): Collection
    {
        $query = Book::query();

        if ($key === 'minPage') {
            $query->where('pageCount', '>=', (int) $value);
        } elseif ($key === 'maxPage') {
            $query->where('pageCount', '<=', (int) $value);
        } elseif ($key === 'keyword') {
            $query->where(function ($query) use ($value) {
                $query->where('title', 'like', '%'.$value.'%')
                    ->orWhere('description', 'like', '%'.$value.'%');
            });
        } elseif ($key === 'published_date') {
            $query->whereYear('published_date', $value);
        }

        $books = $query->get();

        return $books;
    }

    /**
     * Get books by author ID.
     * @param int $id 
     * @return Collection<Book>
     */
    public function getAuthorAndBookData(int $id): Collection
    {
        $books = Book::query()->
            where('author_id', $id)->
            with('author')->
            get();

            return $books;
    }

    /**
     * Get books by genres ID.
     * @param string $key  
     * @param string $value
     * @return Collection<Book>
     */
    public function getGenreAndBookData(string $key, string $value): Collection
    {
        $genres = explode(',', $value);
        $books = collect();
        foreach ($genres as $id) {
            $genre = Genre::findOrFail($id);
            $books = $books->merge($genre->books);
        }
        $books = $books->unique('id');

        return $books;

    }

    /**
     * Get books by many diffrent properties.
     * @param  Collection  $filters
     * @return Collection<Book>
     */
    public function getBookManyFilter(collection $filters): Collection
    {
        $query = Book::query();

        if (isset($filters['minPage'])) {
            $query->where('pageCount', '>=', $filters['minPage']);
        }
        if (isset($filters['maxPage'])) {
            $query->where('pageCount', '<=', $filters['maxPage']);
        }

        if (isset($filters['genres'])) {
            $genreIds = explode(',', $filters['genres']);
            $query->whereHas('genres', function (Builder $query) use ($genreIds) {
                $query->whereIn('genre_id', $genreIds);
            });
        }

        if (isset($filters['keyword'])) {
            $query->where(function (Builder $query) use ($filters) {
                $query->where('title', 'like', '%'.$filters['keyword'].'%')
                    ->orWhere('description', 'like', '%'.$filters['keyword'].'%');
            });
        }

        if (isset($filters['author_id'])) {
            $query->where('author_id', $filters['author_id']);
        }

        $books = $query->get();

        return $books;
    }
}
