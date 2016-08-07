package com.org.light.light;

import android.app.Application;


public class User extends Application {

    private String NAME="";
    private String PASSWORD="";
    private int ALLOWED=9;

    public User(String name, String password, int allowed){
        NAME=name;
        PASSWORD=password;
        ALLOWED=allowed;
    }

    //getters
    public String getName(){return NAME;}

    public String getPassword(){return PASSWORD;}

    public boolean isAllowed(){return ALLOWED>0;}

    public int getAllowedNumber(){return ALLOWED;}

    //setters
    public void setName(String name){
        NAME=name;
    }

    public void setPassword(String password){PASSWORD=password;}

    public void setAllowedNumber(int number){ALLOWED=number;
    }
}
