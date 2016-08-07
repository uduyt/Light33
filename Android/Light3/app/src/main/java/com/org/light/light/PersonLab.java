package com.org.light.light;

import android.content.Context;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Carlos on 29/01/2016.
 */
public class PersonLab {
    private static List<Person> Persons = new ArrayList<Person>();

    public PersonLab() {
    }

    public static int getMyId() {
        //TODO change 1 for my person id (from shared preferences from server when created)
        return 1;
    }

    public static void setPersons(List<Person> persons) {
        Persons = persons;
    }

    public static Person getMe() {

        return getPersonById(getMyId());
    }

    public static Person getPersonById(int id) {

        for (Person p : Persons) {
            if (p.getPersonID() == id) {
                return p;
            }
        }
        return null;
    }

    public static void updatePersons(Context context) {

        LoadPersons loadPersons = new LoadPersons();
        loadPersons.execute(context);

    }
    public static void addPerson(Person person){
        Persons.add(person);
    }

    public static List<Person> getPersons() {
        return Persons;
    }
}

