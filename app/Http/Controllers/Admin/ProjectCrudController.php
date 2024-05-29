<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\ProjectCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Tên dự án'
            ]);
        CRUD::addColumn([
            'name'      => 'image', // The db column name
            'label'     => 'Profile image', // Table column heading
            'type'      => 'image',
            'height' => '120px',
            'width'  => '120px',
        ],);
        CRUD::addColumn([
            'name' => 'content',
            'label' => 'Nội dung'
            ]);
        CRUD::addColumn(['name' => 'type', 'label' => 'Loại dự án']);
        CRUD::addColumn(['name' => 'created_at', 'label' => 'Ngày bắt đầu', 'type' => 'datetime', 'format' => 'DD/MM/YYYY']);
        CRUD::addColumn(['name' => 'updated_at', 'label' => 'Ngày kết thúc', 'type' => 'datetime', 'format' => 'DD/MM/YYYY']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectRequest::class);

        CRUD::addField([
            'name'  => 'name',
            'label' => 'Tên dự án',
        ]);

        $categories = ProjectCategory::pluck('name', 'slug')->toArray();
        CRUD::addField([
            'name'  => 'type',
            'label' => 'Loại dự án',
            'type'  => 'enum',
            'options' => $categories
        ],);
        
        CRUD::addField([   // URL
            'name'  => 'image',
            'label' => 'Link ảnh',
            'type'  => 'url'
        ]);

        CRUD::addField([   // Summernote
            'name'  => 'content',
            'label' => 'Description',
            'type'  => 'summernote',
            'options' => [],
        ]);

        CRUD::addField([
            'name'  => 'created_at',
            'label' => 'Ngày bắt đầu',
            'type' => 'date'
        ]);

        CRUD::addField([
            'name'  => 'updated_at',
            'label' => 'Ngày kết thúc',
            'type' => 'date'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
