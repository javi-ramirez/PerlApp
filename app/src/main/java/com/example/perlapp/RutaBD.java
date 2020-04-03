package com.example.perlapp;

public class RutaBD
{
    private int idruta,nombre_ruta;

    public RutaBD(int idruta, int nombre_ruta) {
        this.idruta = idruta;
        this.nombre_ruta = nombre_ruta;
    }

    public int getIdruta() {
        return idruta;
    }

    public int getNombre_ruta() {
        return nombre_ruta;
    }
}
