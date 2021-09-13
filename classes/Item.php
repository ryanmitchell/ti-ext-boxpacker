<?php

namespace Thoughtco\Boxpacker\Classes;

use DVDoug\BoxPacker\Item as ItemInterface;

class Item implements ItemInterface
{
    private $dimensions;
    private $description;
    
    public function __construct($description, $dimensions)
    {
        $this->description = $description;
        $this->dimensions = (object)$dimensions;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }

    public function getWidth(): int
    {
        return (int)$this->dimensions->width ?? 10;    
    }

    public function getLength(): int
    {
        return (int) ($this->dimensions->length ?? 10);    
    }

    public function getDepth(): int
    {
        return (int) ($this->dimensions->depth ?? 10);    
    }

    public function getWeight(): int
    {
        return (int)($this->dimensions->weight ?? 1);    
    }

    public function getAllowedRotations(): int
    {
        return self::ROTATION_BEST_FIT;
    }
    
    public function getKeepFlat(): bool 
    {
        return false;
    }
}