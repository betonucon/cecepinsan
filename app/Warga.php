<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'm_warga';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mpekerjaan(){
        return $this->belongsTo('App\Pekerjaan','pekerjaan_id','id');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
