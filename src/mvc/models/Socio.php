<?php
#[\AllowDynamicProperties]

class Socio extends Model{
    protected static $fillable = ["dni", "nombre", "apellidos", "nacimiento", "email", 
        "direccion", "cp", "poblacion", "provincia", "telefono", "foto", "conformidad"];
}