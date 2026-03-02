<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\EntityTag\Storage;

use Spryker\Client\EntityTag\Dependency\Client\EntityTagToStorageClientInterface;
use Spryker\Client\EntityTag\Dependency\Service\EntityTagToUtilEncodingServiceInterface;
use Spryker\Client\EntityTag\Dependency\Service\EntityTagToUtilTextServiceInterface;
use Spryker\Service\UtilText\Model\Hash;

class EntityTagWriter implements EntityTagWriterInterface
{
    /**
     * @var \Spryker\Client\EntityTag\Storage\EntityTagKeyGeneratorInterface
     */
    protected $entityTagKeyGenerator;

    /**
     * @var \Spryker\Client\EntityTag\Dependency\Client\EntityTagToStorageClientInterface
     */
    protected $storageClient;

    /**
     * @var \Spryker\Client\EntityTag\Dependency\Service\EntityTagToUtilTextServiceInterface
     */
    protected $utilTextService;

    /**
     * @var \Spryker\Client\EntityTag\Dependency\Service\EntityTagToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    public function __construct(
        EntityTagKeyGeneratorInterface $entityTagKeyGenerator,
        EntityTagToStorageClientInterface $storageClient,
        EntityTagToUtilTextServiceInterface $utilTextService,
        EntityTagToUtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->entityTagKeyGenerator = $entityTagKeyGenerator;
        $this->storageClient = $storageClient;
        $this->utilTextService = $utilTextService;
        $this->utilEncodingService = $utilEncodingService;
    }

    public function write(string $resourceName, string $resourceId, array $resourceAttributes): string
    {
        $entityTagKey = $this->entityTagKeyGenerator->generate($resourceName, $resourceId);
        $entityTagValue = $this->utilTextService->hashValue(
            (string)$this->utilEncodingService->encodeJson($resourceAttributes),
            Hash::MD5,
        );
        $this->storageClient->set($entityTagKey, $entityTagValue);

        return $entityTagValue;
    }
}
