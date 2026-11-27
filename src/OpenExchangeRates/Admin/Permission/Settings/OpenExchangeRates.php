<?php

namespace Nails\Currency\Driver\OpenExchangeRates\Admin\Permission\Settings;

use Nails\Admin\Interfaces\Permission;

class OpenExchangeRates implements Permission
{
    public function label(): string
    {
        return 'Can manage Open Exchange Rates settings';
    }

    public function group(): string
    {
        return 'Settings';
    }
}
