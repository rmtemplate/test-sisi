<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HeadingMenu extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name'];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'id_heading_menu', 'id');
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
