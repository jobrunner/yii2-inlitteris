<?php
namespace jobrunner\inlitteris\api\Citation\Renderer;

trait ComponentTrait
{
    protected $reference;

    public function __construct($reference)
    {
        $this->reference = $reference;
    }
}