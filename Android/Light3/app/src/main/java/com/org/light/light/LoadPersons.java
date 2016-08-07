package com.org.light.light;

import android.content.Context;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;

import java.util.ArrayList;
import java.util.List;


public class LoadPersons extends AsyncTask<Object, Object, List<Person>> {
    private Context mContext;

    @Override
    protected List<Person> doInBackground(Object... params) {
        mContext=(Context) params[0];
        List<Person> Persons = new ArrayList<Person>();

        Person person = new Person(mContext);
        person.setName("Carlos Rosety");
        person.setPersonID(1);
        Persons.add(person);

        person = new Person(mContext);
        person.setName("Luis Diaz");
        person.setPersonID(2);
        Persons.add(person);

        person = new Person(mContext);
        person.setName("Edu Brage");
        person.setPersonID(3);
        Persons.add(person);

        person = new Person(mContext);
        person.setName("Mauricio Muñoz");
        person.setPersonID(4);
        Persons.add(person);

        //TODO: Request persons from server and add them to the Persons list

        return Persons;
    }

    @Override
    protected void onPostExecute(List<Person> Persons) {
        super.onPostExecute(Persons);



        PersonLab.setPersons(Persons);
    }

}
