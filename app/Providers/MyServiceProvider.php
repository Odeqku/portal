<?php

namespace App\Providers;
use App\Providers\Services\AdminServices\AdminServices;
use App\Providers\Services\CreateAdminUserService;
use App\Providers\Services\CreateStudentUserService;
use App\Providers\Services\DataBaseServices\ReturnAllLevelsServices;
use App\Providers\Services\DataBaseServices\ReturnAllSemestersServices;
use App\Providers\Services\DataBaseServices\ReturnAllUsersServices;
use App\Providers\Services\DataBaseServices\ReturnUserProfileServices;
use App\Providers\Services\NewUserService;
use App\Providers\Services\StudentCoursesServices\CompleteRegService;
use App\Providers\Services\StudentMatricNumberServices;
use App\Providers\Services\StudentServices\StudentPageServices;
use App\Providers\Services\UserService;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('user_service', function () {
            return new UserService();
        });

        $this->app->bind('student_user_service', function (){
            return new CreateStudentUserService();
        });

        $this->app->bind('student_matric_number_service', function (){
            return new StudentMatricNumberServices();
        });

        $this->app->bind('new_user_service', function (){
            return new NewUserService();
        });

        $this->app->bind('admin_user_service', function (){
            return new CreateAdminUserService();
        });

        $this->app->bind('complete_reg_service', function (){
            return new CompleteRegService();
        });

        $this->app->bind('users_service', function (){
            return new ReturnAllUsersServices();
        });

        $this->app->bind('levels_service', function (){
            return new ReturnAllLevelsServices();
        });

        $this->app->bind('profile_service', function (){
            return new ReturnUserProfileServices();
        });

        $this->app->bind('semesters_service', function (){
            return new ReturnAllSemestersServices();
        });

        $this->app->bind('admin_services', function (){
            return new AdminServices();
        });

        $this->app->bind('student_page_services', function (){
            return new StudentPageServices();
        });
    
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
