package com.example.perlapp;

public class ChoferBD
{
    private int idchofer;
    private String nombre_chofer, correo;

    public ChoferBD(int idchofer, String nombre_chofer, String correo) {
        this.idchofer = idchofer;
        this.nombre_chofer = nombre_chofer;
        this.correo = correo;
    }

    public int getIdchofer() {
        return idchofer;
    }

    public String getNombre_chofer() {
        return nombre_chofer;
    }

    public String getCorreo() {
        return correo;
    }
}
