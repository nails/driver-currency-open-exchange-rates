<?php

namespace Nails\Currency\Driver;

use Nails\Common\Driver\Base;
use Nails\Common\Factory\HttpRequest;
use Nails\Common\Service\HttpCodes;
use Nails\Currency\Exception\ExchangeException\DriverApiException;
use Nails\Currency\Exception\ExchangeException\DriverNotConfiguredException;
use Nails\Currency\Interfaces\Driver;
use Nails\Currency\Resource\Currency;
use Nails\Factory;

class OpenExchangeRates extends Base implements Driver
{
    /**
     * The base url of the Open Exchange Rates service
     *
     * @var string
     */
    const BASE_URL = 'https://openexchangerates.org/api';

    // --------------------------------------------------------------------------

    /**
     * The App ID to use.
     *
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
        if (empty($this->sAppId)) {
            throw new DriverNotConfiguredException(
                'The OpenExchangeRate App ID has not been configured'
            );
        }

        //  @todo (Pablo 24/08/2020) - Cache the request so subsequent queries for the same base are faster

        /** @var HttpRequest\Get $oGet */
        $oGet      = Factory::factory('HttpRequestGet');
        $oResponse = $oGet
            ->baseUri(static::BASE_URL)
            ->path('latest.json')
            ->query([
                'app_id' => $this->sAppId,
                'base'   => $oFrom->code,
            ])
            ->execute();

        if ($oResponse->getStatusCode() !== HttpCodes::STATUS_OK) {
            throw new DriverApiException(
                sprintf(
                    'Received a non-200 response from OER API: %s %s',
                    $oResponse->getStatusCode(),
                    $oResponse->getReasonPhrase()
                )
            );
        }

        $oBody = $oResponse->getBody();

        if (!property_exists($oBody->rates, $oTo->code)) {
            throw new DriverApiException(
                sprintf(
                    'Currency "%s" was not found in returned exchange rates for currency %s',
                    $oTo->code,
                    $oFrom->code
                )
            );
        }

        return (float) $oBody->rates->{$oTo->code};
    }
}
