<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
    ];

    public function toArray(): array
    {
        $array = parent::toArray();
        $array['id'] = (string) $this->id;
        $array['description'] = $this->description ?? '';
        $array['createdAt'] = $this->created_at
            ? $this->created_at->format('d/m/Y')
            : now()->format('d/m/Y');

        return $array;
    }
}
