<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\EntityTag\Storage;

use Spryker\Client\EntityTag\Dependency\Client\EntityTagToStorageClientInterface;

class EntityTagReader implements EntityTagReaderInterface
{
    /**
     * @var \Spryker\Client\EntityTag\Storage\EntityTagKeyGeneratorInterface
     */
    protected $entityTagKeyGenerator;

    /**
     * @var \Spryker\Client\EntityTag\Dependency\Client\EntityTagToStorageClientInterface
     */
    protected $storageClient;

    public function __construct(EntityTagKeyGeneratorInterface $entityTagKeyGenerator, EntityTagToStorageClientInterface $storageClient)
    {
        $this->entityTagKeyGenerator = $entityTagKeyGenerator;
        $this->storageClient = $storageClient;
    }

    public function read(string $resourceName, string $resourceId): ?string
    {
        $entityTagKey = $this->entityTagKeyGenerator->generate($resourceName, $resourceId);

        return $this->storageClient->get($entityTagKey);
    }
}
