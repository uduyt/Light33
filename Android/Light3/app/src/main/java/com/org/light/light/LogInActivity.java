package com.org.light.light;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.OnSharedPreferenceChangeListener;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GoogleApiAvailability;
import com.org.light.light.gcm.RegistrationIntentService;
import com.org.light.light.loginactivity.LogInTask;


public class LogInActivity extends AppCompatActivity {
    public Context mContext=this;
public OnSharedPreferenceChangeListener listener;
private SharedPreferences sharedPref;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

    sharedPref = PreferenceManager.getDefaultSharedPreferences(this);

        listener = new SharedPreferences.OnSharedPreferenceChangeListener() {
            public void onSharedPreferenceChanged(SharedPreferences prefs, String key) {

                String result=prefs.getString(key, "error");

                if (key.equals(getString(R.string.key_start_logState)) && result.equals("pass")) {
                    if (sharedPref.getString("user_clearance", "0").equals("0")) {
                        Toast.makeText(mContext, "Your clearance level is not high enough", Toast.LENGTH_SHORT).show();
                    } else {

                        if (checkPlayServices()) {
                            // Start IntentService to register this application with GCM.
                            Intent intent = new Intent(mContext, RegistrationIntentService.class);
                            startService(intent);

                            Toast.makeText(mContext, result, Toast.LENGTH_SHORT).show();
                            Intent intent2 = new Intent(mContext, MainActivity.class);
                            startActivity(intent2);
                        }else{
                            Toast.makeText(mContext, "You need to install Play Services!", Toast.LENGTH_SHORT).show();
                        }


                    }
                }
            }
        };
        sharedPref.registerOnSharedPreferenceChangeListener(listener);
    }




    public void LogIn(View view){ //login button

        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(mContext);
        sharedPref.edit().remove(getString(R.string.key_start_logState)).apply();

        EditText user_tv=(EditText) findViewById(R.id.start_username);
        EditText pass_tv=(EditText) findViewById(R.id.start_password);
        LogInTask mLogInTask = new LogInTask();
        mLogInTask.execute(user_tv.getText().toString(), pass_tv.getText().toString(), this);
    }
    public void Goo(View view){
        Intent intent = new Intent(mContext, MainActivity.class);
        startActivity(intent);
    }


    private boolean checkPlayServices() {
        GoogleApiAvailability apiAvailability = GoogleApiAvailability.getInstance();
        int resultCode = apiAvailability.isGooglePlayServicesAvailable(this);
        return (resultCode == ConnectionResult.SUCCESS);

    }
}