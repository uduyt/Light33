package com.org.light.light;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;

import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.org.light.light.mainactivity.CommunityFragment;
import com.org.light.light.mainactivity.ConsumoFragment;
import com.org.light.light.mainactivity.MainFragment;
import com.org.light.light.mainactivity.MarketFragment;
import com.org.light.light.mainactivity.ProfileFragment;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {
    private static android.support.v7.widget.Toolbar myToolbar;
    private static DrawerLayout mDrawerLayout;
    private static TextView tvLights;
    private static SharedPreferences sharedPref;
    private static NavigationView navigationView;

    /**
     * Fragment managing the behaviors, interactions and presentation of the navigation drawer.
     */


    /*
     * Used to store the last screen title. For use in {@link #restoreActionBar()}.
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //toolbar inflated
        myToolbar = (Toolbar) findViewById(R.id.toolbar_main);
        setSupportActionBar(myToolbar);

        sharedPref = PreferenceManager.getDefaultSharedPreferences(this);

        tvLights = (TextView) myToolbar.findViewById(R.id.tv_toolbar_lights);
        tvLights.setText(sharedPref.getString("user_lights", "NO_VALUE"));

        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);



        navigationView = (NavigationView) findViewById(R.id.menu_drawer);
        navigationView.setNavigationItemSelectedListener(this);

        View header = navigationView.getHeaderView(0);

        LinearLayout ll= (LinearLayout) header.findViewById(R.id.ll_profile_header);

        ll.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ToProfile();
            }
        });
        TextView tvProfileName= (TextView) header.findViewById(R.id.tv_drawer_profile_name);
        tvProfileName.setText(PersonLab.getMe().getName());

        //drawer toggle init
        ActionBarDrawerToggle mDrawerToggle = new ActionBarDrawerToggle(
                this, mDrawerLayout, myToolbar,
                R.string.navigation_drawer_open, R.string.navigation_drawer_close
        ) {

            @Override
            public void onDrawerSlide(View drawerView, float slideOffset) {

            }

            public void onDrawerOpened(View drawerView) {

            }

        };
        mDrawerLayout.setDrawerListener(mDrawerToggle);

        mDrawerToggle.syncState();
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

      /*  if (id == R.id.nav_camera) {
            // Handle the camera action
        } else if (id == R.id.nav_gallery) {

        } else if (id == R.id.nav_slideshow) {

        } else if (id == R.id.nav_manage) {

        } else if (id == R.id.nav_share) {

        } else if (id == R.id.nav_send) {

        }
*/
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
    public void ToProfile(){
        ProfileFragment mFragment=new ProfileFragment();
        FragmentTransaction fragmentTransaction = getFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.container, mFragment);
        fragmentTransaction.commit();
    }

}
