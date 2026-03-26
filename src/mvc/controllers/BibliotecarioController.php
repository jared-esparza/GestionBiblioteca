<?php
class BibliotecarioController extends Controller{
    
    public function index():ViewResponse{
        return $this->panel();
    }

    public function panel():ViewResponse{
        
        // comprueba que el usuario tenga el rol adecuado
        Auth::oneRole(LIBRARIAN_PANEL_ROLES);
        
        // carga la vista del panel del administrador
        return view('panel/bibliotecario');
    }
    
}


