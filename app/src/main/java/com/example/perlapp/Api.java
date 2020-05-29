package com.example.perlapp;

public class Api
{
    private static final String ROOT_URL = "http://perlapp.laviveshop.com/PerlApp/v1/Api.php?apicall=";

    //URLs para conexión con el archivo API del servidor para cada case dentro del switch

    //CRUD PARA CAMION
    public static final String URL_CREATE_CAMION = ROOT_URL + "createcamion";
    public static final String URL_READ_CAMION = ROOT_URL + "getcamion";
    public static final String URL_UPDATE_CAMION = ROOT_URL + "updatecamion";
    public static final String URL_DELETE_CAMION = ROOT_URL + "deletcamion&idcamion=";
    //CRUD PARA CHOFER
    public static final String URL_CREATE_CHOFER = ROOT_URL + "createchofer";
    public static final String URL_READ_CHOFER = ROOT_URL + "getchofer";
    public static final String URL_UPDATE_CHOFER = ROOT_URL + "updatechofer";
    public static final String URL_DELETE_CHOFER = ROOT_URL + "deletechofer&idchofer=";
    //CRUD PARA COMENTARIO
    public static final String URL_CREATE_COMENTARIO = ROOT_URL + "createcomentario";
    public static final String URL_READ_COMENTARIO = ROOT_URL + "getcomentario";
    public static final String URL_UPDATE_COMENTARIO = ROOT_URL + "updatecomentario";
    public static final String URL_DELETE_COMENTARIO = ROOT_URL + "deletecomentario&idcomentario=";
    //CRUD PARA DETALLE
    public static final String URL_CREATE_DETALLE = ROOT_URL + "createdetalle";
    public static final String URL_READ_DETALLE = ROOT_URL + "getdetalle";
    public static final String URL_UPDATE_DETALLE = ROOT_URL + "updatedetalle";
    public static final String URL_DELETE_DETALLE = ROOT_URL + "deletedetalle&iddetalle=";
    //CRUD PARA RUTA
    public static final String URL_CREATE_RUTA = ROOT_URL + "createruta";
    public static final String URL_READ_RUTA = ROOT_URL + "getruta";
    public static final String URL_UPDATE_RUTA = ROOT_URL + "updateruta";
    public static final String URL_DELETE_RUTA = ROOT_URL + "deleteruta&idruta=";

    //Ejemplo par login
    // public static final String URL_LOGIN_USUARIO = ROOT_URL + "loginusuario";
}
