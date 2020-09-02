<?php


namespace App\Application\Actions\Distance;


use App\Application\Actions\ActionPayload;
use App\Domain\Distance\Distance;
use Psr\Http\Message\ResponseInterface as Response;

class CalculateDistanceAction extends DistanceAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = ($this->getFormData() ?? null);
        if (is_null($data) || !isset($data->sum) || sizeof($data->sum) < 2) {
            return $this->respond(new ActionPayload(500));
        }
        $inputDistances = $data->sum;
        $resultType = $data->result->type ?? Distance::METERS_LABEL;
        $totalDistance = new Distance($resultType, (float)0);
        foreach ($inputDistances as $distance) {
            $totalDistance->sum(new Distance($distance->type ?? Distance::METERS_LABEL, $distance->value ?? (float)0));
        }
        return $this->respond(new ActionPayload(200, ($resultType === Distance::YARDS_LABEL) ?
            $totalDistance->jsonSerializeInYards() :
            $totalDistance->jsonSerialize()));
    }
}