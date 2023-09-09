<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reimbursement_history extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    protected function waktu(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i:s'),
        );
    }
    public function karyawan(): BelongsTo{
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
