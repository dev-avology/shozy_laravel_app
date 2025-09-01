<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'vendor_id',
        'category_id',
        'status',
        'is_featured',
        'is_3d_available',
        'meta_title',
        'meta_description',
        'tags',
        'specifications',
        'weight',
        'dimensions',
        'stock_quantity',
        'min_order_quantity',
        'max_order_quantity',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_3d_available' => 'boolean',
        'specifications' => 'array',
        'tags' => 'array',
        'weight' => 'decimal:2',
        'dimensions' => 'array',
        'stock_quantity' => 'integer',
        'min_order_quantity' => 'integer',
        'max_order_quantity' => 'integer',
    ];

    // Relationships
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'active' => 'success',
            'inactive' => 'secondary',
            'pending' => 'warning',
            'rejected' => 'danger',
        ];

        $badge = $statuses[$this->status] ?? 'secondary';
        return "<span class='badge bg-{$badge}'>{$this->status}</span>";
    }

    public function getFeaturedBadgeAttribute()
    {
        if ($this->is_featured) {
            return "<span class='badge bg-warning'><i class='fas fa-star me-1'></i>Featured</span>";
        }
        return '';
    }

    public function get3DBadgeAttribute()
    {
        if ($this->is_3d_available) {
            return "<span class='badge bg-info'><i class='fas fa-cube me-1'></i>3D View</span>";
        }
        return '';
    }

    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    public function getFormattedPriceAttribute()
    {
        return 'AED ' . number_format($this->price, 2);
    }

    // Mutators
    public function setTagsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['tags'] = json_encode($value);
        } else {
            $this->attributes['tags'] = $value;
        }
    }

    public function setSpecificationsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['specifications'] = json_encode($value);
        } else {
            $this->attributes['specifications'] = $value;
        }
    }

    public function setDimensionsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['dimensions'] = json_encode($value);
        } else {
            $this->attributes['dimensions'] = $value;
        }
    }
}
