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
use Magento\Catalog\Helper\Data;

class ReadFrontConfig  implements ArgumentInterface , ConfigInterface
{
    protected $product;
    protected $scopeConfig;
    protected $helperProduct;

    public function __construct(ScopeConfigInterface $config , Data $data)
    {
        $this->helperProduct = $data;
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

    public function getProduct(){

            $this->product = $this->helperProduct->getProduct();

        return $this->product;
    }

}