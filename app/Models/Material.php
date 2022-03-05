<?php

namespace App\Models;

use App\Models\Traits\HasRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory, HasRecords;

    protected $fillable = [
        'content',
        'type',
        'name',
        'module_id',
    ];

    const TYPE_PDF = 'PDF';
    const TYPE_HYPERLINK = 'Hyperlink';

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getLinkAttribute()
    {
        return $this->type === self::TYPE_HYPERLINK ? $this->content : "/storage/$this->content";
    }
}
