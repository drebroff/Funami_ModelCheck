<?php


namespace Funami\ModelCheck\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Funami\ModelCheck\Model\Blog::class,
            \Funami\ModelCheck\Model\ResourceModel\Blog::class
        );
    }
}
