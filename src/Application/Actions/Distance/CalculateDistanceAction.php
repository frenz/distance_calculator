<?php


namespace App\Application\Actions\Distance;


use App\Application\Actions\ActionPayload;
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
        $input = $data->sum;
        $output = $data->result->type ?? "meters";
        $totalDistance = 0.00;
        foreach ($input as $item){
            $totalDistance += $item->type === 'meters' ? $item->value : $item ->value * 0.95;
        }
        if ($output === "yards"){
            $totalDistance = $totalDistance / 0.95;
        }

        return $this->respond(new ActionPayload(200,['type'=>$output,'totalDistance'=>$totalDistance]));

    }
}