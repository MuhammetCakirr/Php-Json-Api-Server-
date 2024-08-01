<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\BookViewLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MostViewedBooksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BookViewLog::select('book_id', \DB::raw('count(*) as view_count'))
            ->groupBy('book_id')
            ->orderBy('view_count', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * @param  BookViewLog  $bookviewlog
     */
    public function map($bookviewlog): array
    {
        $book = Book::query()->with('genres', 'author')->find($bookviewlog->book_id);

        return [
            $book ? $book->id : 'Unknown ID',
            $book ? $book->title : 'Unknown Title',
            $book ? $book->description : 'Unknown Description',
            $book ? $book->published_date : 'Unknown Description',
            $book ? $book->author->name : 'Unknown Author',
            $book ? $book->author->biography : 'Unknown Author',
            $book ? $book->author->dateofbirth : 'Unknown Author',
            $book ? $bookviewlog->view_count : 'Unknown Book',
        ];
    }

    public function headings(): array
    {
        return [
            'Book ID',
            'Title',
            'Description',
            'Published Date',
            'Author Name',
            'Author Biography',
            'Author Birthday',
            'View Count',
        ];
    }
}
