<?php

namespace Model;

use Core\EBCAbstractModel;
use DateTime;
use Exception;

/**
 * EBCBook class
 */
class EBCBook extends EBCAbstractModel
{
    /**
     * @return void
     * @throws Exception
     */
    protected function setPostMetaData(): void
    {
        $this->postMetaData['ebc_authors'] = get_post_meta($this->postData['ID'], 'ebc_authors', true);
        $this->postMetaData['ebc_publisher'] = get_post_meta($this->postData['ID'], 'ebc_publisher', true);
        $this->postMetaData['ebc_publish_date'] = new DateTime(get_post_meta($this->postData['ID'], 'ebc_publish_date', true));
    }

    /**
     * @return void
     */
    protected function setPostEvaluatedData(): void
    {
        $this->postEvaluatedData['ebc_publish_date_formatted'] = $this->postMetaData['ebc_publish_date']->format('d.m.Y');
        $this->postEvaluatedData['thumb_url'] = get_the_post_thumbnail_url($this->postData['ID'], 'post-thumbnail');
    }
}
