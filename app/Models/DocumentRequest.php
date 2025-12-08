<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "document_id",
        "status",
        "purpose",
        "barangay_id",
        "fee",
        "processing_period",
        "reference_number",
    ];

    const STATUS_PENDING = "pending";
    const STATUS_PROCESSING = "processing";
    const STATUS_COMPLETED = "completed";
    const STATUS_CANCELLED = "cancelled";
    const STATUS_FOR_PICKUP = "for_pickup";

    protected $appends = ["age_in_days"];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }

    public function getAgeInDaysAttribute()
    {
        return now()->diffInDays($this->created_at);
    }
}
