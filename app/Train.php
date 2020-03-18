<?php

/*
 *
 * Train Models
 *
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'trains';
    
    public $casts = [
        'train_line' => 'string',
        'route_name' => 'string',
        'run_number' => 'string',
        'operator_id' => 'string'
    ];
    
    
    //Which values can be updated?
    protected $fillable = [
        'train_line',
        'route_name',
        'route_number',
        'operator_id'
    ];
 
    //Prevent this from being duped
    public $guarded = ['run_number'];
    
    //We don't need to display the ID field
    //protected $hidden = [ 'id' ];
}
