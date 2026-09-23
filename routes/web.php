<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::view('/','home')->name('home');


 /* Course Routes  */



 Route::view('/about','about')->name('about');

 Route::view('/contact','contact')->name('contact');

 Route::post('contact', 'MessageController@store');

 Route::get('/busqueda', 'SearchController@index')->name('front.search');

 /* "Gestionar Estudiantes/Cursos/Certificados" — admin only. Everything
    below used to have no auth check at all: any visitor who guessed the
    URL could list, edit or delete students, courses and certificates. */
 Route::middleware(['auth', 'admin'])->group(function () {

     Route::get('/courses','CourseController@index')->name('courses.index');

     Route::get('/courses/create', 'CourseController@create')->name('courses.create');

     Route::get('/courses/{courses}/editar', 'CourseController@edit')->name('courses.edit');

     Route::patch('/courses/{courses}/editar', 'CourseController@update')->name('courses.update');

     Route::delete('/courses/{courses}', 'CourseController@destroy')->name('courses.destroy');

     Route::post('/courses','CourseController@store')->name('courses.store');

     Route::get('/courses/{id}','CourseController@show')->name('courses.show');

     Route::get('/course/export','CourseController@exportExcel')->name('courses.exportcourses');

     Route::post('/course/import','CourseController@importExcel')->name('courses.importcourses');

     Route::get('/students','StudentsController@index')->name('students.index');

     Route::get('/students/create', 'StudentsController@create')->name('students.create');

     Route::get('/students/{students}/editar', 'StudentsController@edit')->name('students.edit');

     Route::patch('/students/{students}/editar', 'StudentsController@update')->name('students.update');

     Route::delete('/students/{students}', 'StudentsController@destroy')->name('students.destroy');

     Route::post('/students','StudentsController@store')->name('students.store');

     Route::get('/students/{id}','StudentsController@show')->name('students.show');

     Route::get('students-list-xlsx', 'StudentController@exportExcel')-> name('Students.ExportExcel');

     Route::get('/certificate','CertificateController@index')->name('certificate.index');

     Route::get('/certificate/create', 'CertificateController@create')->name('certificate.create');

     Route::get('/certificate/{certificate}/editar', 'CertificateController@edit')->name('certificate.edit');

     Route::patch('/certificate/{certificate}/editar', 'CertificateController@update')->name('certificate.update');

     Route::delete('/certificate/{certificate}', 'CertificateController@destroy')->name('certificate.destroy');

     Route::post('/certificate','CertificateController@store')->name('certificate.store');

     Route::get('certificate-list-xlsx', 'CertificateController@exportExcel')-> name('certificate.ExportExcel');

 });

 /* Public certificate lookup/verification — must stay reachable without
    login. Registered after the admin group's /certificate/create and
    /certificate/{certificate}/editar so this wildcard doesn't swallow
    those more specific paths. */
 Route::get('/certificate/{id}','CertificateController@downloadPDF')->name('certificate.show');

     /* pdf Routes  */


     Auth::routes();

     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    

     Route::get('/test-pdf', function () {
        $certificate = App\Models\certificates::find(1); // Cambia el ID según sea necesario
        return view('certificate.show', ['certificates' => $certificate]);
    });
