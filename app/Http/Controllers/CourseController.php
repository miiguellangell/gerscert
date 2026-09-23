<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\courses;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseExport;
use App\Imports\CourseImport;
use Symfony\Component\Process\ExecutableFinder;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Capturar el término de búsqueda
        $busqueda_curso = $request->get('Busqueda');
    
        // Buscar cursos por nombre y paginarlos (10 por página)
        $courses = Courses::where('course_name', 'like', "%$busqueda_curso%")->paginate(10)->withQueryString();
    
        // Devolver los cursos a la vista
        return view('courses.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function store()
        {

           $fields = request()->validate([

                'course_name'=>'required',

                'course_description'=>'required',

                'course_duration'=>'required',

                'course_validation'=>'required',

            ]);


             Courses::create($fields);

            return redirect()->route('courses.index');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('courses.show', [
            'courses' => Courses::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(courses $courses)
    {
        $courses -> update([

        'course_name' => request('course_name'),
        'course_description' => request('course_description'),
        'course_duration' => request('course_duration'),
        'course_validation' => request('course_validation'),

        ]);

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(courses $courses)
    {
        $courses->delete();

        return redirect()->route('courses.index');
    }

    public function create(){
        return view('courses.create');

    }
    public function edit(courses $courses)
    {
        return view('courses.edit', [
            'courses' => $courses
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new CourseExport,'Course_export.csv');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new CourseImport, $file);
        return redirect()->route('courses.index');
    }

}
