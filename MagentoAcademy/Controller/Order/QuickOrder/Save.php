<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 04.07.19
 * Time: 22:42
 */

namespace SysPerson\MagentoAcademy\Controller\Order\QuickOrder;

use SysPerson\MagentoAcademy\Controller\Order\MyBaseQuickOrder;
use SysPerson\MagentoAcademy\Api\Order\QuickOrderInterface;
class Save extends MyBaseQuickOrder
{
     public function execute()
     {
         $isPost = $this->getRequest()->isPost();

         if ($isPost) {
             $model = $this->getModel();
             $formData = $this->getRequest()->getParam('order');

             if (empty($formData)) {
                 $formData = $this->getRequest()->getParams();
             }

             if(!empty($formData[QuickOrderInterface::ID_FIELD])) {
                 $id = $formData[QuickOrderInterface::ID_FIELD];
                 $model = $this->repository->getById($id);
             } else {
                 unset($formData[QuickOrderInterface::ID_FIELD]);
             }

             $model->setData($formData);

             try {
                 $model = $this->repository->save($model);
                 $this->messageManager->addSuccessMessage(__('Person has been saved.'));
                 if ($this->getRequest()->getParam('back')) {
                     return $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                 }

                 return $this->redirectToGrid();
             } catch (\Exception $e) {
                 $this->logger->error($e->getMessage());
                 $this->messageManager->addErrorMessage(__('Order doesn\'t save' ));
             }

             $this->_getSession()->setFormData($formData);

             return (!empty($model->getId())) ?
                 $this->_redirect('*/*/edit', ['id' => $model->getId()])
                 : $this->_redirect('*/*/uicreate');
         }
     }


}