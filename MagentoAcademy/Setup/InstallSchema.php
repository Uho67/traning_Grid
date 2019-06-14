<?php

namespace SysPerson\MagentoAcademy\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;

class InstallSchema implements InstallSchemaInterface
{
    /** {@inheritdoc} */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /** create table `sysint_magentoacademy_lessons` */
        $table = $installer->getConnection()->newTable(
            $installer->getTable(PersonsInterface::TABLE_NAME)
        )->addColumn(
            PersonsInterface::ID_FIELD,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
            'Lessons ID'
        )->addColumn(
            PersonsInterface::NAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Lesson Title'
        )->addColumn(
            PersonsInterface::SURNAME_FIELD,
            Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Lesson Speaker'
        )->addColumn(
            PersonsInterface::BIRTH_DATE_FIELD,
            Table::TYPE_DATETIME,
            null,
            ['nullable' => false],
            'Lesson Start Time'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable(PersonsInterface::TABLE_NAME),
                [PersonsInterface::NAME_FIELD, PersonsInterface::SURNAME_FIELD],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [PersonsInterface::NAME_FIELD, PersonsInterface::SURNAME_FIELD],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'SysPerson person Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
