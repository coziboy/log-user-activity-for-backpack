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
        return $this->subject->getTable();
    }

    public function getUser()
    {
        $name = $this->causer->name;
        $email = $this->causer->email;

        return $name."($email)";
    }
}
