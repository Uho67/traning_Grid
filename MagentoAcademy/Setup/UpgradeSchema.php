<?php

namespace SysPerson\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;


use Magento\Framework\DB\Adapter\AdapterInterface;


use SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->logger->info(sprintf("%s is called", self::class));

        if (version_compare($context->getVersion(), '1.0.5', '<')) {

            $installer = $setup;

            $installer->startSetup();

            $table = $installer->getConnection()->newTable(
                $installer->getTable(QuickOrderInterface::TABLE_NAME)
            )->addColumn(
                QuickOrderInterface::ID_FIELD,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
                'QuickOrder ID'
            )->addColumn(
                QuickOrderInterface::NAME_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client name'
            )->addColumn(
                QuickOrderInterface::SKU_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Product sku'
            )->addColumn(
                QuickOrderInterface::EMAIL_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client email'
            )->addColumn(
                QuickOrderInterface::PHONE_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client phone'
            )->addIndex(
                $setup->getIdxName(
                    $installer->getTable(QuickOrderInterface::TABLE_NAME),
                    [QuickOrderInterface::SKU_FIELD],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                [QuickOrderInterface::NAME_FIELD, QuickOrderInterface::SKU_FIELD],
                ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
            )->setComment(
                'QuickOrders table'
            );
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }


    }

}