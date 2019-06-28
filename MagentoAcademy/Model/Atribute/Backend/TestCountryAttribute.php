<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 28.06.19
 * Time: 21:05
 */

namespace SysPerson\MagentoAcademy\Model\Atribute\Backend;

use Magento\Framework\App\Config\ScopeConfigInterface;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Directory\Model\CountryFactory;

class TestCountryAttribute extends AbstractBackend
{
    protected $scopeConfig;
    protected $countryFactory;
    public function __construct(ScopeConfigInterface $config,CountryFactory $countryFactory)
    {
        $this->countryFactory = $countryFactory;
        $this->scopeConfig = $config;
    }

    /**
     * @param Product $object
     * @throws LocalizedException
     * @return bool
     */
    public function validate($object)
    {
        $storeTipe = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $path = 'payment/checkmo/specificcountry';
        $result = $this->scopeConfig->getValue($path,$storeTipe);
        $banCountry =explode(',',$result);
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if(is_array($value)) {
            $coincidence = array_intersect($banCountry, $value);
        }else{
            return true;
        }

        if (!empty($coincidence)){
            $banCountryName = $this->getCountryname($banCountry);
            $banCountryName = implode(',',$banCountryName);
            $stringException = "Theese countres not existis $banCountryName";
            throw new LocalizedException(__($stringException));
        }
        return true;
    }

    public function getCountryname($arrCode){
        $country = array();
        foreach ($arrCode as $code) {
            $countryModel = $this->countryFactory->create()->loadByCode($code);
            $country[]=$countryModel->getName();
        }
        return $country;
    }

}
