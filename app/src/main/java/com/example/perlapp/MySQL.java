package com.example.perlapp;

import android.database.SQLException;
import android.os.StrictMode;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;

import java.sql.Statement;
public class MySQL {

    static String host      = "108.167.151.42";
    static String baseDatos = "lavivesh_perlapp";
    static String usuario   = "lavivesh_PerlApp";
    static String password  = "root1";
    static String cadCon	= "jdbc:mysql://"+host+"/"+baseDatos;

    public static Connection con;
    public static Statement st;
    public static String Message;
    private static ResultSet rs;

    private static void ConexionDriver() throws ClassNotFoundException, IllegalAccessException, InstantiationException {
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);
        try{
            Class.forName( "com.mysql.jdbc.Driver").newInstance();
            con = (Connection) DriverManager.getConnection( cadCon, usuario, password);
            st = (Statement) con.createStatement();
            Message = "Conexion Exitosa";
        } catch (Exception e) {
            e.printStackTrace();
            Message = e.getMessage();
        }
    }

    public static Boolean Conectar(){
        try {
            ConexionDriver();
            if(Message=="Conexion Exitosa") return true;
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        } catch (IllegalAccessException e) {
            e.printStackTrace();
        } catch (InstantiationException e) {
            e.printStackTrace();
        }
        return false;
    }

    private static void DBQuery(String sql) throws java.sql.SQLException {
        rs = (ResultSet) st.executeQuery(sql);
    }

    public static ResultSet Query (String sql){
        rs = null;
        try {
            DBQuery(sql);
        } catch (java.sql.SQLException e) {
            e.printStackTrace();
        }
        return rs ;
    }

    public static Boolean UpdateQuery (String sql){
        rs = null;
        try {
            st.executeUpdate(sql);
            return true;
        } catch (java.sql.SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public static Boolean InsertQuery (String sql){
        rs = null;
        try {
            st.executeUpdate(sql);
            return true;
        } catch (java.sql.SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public static void cerrarConexion() {
        try {
            if (st != null) {
                st.close();
            }
            if (con != null) {
                con.close();
            }
        } catch (SQLException e) {
        } catch (java.sql.SQLException e) {
            e.printStackTrace();
        }
    }
}
