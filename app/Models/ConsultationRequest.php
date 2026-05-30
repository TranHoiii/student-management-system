<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['full_name', 'phone', 'email', 'company_name', 'service_id', 'message', 'status'])]
class ConsultationRequest extends Model
{
    use HasFactory;

    /**
     * Get the service that the consultation request belongs to.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
