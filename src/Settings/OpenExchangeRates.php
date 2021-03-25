<?php

namespace Nails\Currency\Driver\Settings;

use Nails\Common\Helper\Form;
use Nails\Common\Interfaces;
use Nails\Common\Service\FormValidation;
use Nails\Components\Setting;
use Nails\Factory;

/**
 * Class OpenExchangeRates
 *
 * @package Nails\Currency\Driver\Settings
 */
class OpenExchangeRates implements Interfaces\Component\Settings
{
    const KEY_APP_ID = 'sAppId';

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return 'Open Exchange Rates';
    }

    // --------------------------------------------------------------------------

    /**
     * @inheritDoc
     */
    public function get(): array
    {
        /** @var Setting $oAppId */
        $oAppId = Factory::factory('ComponentSetting');
        $oAppId
            ->setKey(static::KEY_APP_ID)
            ->setLabel('App ID')
            ->setInfo('A paid account is required for currency conversions to work correctly')
            ->setValidation([
                FormValidation::RULE_REQUIRED,
            ]);

        return [
            $oAppId,
        ];
    }
}
