package com.example.perlapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.text.DateFormat;
import java.util.Date;

import static android.view.View.GONE;

public class VerOpiniones extends AppCompatActivity {

    private EditText txtNumCamion,txtNombreUsuario,txtComentario;
    private  Button btnEnviar;
    private static final int CODE_GET_REQUEST = 1024;
    private static final int CODE_POST_REQUEST = 1025;
    private int idComen=0;
    ProgressBar progressBar;
    ListView listView;
    List<ComentarioBD> comentarioList;
    boolean isUpdating = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ver_opiniones);

        txtNumCamion= (EditText) findViewById(R.id.txtNumCamion);
        txtNombreUsuario= (EditText) findViewById(R.id.txtNombreUsuario);
        txtComentario = (EditText) findViewById(R.id.txtComentario);
        btnEnviar = (Button) findViewById(R.id.btnEnviar);
        progressBar = (ProgressBar) findViewById(R.id.progressBar);
        listView = (ListView) findViewById(R.id.listViewComentario);
        comentarioList = new ArrayList<>();

        btnEnviar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (isUpdating) {
                    updateComentario();
                } else {
                    createComentario();
                }
            }
        });

        readComentario();
    }

    private void createComentario() {
        Date date = new Date();
        DateFormat fecha = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss ");
        String creador = txtNombreUsuario.getText().toString().trim();
        String comentario = txtComentario.getText().toString().trim();
        String fk_idcamion = txtNumCamion.getText().toString().trim();
        String fecha_hora = fecha.format(date);

        //validating the inputs
        if (TextUtils.isEmpty(fk_idcamion)) {
            txtNumCamion.setError("Porfavor añade un número de camión");
            txtNumCamion.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(creador)) {
            txtNombreUsuario.setError("Porfavor añade un nombre de usuario");
            txtNombreUsuario.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(comentario)) {
            txtComentario.setError("Porfavor añade un comentario");
            txtComentario.requestFocus();
            return;
        }

        //if validation passes
        HashMap<String, String> params = new HashMap<>();
        params.put("creador", creador);
        params.put("comentario", comentario);
        params.put("fecha_hora", fecha_hora);
        params.put("fk_idcamion", fk_idcamion);

        //Calling the create Comentario API
        PerformNetworkRequest request = new PerformNetworkRequest(Api.URL_CREATE_COMENTARIO, params, CODE_POST_REQUEST);
        request.execute();

        txtNumCamion.setText("");
        txtNombreUsuario.setText("");
        txtComentario.setText("");
    }

    private void readComentario() {
        PerformNetworkRequest request = new PerformNetworkRequest(Api.URL_READ_COMENTARIO, null, CODE_GET_REQUEST);
        request.execute();
    }

    private void updateComentario() {
        Date date = new Date();
        DateFormat fecha = new SimpleDateFormat("dd/MM/yyyy HH:mm:ss ");
        int idComentario = idComen;
        String creador = txtNombreUsuario.getText().toString().trim();
        String comentario = txtComentario.getText().toString().trim();
        String fecha_hora = fecha.format(date);
        String fk_idcamion = txtNumCamion.getText().toString().trim();

        //validating the inputs
        if (TextUtils.isEmpty(creador)) {
            txtNombreUsuario.setError("Porfavor añade un nombre de usuario");
            txtNombreUsuario.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(comentario)) {
            txtComentario.setError("Porfavor añade un comentario");
            txtComentario.requestFocus();
            return;
        }

        if (TextUtils.isEmpty(fk_idcamion)) {
            txtNumCamion.setError("Porfavor añade un número de camión");
            txtNumCamion.requestFocus();
            return;
        }

        HashMap<String, String> params = new HashMap<>();
        params.put("idcomentario", String.valueOf(idComentario));
        params.put("creador", creador);
        params.put("comentario", comentario);
        params.put("fecha_hora", fecha_hora);
        params.put("fk_idcamion", fk_idcamion);

        PerformNetworkRequest request = new PerformNetworkRequest(Api.URL_UPDATE_COMENTARIO, params, CODE_POST_REQUEST);
        request.execute();

        btnEnviar.setText("Registrar");

        idComen=0;
        txtNumCamion.setText("");
        txtComentario.setText("");
        txtNombreUsuario.setText("");

        isUpdating = false;
    }

    private void deleteComentario(int idcomentario) {
        PerformNetworkRequest request = new PerformNetworkRequest(Api.URL_DELETE_COMENTARIO + idcomentario, null, CODE_GET_REQUEST);
        request.execute();
    }

    private void refreshComentarioList(JSONArray comentario) throws JSONException {
        comentarioList.clear();

        for (int i = 0; i < comentario.length(); i++) {
            JSONObject obj = comentario.getJSONObject(i);

            comentarioList.add(new ComentarioBD(
                    obj.getInt("idcomentario"),
                    obj.getString("creador"),
                    obj.getString("comentario"),
                    obj.getString("fecha_hora"),
                    obj.getInt("fk_idcamion")
            ));
        }
        ComentarioAdapter adapter = new ComentarioAdapter(comentarioList);
        listView.setAdapter(adapter);
    }

    private class PerformNetworkRequest extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        PerformNetworkRequest(String url, HashMap<String, String> params, int requestCode) {
            this.url = url;
            this.params = params;
            this.requestCode = requestCode;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressBar.setVisibility(View.VISIBLE);
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            progressBar.setVisibility(GONE);
            try {
                JSONObject object = new JSONObject(s);
                if (!object.getBoolean("error")) {
                    Toast.makeText(getApplicationContext(), object.getString("message"), Toast.LENGTH_SHORT).show();
                    refreshComentarioList(object.getJSONArray("comentario"));
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected String doInBackground(Void... voids) {
            RequestHandler requestHandler = new RequestHandler();

            if (requestCode == CODE_POST_REQUEST)
                return requestHandler.sendPostRequest(url, params);


            if (requestCode == CODE_GET_REQUEST)
                return requestHandler.sendGetRequest(url);

            return null;
        }
    }

    class ComentarioAdapter extends ArrayAdapter<ComentarioBD> {
        List<ComentarioBD> comentarioList;

        public ComentarioAdapter(List<ComentarioBD>
                                      comentarioList) {
            super(VerOpiniones.this, R.layout.activity_lista_comentarios, comentarioList);
            this.comentarioList = comentarioList;
        }


        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            LayoutInflater inflater = getLayoutInflater();
            View listViewItem = inflater.inflate(R.layout.activity_lista_comentarios, null, true);

            TextView textViewName = listViewItem.findViewById(R.id.textViewName);
            TextView textViewUpdate = listViewItem.findViewById(R.id.textViewUpdate);
            TextView textViewDelete = listViewItem.findViewById(R.id.textViewDelete);
            TextView textViewComentary = listViewItem.findViewById(R.id.textViewComentary);

            final ComentarioBD comentario = comentarioList.get(position);

            textViewName.setText(comentario.getCreador());
            textViewComentary.setText(comentario.getComentario());

            textViewUpdate.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    isUpdating = true;
                    idComen = comentario.getIdcomentario();
                    txtNombreUsuario.setText(comentario.getComentario());
                    txtComentario.setText(comentario.getComentario());
                    txtNumCamion.setText(comentario.getFk_idcamion());
                    btnEnviar.setText("Actualizar");
                }
            });

            textViewDelete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    AlertDialog.Builder builder = new AlertDialog.Builder(VerOpiniones.this);

                    builder.setTitle("Eliminar " + comentario.getCreador())
                            .setMessage("¿Estas seguro que deseas eliminarlo?")
                            .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    deleteComentario(comentario.getIdcomentario());
                                }
                            })
                            .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                }
                            })
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .show();
                }
            });

            return listViewItem;
        }
    }
}
