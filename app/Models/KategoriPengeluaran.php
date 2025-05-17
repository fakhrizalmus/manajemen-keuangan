<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriPengeluaran extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the KategoriPengeluaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class);
    }
}
