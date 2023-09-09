<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reimbursement_history extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function karyawan(): BelongsTo{
        return $this->belongsTo(Karyawan::class, 'karyawan');
    }
}
