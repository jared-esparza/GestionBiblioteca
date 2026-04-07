<?php
class SocioController extends Controller{
    public function index(){
        return $this->list();
    }

    public function list(int $page = 1){

        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }

        $filtro = Filter::apply('socios');
        $total = $filtro ? Socio::filteredResults($filtro): Socio::total();
        $limit = RESULTS_PER_PAGE;
        $paginator = new Paginator('/Socio/list', $page, $limit, $total);

        $socios = $filtro ? Socio::filter($filtro, $limit, $paginator->getOffset()): Socio::orderBy('nombre', 'ASC', $limit, $paginator->getOffset());

        return view('socio/list', ['socios'=>$socios, 'paginator'=>$paginator, 'filtro'=>$filtro]);
    }

    public function show(int $id = 0){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
        $socio = Socio::findOrFail($id);
        $prestamos = $socio->hasMany('V_prestamo');
        return view('socio/show', ['socio'=>$socio, 'prestamos'=>$prestamos]);
    }

    public function create(){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
        return view('socio/create');
    }

    public function store(){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
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
        }catch(ValidationException $e){
            Session::error($e->getMessage());
            return redirect("/Socio/create");
        }
    }

    public function edit(int $id = 0){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
        $socio = Socio::findOrFail($id, "No se encontró el socio");
        $prestamos = $socio->hasMany('V_prestamo');
        return view('socio/edit', ['socio'=>$socio, 'prestamos'=>$prestamos]);
    }
    public function update(){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
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
        }catch(ValidationException $e){
            Session::error($e->getMessage());
            return redirect("/Socio/edit/$id");
        }
    }

    public function delete(int $id = 0){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
        $socio = Socio::findOrFail($id, "No existe el socio");
        return view("socio/delete", ["socio"=>$socio]);
    }

    public function destroy(){
        if(!Login::oneRole(LIBRARIAN_PANEL_ROLES)){
            Session::error("No puedes realizar esta operación.");
            return redirect('/');
        }
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