<?php
class SocioController extends Controller{
    public function index(){
        return $this->list();
    }

    public function list(){
        $socios = Socio::orderBy('nombre');

        return view('socio/list', ['socios'=>$socios]);
    }

    public function show(int $id = 0){
        $socio = Socio::findOrFail($id);
        $prestamos = $socio->hasMany('V_prestamo');
        return view('socio/show', ['socio'=>$socio, 'prestamos'=>$prestamos]);
    }

    public function create(){
        return view('socio/create');
    }

    public function store(){
        if(!request()->has('guardar')){
            throw new FormException("No se recibió el formulario");
        }
        try{
            $socio = Socio::create(request()->posts());
            Session::success("Guardado del socio $socio->nombre correcto.");
            return redirect("/socio/show/$socio->id");
        }catch(SQLException $e){
            $mensaje = "No se pudo guardar el socio $socio->nombre.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un socio con el DNI $socio->dni.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/socio/create");
        }
    }

    public function edit(int $id = 0){
        $socio = Socio::findOrFail($id, "No se encontró el socio");
        $prestamos = $socio->hasMany('V_prestamo');
        return view('socio/edit', ['socio'=>$socio, 'prestamos'=>$prestamos]);
    }
    public function update(){
        if(!request()->has('actualizar')){
            throw new FormException("No se recibieron datos.");
        }
        $id = intval(request()->post('id'));
        try{
            $socio = Socio::create(request()->posts(), $id);
            Session::success("Actualización del socio $socio->nombre correcta.");
            return redirect("/socio/edit/$id");
        }catch(SQLException $e){
            $mensaje = "No se pudo actualizar el socio $socio->nombre.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un socio con el DNI $socio->dni.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/socio/edit/$id");
        }
    }

    public function delete(int $id = 0){
        $socio = Socio::findOrFail($id, "No existe el socio");
        return view("socio/delete", ["socio"=>$socio]);
    }

    public function destroy(){
        if(!request()->has("borrar")){
            throw new FormException("No se recibieron datos");
        }
        $id = intval(request()->post("id"));
        $socio = Socio::findOrFail($id);
        try{
            $socio->deleteObject();
            Session::success("Se ha borrado el socio $socio->nombre.");
            return redirect("/socio/list");
        }catch(SQLException $e){
            Session::error("No se pudo borrar el socio $socio->nombre.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/socio/delete/$id");
        }
    
    }

}