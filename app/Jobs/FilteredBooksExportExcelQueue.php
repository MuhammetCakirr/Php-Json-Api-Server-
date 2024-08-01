<?php

namespace App\Jobs;

use App\Exports\FilteredBooksExport;
use App\Services\FilteredBookService;
use Illuminate\Support\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class FilteredBooksExportExcelQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Collection $filters;

    /**
     * Create a new job instance.
     *
     * @param  Collection $filters
     */
    public function __construct(Collection $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filteredBookService= new FilteredBookService();

        $books= $filteredBookService->goToRepository($this->filters);

        $fileName = 'filtered_books_'.now()->format('Y_m_d_H_i_s').'.xlsx';

        Excel::store(new FilteredBooksExport($books), $fileName, 'public');
    }
}
