/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

import java.util.Date;

/**
 *
 * @author salma
 */
public class Reclamation {
    private int id_rec;
    private String username;
    private String obj_rec;
    private String suj_rec;
    private String etat_rec;
    private int id_cat;
    private String nom_cat;
    private String date_rec;
   

   

    public Reclamation(int id_rec, int id_cat, String nom_cat, String username, String obj_rec, String suj_rec, String etat_rec, String date_rec) {
        this.id_rec = id_rec;
        this.id_cat = id_cat;
        this.nom_cat = nom_cat;
        this.username = username;
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
        this.etat_rec = etat_rec;
        this.date_rec = date_rec;
    }

    public Reclamation() {
    }

    public Reclamation(int id_rec) {
        this.id_rec = id_rec;
    }

    public Reclamation(int id_cat, String nom_cat, String username, String obj_rec, String suj_rec) {
        this.id_cat = id_cat;
        this.nom_cat = nom_cat;
        this.username = username;
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
    }
    
    public Reclamation(String nom_cat, String username, String obj_rec, String suj_rec) {
        this.nom_cat = nom_cat;
        this.username = username;
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
    }

    public Reclamation(int id_rec, String etat_rec) {
        this.id_rec = id_rec;
        this.etat_rec = etat_rec;
    }
    
    public Reclamation(String obj_rec, String suj_rec, int id_cat) {
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
        this.id_cat=id_cat;
    }
    
    public Reclamation(String obj_rec, String suj_rec) {
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
        
    }

    public Reclamation(int id_rec, String nom_cat, String username, String obj_rec, String suj_rec, String etat_rec, String date_rec) {
        this.id_rec = id_rec;
        this.nom_cat = nom_cat;
        this.username = username;
        this.obj_rec = obj_rec;
        this.suj_rec = suj_rec;
        this.etat_rec = etat_rec;
        this.date_rec = date_rec;
    }

//    public Reclamation(String obj_rec, String suj_rec, String nom_cat) {
//        this.obj_rec = obj_rec;
//        this.nom_cat = nom_cat;
//        this.suj_rec = suj_rec;
//    }

    public int getId_rec() {
        return id_rec;
    }

    public void setId_rec(int id_rec) {
        this.id_rec = id_rec;
    }

    public int getId_cat() {
        return id_cat;
    }

    public void setId_cat(int id_cat) {
        this.id_cat = id_cat;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getObj_rec() {
        return obj_rec;
    }

    public void setObj_rec(String obj_rec) {
        this.obj_rec = obj_rec;
    }

    public String getSuj_rec() {
        return suj_rec;
    }

    public void setSuj_rec(String suj_rec) {
        this.suj_rec = suj_rec;
    }

    public String getEtat_rec() {
        return etat_rec;
    }

    public String getNom_cat() {
        return nom_cat;
    }

    public void setNom_cat(String nom_cat) {
        this.nom_cat = nom_cat;
    }

    public void setEtat_rec(String etat_rec) {
        this.etat_rec = etat_rec;
    }

    public String getDate_rec() {
        return date_rec;
    }

    public void setDate_rec(String date_rec) {
        this.date_rec = date_rec;
    }

    
    @Override
    public String toString() {
        return "Reclamation : " + "User : " + username + " Objet : " + obj_rec + " Description : " + suj_rec + " Etat : " + etat_rec + " Catégorie : " + id_cat + " Temps d'envoi : " + date_rec ;
    }

    

    
    
}