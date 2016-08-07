package com.org.light.light.loginactivity;

import android.app.Application;
import android.content.Context;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.AsyncTask;
import android.preference.PreferenceManager;
import android.util.Log;
import android.widget.Toast;


import com.org.light.light.Person;
import com.org.light.light.PersonLab;
import com.org.light.light.R;
import com.org.light.light.User;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class LogInTask  extends AsyncTask<Object, String, String> {

    private final String LOG_TAG = LogInTask.class.getSimpleName();
    private Context mContext;
    @Override
    protected String doInBackground(Object... params) {
        String responseString = null;
        HttpURLConnection urlConnection = null;
        BufferedReader reader = null;
        mContext= (Context) params[2];
        // Will contain the raw JSON response as a string.
        String forecastJsonStr = null;

        try {
            // Construct the URL for the OpenWeatherMap query
            // Possible parameters are avaiable at OWM's forecast API page, at
            // http://openweathermap.org/API#forecast

            final String REQUEST_BASE_URL =
                    "http://lightbeta.esy.es/php/functions/login.php?";
            final String USER_NAME = "username";
            final String PASSWORD = "password";

            Uri builtUri = Uri.parse(REQUEST_BASE_URL).buildUpon()
                    .appendQueryParameter(USER_NAME, params[0].toString())
                    .appendQueryParameter(PASSWORD, params[1].toString())
                    .build();

            URL url = new URL(builtUri.toString());

            Log.v(LOG_TAG, "Built URI " + builtUri.toString());

            // Create the request to OpenWeatherMap, and open the connection
            urlConnection = (HttpURLConnection) url.openConnection();
            urlConnection.setRequestMethod("GET");
            urlConnection.connect();

            // Read the input stream into a String
            InputStream inputStream = urlConnection.getInputStream();
            if (inputStream == null) {
                // Nothing to do.
                return null;
            }
            reader = new BufferedReader(new InputStreamReader(inputStream));
            responseString=reader.readLine();


            Log.d("myresponsestring",responseString);
            Log.d("responsemethod",urlConnection.getResponseMessage());
        } catch (IOException e) {
            Log.e(LOG_TAG, "Error ", e);
            // If the code didn't successfully get the weather data, there's no point in attemping
            // to parse it.
            return null;
        } finally {
            if (urlConnection != null) {
                urlConnection.disconnect();
            }
            if (reader != null) {
                try {
                    reader.close();
                } catch (final IOException e) {
                    Log.e(LOG_TAG, "Error closing stream", e);
                }
            }
        }
        return responseString;
    }
    @Override
    protected void onPostExecute(String result) {
        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(mContext);
        SharedPreferences.Editor editor = sharedPref.edit();
        String output,results;
        output=result;
        if (!result.equals("nopass")){

            try{
                JSONObject mUser= new JSONObject(result);

                Person me=new Person(mContext);
                me.setPersonID(Integer.parseInt(mUser.getString("id")));
                me.setUsername(mUser.getString("username"));
                me.setName(mUser.getString("name"));
                me.setLights(Integer.parseInt(mUser.getString("lights")));
                me.setLights(Integer.parseInt(mUser.getString("experience")));
                me.setLights(Integer.parseInt(mUser.getString("level")));
                PersonLab.addPerson(me);

                editor.putString("user_id", mUser.getString("id"));
                editor.putString("user_username", mUser.getString("username"));
                editor.putString("user_password", mUser.getString("password"));
                editor.putString("user_name", mUser.getString("name"));
                editor.putString("user_email", mUser.getString("email"));
                editor.putString("user_lights", mUser.getString("lights"));
                editor.putString("user_experience", mUser.getString("experience"));
                editor.putString("user_level", mUser.getString("level"));
                editor.putString("user_times_in", mUser.getString("times_in"));
                editor.putString("user_clearance", mUser.getString("clearance"));
                editor.apply();
                output="pass";

            }catch (JSONException e){
                Log.e(LOG_TAG, "Error closing stream", e);
                Toast.makeText(mContext, "Response wasn't JSON format", Toast.LENGTH_LONG).show();
            }

        }

        editor.putString(mContext.getString(R.string.key_start_logState), output);
        editor.commit();
    }
}


