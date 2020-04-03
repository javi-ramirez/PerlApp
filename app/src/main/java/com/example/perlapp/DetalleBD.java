package com.example.perlapp;

public class DetalleBD
{
    private int iddetalle, fk_idchofer, fk_idruta, fk_idcamion;
    private String hora_inicio, hora_fin;

    public DetalleBD(int iddetalle, String hora_inicio, String hora_fin, int fk_idchofer, int fk_idruta, int fk_idcamion) {
        this.iddetalle = iddetalle;
        this.hora_inicio = hora_inicio;
        this.hora_fin = hora_fin;
        this.fk_idchofer = fk_idchofer;
        this.fk_idruta = fk_idruta;
        this.fk_idcamion = fk_idcamion;
    }

    public int getIddetalle() {
        return iddetalle;
    }

    public String getHora_inicio() {
        return hora_inicio;
    }

    public String getHora_fin() {
        return hora_fin;
    }

    public int getFk_idchofer() {
        return fk_idchofer;
    }

    public int getFk_idruta() {
        return fk_idruta;
    }

    public int getFk_idcamion() {
        return fk_idcamion;
    }
}
