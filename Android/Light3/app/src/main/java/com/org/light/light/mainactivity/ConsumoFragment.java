package com.org.light.light.mainactivity;


import android.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.org.light.light.R;


/**
 * A simple {@link Fragment} subclass.
 */
public class ConsumoFragment extends Fragment {


    public ConsumoFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View myView = inflater.inflate(R.layout.fragment_consumo,container,false);
               return myView;
    }


}
