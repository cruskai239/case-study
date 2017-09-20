<?php

namespace App\Services\Impressions;

use App\User;
use Delatbabel\Elocrypt\Elocrypt;
use Illuminate\Database\Eloquent\Model;

class Impression extends Model
{
    use Elocrypt;
    //
    protected $table = 'impressions';
    protected $fillable = ['created_at', 'updated_at', 'data', 'user_id', 'event_name'];
    protected $dates = ['created_at', 'updated_at', ];
    protected $encrypts = ['data'];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }




}
