<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'user'=>$this->user->name,
            'service'=>$this->service->name,
            'reservation_date&time'=>$this->reservation_time,
            'status'=>$this->status,
        ];
    }
}
