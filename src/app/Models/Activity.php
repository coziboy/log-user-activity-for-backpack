<?php

namespace Coziboy\LogUserActivityForBackpack\app\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity as ModelsActivity;

class Activity extends ModelsActivity
{
    use CrudTrait;

    public function getDate()
    {
        $created = Carbon::parse($this->created_at);
        return $created->format("Y-m-d H:i:s") . " (" . $created->diffForHumans() . ")";
    }

    public function getLogTypeClass()
    {
        $log_type = $this->description;
        switch ($log_type) {
            case 'created':
                $class = "badge badge-success";
                break;

            case 'updated':
                $class = "badge badge-warning text-white";
                break;

            case 'deleted':
                $class = "badge badge-danger text-white";
                break;

            default:
                $class = "badge badge-info";
                break;
        }
        return $class;
    }

    public function getTableName()
    {
        return $this->subject->getTable();
    }

    public function getUser()
    {
        $name = $this->causer->name;
        $email = $this->causer->email;
        return $name . "($email)";
    }
}
