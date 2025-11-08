<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_name','company_id','price','stock','comment','img_path'];

    public function getDisplayIdAttribute(): int
    {
        return static::orderBy('id', 'asc')->pluck('id')->search($this->id) + 1;
    }

    public function scopeFilter($query, $request)
    {
        return $query
            ->when($request->name, fn($q) => $q->where('product_name', 'like', '%'.$request->name.'%'))
            ->when($request->company_id, fn($q) => $q->where('company_id', $request->company_id));
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}