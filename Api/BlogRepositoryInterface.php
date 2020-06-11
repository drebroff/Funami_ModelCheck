<?php


namespace Funami\ModelCheck\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BlogRepositoryInterface
{

    /**
     * Save Blog
     * @param \Funami\ModelCheck\Api\Data\BlogInterface $blog
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Funami\ModelCheck\Api\Data\BlogInterface $blog
    );

    /**
     * Retrieve Blog
     * @param string $blogId
     * @return \Funami\ModelCheck\Api\Data\BlogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($blogId);

    /**
     * Retrieve Blog matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Funami\ModelCheck\Api\Data\BlogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Blog
     * @param \Funami\ModelCheck\Api\Data\BlogInterface $blog
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Funami\ModelCheck\Api\Data\BlogInterface $blog
    );

    /**
     * Delete Blog by ID
     * @param string $blogId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($blogId);
}
