<?php


namespace SysPerson\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use SysPerson\MagentoAcademy\Model\Atribute\Frontend\TestCountryAttribute as Frontend;
use Magento\Customer\Model\ResourceModel\Address\Attribute\Source\Country;

use SysPerson\MagentoAcademy\Model\Atribute\Backend\TestCountryAttribute as Backend;

class UpgradeData implements UpgradeDataInterface
{
    protected $eavSetupFactory;


    /** @var LoggerInterface  */
    private $logger;

    /**
     * UpgradeData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        LoggerInterface $logger
    ) {
        $this->eavSetupFactory       = $eavSetupFactory;
        $this->logger                = $logger;
    }


    /** {@inheritDoc} */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.3', '<')) {

            $eavSetup = $this->eavSetupFactory->create();
            /** test attribute dipending from paiment country*/
            $eavSetup->addAttribute(Product::ENTITY, 'TestCountryAttribute',
                [
                    'group' => 'General',
                    'type' => 'varchar',
                    'label' => 'TestCountryAttribute',
                    'input' => 'multiselect',
                    'source' => Country::class,
                    'frontend' => Frontend::class,
                    'backend' => Backend::class,
                    'required' => false,
                    'sort_order' => 50,
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true,
                    'visible' => true,
                    'is_html_allowed_on_front' => true,
                    'visible_on_front' => true

                ]);


        }
    }
}
