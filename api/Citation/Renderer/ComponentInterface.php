<?php
namespace jobrunner\inlitteris\api\Renderer;

interface ComponentInterface
{
    /**
     * Renders a component in a citation
     *
     * @return string
     */
    public function render();
}