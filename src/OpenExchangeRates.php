<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Factory;

class OpenExchangeRates extends Base
{
    /**
     * The base url of the Open Exchange Rates service
     * @var string
     */
    const BASE_URL = 'https://openexchangerates.org/api';

    // --------------------------------------------------------------------------

    /**
     * The App ID to use.
     * @var string
     */
    protected $sAppId;
}
