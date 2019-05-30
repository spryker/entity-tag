<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\EntityTag;

use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\EntityTag\Dependency\Client\EntityTagToStorageClientBridge;
use Spryker\Client\Kernel\Container;

class EntityTagDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addStorageClient(Container $container): Container
    {
        $container[static::CLIENT_STORAGE] = function (Container $container) {
            return new EntityTagToStorageClientBridge(
                $container->getLocator()->storage()->client()
            );
        };

        return $container;
    }
}
