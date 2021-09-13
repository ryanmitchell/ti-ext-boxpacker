<?php

namespace Thoughtco\Boxpacker\Models;

use Admin\Traits\Locationable;
use DVDoug\BoxPacker\Box as BoxInterface;
use Igniter\Flame\Database\Model;
use Igniter\Flame\Database\Traits\Validation;

class Box extends Model
{
    use Locationable;
    use Validation;
    
    const LOCATIONABLE_RELATION = 'locations';

    public $casts = [
        'dimensions' => 'array',
    ];
    
    protected $fillable = ['label', 'dimensions', 'is_enabled'];
        
    public $relation = [
        'morphToMany' => [
            'locations' => ['Admin\Models\Locations_model', 'name' => 'locationable'],
        ],
    ];  
    
    public $rules = [
        ['label', 'lang:thoughtco.boxpacker::default.label_label', 'required|string'],
        ['dimensions.width', 'lang:thoughtco.boxpacker::default.label_width', 'required|integer|min:0'],
        ['dimensions.length', 'lang:thoughtco.boxpacker::default.label_length', 'required|integer|min:0'],
        ['dimensions.depth', 'lang:thoughtco.boxpacker::default.label_depth', 'required|integer|min:0'],
        ['dimensions.weight', 'lang:thoughtco.boxpacker::default.label_weight', 'required|integer|min:0'],
        ['dimensions.inner_width', 'lang:thoughtco.boxpacker::default.label_inner_width', 'required|integer|min:0'],
        ['dimensions.inner_length', 'lang:thoughtco.boxpacker::default.label_inner_length', 'required|integer|min:0'],
        ['dimensions.inner_depth', 'lang:thoughtco.boxpacker::default.label_inner_depth', 'required|integer|min:0'],
        ['dimensions.max_weight', 'lang:thoughtco.boxpacker::default.label_max_weight', 'required|integer|min:0'],        
    ];  
    
    protected $table = 'thoughtco_boxes';
    
    public $timestamps = TRUE;    
    
    public function scopeIsEnabled($query)
    {
        return $query->where('is_enabled', 1);
    }
}
