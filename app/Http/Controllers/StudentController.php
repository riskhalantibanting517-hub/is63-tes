<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $perPage = (int) $request->get('perPage', 10);
        if (!in_array($perPage, [5,10,25,50])) {
            $perPage = 10;
        }

        $sort = $request->get('sort', 'name');
        $dir = $request->get('dir', 'asc');
        if (!in_array($sort, ['name','nim','email','major','status'])) {
            $sort = 'name';
        }
        $dir = $dir === 'desc' ? 'desc' : 'asc';

        $query = Student::query();

        if ($q) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('nim', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('major', 'like', "%{$q}%");
            });
        }

        $students = $query->orderBy($sort, $dir)
                          ->paginate($perPage)
                          ->withQueryString();

        return view('students.index', compact('students', 'q', 'perPage', 'sort', 'dir'));
    }

    /**
     * Export students to CSV (honors current filters and sorting)
     */
    public function export(Request $request)
    {
        $q = $request->get('q');
        $sort = $request->get('sort', 'name');
        $dir = $request->get('dir', 'asc');

        $query = Student::query();
        if ($q) {
            $query->where(function ($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('nim', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('major', 'like', "%{$q}%");
            });
        }
        $students = $query->orderBy($sort, $dir)->get();

        $columns = ['NIM','Nama','Email','Jurusan','Telepon','Status','Kota','Provinsi','Tanggal Lahir','Jenis Kelamin','Alamat'];

        $callback = function() use ($students, $columns) {
            $FH = fopen('php://output', 'w');
            fputcsv($FH, $columns);
            foreach ($students as $s) {
                fputcsv($FH, [
                    $s->nim,
                    $s->name,
                    $s->email,
                    $s->major,
                    $s->phone,
                    $s->status,
                    $s->city,
                    $s->province,
                    $s->birth_date ? $s->birth_date->format('Y-m-d') : '',
                    $s->gender,
                    $s->address,
                ]);
            }
            fclose($FH);
        };

        $filename = 'students_export_'.date('Ymd_His').'.csv';
        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = \App\Models\Major::orderBy('name')->pluck('name');
        return view('students.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:students|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:students',
            'phone' => 'nullable|string',
            'major' => 'required|exists:majors,name',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,inactive,graduated',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $majors = \App\Models\Major::orderBy('name')->pluck('name');
        return view('students.edit', compact('student', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:students,nim,' . $student->id . '|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string',
            'major' => 'required|exists:majors,name',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'province' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'status' => 'required|in:active,inactive,graduated',
        ]);

        $student->update($validated);

        return redirect()->route('students.show', $student)
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
