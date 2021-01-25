<?php

namespace Coziboy\LogUserActivityForBackpack\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Coziboy\LogUserActivityForBackpack\app\Models\Activity;

/**
 * Class LogUserActivityCrudController.
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LogUserActivityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Activity::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/log-user');
        CRUD::setEntityNameStrings('log-user', 'log-user-activities');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'ID',
            'type'  => 'number',
        ]);

        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => 'Date',
            'type'      => 'model_function',
            'function_name' => 'getDate',
        ]);

        $this->crud->addColumn([
            'name'      => 'description',
            'label'     => 'Log Type',
            'type'      => 'text',
            'wrapper'   => [
                'element'   => 'span',
                'class'     => function ($crud, $column, $entry, $related_key) {
                    switch ($entry->description) {
                        case 'created':
                            $class = 'badge badge-success';
                            break;

                        case 'updated':
                            $class = 'badge badge-warning text-white';
                            break;

                        case 'deleted':
                            $class = 'badge badge-danger text-white';
                            break;

                        default:
                            $class = 'badge badge-info';
                            break;
                    }

                    return $class;
                },
            ],
        ]);

        $this->crud->addColumn([
            'name'      => 'subject',
            'label'     => 'Model',
            'type'      => 'model_function',
            'function_name' => 'getTableName',
        ]);

        $this->crud->addColumn([
            'name'      => 'causer',
            'label'     => 'User',
            'type'      => 'model_function',
            'function_name' => 'getUser',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->setShowContentClass('col-md-12');

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'ID',
            'type'  => 'number',
        ]);

        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => 'Date',
            'type'      => 'model_function',
            'function_name' => 'getDate',
        ]);

        $this->crud->addColumn([
            'name'      => 'description',
            'label'     => 'Log Type',
            'type'      => 'text',
            'wrapper'   => [
                'element'   => 'span',
                'class'     => function ($crud, $column, $entry, $related_key) {
                    switch ($entry->description) {
                        case 'created':
                            $class = 'badge badge-success';
                            break;

                        case 'updated':
                            $class = 'badge badge-warning text-white';
                            break;

                        case 'deleted':
                            $class = 'badge badge-danger text-white';
                            break;

                        default:
                            $class = 'badge badge-info';
                            break;
                    }

                    return $class;
                },
            ],
        ]);

        $this->crud->addColumn([
            'name'      => 'subject',
            'label'     => 'Model',
            'type'      => 'model_function',
            'function_name' => 'getTableName',
        ]);

        $this->crud->addColumn([
            'name'      => 'causer',
            'label'     => 'User',
            'type'      => 'model_function',
            'function_name' => 'getUser',
        ]);

        $this->crud->addColumn([
            'name'      => 'properties',
            'label'     => 'Data',
            'type'      => 'properties',
        ]);
    }
}
