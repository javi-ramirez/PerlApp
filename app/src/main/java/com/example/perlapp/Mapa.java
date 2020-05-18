package com.example.perlapp;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.FragmentActivity;

import android.graphics.Camera;
import android.location.Location;
import android.location.LocationListener;
import android.os.Bundle;
import android.widget.Toast;

import com.firebase.geofire.GeoFire;
import com.firebase.geofire.GeoLocation;
import com.firebase.geofire.GeoQuery;
import com.firebase.geofire.GeoQueryEventListener;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApi;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.List;

public class Mapa extends FragmentActivity implements OnMapReadyCallback, GoogleApiClient.ConnectionCallbacks,GoogleApiClient.OnConnectionFailedListener, com.google.android.gms.location.LocationListener {

        private GoogleMap mMap;
        GoogleApiClient mGoogleApiClient;
        Location mLastLocation;
        LocationRequest mLocationRequest;
        private Marker camionMarker;

        @Override
        protected void onCreate(Bundle savedInstanceState) {
                super.onCreate(savedInstanceState);
                setContentView(R.layout.activity_mapa);
                // Obtain the SupportMapFragment and get notified when the map is ready to be used.
                SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                        .findFragmentById(R.id.map);
                mapFragment.getMapAsync(this);
        }


        /**
         * Manipulates the map once available.
         * This callback is triggered when the map is ready to be used.
         * This is where we can add markers or lines, add listeners or move the camera. In this case,
         * we just add a marker near Sydney, Australia.
         * If Google Play services is not installed on the device, the user will be prompted to install
         * it inside the SupportMapFragment. This method will only be triggered once the user has
         * installed Google Play services and returned to the app.
         */
        @Override
        public void onMapReady(GoogleMap googleMap) {
                mMap = googleMap;
                buildGoogleApiClient();
                mMap.setMyLocationEnabled(true);

        }

        protected synchronized void buildGoogleApiClient(){
                mGoogleApiClient = new GoogleApiClient.Builder(this)
                        .addConnectionCallbacks(this).addOnConnectionFailedListener(this).addApi(LocationServices.API).build();
                mGoogleApiClient.connect();
        }

        @Override
        public void onLocationChanged(Location location) {
                mLastLocation = location;
                getCamiones();

                LatLng latLng = new LatLng(location.getLatitude(),location.getLongitude());
                mMap.moveCamera(CameraUpdateFactory.newLatLng(latLng));
                mMap.animateCamera(CameraUpdateFactory.zoomTo(17));


        }


        @Override
        public void onConnected(@Nullable Bundle bundle) {
                mLocationRequest=new LocationRequest();
                mLocationRequest.setInterval(10000);
                mLocationRequest.setFastestInterval(10000);
                mLocationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);

                LocationServices.FusedLocationApi.requestLocationUpdates(mGoogleApiClient,mLocationRequest,this);

        }

        @Override
        public void onConnectionSuspended(int i) {

        }

        @Override
        public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {


        }

        @Override
        protected void onStop() {
                super.onStop();

        }
        private void getCamiones(){
                DatabaseReference choferes = FirebaseDatabase.getInstance().getReference().child("Chofer");
                GeoFire geoFire = new GeoFire(choferes);
                LatLng actual = new LatLng(mLastLocation.getLatitude(),mLastLocation.getLongitude());
                GeoQuery geoQuery = geoFire.queryAtLocation(new GeoLocation(actual.latitude,actual.longitude),1);
                geoQuery.removeAllListeners();
                geoQuery.addGeoQueryEventListener(new GeoQueryEventListener() {
                        @Override
                        public void onKeyEntered(String key, GeoLocation location) {

                                Toast toast=Toast.makeText(getApplicationContext(),"Camión encontrado",Toast.LENGTH_LONG);
                                toast.show();
                                getUbicacionCamion(key);
                                //Asi como llamo getUbicacion con la llave asi pueden llamar a un metodo que jale los datos de la ruta del chofer con esa llave
                        }

                        @Override
                        public void onKeyExited(String key) {

                        }

                        @Override
                        public void onKeyMoved(String key, GeoLocation location) {

                        }

                        @Override
                        public void onGeoQueryReady() {
                        }

                        @Override
                        public void onGeoQueryError(DatabaseError error) {
                                Toast toast=Toast.makeText(getApplicationContext(),"Error",Toast.LENGTH_LONG);
                                toast.show();
                        }
                });}
        protected void getUbicacionCamion(String key){

                DatabaseReference camionLocationRef = FirebaseDatabase.getInstance().getReference().child("Chofer").child(key).child("l");
                camionLocationRef.addValueEventListener(new ValueEventListener() {
                        @Override
                        public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                                if(dataSnapshot.exists()){
                                        List<Object> map = (List<Object>) dataSnapshot.getValue();
                                        double locationLat = 0;
                                        double locationLng = 0;
                                        if(map.get(0) != null){
                                                locationLat = Double.parseDouble(map.get(0).toString());
                                        }
                                        if(map.get(1) != null){
                                                locationLng = Double.parseDouble(map.get(1).toString()) ;
                                        }
                                        if(camionMarker != null){
                                                camionMarker.remove();
                                        }
                                        LatLng camionLatLon = new LatLng(locationLat,locationLng);

                                        map.clear();
                                        camionMarker = mMap.addMarker(new MarkerOptions().   position(camionLatLon).title("Aqui lo que jalaron de la BD"));

                                }
                        }

                        @Override
                        public void onCancelled(@NonNull DatabaseError databaseError) {

                        }
                });

        }


}
