<?php
namespace Dtn\FeaturedProducts\Model\Config\Source;
 
class SortBy implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'name', 'label' => __('Product Name')],
            ['value' => 'create_at', 'label' => __('Create At')]
        ];
    }
}