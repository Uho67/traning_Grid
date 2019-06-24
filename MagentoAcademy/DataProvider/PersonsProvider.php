<?php


namespace SysPerson\MagentoAcademy\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;

use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Model\ResourceModel\Persons\CollectionFactory;

class PersonsProvider extends AbstractDataProvider
{
    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }


        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $persons PersonsInterface */
        foreach ($items as $person) {
            $this->loadedData[$person->getId()] = $person->getData();
        }

        return $this->loadedData;
    }
}