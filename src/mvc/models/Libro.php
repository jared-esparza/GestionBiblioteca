<?php
#[\AllowDynamicProperties]

class Libro extends Model{
    protected static $fillable = ["isbn", "titulo", "editorial", "idioma", "autor",
        "edicion", "anyo", "edadrecomendada", "portada", "caracteristicas", "sinopsis", "paginas"];

    public function addtema(int $idtema):int {
        $consulta = "INSERT INTO temas_libros (idlibro, idtema) VALUES ($this->id, $idtema)";
        return DB::insert($consulta);
    }

    public function removetema(int $idtema):int {
        $consulta = "DELETE FROM temas_libros WHERE idlibro = $this->id and idtema = $idtema";
        return DB::delete($consulta);
    }

}