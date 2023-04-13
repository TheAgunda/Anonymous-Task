<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAvailability extends Model
{
    use HasFactory;
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
