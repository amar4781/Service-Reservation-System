<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $reservations = ReservationResource::collection(Reservation::all());
        return $this->apiResponde($reservations,'ok',200);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation){
            return $this->apiResponde(null,'not found',404);
        }
        return $this->apiResponde(new ReservationResource($reservation),'ok',200);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation){
            return $this->apiResponde(null,'not found',404);
        }

        $reservation->update($request->only('status'));

        return $this->apiResponde(new ReservationResource($reservation),'ok',200);
    }
}
