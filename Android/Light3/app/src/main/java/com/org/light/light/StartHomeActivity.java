package com.org.light.light;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;


public class StartHomeActivity extends AppCompatActivity {
private Toolbar mToolbar;
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_start_home);

        //toolbar inflated
        mToolbar = (Toolbar) findViewById(R.id.toolbar_start_activity);
        setSupportActionBar(mToolbar);


        //drawer toggle init


    }
}
