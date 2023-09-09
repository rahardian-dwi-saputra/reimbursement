<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Authenticatable
{
    use HasFactory;
    
    protected $guard = "webkaryawan";
    protected $table = 'karyawan';
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $timestamps = false;  
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];

    public function reimbursement(): HasMany
    {
        return $this->hasMany(Reimbursement::class);
    }
    public function reimbursement_history(): HasMany
    {
        return $this->hasMany(Reimbursement_history::class);
    }
}
