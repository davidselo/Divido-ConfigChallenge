<?php

namespace Parser\Adapter;

/**
 * Abstract adapter
 *
 * @category    Adapter
 * @author      David Villalba Flores
 */
interface ParserInterface
{
    /**
     * Get config method.
     * @return Json|array configuration information.
     */
    public function get(string $configValue): string;
}
