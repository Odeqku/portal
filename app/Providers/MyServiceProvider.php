<?php

namespace App\Providers;
use App\Providers\Services\AdminServices\AdminPageServices;
use App\Providers\Services\AdminServices\CreateAdminUserService;
use App\Providers\Services\AdminServices\CreateCourseServices;
use App\Providers\Services\DataBaseServices\ReturnAllCoursesAndDepartmentsServices;
use App\Providers\Services\DataBaseServices\ReturnAllCoursesService;
use App\Providers\Services\DataBaseServices\ReturnAllDepartmentsServices;
use App\Providers\Services\DataBaseServices\ReturnAllFacultiesAndSemestersServices;
use App\Providers\Services\ImageFileServices\SaveImageServices;
use App\Providers\Services\StudentServices\CreateStudentUserService;
use App\Providers\Services\DataBaseServices\ReturnAllLevelsServices;
use App\Providers\Services\DataBaseServices\ReturnAllSemestersServices;
use App\Providers\Services\DataBaseServices\ReturnAllUsersServices;
use App\Providers\Services\DataBaseServices\ReturnUserProfileServices;
use App\Providers\Services\DataBaseServices\NewUserService;
use App\Providers\Services\StudentServices\CompleteRegService;
use App\Providers\Services\StudentServices\StudentGuardianDetailsService;
use App\Providers\Services\StudentServices\StudentMatricNumberServices;
use App\Providers\Services\StudentServices\StudentNextOfKinsService;
use App\Providers\Services\StudentServices\StudentPageServices;
use App\Providers\Services\StudentServices\StudentPersonalDetailsService;
use App\Providers\Services\StudentServices\StudentSponsorService;
use App\Providers\Services\UserService;
use App\Providers\Services\ValidationServices\ValidateRegRequestServices;
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

        $this->app->bind('admin_page_services', function (){
            return new AdminPageServices();
        });

        $this->app->bind('student_page_services', function (){
            return new StudentPageServices();
        });

        $this->app->bind('validate_reg_request_services', function (){
            return new ValidateRegRequestServices();
        });

        $this->app->bind('save_image_services', function (){
            return new SaveImageServices();
        });

        $this->app->bind('student_details_service', function (){
            return new StudentPersonalDetailsService();
        });

        $this->app->bind('student_next_of_kin_service', function (){
            return new StudentNextOfKinsService();
        });

        $this->app->bind('student_guardian_service', function (){
            return new StudentGuardianDetailsService();
        });

        $this->app->bind('student_sponsor_service', function (){
            return new StudentSponsorService();
        });

        $this->app->bind('courses_service', function (){
            return new ReturnAllCoursesService();
        });
    
        $this->app->bind('departments_service', function (){
            return new ReturnAllDepartmentsServices();
        });

        $this->app->bind('courses_and_departments_service', function (){
            return new ReturnAllCoursesAndDepartmentsServices();
        });

        $this->app->bind('faculties_and_semesters_service', function (){
            return new ReturnAllFacultiesAndSemestersServices();
        });

        $this->app->bind('create_course_services', function() {
            return new CreateCourseServices();
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
