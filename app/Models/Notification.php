<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
        protected $fillable = ['type', 'message', 'related_id', 'read_at'];

}
