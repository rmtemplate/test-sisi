<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Menu extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['id_heading_menu', 'id_role', 'slug', 'name', 'icon', 'url', 'parent_id'];

    public function subMenu()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
