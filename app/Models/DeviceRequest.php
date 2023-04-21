<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceRequest extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'device', 'model', 'specifications', 'device_bought', 'serial_number', 'code', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
