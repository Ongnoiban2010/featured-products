<?php
namespace Dtn\FeaturedProducts\Block\Product;

class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
    const DEFAULT_COLLECTION_SORT_BY = 'name';
    const DEFAULT_COLLECTION_ORDER = 'asc';

    public function createCollection()
    {
        $collection = $this->productCollectionFactory->create();
        $this->setTemplate("Magento_CatalogWidget::product/widget/content/grid.phtml");
        $collection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());

        $collection = $this->_addProductAttributesAndPrices($collection)
        ->addStoreFilter()
        ->setPageSize($this->getData('products_count'))
        ->setOrder($this->getSortBy(), $this->getSortOrder());

        if ($this->getData('display_special') == 'special_price') {
            $collection->addAttributeToFilter('special_price', array('notnull' => true));
        }
        if ($this->getData('display_sku') == 'sku') {
            $collection->addAttributeToFilter('sku', array('like' => 'MH01'));
        }
        $conditions = $this->getConditions();
        $conditions->collectValidatedAttributes($collection);
        $this->sqlBuilder->attachConditionToCollection($collection, $conditions);

        return $collection;
    }

    public function getSortBy()
    {
        if (!$this->hasData('collection_sort_by')) {
            $this->setData('collection_sort_by', self::DEFAULT_COLLECTION_SORT_BY);
        }
        return $this->getData('collection_sort_by');
    }

    public function getSortOrder()
    {
        if (!$this->hasData('collection_sort_order')) {
            $this->setData('collection_sort_order', self::DEFAULT_COLLECTION_ORDER);
        }
        return $this->getData('collection_sort_order');
    }
}