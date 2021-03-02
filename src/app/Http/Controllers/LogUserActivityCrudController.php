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
        $this->crud->setTitle(__('Log User Activities'));
        $this->crud->setHeading(__('Log User Activities'));

        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            trans('Log User Activities') => backpack_url('log-user'),
            trans('backpack::crud.list') => false,
        ];

        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => __('ID'),
            'type'  => 'number',
        ]);

        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => __('Date'),
            'type'      => 'model_function',
            'function_name' => 'getDate',
        ]);

        $this->crud->addColumn([
            'name'      => 'description',
            'label'     => __('Log Type'),
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
            'label'     => __('Model'),
            'type'      => 'model_function',
            'function_name' => 'getTableName',
        ]);

        $this->crud->addColumn([
            'name'      => 'causer',
            'label'     => __('User'),
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
            'label' => __('ID'),
            'type'  => 'number',
        ]);

        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => __('Date'),
            'type'      => 'model_function',
            'function_name' => 'getDate',
        ]);

        $this->crud->addColumn([
            'name'      => 'description',
            'label'     => __('Log Type'),
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
            'label'     => __('Model'),
            'type'      => 'model_function',
            'function_name' => 'getTableName',
        ]);

        $this->crud->addColumn([
            'name'      => 'causer',
            'label'     => __('User'),
            'type'      => 'model_function',
            'function_name' => 'getUser',
        ]);

        $this->crud->addColumn([
            'name'      => 'properties',
            'label'     => __('Data'),
            'type'      => 'properties',
        ]);
    }
}
