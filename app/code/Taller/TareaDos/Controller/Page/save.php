<?php
namespace Taller\TareaDos\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;


class Save extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result->setData(['message' => $data]);
        return $result;
    }
}