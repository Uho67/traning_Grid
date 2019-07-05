<?php


namespace SysPerson\MagentoAcademy\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Api\Data\PersonsInterfaceFactory;

class InstallData implements InstallDataInterface
{
    /** @var PersonsInterfaceFactory  */
    private $personsFactory;

    /** @var TransactionFactory */
    private $transactionFactory;

    /** LoggerInterface */
    private $logger;

    public function __construct(
        PersonsInterfaceFactory $personsFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->personsFactory       = $personsFactory;
        $this->transactionFactory   = $transactionFactory;
        $this->logger               = $logger;
    }

    /** {@inheritdoc} */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var Transaction $transactionalModel */
        $transactionalModel = $this->transactionFactory->create();

        $BirthDate = new \DateTimeImmutable();


        for ($i = 1; $i < 25; $i++) {
            /** @var PersonsInterface $lesson */
            $person = $this->personsFactory->create();
            $person->setName(sprintf("Name %d", $i));
            $person->setSurname(sprintf("Surname %d", $i));

            $person->setBirthDate($BirthDate);


            $transactionalModel->addObject($person);
        }

        try {
            $transactionalModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
