<?php


namespace SysPerson\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface;
use SysPerson\MagentoAcademy\Api\Order\QuickOrderInterfaceFactory;

class UpgradeData implements UpgradeDataInterface
{
    /** @var QuickOrderInterfaceFactory  */
    private $QuickOrderFactory;

    /**
    private $transactionFactory;
     */
    private $transactionFactory;

    /** @var LoggerInterface  */
    private $logger;

    /**
     * UpgradeData constructor.
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        QuickOrderInterfaceFactory $QuickOrderFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->transactionFactory    = $transactionFactory;
        $this->QuickOrderFactory     = $QuickOrderFactory;
        $this->logger                = $logger;
    }


    /** {@inheritDoc} */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.6', '<')) {

            /** @var Transaction $transactionalModel */
            $transactionalModel = $this->transactionFactory->create();

            for ($i = 1; $i < 25; $i++) {
                /** @var QuickOrderInterface $order */
                $order = $this->QuickOrderFactory->create();
                $order->setName(sprintf("Name %d", $i));
                $order->setSku(sprintf("Sku %d", $i));
                $order->setEmail(sprintf("Email %d", $i));
                $order->setPhone(sprintf("Phone %d",$i));
                $transactionalModel->addObject($order);
            }

            try {
                $transactionalModel->save();
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }

        }
    }

//    public function getAttribut(){
//        $eavSetup = $this->eavSetupFactory->create();
//        /** test attribute dipending from paiment country*/
//        $eavSetup->addAttribute(Product::ENTITY, 'TestCountryAttribute',
//            [
//                'group' => 'General',
//                'type' => 'varchar',
//                'label' => 'TestCountryAttribute',
//                'input' => 'multiselect',
//                'source' => Country::class,
//                'frontend' => Frontend::class,
//                'backend' => Backend::class,
//                'required' => false,
//                'sort_order' => 50,
//                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
//                'is_used_in_grid' => true,
//                'is_visible_in_grid' => true,
//                'is_filterable_in_grid' => true,
//                'visible' => true,
//                'is_html_allowed_on_front' => true,
//                'visible_on_front' => true
//
//            ]);
//
//    }
}
