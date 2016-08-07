package com.org.light.light;

import android.content.Context;
import android.graphics.Bitmap;

/**
 * Created by Carlos on 29/01/2016.
 */
public class Person {
    private int PersonID;
    private Bitmap Icon;
    private String Name;
    public String Username;
    private int Lights;
    private String School;
    private String Classroom;
    private int Level;
    private int Experience;
    public int getPersonID() {
        return PersonID;
    }

    public Person(Context context){

    }

    public void setLights(int lights) {
        Lights = lights;
    }

    public void setPersonID(int personID) {
        PersonID = personID;
    }

    public String getUsername() {
        return Username;
    }

    public void setUsername(String username) {
        Username = username;
    }

    public int getLevel() {
        return Level;
    }

    public void setLevel(int level) {
        Level = level;
    }

    public int getExperience() {
        return Experience;
    }

    public void setExperience(int experience) {
        Experience = experience;
    }

    public Bitmap getIcon() {
        return Icon;
    }

    public void setIcon(Bitmap icon) {
        Icon = icon;
    }

    public String getName() {
        return Name;
    }

    public void setName(String name) {
        Name = name;
    }

    public int getLights() {
        return Lights;
    }

    public void addLights(int lights) {
        Lights+= lights;
    }

    public String getSchool() {
        return School;
    }

    public void setSchool(String school) {
        School = school;
    }

    public String getClassroom() {
        return Classroom;
    }

    public void setClassroom(String classroom) {
        Classroom = classroom;
    }
}
