<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 17.06.19
 * Time: 13:04
 */

namespace SysPerson\MagentoAcademy\ViewModel;

use SysPerson\MagentoAcademy\Api\PersonFront\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ReadFrontConfig implements ArgumentInterface , ConfigInterface
{
    protected $scopeConfig;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->scopeConfig = $config;
    }

    public function getTitle()
    {
        return $this->scopeConfig->getValue(self::TITLE_CONFIG_PATH);
    }
    public function getMessage()
    {
        return $this->scopeConfig->getValue(self::MESSAGE_CONFIG_PATH);
    }

}