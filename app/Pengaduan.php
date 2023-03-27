<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 't_pengaduan';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mwarga(){
        return $this->belongsTo('App\Warga','nik','nik');
    }
    function mkategoripengaduan(){
        return $this->belongsTo('App\Mpengaduan','kategori_pengaduan_id','id');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
