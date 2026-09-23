<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;

class StudentsController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $busqueda = $request->get('BusquedaEstudiante');

          $students = students::when($busqueda, function ($query) use ($busqueda) {
                $query->where('id', 'like', "%$busqueda%")
                      ->orWhere('student_name', 'like', "%$busqueda%");
            })->paginate(10)->withQueryString();

          return view('students.index', [

            'students'=> $students

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

                'id'=>'required',

                'typeid'=>'required',

                'student_name'=>'required',

                'student_description'=>'required',

                'student_mail'=>'required',

                'student_age'=>'required',

                'student_phone'=>'required|string|max:20',

            ]);


             students::create($fields);

            return redirect()->route('students.index');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('students.show', [
            'students' => students::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(students $students)
    {
        $fields = request()->validate([
            'student_id' => 'required',
            'typeid' => 'required',
            'student_name' => 'required',
            'student_description' => 'required',
            'student_age' => 'required',
            'student_mail' => 'required',
            'student_phone' => 'required|string|max:20',
        ]);

        $students -> update([
        'id' => $fields['student_id'],
        'typeid' => $fields['typeid'],
        'student_name' => $fields['student_name'],
        'student_description' => $fields['student_description'],
        'student_age' => $fields['student_age'],
        'student_mail' => $fields['student_mail'],
        'student_phone' => $fields['student_phone'],

        ]);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(students $students)
    {
        $students->delete();

        return redirect()->route('students.index');
    }

    public function create(){
        return view('students.create');

    }
    public function edit(students $students)
    {
        return view('students.edit', [
            'students' => $students
        ]);
    }


}
