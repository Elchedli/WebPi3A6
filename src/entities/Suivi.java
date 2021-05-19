/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;
import javafx.scene.control.TextField;
/**
 *
 * @author shidono
 */
public class Suivi {
    private Integer id_s;
    public void setId_s(Integer id_s) {
        this.id_s = id_s;
    }
    private String client;
    private String username;
    private String titre_s;
    private String date_ds;
    private String date_fs;
    private String temps_ds;
    private String temps_fs;

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public Suivi() {
        
    }

    public void setClient(String client) {
        this.client = client;
    }

    public void setTitre_s(String titre_s) {
        this.titre_s = titre_s;
    }

    public void setDate_ds(String date_ds) {
        this.date_ds = date_ds;
    }

    public void setDate_fs(String date_fs) {
        this.date_fs = date_fs;
    }

    public void setTemps_ds(String temps_ds) {
        this.temps_ds = temps_ds;
    }

    public void setTemps_fs(String temps_fs) {
        this.temps_fs = temps_fs;
    }

    public Suivi(int id, String titre, String debut, String fin, String timedeb, String timefin) {
        this.id_s = id;
        this.titre_s = titre;
        this.date_ds = debut;
        this.date_fs = fin;
        this.temps_ds = timedeb;
        this.temps_fs = timefin;
    }

    public Suivi(String client,String titre, String datedeb, String datefin, String timedeb, String timefin) {
        this.client = client;
        this.titre_s = titre;
        this.date_ds = datedeb;
        this.date_fs = datefin;
        this.temps_ds = timedeb;
        this.temps_fs = timefin;
    }

    public Suivi(int id,String user, String titre, String debut, String fin, String timedeb, String timefin) {
        this.id_s = id;
        this.client = user;
        this.titre_s = titre;
        this.date_ds = debut;
        this.date_fs = fin;
        this.temps_ds = timedeb;
        this.temps_fs = timefin;
    }

//    public Suivi(String titre,Date ){
//        
//    }
    
    public Integer getId_s() {
        return id_s;
    }

    public String getClient() {
        return client;
    }
    
    public String getTitre_s() {
        return titre_s;
    }

    public String getDate_ds() {
        return date_ds;
    }

    public String getDate_fs() {
        return date_fs;
    }

    public String getTemps_ds() {
        return temps_ds;
    }

    public String getTemps_fs() {
        return temps_fs;
    }

    @Override
    public String toString() {
        return "Suivi{" + "id_s=" + id_s + ", user=" + client + ", titre_s=" + titre_s + ", date_ds=" + date_ds + ", date_fs=" + date_fs + ", temps_ds=" + temps_ds + ", temps_fs=" + temps_fs + '}';
    }
    
    
}
