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

        return $created->format('Y-m-d H:i:s').' ('.$created->diffForHumans().')';
    }

    public function getTableName()
    {
        return str_replace(config('backpack.log-user-activity.model'), '', $this->subject_type);
    }

    public function getUser()
    {
        if(!$this->causer) return '-';
        $name = $this->causer->name;
        $email = $this->causer->email;

        return $name."($email)";
    }
}
