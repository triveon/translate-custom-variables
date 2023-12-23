<?php

declare(strict_types = 1);

namespace Triveon\TransCustomVars\Plugin\Model\Template;

use Magento\Email\Model\Template\Filter as Subject;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Filter
 */
class Filter extends Subject
{
    private const CUSTOM_VAR_PREFIX = 'customVar_';

    /**
     * Function to set values of custom vars used in translations
     * @param Subject  $subject
     * @param callable $proceed
     * @param string[] $construction
     * @return string
     * @throws NoSuchEntityException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundTransDirective(Subject $subject, callable $proceed, array $construction)
    {
        $directive = $this->explodeModifiers($construction[2], 'escape')[0];
        $params = $this->getTransParameters($directive)[1];

        foreach ($params as $param) {
            if (!is_string($param) || !str_starts_with($param, self::CUSTOM_VAR_PREFIX)) {
                continue;
            }

            $customVarCode = substr($param, strlen(self::CUSTOM_VAR_PREFIX));
            $storeId = $this->_storeManager->getStore()->getId();
            $customVariable = $this->_variableFactory->create()->setStoreId($storeId)->loadByCode($customVarCode);

            if (!$customVariable->getId()) {
                continue;
            }

            $construction[2] = str_replace(
                $param,
                sprintf('"%s"', $customVariable->getValue()),
                $construction[2]
            );
        }

        return $proceed($construction);
    }
}
