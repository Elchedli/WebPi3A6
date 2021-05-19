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
public class Commentaire {
    private int id;
    private int id_user;
    private String username;
    private int id_pub;
    private String content;
    private String Date;

    public Commentaire() {
    }

    @Override
    public String toString() {
        return "Commentaire{" + "id=" + id + ", id_user=" + id_user + ", username=" + username + ", id_pub=" + id_pub + ", content=" + content + ", Date=" + Date + '}';
    }

    
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public int getId_pub() {
        return id_pub;
    }

    public void setId_pub(int id_pub) {
        this.id_pub = id_pub;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getDate() {
        return Date;
    }

    public void setDate(String Date) {
        this.Date = Date;
    }
    
}
