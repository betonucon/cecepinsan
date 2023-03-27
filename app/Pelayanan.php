<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 't_pelayanan';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mwarga(){
        return $this->belongsTo('App\Warga','nik','nik');
    }
    function mpelayanan(){
        return $this->belongsTo('App\Mpelayanan','tipe','tipe');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
