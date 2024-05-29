<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\MyProfile;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(){
        $profile = MyProfile::first();
        $projects = Project::all();
        $project_categories = ProjectCategory::all();
        $blogs = Blog::all();
        return view('welcome', compact('profile', 'projects', 'project_categories', 'blogs'));
    }
}
