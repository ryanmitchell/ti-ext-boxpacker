<?php

namespace Thoughtco\Boxpacker\Classes;

use DVDoug\BoxPacker\Box as BoxInterface;

class Box implements BoxInterface
{
    private $model;
    private $dimensions;
    
    public function __construct($model)
    {
        $this->model = $model;
        $this->dimensions = (object)$model->dimensions;
    }
    
    public function getReference(): string
    {
        return $this->model->label;
    }
    
    public function getId(): string
    {
        return $this->model->id;
    }
    
    public function getDimensions(): array
    {
        return (array)$this->dimensions;
    }
    
    public function getOuterWidth(): int
    {
        return (int)($this->dimensions->width ?? 10);    
    }

    public function getOuterLength(): int
    {
        return (int)($this->dimensions->length ?? 10);    
    }

    public function getOuterDepth(): int
    {
        return (int)($this->dimensions->depth ?? 10);    
    }

    public function getEmptyWeight(): int
    {
        return (int)($this->dimensions->weight ?? 1);    
    }

    public function getInnerWidth(): int
    {
        return (int)($this->dimensions->inner_width ?? 10);    
    }

    public function getInnerLength(): int
    {
        return (int)($this->dimensions->inner_length ?? 10);    
    }

    public function getInnerDepth(): int
    {
        return (int)($this->dimensions->inner_depth ?? 10);    
    }

    public function getMaxWeight(): int
    {
        return (int)($this->dimensions->max_weight ?? 1);    
    }

}