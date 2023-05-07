<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\DeviceRequest;
use App\Http\Resources\DeviceRequestResource;
use App\Http\Resources\UserResource;

class DeviceRequestController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $deviceRequests = DeviceRequest::all();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Display a listing of the resource.
     */
    public function expired() {
        $deviceRequests = DeviceRequest::all();
        $expiredRequests = collect([]);

        foreach ($deviceRequests as $deviceRequest) {
            $futureDate = Carbon::parse($deviceRequest->receipt_date)->addYears(2);

            if (Carbon::parse($futureDate)->lessThanOrEqualTo(Carbon::now())) {
                $expiredRequests->push($deviceRequest);
                $deviceRequest->update([
                    'status' => 'Expired'
                ]);
            }
        }

        return DeviceRequestResource::collection($expiredRequests);
    }

    /**
     * Display a listing of a user's resource.
     */
    public function user(User $user) {
        $deviceRequests = DeviceRequest::where('user_id', $user->id)->get();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $username = User::find($request->user_id)->name;
        $fileAttach     = $request->file('attachment');
        $filenameAttach = 'Receipt - ' . $username . ' '  . time() . '.' . $fileAttach->getClientOriginalExtension();
        $pathLog     = $fileAttach->storeAs('Receipts', $filenameAttach);

        $deviceRequest = DeviceRequest::create([
            'user_id' => $request->user_id,
            'device' => $request->device,
            'model' => $request->model,
            'specifications' => $request->specifications,
            'device_bought' => $request->input('device_bought') ? true : false,
            'serial_number' => $request->serial_number,
            'imei' => $request->imei,
            'code' => $request->code,
            'status' => $request->status,
            'receipt_date' => $request->receipt_date,
            'attachment' => $pathLog,
            'assistant_id' => $request->assistant_id,
        ]);

        return new DeviceRequestResource($deviceRequest);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function users(Request $request) {
        $users = User::where('job_title', 'Manager')->orWhere('job_title', 'Director')->get();
        return UserResource::collection($users);
    }

    public function mine(User $user) {
        $deviceRequests = DeviceRequest::where('user_id', $user->id)->get();
        return DeviceRequestResource::collection($deviceRequests);
    }

    public function onbehalf(User $user) {
        $deviceRequests = DeviceRequest::where('assistant_id', $user->id)->get();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceRequest $deviceRequest) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceRequest $deviceRequest) {
        //
    }
}
