<?php


namespace Funami\ModelCheck\Api\Data;

interface BlogSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Blog list.
     * @return \Funami\ModelCheck\Api\Data\BlogInterface[]
     */
    public function getItems();

    /**
     * Set Content list.
     * @param \Funami\ModelCheck\Api\Data\BlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
