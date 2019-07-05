<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 21:09
 */

namespace SysPerson\MagentoAcademy\Controller\Order;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

use SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface;
use SysPerson\MagentoAcademy\Api\QuickOrdersRepositoryInterface;
use SysPerson\MagentoAcademy\Model\QuickOrdersFactory;

abstract class MyBaseQuickOrder extends Action
{
    const QUERY_PARAM_ID        = 'id';

    /** @var PageFactory  */
    protected $pageFactory;

    /** @var  QuickOrdersFactory */
    protected $modelFactory;

    /** @var QuickOrderInterface */
    protected $model;

    /** @var Page */
    protected $resultPage;

    /** @var QuickOrdersRepositoryInterface */
    protected $repository;

    public function __construct(Context $context,PageFactory $pageFactory,
                                QuickOrdersFactory $quickOrdersFactory,
                                QuickOrdersRepositoryInterface $quickOrdersRepository)
    {
        $this->pageFactory  =  $pageFactory;
        $this->modelFactory = $quickOrdersFactory;
        $this->repository   = $quickOrdersRepository;
        parent::__construct($context);
    }

    /** @return QuickOrderInterface */
    protected function getModel()
    {
        if (null === $this->model) {
            $this->model = $this->modelFactory->create();
        }
        return $this->model;
    }

    protected function redirectLastPage()
    {
        $this->_redirect($this->_redirect->getRefererUrl());
        return;
    }

    /** {@inheritdoc} */
    public function execute()
    {
        $this->_setPageData();
        return $this->resultPage;
    }

    /**
     * @return ResponseInterface
     */
    protected function redirectToGrid()
    {
        return $this->_redirect('*/*/listing');
    }

}