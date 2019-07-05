<?php


namespace SysPerson\MagentoAcademy\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;



use SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface;
use SysPerson\MagentoAcademy\Api\Data\PersonsSearchResultsInterface;

class PersonsList extends Template
{

    protected $searchCriteria;
    protected $scopeConfig;
    /** @var PersonsRepositoryInterface */
    protected $repository;

    /**
     * @param Context                       $context
     * @param PersonsRepositoryInterface    $personsRepository
     * @param SearchCriteriaBuilder         $searchCriteriaBuilder
     * @param array                         $data
     */
    public function __construct(
        ScopeConfigInterface $config,
        Context $context,
        PersonsRepositoryInterface $personsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->scopeConfig = $config;
        $this->repository       = $personsRepository;
        $this->searchCriteria   = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    public function toHtml()
    {
        $storeTipe = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE;
        $path = 'persons/general/is_enabled';
        $result = $this->scopeConfig->getValue($path,$storeTipe);
        $m= $result;
        if($m==1){
            return parent::toHtml();
        }
        else {
            return "";
        }
    }

    /**
     * @return PersonsSearchResultsInterface
     */
    public function getActualPersonsList()
    {
        $searchCriteria = $this->searchCriteria->create();
        $searchResult = $this->repository->getList($searchCriteria);
        return $searchResult;
    }
}
