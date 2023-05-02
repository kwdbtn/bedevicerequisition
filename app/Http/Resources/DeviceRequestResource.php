<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceRequestResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'user' => User::find($this->user_id)->name,
            'device' => $this->device,
            'model' => $this->model,
            'specifications' => $this->specifications,
            'device_bought' => $this->device_bought,
            'serial_number' => $this->serial_number,
            'code' => $this->code,
            'status' => $this->status,
            'purchase_date' => $this->purchase_date,
            'request_date' => $this->created_at->toFormattedDateString(),
        ];
    }
}
