<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('dashboard.reservations.index',compact('reservations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'=>'required|exists:services,id',
            'reservation_time'=>'required|date|after:now'
        ]);

        Reservation::create([
            'user_id'=>Auth::id(),
            'service_id'=>$request->service_id,
            'reservation_time'=>$request->reservation_time,
            'status'=>'pending'
        ]);

        return redirect()->route('website.home')->with('success','Reservation submitted successfully');
    }

    public function myReservations()
    {
        $myReservations = Reservation::with('service')->where('user_id',Auth::id())->get();
        return view('website.reservations.my-reservation',compact('myReservations'));
    }

    public function cancel(Service $service)
    {
        $reservation = Reservation::where('service_id', $service->id)
            ->where('user_id', auth()->id())
            ->first();

            $reservation->delete();
            return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }

    public function edit($id)
    {
        $reserve = Reservation::findOrFail($id);
        return view('dashboard.reservations.edit',compact('reserve'));
    }

    public function updateStatus(Request $request,$id)
    {
        $reserve = Reservation::findOrFail($id);

        $reserve->update([
            'status'=>$request->status
        ]);

        return redirect()->route('dashboard.reservations.index');
    }

}
