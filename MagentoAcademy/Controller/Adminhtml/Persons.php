<?php



namespace SysPerson\MagentoAcademy\Controller\Adminhtml;

use Psr\Log\LoggerInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;


use SysPerson\MagentoAcademy\Api\Data\PersonsInterface;
use SysPerson\MagentoAcademy\Api\PersonsRepositoryInterface;
use SysPerson\MagentoAcademy\Model\PersonsFactory;

abstract class Persons extends Action
{
    const ACL_RESOURCE          = 'Sysperson_MagentoAcademy::all';
    const MENU_ITEM             = 'Sysperson_MagentoAcademy::all';
    const PAGE_TITLE            = 'Sysperson_MagentoAcademy Persons';
    const BREADCRUMB_TITLE      = 'Persons';
    const QUERY_PARAM_ID        = 'id';

    /** @var Registry  */
    protected $registry;

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  PersonsFactory */
    protected $modelFactory;

    /** @var PersonsInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var PersonsRepositoryInterface */
    protected $repository;

    /** @var Logger */
    protected $logger;

    /**
     * @param Context                       $context
     * @param Registry                      $registry
     * @param PageFactory                   $pageFactory
     * @param PersonsRepositoryInterface    $personsRepository
     * @param PersonsFactory                $factory
     * @param LoggerInterface               $logger
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory,
        PersonsRepositoryInterface $personsRepository,
        PersonsFactory $factory,
        LoggerInterface $logger
    ){
        $this->registry       = $registry;
        $this->pageFactory    = $pageFactory;
        $this->repository     = $personsRepository;
        $this->modelFactory   = $factory;
        $this->logger         = $logger;

        parent::__construct($context);
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }

    /**
     * @return Page
     */
    protected function _getResultPage()
    {
        if (null === $this->resultPage) {
            $this->resultPage = $this->pageFactory->create();
        }

        return $this->resultPage;
    }

    /**
     * @return Persons
     */
    protected function _setPageData()
    {
          $resultPage = $this->_getResultPage();
        $resultPage->setActiveMenu(static::MENU_ITEM);
        $resultPage->getConfig()->getTitle()->prepend((__(static::PAGE_TITLE)));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));
        $resultPage->addBreadcrumb(__(static::BREADCRUMB_TITLE), __(static::BREADCRUMB_TITLE));

        return $this;
    }

    /** @return PersonsInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }

        return $this->model;
    }

    /**
     * @return ResultInterface
     */
    protected function doRefererRedirect()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());

        return $redirect;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/listing');
    }
}
