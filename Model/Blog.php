<?php


namespace Funami\ModelCheck\Model;

use Funami\ModelCheck\Api\Data\BlogInterface;
use Funami\ModelCheck\Api\Data\BlogInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Blog extends \Magento\Framework\Model\AbstractModel
{

    protected $blogDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'funami_modelcheck_blog';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param BlogInterfaceFactory $blogDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Funami\ModelCheck\Model\ResourceModel\Blog $resource
     * @param \Funami\ModelCheck\Model\ResourceModel\Blog\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        BlogInterfaceFactory $blogDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Funami\ModelCheck\Model\ResourceModel\Blog $resource,
        \Funami\ModelCheck\Model\ResourceModel\Blog\Collection $resourceCollection,
        array $data = []
    ) {
        $this->blogDataFactory = $blogDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve blog model with blog data
     * @return BlogInterface
     */
    public function getDataModel()
    {
        $blogData = $this->getData();
        
        $blogDataObject = $this->blogDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $blogDataObject,
            $blogData,
            BlogInterface::class
        );
        
        return $blogDataObject;
    }
}
