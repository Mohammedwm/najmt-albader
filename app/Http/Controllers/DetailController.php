<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailController extends Controller
{
    public function index($Worker_id)
    {
        $worker = Worker::findOrFail($Worker_id);
        if ($worker == null) {
            return abort(404);
        }
        return view('front.detail', compact('worker'));
    }
    public function bookingWorker(Request $request)
    {
        $role = [
            'worker_id' => 'required|numeric|exists:workers,id',
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:9',
            'description' => 'required|max:255',
        ];
        $validator = Validator::make($request->all(), $role);
        if ($validator->fails()) {
            return response()->json(['status'=>2,'errors'=>$validator->errors()->all()]);
        }
        $worker = Worker::findOrFail($request->worker_id);
        if ($worker == null) {
            $error[] = 'خطأ في رقم العاملة';
            return response()->json(['status'=> 2,'errors'=>$error]);
        }
        if ($worker->status == 0) {
            $error[] = 'العاملة غير فعالة';
            return response()->json(['status'=> 2,'errors'=>$error]);
        }
        if ($worker->status == 2) {
            $error[] = 'العاملة محجوزة حالياً ';
            return response()->json(['status'=> 2,'errors'=>$error]);
        }
        $data = $request->all();
        $data['follow_url'] = uniqid();
        $booking = Booking::create($data);
        $data['message'] = 'تمت عملية حجز العاملة بنجاح';
        $data['booking_id'] = $booking->id;
        $worker->status = 2;
        $worker->save();
        return response()->json(['status' => 1 ,'errors' => $data]);
    }
    public function bookingFollow($follow_url)
    {
        $booking = Booking::where('follow_url',$follow_url)->first();
        if ($booking == null) {
            return abort(404);
        }
        return view('front.booking-follow', compact('booking'));
    }
}
