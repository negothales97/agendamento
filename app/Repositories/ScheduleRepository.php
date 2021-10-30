<?php

namespace App\Repositories;

use App\Interfaces\ScheduleRepositoryInterface;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryInterface
{

    public function findBy(array $data)
    {
        $resources = $this->filter($data, $this->model);
        return $resources->select('schedules.*')->get();
    }

    public function findById($id)
    {
        return $this->model::where('id', $id)->with(['customer', 'specialist'])->first();
    }

    protected function filter(array $data, $resources)
    {
        if (isset($data['generated']) && $data['generated'] == true) {
            $resources = $resources->join('customers', 'customers.id', '=', 'schedules.customer_id');
        }
        if (isset($data['specialist_id']) && $data['specialist_id'] != '') {
            $resources = $resources->where('specialist_id', $data['specialist_id']);
        }
        if (isset($data['place_id']) && $data['place_id'] != '') {
            $resources = $resources->where('place_id', $data['place_id']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $resources = $resources->where('status', $data['status']);
        }
        if (isset($data['date']) && $data['date'] != '') {

            $past = $data['past'] == 'true' ? '<=' : '>=';
            $pastHour = $data['past'] == 'true' ? '<' : '>=';
            $hour = $data['past'] == 'true' ? '00:00' : '23:59';

            $resources = $resources->whereDate('date', $past, $data['date']);
            $resources = $resources
                ->whereRaw("IF(date = '{$data['date']}', final_hour, '{$hour}') $pastHour '{$data['final_hour']}'");
        }
        if (isset($data['relationship']) && $data['relationship'] != null) {
            $resources =  $resources->with(['customer', 'specialist', 'place']);
        }
        if (isset($data['ordenation'])) {
            $resources =  $resources->orderBy($data['ordenation'][0], $data['ordenation'][1]);
        }
        return $resources;
    }
}
