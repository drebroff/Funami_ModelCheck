<?php


namespace Funami\ModelCheck\Model\Data;

use Funami\ModelCheck\Api\Data\BlogInterface;

class Blog extends \Magento\Framework\Api\AbstractExtensibleObject implements BlogInterface
{

    /**
     * Get blog_id
     * @return string|null
     */
    public function getBlogId()
    {
        return $this->_get(self::BLOG_ID);
    }

    /**
     * Set blog_id
     * @param string $blogId
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     */
    public function setBlogId($blogId)
    {
        return $this->setData(self::BLOG_ID, $blogId);
    }

    /**
     * Get Content
     * @return string|null
     */
    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    /**
     * Set Content
     * @param string $content
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Funami\ModelCheck\Api\Data\BlogExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Funami\ModelCheck\Api\Data\BlogExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Funami\ModelCheck\Api\Data\BlogExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
