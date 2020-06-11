<?php


namespace Funami\ModelCheck\Api\Data;

interface BlogInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const CONTENT = 'Content';
    const BLOG_ID = 'blog_id';

    /**
     * Get blog_id
     * @return string|null
     */
    public function getBlogId();

    /**
     * Set blog_id
     * @param string $blogId
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     */
    public function setBlogId($blogId);

    /**
     * Get Content
     * @return string|null
     */
    public function getContent();

    /**
     * Set Content
     * @param string $content
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     */
    public function setContent($content);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Funami\ModelCheck\Api\Data\BlogExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Funami\ModelCheck\Api\Data\BlogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Funami\ModelCheck\Api\Data\BlogExtensionInterface $extensionAttributes
    );
}
