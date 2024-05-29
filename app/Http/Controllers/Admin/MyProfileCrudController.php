<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MyProfileRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MyProfileCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MyProfileCrudController extends CrudController
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
        CRUD::setModel(\App\Models\MyProfile::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/my-profile');
        CRUD::setEntityNameStrings('my profile', 'my profiles');
        $this->crud->denyAccess('create');
        $this->crud->denyAccess('delete');
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
            'label' => "Tên"
        ]);

        CRUD::addColumn([
            'name' => 'avatar',
            'label' => "Avatar",
            'type' => 'image',
            'width' => '130px',
            'height' => '190px'
        ]);
        
        CRUD::addColumn([
            'name' => 'age',
            'label' => "Tuổi"
        ]);
        
        CRUD::addColumn([
            'name' => 'email',
            'label' => "Email"
        ]);

    }

    protected function setupShowOperation()
    {
        // $this->autoSetupShowOperation();

        CRUD::addColumn([
            'name'  => 'name',
            'label' => 'Tên',
            'type'  => 'text',
        ]);

        CRUD::addColumn([
            'name'  => 'avatar',
            'label' => 'Avatar',
            'type'  => 'image',
            'width' => '150px',
            'height' => '250px'
        ]);

        CRUD::addColumn([
            'name'  => 'age',
            'label' => 'Tuổi',
            'type'  => 'text',
        ]);

        CRUD::addColumn([
            'name'  => 'phone',
            'label' => 'Tên',
            'type'  => 'Số điện thoại',
        ]);

        CRUD::addColumn([
            'name'  => 'city',
            'label' => 'Thành phố',
            'type'  => 'text',
        ]);

        CRUD::addColumn([
            'name'  => 'job',
            'label' => 'Nghề nghiệp',
            'type'  => 'text',
        ]);

        CRUD::addColumn([
            'name'  => 'email',
            'label' => 'Email',
            'type'  => 'text',
        ]);

        CRUD::addColumn([
            'name'  => 'about',
            'label' => 'About',
            'type'  => 'custom_html',
            'value' => function($entry){
                return '<p>'. $entry->about .'</p>';
            },
        ]);

        CRUD::addColumn([
            'name'  => 'gg_map',
            'label' => 'Google map',
            'type'  => 'custom_html',
            'value' => function($entry){
                return $entry->gg_map;
            },
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::field('name');
        CRUD::field('avatar');
        CRUD::field('age');
        CRUD::field('phone');
        CRUD::field('city');
        CRUD::field('job');
        CRUD::field('email');
        CRUD::field('about');
        CRUD::field('gg_map');
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
