<?php
/**
 * Tweakwise & Emico (https://www.tweakwise.com/ & https://www.emico.nl/) - All Rights Reserved
 *
 * @copyright Copyright (c) 2017-2017 Tweakwise.com B.V. (https://www.tweakwise.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Emico\TweakwiseExport\Controller\Feed;

use Emico\TweakwiseExport\App\Response\FeedContent;
use Emico\TweakwiseExport\Model\Config;
use Emico\TweakwiseExport\Model\Export as ExportModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http as HttpResponse;
use Magento\Framework\Exception\NotFoundException;

class Export extends Action
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Export
     */
    protected $export;

    /**
     * Export constructor.
     *
     * @param Context $context
     * @param Config $config
     * @param ExportModel $export
     */
    public function __construct(Context $context, Config $config, ExportModel $export)
    {
        parent::__construct($context);
        $this->config = $config;
        $this->export = $export;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $requestKey = $this->getRequest()->getParam('key');
        $configKey = $this->config->getKey();
        if ($requestKey != $configKey) {
            throw new NotFoundException(__('Page not found.'));
        }

        $response = $this->getResponse();
        if (!$response instanceof HttpResponse) {
            throw new NotFoundException(__('Page not found.'));
        }

        $response->setHeader('Content-Type', 'text/xml');
        $response->setContent(new FeedContent($this->export));
    }
}