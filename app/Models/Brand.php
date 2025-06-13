<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Brand extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'created_by',
    ];

    public function toSearchableArray(): array
    {
        return [
            'name'          => $this->name,
            'created_by'    => $this->created_by
        ];
    }

    public function searchableAs(): string
    {
        return 'brand_index';
    }
}
