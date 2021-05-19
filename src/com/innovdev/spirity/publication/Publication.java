/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.innovdev.spirity.publication;
/**
 *
 * @author HP I5
 */
public class Publication{
    private int id;
    private int user_id;
    private int nb_react;
    private String text;
    private String date;
    public String Username;

    public String getUsername() {
        return Username;
    }

    public void setUsername(String Username) {
        this.Username = Username;
    }

    @Override
    public String toString() {
        return "Publication{" + "id=" + id + ", user_id=" + user_id + ", nb_react=" + nb_react + ", text=" + text + ", date=" + date + ", Username=" + Username + '}';
    }
    
    public Publication(int user_id, int nb_react, String text) {
        this.user_id = user_id;
        this.nb_react = nb_react;
        this.text = text;
    }

    public Publication(int user_id, int nb_react, String text, String date) {
        this.user_id = user_id;
        this.nb_react = nb_react;
        this.text = text;
        this.date = date;
    }

    public Publication(int id) {
        this.id = id;
    }

    public Publication(int id, int user_id, int nb_react, String text, String date) {
        this.id = id;
        this.user_id = user_id;
        this.nb_react = nb_react;
        this.text = text;
        this.date = date;
    }

    public Publication()
    {
    }

    public int getUser_id() {
        return user_id;
    }

    public int getId() {
        return id;
    }

    public int getNb_react() {
        return nb_react;
    }
    public String getText() {
        return text;
    }

    public String getDate() {
        return date;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public void setNb_react(int nb_react) {
        this.nb_react = nb_react;
    }
    public void setText(String text) {
        this.text = text;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public Publication(String text) {
        this.text = text;
    }

    public Publication(int user_id, String text) {
        this.user_id = user_id;
        this.text = text;
    }
}
