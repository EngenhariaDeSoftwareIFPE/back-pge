<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    use HttpResponses;
    
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->tokenCan('signatory')){
            return $this->error('Unauthorized', 403);
        }

        return StudentResource::collection(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matricula' => 'required|unique:students',
            'nome' => 'required',
            'curso' => 'required|in:Licenciatura em Música,Técnico em Agropecuária,Técnico em Agroindústria',
            'email' => [
                'required',
                'email',
                'unique:students',
                'regex:/@discente\.ifpe\.edu\.br$/', // Pertencer ao domínio de email discente
            ],
            'password' => [
                'required',
                'min:8',  // Mínimo de 8 caracteres
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                // Pelo menos uma letra minúscula, uma letra maiúscula e um dígito
            ],
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos', 422, $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $created = Student::create($request->all());

        if ($created){
            return $this->success('Estudante cadastrado com sucesso', 201, new StudentResource($created));
        }
        return $this->error('Erro ao cadastrar estudante', 400);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::where('matricula', $id)->first();

        if ($student) {
            return $this->success('Estudante retornado com sucesso', 200, new StudentResource($student));
        }

        return $this->error('Estudante não encontrado', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->tokenCan('student')){
            return $this->error('Unauthorized', 403);
        }

        $validator = Validator::make($request->all(), [
            'matricula' => 'required',
            'nome' => 'required',
            'curso' => 'required|in:Licenciatura em Música,Técnico em Agropecuária,Técnico em Agroindústria',
            'email' => [
                'required',
                'email',
                'regex:/@discente\.ifpe\.edu\.br$/', // Pertencer ao domínio de email discente
            ]
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos', 422, $validator->errors());
        }

        $validated = $validator->validated();

        $updated = Student::where('matricula', $id)->update([
            'matricula' => $validated['matricula'],
            'nome' => $validated['nome'],
            'curso' => $validated['curso'],
            'email' => $validated['email'],
        ]);

        if ($updated){
            $updatedStudent = Student::where('matricula', $id)->first();
            return $this->success('Estudante atualizado com sucesso', 200, new StudentResource($updatedStudent));
        }
        return $this->error('Falha na atualização do estudante', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->tokenCan('student')){
            return $this->error('Unauthorized', 403);
        }

        $deleted = Student::where('matricula', $id)->delete();

        if ($deleted) {
            return $this->success('Estudante deletado com sucesso', 200);
        }

        return $this->error('Falha ao deletar estudante', 400);
    }

    public function updatePassword(Request $request, string $id)
    {
        if (!auth()->user()->tokenCan('student')){
            return $this->error('Unauthorized', 403);
        }
        
        // Verifique se a senha antiga fornecida é válida
        $student = Student::where('matricula', $id)->first();

        if (!$student){
            return $this->error('Estudante não encontrado', 404);
        }
        else if (!Hash::check($request->input('old_password'), $student->password)) {
            return $this->error('Senha antiga inválida', 422);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => [
                'required',
                'min:8',  // Mínimo de 8 caracteres
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                // Pelo menos uma letra minúscula, uma letra maiúscula e um dígito
            ],
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos', 422, $validator->errors());
        }

        $updated = Student::where('matricula', $id)->update([
            'password' => bcrypt($request->new_password),
        ]);

        if ($updated){
            $updatedStudent = Student::where('matricula', $id)->first();
            return $this->success('Senha do estudante atualizada com sucesso', 200, new StudentResource($updatedStudent));
        }
        return $this->error('Falha na atualização da senha do estudante', 400);
    }
}
