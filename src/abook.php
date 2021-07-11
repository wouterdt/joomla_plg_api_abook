<?php

// Class structure example
defined('_JEXEC') or die();
class PlgAPIAbook extends ApiPlugin
{
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config = array());

        // Set resource path
        ApiResource::addIncludePath(dirname(__FILE__) . '/abook');
        // Set the login resource to be public
        $this->setResourceAccess('category', 'public', 'get');
        //$this->setResourceAccess('category', 'public', 'put');
        $this->setResourceAccess('categories', 'public', 'get');
    }
}
