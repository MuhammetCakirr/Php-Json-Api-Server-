<?php

namespace App\Services;

use App\Repositories\EloquentFilteredBookRepository;
use Illuminate\Support\Collection;

class FilteredBookService
{
    /**
     * Summary of filteredBooksRouting
     * @param Collection $filters
     * 
     */
    public function goToRepository(Collection $filters){

        $repository= new EloquentFilteredBookRepository();

        if (count($filters) === 1) 
        {
            
            $firstKey = $filters->keys()->first();

            $value = $filters->get($firstKey);

            if (filled($filters) === "author_id") 
            {

                $books= $repository->getAuthorAndBookData($filters->get('author_id'));
                return $books;
                
            }

            if (filled($filters) === "genres") 
            {
                $books= $repository->getGenreAndBookData($firstKey,$value);
                return $books;
            }

            $books=$repository->getOnlyBookData($firstKey,$value);
            return $books;

        }

        $books= $repository->getBookManyFilter($filters);
        return $books;
    }



}
