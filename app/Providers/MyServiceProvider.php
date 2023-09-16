<?php

namespace App\Providers;
use App\Providers\Services\CreateAdminUserService;
use App\Providers\Services\CreateStudentUserService;
use App\Providers\Services\NewUserService;
use App\Providers\Services\StudentCoursesServices\CompleteRegService;
use App\Providers\Services\StudentMatricNumberServices;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
