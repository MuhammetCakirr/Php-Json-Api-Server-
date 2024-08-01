<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateContractForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $name;

    private string $bookName;

    private string $dateOfTake;

    private string $deliveryDate;

    public function __construct(string $name, string $bookname, string $dateoftake, string $deliverydate)
    {
        $this->name = $name;
        $this->bookName = $bookname;
        $this->dateOfTake = $dateoftake;
        $this->deliveryDate = $deliverydate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView('contracts.contract', [
            'name' => $this->name,
            'bookName' => $this->bookName,
            'dateOfTake' => $this->dateOfTake,
            'deliveryDate' => $this->deliveryDate,
        ]);

        $fileName = 'contract_'.$this->name.now()->format('Y_m_d_H_i_s').'.pdf';
        $pdf->save(storage_path('app/public/contracts/'.$fileName));
    }
}
