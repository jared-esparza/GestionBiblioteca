<?php
class TemaController extends Controller{
    public function index(){
        return $this->list();
    }

    public function list(){
        $temas = Tema::orderBy('tema');

        return view('tema/list', ['temas'=>$temas]);
    }

    public function show(int $id = 0){
        $tema = Tema::findOrFail($id);
        return view('tema/show', ['tema'=>$tema]);
    }

    public function create(){
        return view('tema/create');
    }

    public function store(){
        if(!request()->has('guardar')){
            throw new FormException("No se recibió el formulario");
        }
        try{
            $tema = Tema::create(request()->posts());
            Session::success("Guardado del tema $tema->tema correcto.");
            return redirect("/tema/show/$tema->id");
        }catch(SQLException $e){
            $mensaje = "No se pudo guardar el tema $tema->tema.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un tema con el nombre $tema->tema.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/tema/create");
        }
    }

    public function edit(int $id = 0){
        $tema = Tema::findOrFail($id, "No se encontró el tema");
        return view('tema/edit', ['tema'=>$tema]);
    }
    public function update(){
        if(!request()->has('actualizar')){
            throw new FormException("No se recibieron datos.");
        }
        $id = intval(request()->post('id'));
        try{
            $tema = Tema::create(request()->posts(), $id);
            Session::success("Actualización del tema $tema->tema correcta.");
            return redirect("/tema/edit/$id");
        }catch(SQLException $e){
            $mensaje = "No se pudo actualizar el tema $tema->tema.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un tema con el nomre $tema->tema.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/tema/edit/$id");
        }
    }

    public function delete(int $id = 0){
        $tema = Tema::findOrFail($id, "No existe el tema");
        return view("tema/delete", ["tema"=>$tema]);
    }

    public function destroy(){
        if(!request()->has("borrar")){
            throw new FormException("No se recibieron datos");
        }
        $id = intval(request()->post("id"));
        $tema = Tema::findOrFail($id);
        try{
            $tema->deleteObject();
            Session::success("Se ha borrado el tema $tema->tema.");
            return redirect("/tema/list");
        }catch(SQLException $e){
            Session::error("No se pudo borrar el tema $tema->tema.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/tema/delete/$id");
        }
    
    }

}