<?php


namespace Funami\ModelCheck\Model\ResourceModel;

class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('funami_modelcheck_blog', 'blog_id');
    }
}
