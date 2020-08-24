<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Currency\Interfaces\Driver;
use Nails\Currency\Resource\Currency;
use Nails\Factory;

class OpenExchangeRates extends Base implements Driver
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

    // --------------------------------------------------------------------------

    /**
     * Returns the rate between two given currencies
     *
     * @param Currency $oFrom The from currency
     * @param Currency $oTo   The to currency
     *
     * @return float
     */
    public function getRate(Currency $oFrom, Currency $oTo): float
    {
        return 0.22;
    }
}
