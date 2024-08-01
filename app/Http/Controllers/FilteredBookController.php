<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterBookRequest;
use App\Services\FilteredBookService;
use App\Http\Resources\BookResources;
use App\Jobs\FilteredBooksExportExcelQueue;

class FilteredBookController extends Controller
{
        public function getBookByFilter(FilterBookRequest $request)
        {
            $validatedData = $request->validated();
            // dd(filled($validatedData) == "excel");
            $message = 'The Excel file is being prepared. The download will be started when it is ready.';

            $filtersCollection = collect($validatedData);
            
            if (filled($filtersCollection) == "excel" && $request->input("excel")==1) {
                // $token = Str::random(20);

                // Cache::put($token, $filters, now()->addMinutes(1));

                
                FilteredBooksExportExcelQueue::dispatch($filtersCollection);

                $data = [
                    'status' => 200,
                    'message' => $message,
                ];

                
                return response()->json($data);
            }

            $service=new FilteredBookService();

            $books= $service->goToRepository($filtersCollection);

            return BookResources::collection($books);

        }


}
