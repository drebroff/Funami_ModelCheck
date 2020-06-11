<?php

namespace Funami\ModelCheck\Block;

use Magento\Framework\View\Element\Template\Context;
//use Thienphucvx\Sample\Model\ResourceModel\Post\Collection as PostCollection;
class View extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    protected $_postCollectionFactory;
    protected function _prepareLayout()
    {
        $prepareBlogPageTitle = self::getBlogTitle(self::getBlogIdFromUrl());
        $a = 123;
        $this->pageConfig->getTitle()->set(__($prepareBlogPageTitle) . ' - ' . $this->pageConfig->getTitle()->getDefault());
        return parent::_prepareLayout();
    }
    public function __construct(
        Context $context,
        \Funami\ModelCheck\Model\ResourceModel\Blog\CollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_postCollectionFactory = $postCollectionFactory;
    }

    public function getBlogIdFromUrl(){
        return $this->getRequest()->getParam('id');
    }
    public function getBlog($id) {
        return $this->_postCollectionFactory->create()->addFieldToFilter('blog_id',$id)->getData();
    }
    public function getBlogTitle($id) {
        $getBlogTitleRaw = $this->_postCollectionFactory->create()
            ->addFieldToFilter('blog_id',$id)->addFieldToSelect('title')->getData();
        return $getBlogTitleRaw[0]['title'];
    }
    public function getBlogs() {


        if (!$this->hasData('blogs')) {
            $posts = $this->_postCollectionFactory->create();
            $this->setData('blogs', $posts);
        }

        return $this->getData('blogs');

    }
    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Thienphucvx\Sample\Model\Post::CACHE_TAG . '_' . 'list'];
    }




}
