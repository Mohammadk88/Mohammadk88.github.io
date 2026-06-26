<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFeature extends Model
{
    protected $fillable = ['project_id', 'feature_ar', 'feature_en', 'feature_tr', 'icon'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getLabel(): string
    {
        $locale = app()->getLocale();
        return $this->{"feature_{$locale}"} ?? $this->feature_ar ?? $this->feature_en ?? '';
    }
}
