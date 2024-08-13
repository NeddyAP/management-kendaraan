<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranPerbulan extends Model
{
    use HasFactory;

    protected $table = 'anggaran_perbulans';

    protected $fillable = [
        'januari',
        'februari',
        'maret',
        'april',
        'mei',
        'juni',
        'juli',
        'agustus',
        'september',
        'oktober',
        'november',
        'desember',
    ];

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->januari + $this->februari + $this->maret + $this->april + $this->mei + $this->juni + $this->juli + $this->agustus + $this->september + $this->oktober + $this->november + $this->desember;
    }

    public function paguAnggarans()
    {
        return $this->hasMany(PaguAnggaran::class);
    }

    public function masterAnggarans()
    {
        return $this->hasMany(MasterAnggaran::class);
    }

    public function groupAnggarans()
    {
        return $this->hasMany(GroupAnggaran::class);
    }
}