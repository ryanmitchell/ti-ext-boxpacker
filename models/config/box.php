<?php

return [
    'list' => [
        'toolbar' => [
            'buttons' => [
		        'create' => [
		            'label' => 'lang:admin::lang.button_new',
		            'class' => 'btn btn-primary',
		            'href' => 'thoughtco/boxpacker/boxes/create',
		        ],
                'delete' => ['label' => 'lang:admin::lang.button_delete', 'class' => 'btn btn-danger', 'data-request-form' => '#list-form', 'data-request' => 'onDelete', 'data-request-data' => "_method:'DELETE'", 'data-request-data' => "_method:'DELETE'", 'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm'],
            
			],
        ],
		'filter' => [],
        'columns' => [
            'edit' => [
                'type' => 'button',
                'iconCssClass' => 'fa fa-pencil',
                'attributes' => [
                    'class' => 'btn btn-edit',
                    'href' => 'thoughtco/boxpacker/boxes/edit/{id}',
                ],
            ],
            'label' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_label',
                'type' => 'text',
                'sortable' => TRUE,
            ],
        ],
    ],

    'form' => [
        'toolbar' => [
            'buttons' => [
                'back' => ['label' => 'lang:admin::lang.button_icon_back', 'class' => 'btn btn-default', 'href' => 'thoughtco/boxpacker/boxes'],
                'save' => [
                    'label' => 'lang:admin::lang.button_save',
                    'class' => 'btn btn-primary',
                    'data-request' => 'onSave',
                ],
                'saveClose' => [
                    'label' => 'lang:admin::lang.button_save_close',
                    'class' => 'btn btn-default',
                    'data-request' => 'onSave',
                    'data-request-data' => 'close:1',
                ],
            ],
        ],
		'fields' => [
            'label' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_label',
                'type' => 'text',
				'span' => 'left',
            ],
		    'locations' => [
		        'label' => 'lang:admin::lang.label_location',
		        'type' => 'relation',
		        'span' => 'right',
		        'valueFrom' => 'locations',
		        'nameFrom' => 'location_name',
		    ],
			'dimensions[width]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_width',
                'type' => 'text',
                'span' => 'left',
            ],
			'dimensions[length]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_length',
                'type' => 'text',
                'span' => 'right',
            ],			
			'dimensions[depth]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_depth',
                'type' => 'text',
                'span' => 'left',
            ],
			'dimensions[weight]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_weight',
                'type' => 'text',
                'span' => 'right',
            ],
			'dimensions[inner_width]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_inner_width',
                'type' => 'text',
                'span' => 'left',
            ],
			'dimensions[inner_length]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_inner_length',
                'type' => 'text',
                'span' => 'right',
            ],			
			'dimensions[inner_depth]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_inner_depth',
                'type' => 'text',
                'span' => 'left',
            ],
			'dimensions[max_weight]' => [
                'label' => 'lang:thoughtco.boxpacker::default.label_max_weight',
                'type' => 'text',
                'span' => 'right',
            ],
			'is_enabled' => [
				'label' => 'lang:thoughtco.boxpacker::default.label_status',
				'type' => 'switch',
				'span' => 'left',
			],		
        ],
    ],
];
