<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    protected $fillable = ['name', 'phone', 'location', 'description', 'status'];

    // one vendor has many experiences
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
