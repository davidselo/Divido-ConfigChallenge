<?php

namespace Loader\Adapter;

use Loader\Adapter\LoaderInterface;

class JsonAdapter implements LoaderAdapterInterface
{

    public function loadConfig(string $file): array
    {
        var_dump(__METHOD__);
        // TODO: Implement loadConfig() method.
    }

    public function overwriteConfig(string $file): array
    {
        // TODO: Implement overwriteConfig() method.
    }
}