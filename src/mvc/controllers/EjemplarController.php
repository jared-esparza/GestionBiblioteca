<?php
class EjemplarController extends Controller{

    public function create(int $id = 0){
        $libro = Libro::findOrfail($id);
        return view('ejemplar/create', ['libro'=> $libro]);
    }

    public function store(){
        if(!request()->has('guardar')){
            throw new FormException("No se recibió el formulario");
        }
        try{
            $ejemplar = Ejemplar::create(request()->posts());
            Session::success("Guardado del ejemplar $ejemplar->id correcto.");
            return redirect('/Libro/show/'.request()->post('idlibro'));
        }catch(SQLException $e){
            $mensaje = "No se pudo guardar el ejemplar $ejemplar->id.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un ejemplar con el DNI $ejemplar->dni.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/ejemplar/create");
        }
    }

    public function edit(int $id = 0){
        $ejemplar = Ejemplar::findOrFail($id, "No se encontró el ejemplar");
        return view('ejemplar/edit', ['ejemplar'=>$ejemplar]);
    }
    public function update(){
        if(!request()->has('actualizar')){
            throw new FormException("No se recibieron datos.");
        }
        $id = intval(request()->post('id'));
        try{
            $ejemplar = Ejemplar::create(request()->posts(), $id);
            Session::success("Actualización del ejemplar $ejemplar->id correcta.");
            return redirect("/ejemplar/edit/$id");
        }catch(SQLException $e){
            $mensaje = "No se pudo actualizar el ejemplar $ejemplar->id.";
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/ejemplar/edit/$id");
        }
    }

    public function destroy(int $id = 0){

        $ejemplar = Ejemplar::findOrFail($id, "No se encontró el ejemplar");

        if ($ejemplar->hasAny("Prestamo")){
            throw new Exception("Este ejemplar no puede eliminarse porque tiene prestamos");
        }
        try{
            $ejemplar->deleteObject();
            Session::success("Se ha borrado el ejemplar correctamente");
            return redirect("/libro/edit/$ejemplar->idlibro");
        }catch(SQLException $e){
            Session::error("No se pudo borrar el ejemplar $ejemplar->id.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/libro/edit/$ejemplar->idlibro");
        }
    }
}