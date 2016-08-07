package com.org.light.light.mainactivity;


import android.app.Fragment;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Canvas;
import android.graphics.ColorFilter;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.widget.CardView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.TextView;

import com.org.light.light.MainActivity;
import com.org.light.light.R;
import com.org.light.light.StartHomeActivity;
import com.org.light.light.StartMobilityActivity;


/**
 * A simple {@link Fragment} subclass.
 */

public class MainFragment extends Fragment {

    FloatingActionButton fabMain,fabMobility,fabHome;
    FrameLayout dimmer;
    CardView notifIntro;
    Button notifIntroButton;

private boolean fabChecked=false;
    public MainFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
       /* View myView = inflater.inflate(R.layout.fragment_main,container,false);
               return myView;*/

        View rootView = inflater.inflate(R.layout.fragment_main, container, false);

        fabMain= (FloatingActionButton) rootView.findViewById(R.id.fab_main);
        fabMobility= (FloatingActionButton) rootView.findViewById(R.id.fab_mobility);
        fabHome= (FloatingActionButton) rootView.findViewById(R.id.fab_home);
        dimmer=(FrameLayout) rootView.findViewById(R.id.dimmer);

        fabMobility.hide();
        fabHome.hide();
        notifIntro=(CardView) rootView.findViewById(R.id.notif_intro);
        notifIntroButton=(Button) notifIntro.findViewById(R.id.notif_but1);

        notifIntroButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                notifIntro.setVisibility(View.GONE);
            }
        });
        fabMain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (fabChecked) {
                    dimmer.setVisibility(View.GONE);
                    fabMobility.hide();
                    fabHome.hide();
                    fabMain.setImageResource(R.mipmap.ic_fab);
                } else {
                    dimmer.setVisibility(View.VISIBLE);
                    fabMobility.show();
                    fabHome.show();
                    fabMain.setImageResource(R.drawable.ic_clear);
                }
                fabChecked = !fabChecked;
            }
        });
        fabMobility.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), StartMobilityActivity.class);
                startActivity(intent);
            }
        });

        fabHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getActivity(), StartHomeActivity.class);
                startActivity(intent);
            }
        });

        return rootView;
    }
}
