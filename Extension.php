<?php

namespace Thoughtco\Boxpacker;

use Admin\Models\Menus_model;
use Admin\Models\Orders_model;
use DVDoug\BoxPacker\InfalliblePacker;
use Illuminate\Support\Facades\Event;
use Igniter\Local\Facades\Location;
use System\Classes\BaseExtension;
use Thoughtco\Boxpacker\Classes\Item as BoxItem;
use Thoughtco\Boxpacker\Classes\Box as BoxClass;
use Thoughtco\Boxpacker\Models\Box;

class Extension extends BaseExtension
{
    public function boot()
    {
        $this->extendMenus();
        $this->extendOrders();
        $this->packBoxesOnPayment();
    }

    private function extendMenus()
    {
		Menus_model::extend(function ($model) {
			$model->fillable(array_merge($model->getFillable(), ['dimensions']));
            $model->addCasts(['dimensions' => 'array']);
		});

        Event::listen('admin.form.extendFieldsBefore', function ($form) {

            if ($form->model instanceof Menus_model) {

                $form->tabs['fields']['dimensions[width]'] = [
                    'tab' => 'lang:thoughtco.boxpacker::default.tab_dimensions',
                    'label' => 'lang:thoughtco.boxpacker::default.label_width',
                    'type' => 'text',
                    'span' => 'left',
                ];

                $form->tabs['fields']['dimensions[length]'] = [
                    'tab' => 'lang:thoughtco.boxpacker::default.tab_dimensions',
                    'label' => 'lang:thoughtco.boxpacker::default.label_length',
                    'type' => 'text',
                    'span' => 'right',
                ];

                $form->tabs['fields']['dimensions[depth]'] = [
                    'tab' => 'lang:thoughtco.boxpacker::default.tab_dimensions',
                    'label' => 'lang:thoughtco.boxpacker::default.label_depth',
                    'type' => 'text',
                    'span' => 'left',
                ];

                $form->tabs['fields']['dimensions[weight]'] = [
                    'tab' => 'lang:thoughtco.boxpacker::default.tab_dimensions',
                    'label' => 'lang:thoughtco.boxpacker::default.label_weight',
                    'type' => 'text',
                    'span' => 'right',
                ];

            }

        });
    }

    private function extendOrders()
    {
		Orders_model::extend(function ($model) {
			$model->fillable(array_merge($model->getFillable(), ['boxes']));
		});
    }

    private function packBoxesOnPayment()
    {
        Event::listen('admin.order.beforePaymentProcessed', function ($model) {

            if (!Location::orderTypeIsDelivery())
                return;

            $packer = new InfalliblePacker();

            Box::whereHasOrDoesntHaveLocation(Location::current()->location_id)
                ->isEnabled()
                ->each(function ($box) use ($packer) {
                    $packer->addBox(new BoxClass($box));
                });

            $model->getOrderMenus()
            ->each(function ($orderMenu) use ($packer) {
                if ($menuModel = Menus_model::find($orderMenu->menu_id ?? $orderMenu->id)) {
                    $packer->addItem(new BoxItem($menuModel->menu_name, $menuModel->dimensions), $orderMenu->quantity ?? $orderMenu->qty);
                }
            });

            $packedBoxes = $packer->pack();
            $unpackedItems = $packer->getUnpackedItems();

            $model->boxes = [
                'packed' => collect($packedBoxes)->map(function ($box) {
                    return [
                        'type' => $box->getBox()->getReference(),
                        'box_id' => $box->getBox()->getId(),
                        'dimensions' => $box->getBox()->getDimensions(),
                        'items' => collect($box->getItems())->map(function ($item) {
                            return $item->getItem()->getDescription();
                        }),
                    ];
                })->toArray(),
                'unpacked' => collect($unpackedItems)->map(function ($item) {
                    return $item->getDescription();
                })->toArray(),
            ];

        });
    }


    public function registerPermissions()
    {
        return [
            'Thoughtco.Boxpacker.Manage' => [
                'description' => 'Create, modify and delete boxes',
                'group' => 'module',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'restaurant' => [
                'child' => [
                    'boxes' => [
                        'priority' => 999,
                        'class' => 'boxes',
                        'href' => admin_url('thoughtco/boxpacker/boxes'),
                        'title' => lang('thoughtco.boxpacker::default.text_boxes'),
                        'permission' => 'Thoughtco.Boxpacker.*',
                    ],
                ],
            ],
        ];
    }

}
