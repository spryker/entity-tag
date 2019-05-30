<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\EntityTag;

use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\EntityTag\EntityTagFactory getFactory()
 */
class EntityTagClient extends AbstractClient implements EntityTagClientInterface
{
    /**
     * @param string $resourceName
     * @param string $resourceId
     *
     * @return string
     */
    public function generateKey(string $resourceName, string $resourceId): string
    {
        return $this->getFactory()->createEntityTagKeyGenerator()->generate($resourceName, $resourceId);
    }

    /**
     * @param string $resourceName
     * @param string $resourceId
     *
     * @return string|null
     */
    public function read(string $resourceName, string $resourceId): ?string
    {
        return $this->getFactory()->createEntityTagReader()->read($resourceName, $resourceId);
    }

    /**
     * @param string $resourceName
     * @param string $resourceId
     * @param array $resourceAttributes
     *
     * @return string|null
     */
    public function write(string $resourceName, string $resourceId, array $resourceAttributes): ?string
    {
        return $this->getFactory()->createEntityTagWriter()->write($resourceName, $resourceId, $resourceAttributes);
    }
}
