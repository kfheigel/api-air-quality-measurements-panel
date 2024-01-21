<?php

declare(strict_types=1);

namespace App\UseCase\CreateMeasurement;

use App\Domain\Validator\DeviceId\IsDeviceIdExists;
use App\Domain\Validator\MeasurementParameterId\IsMeasurementParameterIdExists;
use App\Infrastructure\Messenger\Command\AsyncCommandInterface;
use App\Infrastructure\Messenger\Command\CommandInterface;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

final readonly class CreateMeasurementCommand implements AsyncCommandInterface, CommandInterface
{
    public function __construct(
        #[IsMeasurementParameterIdExists(404)]
        public Uuid $parameterId,
        #[IsDeviceIdExists(404)]
        public Uuid $deviceId,
        public float $value,
        public DateTimeImmutable $recordedAt,
    ) {
    }
}
