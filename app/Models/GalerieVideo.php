<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class GalerieVideo extends Model
{
    use LogsActivity;
    use SoftDeletes;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'galerie_videos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['site', 'titre', 'slug', 'url_video_youtube', 'description', 'etat', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " a été {$eventName}";
    }
}
