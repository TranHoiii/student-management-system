<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'slug', 'short_description', 'description', 'is_active'])]
class Service extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the consultation requests for the service.
     */
    public function consultationRequests(): HasMany
    {
        return $this->hasMany(ConsultationRequest::class);
    }
}
