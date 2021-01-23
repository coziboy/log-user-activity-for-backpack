<?php

namespace Coziboy\LogUserActivityForBackpack\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class LogUserActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderByDesc('created_at')->paginate(10);

        return view('log-user::log-user-activity', compact('activities'));
    }

    public function show($id)
    {
        try {
            $activity = Activity::findOrfail($id);
            $created = Carbon::parse($activity->created_at);

            switch ($activity->description) {
                case 'created':
                    $description = "<span class='badge badge-success'>$activity->description</span>";
                    break;

                case 'updated':
                    $description = "<span class='badge badge-warning text-white'>$activity->description</span>";
                    break;

                case 'deleted':
                    $description = "<span class='badge badge-danger text-white'>$activity->description</span>";
                    break;

                default:
                    $description = "<span class='badge badge-info'>$activity->description</span>";
                    break;
            }

            $data = collect([
                'log_type' => $description,
                'created_at' => $created->format('Y-m-d H:i:s').'('.$created->diffForHumans().')',
                'model' => $activity->subject->getTable(),
                'causer' => ! empty($activity->causer) ? $activity->causer->name.' ('.$activity->causer->email.')' : '-',
                'changes' => $activity->changes,
            ]);

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
