package com.example.webviewejercicio;

import androidx.appcompat.app.AppCompatActivity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.lang.ref.ReferenceQueue;
import java.util.HashMap;
import java.util.Map;
import java.net.*;

import static android.content.ContentValues.TAG;

public class MainActivity extends Activity {
    EditText etnombre, etequipo, etposicion, etemail, etnumero;
    Button btnAlta, btnConsulta, btnBorrar, btnEditar, btnLimpiar;
    String emailOld;
    RequestQueue requestQueue;
    /*==================== IP LOCAL ==============*/
    private static String ip_local ="192.168.100.9";
    private  static final String URL1 = "http://"+ip_local+"/WebViewPhp/insertar_jugador.php";



    @Override
    protected void onCreate(Bundle b) {
        super.onCreate(b);
        setContentView(R.layout.activity_main);

        requestQueue = Volley.newRequestQueue(this);

        etnombre = (EditText) findViewById(R.id.Nombre);
        etemail = (EditText) findViewById(R.id.Email);
        etequipo = (EditText) findViewById(R.id.Equipo);
        etposicion = (EditText) findViewById(R.id.Posicion);
        etnumero = (EditText) findViewById(R.id.Numero);

        btnAlta = (Button) findViewById(R.id.btnAlta);
        btnConsulta = (Button) findViewById(R.id.btnConsulta);
        btnBorrar = (Button) findViewById(R.id.btnBorrar);
        btnEditar = (Button) findViewById(R.id.btnEditar);
        btnLimpiar = (Button) findViewById(R.id.btnLimpiar);

        btnLimpiar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                etnombre.setText("");
                etposicion.setText("");
                etequipo.setText("");
                etnumero.setText("");
                etemail.setText("");
            }
        });

        btnAlta.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String nombre = etnombre.getText().toString();
                String emil = etemail.getText().toString();
                String posicion = etposicion.getText().toString();
                String equipo = etequipo.getText().toString();
                String telefono = etnumero.getText().toString();
                
                createJugador(nombre, emil, posicion, equipo, telefono);
                etnombre.setText("");
                etposicion.setText("");
                etequipo.setText("");
                etnumero.setText("");
                etemail.setText("");

            }
        });

        btnConsulta.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                readJugador();
            }

        });

        btnBorrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String email = etemail.getText().toString();
                removeJugador(email);
                etemail.setText("");
            }
        });

        btnEditar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String nombre = etnombre.getText().toString();
                String emailNew = etemail.getText().toString();
                String posicion = etposicion.getText().toString();
                String equipo = etequipo.getText().toString();
                String telefono = etnumero.getText().toString();

                editJugador(nombre, emailNew, emailOld, posicion, equipo, telefono);
            }
        });
    }

    private void editJugador(final String nombre, final String emailNew, final String emailOld, final String posicion, final String equipo, final String telefono) {
        String URLEdit = "http://"+ip_local+"/WebViewPhp/editar_jugador.php";
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                URLEdit,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(MainActivity.this, "SE EDITO A "+emailOld+" DE LA BASE", Toast.LENGTH_SHORT).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(MainActivity.this, "NO SE PUEDO EDITAR A "+emailOld+" DE LA BASE", Toast.LENGTH_SHORT).show();
                    }
                }

        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("nombre", nombre);
                params.put("emailnew", emailNew);
                params.put("emailold", emailOld);
                params.put("posicion", posicion);
                params.put("equipo", equipo);
                params.put("telefono", telefono);
                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

    private void removeJugador( final String email) {

        String URLBorrar = "http://"+ip_local+"/WebViewPhp/borrar_jugador.php";
        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                URLBorrar,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(MainActivity.this, "SE BORRO A "+email+" DE LA BASE", Toast.LENGTH_SHORT).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(MainActivity.this, "ERROR AL BORRAR "+email+" DE LA BASE", Toast.LENGTH_SHORT).show();

                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email);
                return params;
            }
        };

        requestQueue.add(stringRequest);
    }

    private void readJugador() {
        final String email = etemail.getText().toString();
        String URL = "http://"+ip_local+"/WebViewPhp/consultar_jugador.php?email="+ email;
        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest(
                Request.Method.GET, URL,
                null,
                new Response.Listener<JSONObject>() {
                    @Override
                    public void onResponse(JSONObject response) {
                        String nombre, posicion, equipo, telefono;
                        try {
                            //obtenrgo el json de la consulta
                            nombre = response.getString("nombre");
                            posicion = response.getString("posicion");
                            equipo = response.getString("equipo");
                            telefono = response.getString("telefono");

                            //settext de los edit
                            etnombre.setText(nombre);
                            etposicion.setText(posicion);
                            etequipo.setText(equipo);
                            etnumero.setText(telefono);
                            emailOld = email;
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(MainActivity.this, "ERROR NO EXISTE "+email+" DENTRO DE LA BASE", Toast.LENGTH_SHORT).show();
                }
            }
        );

        requestQueue.add(jsonObjectRequest);
    }

    private void createJugador(final String nombre, final String emil, final String posicion, final String equipo, final String telefono) {

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST, URL1,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(MainActivity.this, "CORRECT", Toast.LENGTH_SHORT).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(MainActivity.this, "ERROR", Toast.LENGTH_SHORT).show();
                    }
                }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String, String> params = new HashMap<>();
                params.put("nombre", nombre);
                params.put("email", emil);
                params.put("posicion", posicion);
                params.put("equipo", equipo);
                params.put("telefono", telefono);
                return params;
            }
        };

        requestQueue.add(stringRequest);

    }


}