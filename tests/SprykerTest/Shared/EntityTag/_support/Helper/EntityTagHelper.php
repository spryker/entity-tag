<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Shared\EntityTag\Helper;

use Codeception\Module;
use SprykerTest\Shared\Testify\Helper\LocatorHelperTrait;

class EntityTagHelper extends Module
{
    use LocatorHelperTrait;

    /**
     * @param string $resourceName
     * @param string $resourceId
     * @param array $attributes
     *
     * @return string|null
     */
    public function haveEntityTag(string $resourceName, string $resourceId, array $attributes): ?string
    {
        $entityTagClient = $this->getLocator()->entityTag()->client();

        return $entityTagClient->write($resourceName, $resourceId, $attributes);
    }
}
