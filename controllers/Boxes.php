<?php

namespace Thoughtco\Boxpacker\Controllers;

use Admin\Classes\AdminController;
use Admin\Facades\AdminMenu;
use Admin\Facades\Template;

class Boxes extends AdminController
{
    public $implement = [
        'Admin\Actions\FormController',
        'Admin\Actions\ListController',
    ];

    public $listConfig = [
        'list' => [
            'model' => 'Thoughtco\Boxpacker\Models\Box',
            'title' => 'lang:thoughtco.boxpacker::default.text_boxes',
            'emptyMessage' => 'lang:thoughtco.boxpacker::default.text_boxes_empty',
            'defaultSort' => ['id', 'DESC'],
            'configFile' => 'box',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:thoughtco.boxpacker::default.text_boxes',
        'model' => 'Thoughtco\Boxpacker\Models\Box',
        'create' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'thoughtco/boxpacker/boxes/edit/{id}',
            'redirectClose' => 'thoughtco/boxpacker/boxes',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'thoughtco/boxpacker/boxes/edit/{id}',
            'redirectClose' => 'thoughtco/boxpacker/boxes',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'thoughtco/boxpacker/boxes',
        ],
        'delete' => [
            'redirect' => 'thoughtco/boxpacker/boxes',
        ],
        'configFile' => 'box',
    ];

    protected $requiredPermissions = 'Thoughtco.Boxpacker.*';
    
    public function __construct()
    {
        parent::__construct();
        AdminMenu::setContext('restaurant', 'boxes');
    }
}
