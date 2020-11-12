<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'is_public'
    ];



    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public static function boot() {
        parent::boot();

        static::created(function (Snippet $snippet){
            $snippet->steps()->create([
                'order' => 1
            ]);
        });

        static::creating(function (Snippet $snippet) {
            $snippet->uuid = Str::uuid();
        });
    }

    public function isPublic() {
        return $this->is_public;
    }

    public function scopePublic(Builder $builder) {
        return $builder->where('is_public', true);
    }

    public function steps() {
        return $this->hasMany(Step::class)->orderBy('order', 'asc');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
