package com.example.perlapp;

import java.time.LocalDateTime;

public class ComentarioBD
{
    private int idcomentario, fk_idcamion;
    private String creador, comentario, fecha_hora;

    public ComentarioBD(int idcomentario, String creador, String comentario, String fecha_hora, int fk_idcamion) {
        this.idcomentario = idcomentario;
        this.creador = creador;
        this.comentario = comentario;
        this.fecha_hora = fecha_hora;
        this.fk_idcamion = fk_idcamion;
    }

    public int getIdcomentario() {
        return idcomentario;
    }

    public String getCreador() {
        return creador;
    }

    public String getComentario() {
        return comentario;
    }

    public String getFecha_hora() {
        return fecha_hora;
    }

    public int getFk_idcamion() {
        return fk_idcamion;
    }
}
