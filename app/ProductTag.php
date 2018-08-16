<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductTag
 *
 * @package App
 * @property string $name
*/
class ProductTag extends Model
{
    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    
}
