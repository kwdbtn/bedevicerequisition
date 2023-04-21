<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeviceRequestResource;
use App\Models\DeviceRequest;
use Illuminate\Http\Request;

class DeviceRequestController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $deviceRequests = DeviceRequest::all();
        return DeviceRequestResource::collection($deviceRequests);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $deviceRequest = DeviceRequest::create([
            'user_id' => $request->user_id,
            'device' => $request->device,
            'model' => $request->model,
            'specifications' => $request->specifications,
            'device_bought' => $request->input('device_bought') ? true : false,
            'serial_number' => $request->serial_number,
            'code' => $request->code,
            'status' => $request->status,
        ]);

        return new DeviceRequestResource($deviceRequest);
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
