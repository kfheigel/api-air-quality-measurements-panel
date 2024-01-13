<?php

declare(strict_types=1);

namespace App\UseCase\CreateMeasurementParameter;

use App\Domain\Validator\MeasurementParameterCode\IsMeasurementParameterCodeNotExists;
use App\Domain\Validator\MeasurementParameterFormula\IsMeasurementParameterFormulaNotExists;
use App\Domain\Validator\MeasurementParameterName\IsMeasurementParameterNameNotExists;
use App\Infrastructure\Messenger\AsyncCommandInterface;

final readonly class CreateMeasurementParameterCommand implements AsyncCommandInterface
{
    public function __construct(
        #[IsMeasurementParameterNameNotExists(403)]
        public string $name,
        #[IsMeasurementParameterCodeNotExists(403)]
        public string $code,
        #[IsMeasurementParameterFormulaNotExists(403)]
        public string $formula
    ) {
    }
}