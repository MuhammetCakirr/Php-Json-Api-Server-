<?php

namespace App\Jobs;

use App\Exports\MostViewedBooksExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExcelQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = 'most_viewed_books_'.now()->format('Y_m_d_H_i_s').'.xlsx';
        Excel::store(new MostViewedBooksExport, $fileName, 'public');
    }
}
