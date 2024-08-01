<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'Title' => $this->title,
            'Description' => $this->description,
            'Page Count' => $this->pageCount,
            'Published Date' => Carbon::parse($this->published_date)->format('l, F j, Y'),
            'Author Name' => $this->author->name,
            'Author Biography' => $this->author->biography,

        ];

    }
}
