<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'user_id',
        'account_title',
        'account_no',
        'bank_name',
        'branch_code',
        'iban',
        'bank_letter_doc',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /*
    |===============================================
    | Get User Details For That Address
    |===============================================
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }


}
