<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function package_track()
    {
        return $this->hasMany(Package_track::class);
    }

    public function user_s()
    {
        return $this->belongsTo(ExpressUser::class, 'user_sender_id');
    }

    public function user_r()
    {
        return $this->belongsTo(ExpressUser::class, 'user_reciver_id');
    }

    public function point_s()
    {
        return $this->belongsTo(Point::class, 'point_id_s');
    }

    public function point_r()
    {
        return $this->belongsTo(Point::class, 'point_id');
    }
}
