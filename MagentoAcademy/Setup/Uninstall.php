<?php

namespace SysPerson\MagentoAcademy\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;

/**
 * Class Uninstall
 * @package Sysint\MagentoAcademy\Setup
 */
class Uninstall implements UninstallInterface
{
    /** {@inheritDoc} */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
         //$defaultConnection = $setup->getConnection();

        $this->dropTable($setup, PersonsInterface::TABLE_NAME);

//        $defaultConnection->dropColumn(
//            $this->getTableNameWithPrefix($setup, 'admin_user'),
//            'refresh_token'
//        );
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     */
    private function dropTable(SchemaSetupInterface $setup, $tableName)
    {
        $connection = $setup->getConnection();
        $connection->dropTable($this->getTableNameWithPrefix($setup, $tableName));
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param string $tableName
     *
     * @return string
     */
    private function getTableNameWithPrefix(SchemaSetupInterface $setup, $tableName)
    {
        return $setup->getTable($tableName);
    }
}
