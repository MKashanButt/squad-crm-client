<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormInput extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_phone',
        'secondary_phone',
        'first_name',
        'last_name',
        'dob',
        'medicare_id',
        'address',
        'city',
        'state',
        'zip',
        'product_specs',
        'doctor_name',
        'facility_name',
        'patient_last_visit',
        'doctor_address',
        'doctor_phone',
        'doctor_fax',
        'doctor_npi',
        'recording_link',
        'comments',
        'center_code_id',
        'insurance_id',
        'products_id',
        'users_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'dob' => 'date',
        'center_code_id' => 'integer',
        'insurance_id' => 'integer',
        'products_id' => 'integer',
        'users_id' => 'integer',
    ];

    public function centerCode(): BelongsTo
    {
        return $this->belongsTo(CenterCode::class);
    }

    public function insurance(): BelongsTo
    {
        return $this->belongsTo(Insurance::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
