<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrw extends Model
{
    protected $table = 'm_rw';
    protected $guarded = ['id'];
    public $timestamps = false;
    // function mjabatan(){
    //     return $this->belongsTo('App\Models\Jabatan','jabatan_id','id');
    // }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
