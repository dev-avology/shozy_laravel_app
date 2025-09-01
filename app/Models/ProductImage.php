<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'alt_text',
        'is_primary',
        'sort_order',
        'type', // 'image', '360_view', '3d_model'
        'metadata', // For storing additional image data
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
        'metadata' => 'array',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scopes
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scope360View($query)
    {
        return $query->where('type', '360_view');
    }

    public function scope3DModel($query)
    {
        return $query->where('type', '3d_model');
    }

    // Accessors
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    public function getThumbnailUrlAttribute()
    {
        $path = $this->path;
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $thumbnailPath = str_replace('.' . $extension, '_thumb.' . $extension, $path);
        
        return asset('storage/' . $thumbnailPath);
    }

    public function getIs360ViewAttribute()
    {
        return $this->type === '360_view';
    }

    public function getIs3DModelAttribute()
    {
        return $this->type === '3d_model';
    }

    public function getFormattedTypeAttribute()
    {
        $types = [
            'image' => 'Image',
            '360_view' => '360° View',
            '3d_model' => '3D Model',
        ];

        return $types[$this->type] ?? 'Unknown';
    }
}
