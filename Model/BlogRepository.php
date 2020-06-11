<?php


namespace Funami\ModelCheck\Model;

use Funami\ModelCheck\Api\BlogRepositoryInterface;
use Funami\ModelCheck\Api\Data\BlogSearchResultsInterfaceFactory;
use Funami\ModelCheck\Api\Data\BlogInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Funami\ModelCheck\Model\ResourceModel\Blog as ResourceBlog;
use Funami\ModelCheck\Model\ResourceModel\Blog\CollectionFactory as BlogCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

class BlogRepository implements BlogRepositoryInterface
{

    protected $resource;

    protected $blogFactory;

    protected $blogCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBlogFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceBlog $resource
     * @param BlogFactory $blogFactory
     * @param BlogInterfaceFactory $dataBlogFactory
     * @param BlogCollectionFactory $blogCollectionFactory
     * @param BlogSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceBlog $resource,
        BlogFactory $blogFactory,
        BlogInterfaceFactory $dataBlogFactory,
        BlogCollectionFactory $blogCollectionFactory,
        BlogSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->blogFactory = $blogFactory;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBlogFactory = $dataBlogFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Funami\ModelCheck\Api\Data\BlogInterface $blog
    ) {
        /* if (empty($blog->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $blog->setStoreId($storeId);
        } */
        
        $blogData = $this->extensibleDataObjectConverter->toNestedArray(
            $blog,
            [],
            \Funami\ModelCheck\Api\Data\BlogInterface::class
        );
        
        $blogModel = $this->blogFactory->create()->setData($blogData);
        
        try {
            $this->resource->save($blogModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the blog: %1',
                $exception->getMessage()
            ));
        }
        return $blogModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($blogId)
    {
        $blog = $this->blogFactory->create();
        $this->resource->load($blog, $blogId);
        if (!$blog->getId()) {
            throw new NoSuchEntityException(__('Blog with id "%1" does not exist.', $blogId));
        }
        return $blog->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->blogCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Funami\ModelCheck\Api\Data\BlogInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Funami\ModelCheck\Api\Data\BlogInterface $blog
    ) {
        try {
            $blogModel = $this->blogFactory->create();
            $this->resource->load($blogModel, $blog->getBlogId());
            $this->resource->delete($blogModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Blog: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($blogId)
    {
        return $this->delete($this->get($blogId));
    }
}
