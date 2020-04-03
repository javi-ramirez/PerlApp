package com.example.perlapp;

public class CamionBD
{
    private int idcamion,numero;

    public CamionBD(int idcamion, int numero) {
        this.idcamion = idcamion;
        this.numero = numero;
    }

    public int getIdcamion() {
        return idcamion;
    }

    public int getNumero() {
        return numero;
    }
}
