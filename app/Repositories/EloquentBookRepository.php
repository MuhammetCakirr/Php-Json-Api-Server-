<?php

namespace App\Repositories;

use App\Jobs\ExcelQueue;
use App\Models\Book;
use App\Models\BookViewLog;
use App\Models\Genre;

class EloquentBookRepository implements BookRepositoryInterface
{
    public function getAllBook()
    {
        return Book::with('genres', 'author')->get();
    }

    public function findById($id, $userid, $ipAddress)
    {
        BookViewLog::create([
            'user_id' => $userid,
            'book_id' => $id,
            'ip_address' => $ipAddress,
            'viewed_at' => now(),
        ]);
        $book = Book::where('id', $id)->with('genres', 'author')->first();
        // ->delay(now()->addSeconds(5))
        ExcelQueue::dispatch();

        return $book;
    }

    public function createBook($attributes)
    {
        $book = Book::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'published_date' => $attributes['published_date'],
            'author_id' => $attributes['author_id'],
        ]);

        if (isset($attributes['genre_id'])) {

            if (! is_array($attributes['genre_id'])) {
                $genreIds = explode(',', $attributes['genre_id']);
            } else {
                $genreIds = $attributes['genre_id'];
            }

            foreach ($genreIds as $genreId) {
                $genre = Genre::find($genreId);
                if ($genre) {
                    $book->genres()->attach($genreId);
                }
            }
        }

        return $book;
    }

    public function updateBook($id, array $attributes)
    {
        $book = Book::find($id);
        $updateData = [];
        if (isset($attributes['title'])) {
            $updateData['title'] = $attributes['title'];
        }
        if (isset($attributes['description'])) {
            $updateData['description'] = $attributes['description'];
        }
        if (isset($attributes['published_date'])) {
            $updateData['published_date'] = $attributes['published_date'];
        }
        if (isset($attributes['author_id'])) {
            $updateData['author_id'] = $attributes['author_id'];
        }
        if (! empty($updateData)) {
            $book->update($updateData);
        }
        if (isset($attributes['genre_id'])) {

            if (! is_array($attributes['genre_id'])) {
                $genreIds = explode(',', $attributes['genre_id']);
            } else {
                $genreIds = $attributes['genre_id'];
            }
            $book->genres()->detach();
            foreach ($genreIds as $genreId) {
                $genre = Genre::find($genreId);
                if ($genre) {
                    $book->genres()->attach($genreId);
                }
            }
        }

        return $book;
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        $book->delete();

        return true;
    }
}
