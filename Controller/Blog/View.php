<?php


namespace Funami\ModelCheck\Controller\Blog;

use Laminas\Mvc\Controller\AbstractController;

class View extends \Magento\Framework\App\Action\Action
{
    protected $employeeFactory;

    protected $sessionConfig;
    protected $sessionManager;
    protected $cookieMetadataFactory;
    protected $cookieManager;
    protected $logger;
    protected $cache;
    protected $resultPageFactory;
    /**
     * @var \Funami\ModelCheck\Model\ResourceModel\Blog\CollectionFactory
     */
    private $_postCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
//        \Thienphucvx\Sample\Model\PostFactory $postFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Session\Config\ConfigInterface $sessionConfig,
        \Magento\Framework\Session\SessionManagerInterface $sessionManager,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        \Psr\Log\LoggerInterface $logger
//        \Funami\ModelCheck\Model\ResourceModel\Blog\CollectionFactory $postCollectionFactory

    )
    {
//        $this->postFactory = $postFactory;

        $this->resultPageFactory = $resultPageFactory;
        $this->sessionConfig = $sessionConfig;
        $this->sessionManager = $sessionManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->cookieManager = $cookieManager;
        $this->logger = $logger;
//        $this->_postCollectionFactory = $postCollectionFactory;
        return parent::__construct($context);
    }

    /**
     * Url like http://magento2.ce/sample/test/view/
     */
    public function execute()
    {
        $blogIdGetParam = $this->getRequest()->getParam('id');

        if (!isset($blogIdGetParam) ) {
            $this->_redirect('*/*/');
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
