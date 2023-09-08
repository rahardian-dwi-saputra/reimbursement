<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Reimbursement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function tanggalPengajuan(): Attribute
    {
        return Attribute::make(
        	get: fn (string $value) => Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y'),
            set: fn (string $value) => Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d'),
        );
    }
}