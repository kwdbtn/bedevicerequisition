<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
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
            'imei' => $this->imei,
            'code' => $this->code,
            'status' => $this->status,
            'receipt_date' => Carbon::parse($this->receipt_date)->toFormattedDateString(),
            'request_date' => $this->created_at->toFormattedDateString(),
            'attachment' => $this->attachment,
            'assistant_id' => $this->assistant_id,
        ];
    }
}
