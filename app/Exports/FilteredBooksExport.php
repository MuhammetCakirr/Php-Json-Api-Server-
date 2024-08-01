<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FilteredBooksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private Collection $books;

    public function __construct(Collection $books)
    {
        $this->books = $books;
    }

    public function collection()
    {
        return $this->books;
    }

    public function map($book): array
    {
        return [
            $book->title ?? 'Unknown Title',
            $book->description ?? 'Unknown Description',
            $book->pageCount ?? 'Unknown Page Count',
            $book->published_date ?? 'Unknown Published Date',
            $book->author->name ?? 'Unknown Author',
            $book->author->biography ?? 'Unknown Biography',
        ];
    }

    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Page Count',
            'Published Date',
            'Author Name',
            'Author Biography',
        ];
    }


}
