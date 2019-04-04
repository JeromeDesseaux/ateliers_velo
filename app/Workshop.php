<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Workshop extends Model
{
    use Sluggable;
    protected $fillable = ['title', 'description', 'city', 'zipcode', 'latitude', 'longitude', 'image', 'date', 'category_id','place','automatic_validation'];
    protected $guarded = ['status', 'slug'];
    // protected $dateFormat = 'd/m/Y H:M';

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = str_slug($value);
    // }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function setDateAttribute($value)
    {
        // $this->attributes['date'] = (new Carbon($value))->format('d/m/y H:M');
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y H:i', $value);
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d/m/Y à H:i');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\WorkshopCategory');
    }

    public function inscriptions()
    {
        return $this->hasMany('App\Inscription');
    }

    public function participants()
    {
        return $this->hasMany('App\Inscription')->where('status','=','accepted');
    }
}
