<?php
class LibroController extends Controller{
    public function index(){
        return $this->list();
    }

    public function list(int $page = 1){
       
        $filtro = Filter::apply('libros');
        $total = $filtro ? V_libro::filteredResults($filtro): V_libro::total();  
        $limit = RESULTS_PER_PAGE;
        $paginator = new Paginator('/Libro/list', $page, $limit, $total);

        $libros = $filtro ? V_libro::filter($filtro, $limit, $paginator->getOffset()): V_libro::orderBy('titulo', 'DESC', $limit, $paginator->getOffset());

        return view('libro/list', ['libros'=>$libros, 'paginator'=>$paginator, 'filtro'=>$filtro]);
    }

    public function show(int $id = 0){
        // if(!$id){
        //     throw new NothingToFindException('No se indico el libro a buscar');
        // }
        // $libro = Libro::find($id);

        // if(!$libro){
        //     throw new NotFoundException('No se encontro el libro indicado');
        // }
        // return view('libro/show', ['libro' => $libro]);

        $libro = Libro::findOrFail($id);
        $ejemplares = $libro->hasMany('Ejemplar');
        $temas = $libro->belongsToMany('Tema', 'temas_libros');
        return view('libro/show', ['libro'=>$libro, 'ejemplares'=>$ejemplares, 'temas'=>$temas]);
    }

    public function create(){
        $listaTemas = Tema::orderBy('tema');
        return view('libro/create' , ['listaTemas'=>$listaTemas]);
    }

    // public function store(){
    //     if(!request()->has('guardar')){
    //         throw new FormException("No se recibió el formulario");
    //     }
    //     $libro = new Libro();
    //     $libro->isbn = request()->post("isbn");
    //     $libro->titulo = request()->post("titulo");
    //     $libro->editorial = request()->post("editorial");
    //     $libro->autor = request()->post("autor");
    //     $libro->idioma = request()->post("idioma");
    //     $libro->edicion = request()->post("edicion");
    //     $libro->anyo = request()->post("anyo");
    //     $libro->edadrecomendada = request()->post("edadrecomendada");
    //     $libro->paginas = request()->post("paginas");
    //     $libro->caracteristicas = request()->post("caracteristicas");
    //     $libro->sinopsis = request()->post("sinopsis");
    //     $libro->edadrecomendada = request()->post("edadrecomendada");

    //     try{
    //         $libro->save();
    //         Session::success("Guardado del libro $libro->titulo correcto.");
    //         return redirect("/libro/show/$libro->id");
    //     }catch(SQLException $e){
    //         $mensaje = "No se pudo guardar el libro $libro->titulo.";

    //         if(str_contains($e->getMessage(),"Duplicate entry")){
    //             $mensaje .= "<br> ya existe un libro con el ISBN $libro->isbn.";
    //         }
    //         Session::error($mensaje);
    //         if(DEBUG){
    //             throw new SQLException($e->getMessage());
    //         } 
    //         return redirect("/libro/create");
    //     }
    // }

    public function store(){
        if(!request()->has('guardar')){
            throw new FormException("No se recibió el formulario");
        }
        try{
            $libro = Libro::create(request()->posts());
            if(request()->post("idtema")){
                $libro->addtema(intval(request()->post("idtema")));
            }
            Session::success("Guardado del libro $libro->titulo correcto.");
            return redirect("/libro/show/$libro->id");
        }catch(SQLException $e){
            $mensaje = "No se pudo guardar el libro $libro->titulo.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un libro con el ISBN $libro->isbn.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/libro/create");
        }
    }

    public function edit(int $id = 0){
        $libro = Libro::findOrFail($id, "No se encontró el libro");
        $ejemplares = $libro->hasMany('Ejemplar');
        $temas = $libro->belongsToMany('Tema', 'temas_libros');
        $listaTemas = array_diff(Tema::orderBy('tema') , $temas);
        return view('libro/edit', ['libro'=>$libro, 'ejemplares'=>$ejemplares, 'temas'=>$temas, 'listaTemas'=>$listaTemas]);
    }
    public function update(){
        if(!request()->has('actualizar')){
            throw new FormException("No se recibieron datos.");
        }
        $id = intval(request()->post('id'));
        try{
            $libro = Libro::create(request()->posts(), $id);
            Session::success("Actualización del libro $libro->titulo correcta.");
            return redirect("/libro/edit/$id");
        }catch(SQLException $e){
            $mensaje = "No se pudo actualizar el libro $libro->titulo.";

            if(str_contains($e->getMessage(),'Duplicate entry')){
                $mensaje .= "<br> ya existe un libro con el ISBN $libro->isbn.";
            }
            Session::error($mensaje);
            if(DEBUG){
                throw new SQLException($e->getMessage());
            } 
            return redirect("/libro/edit/$id");
        }
    }

    public function delete(int $id = 0){
        $libro = Libro::findOrFail($id, "No existe el libro");
        return view("libro/delete", ["libro"=>$libro]);
    }

    public function destroy(){
        if(!request()->has("borrar")){
            throw new FormException("No se recibieron datos");
        }
        $id = intval(request()->post("id"));
        $libro = Libro::findOrFail($id);
        if($libro->hasAny('Ejemplar')){
            throw new Exception("No se puede borrar el libro mientras tenga ejemplares.");
        }
        try{
            $libro->deleteObject();
            Session::success("Se ha borrado el libro $libro->titulo.");
            return redirect("/libro/list");
        }catch(SQLException $e){
            Session::error("No se pudo borrar el libro $libro->titulo.");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/libro/delete/$id");
        }
    
    }

    public function addtema(){
        if(empty(request()->post("add"))){
            throw new FormException("No se recibió el formulario");
        }
        $idlibro = intval(request()->post("idlibro"));
        $idtema = intval(request()->post("idtema"));

        $libro = Libro::findOrFail($idlibro, "No se encontró el libro");
        $tema = Tema::findOrFail($idtema, "No se encontró el tema");

        try{
            $libro->addtema($idtema);
            Session::success("Se ha añadido el tema $tema->tema a $libro->titulo .");
            return redirect("/Libro/edit/$idlibro");
        }catch(SQLException $e){
            Session::error("No se pudo añadir $tema->tema a $libro->titulo .");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/Libro/edit/$idlibro");
        }
    }

    public function removetema(){
        if(empty(request()->post("remove"))){
            throw new FormException("No se ha recibodo el formulario");
        }
        $idlibro = intval(request()->post("idlibro"));
        $idtema = intval(request()->post("idtema"));

        $libro = Libro::findOrFail($idlibro, "No se encontró el libro");
        $tema = Tema::findOrFail($idtema, "No se encontró el tema");

        try{
            $libro->removetema($idtema);
            Session::success("Se ha eliminado el tema $tema->tema del libro $libro->titulo .");
            return redirect("/Libro/edit/$idlibro");
        }catch(SQLException $e){
            Session::error("No se pudo eliminar $tema->tema de $libro->titulo .");
            if(DEBUG){
                throw new SQLException($e->getMessage());
            }
            return redirect("/Libro/edit/$idlibro");
        }
    }

}