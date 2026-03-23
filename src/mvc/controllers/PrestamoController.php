<?php
class PrestamoController extends Controller{
    public function index(){
        return $this->list();
    }

    public function list(){
        $prestamos = V_prestamo::orderBy('id');

        return view('prestamo/list', ['prestamos'=>$prestamos]);
    }

    // public function show(int $id = 0){
    //     $prestamo = Prestamo::findOrFail($id);
    //     return view('prestamo/show', ['prestamo'=>$prestamo]);
    // }

    public function create(){
        return view('prestamo/create');
    }

    public function store(){
        if(!request()->has('guardar')){
            throw new FormException("No se recibió el formulario");
        }
        try{
            $prestamo = Prestamo::create(request()->posts());
            Session::success("Guardado del prestamo $prestamo->id correcto.");
            return redirect("/socio/show/$prestamo->idsocio");
        }catch(SQLException $e){
            $mensaje = "No se pudo guardar el prestamo $prestamo->prestamo.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un prestamo con el nombre $prestamo->id.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/prestamo/create");
        }
    }

    public function issue(int $id = 0){
        $prestamo = Prestamo::findOrFail($id, "No se encontró el prestamo");
        return view('prestamo/issue', ['prestamo'=>$prestamo]);
    }

    public function extend(int $id = 0){
        $prestamo = Prestamo::findOrFail($id, "No se encontró el prestamo");
        return view('prestamo/extend', ['prestamo'=>$prestamo]);
    }
    public function update(){
        if(!request()->has('actualizar')){
            throw new FormException("No se recibieron datos.");
        }
        $id = intval(request()->post('id'));
        try{
            $prestamo = Prestamo::create(request()->posts(), $id);
            Session::success("Actualización del prestamo $prestamo->id correcta.");
            return redirect("/Prestamo");
        }catch(SQLException $e){
            Session::error("No se pudo actualizar el prestamo $prestamo->id.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/prestamo");
        }
    }

    public function delete(int $id = 0){
        $prestamo = Prestamo::findOrFail($id, "No existe el prestamo");
        return view("prestamo/delete", ["prestamo"=>$prestamo]);
    }

    public function destroy(){
        if(!request()->has("borrar")){
            throw new FormException("No se recibieron datos");
        }
        $id = intval(request()->post("id"));
        $prestamo = Prestamo::findOrFail($id);
        try{
            $prestamo->deleteObject();
            Session::success("Se ha borrado el prestamo $prestamo->prestamo.");
            return redirect("/prestamo/list");
        }catch(SQLException $e){
            Session::error("No se pudo borrar el prestamo $prestamo->prestamo.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/prestamo/delete/$id");
        }
    
    }

    public function returndate(int $id){
        Prestamo::create(['devolucion'=>date('Y-m-d')], $id);
        return redirect('/Prestamo');
    }

}