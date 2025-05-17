<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriPemasukan extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the pemasukans for the KategoriPemasukan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pemasukans()
    {
        return $this->hasMany(Pemasukan::class);
    }
}
