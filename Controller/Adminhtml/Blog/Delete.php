<?php


namespace Funami\ModelCheck\Controller\Adminhtml\Blog;

class Delete extends \Funami\ModelCheck\Controller\Adminhtml\Blog
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('blog_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Funami\ModelCheck\Model\Blog::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Blog.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['blog_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Blog to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
