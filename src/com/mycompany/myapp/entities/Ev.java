/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entities;

import java.util.Objects;

/**
 *
 * @author Islem
 */
public class Ev {
    private int id_ev;
    private String titre_ev;
    private String type_ev;
    private String emplacement_ev;
    private String date_dev;
    private String date_fev;
    private String temps_dev;
    private String temps_fev;
    private String age_max;
    private String age_min;
    private String image;

    private int id_act;

//    public Ev(String text, String text0, String text1, Date valueOf, Date valueOf0, String text2, String text3, String text4, String text5) {
//        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
//    }
    
    public Ev(String title,String type,String emplacement,String date_dev,String date_fin,String temps_deb,String temps_fin,String age_min,String age_max){
        this.titre_ev= title;
        this.type_ev = type;
        this.emplacement_ev = emplacement;
        this.date_dev = date_dev;
        this.date_fev = date_fin;
        this.temps_dev = temps_deb;
        this.temps_fev =temps_deb;
        this.age_min = age_min;
        this.age_max = age_max;
    }
    public Ev(String titre_ev, String type_ev, String emplacement_ev, String date_dev, String date_fev, String temps_dev, String temps_fev, String age_max, String age_min, int id_act) {
        this.titre_ev = titre_ev;
        this.type_ev = type_ev;
        this.emplacement_ev = emplacement_ev;
        this.date_dev = date_dev;
        this.date_fev = date_fev;
        this.temps_dev = temps_dev;
        this.temps_fev = temps_fev;
        this.age_max = age_max;
        this.age_min = age_min;
        this.id_act = id_act;
    }
    
       public Ev(int id_Ev ,String title1,String type1,String emplacement1,String date_deb11,String date_fin1,String temps_deb1,String temps_fin1,String age_min1,String age_max1) {
        this.id_ev = id_Ev;
         this.titre_ev = title1;
        this.type_ev = type1;
        this.emplacement_ev = emplacement1;
        this.date_dev = date_deb11;
        this.date_fev = date_fin1;
        this.temps_dev = temps_deb1;
        this.temps_fev =temps_fin1;
       this.age_min = age_min1;
        this.age_max = age_max1;
       
        
    } 
       
//    public Ev(String title,String type,String emplacement,String date_dev,String date_fin,String temps_deb,String temps_fin,int age_min,int age_max,int id_act){
//       
//        this.titre_ev= title;
//        this.type_ev = type;
//        this.emplacement_ev = emplacement;
//        this.date_dev = date_dev;
//        this.date_fev = date_fin;
//        this.temps_dev = temps_deb;
//        this.temps_fev = temps_deb;
//        this.age_min = age_min;
//        this.age_max = age_max;
//        this.id_act=id_act;
//
//    
//
//    }

/*public Ev(int id_ev, String titre, String type, String emplacement, Date date_dev, Date date_fev, String temps_dev, String temps_fev, int age_max, int age_min){     
    this.id_ev=id_ev;
        this.titre_ev = titre;
        this.type_ev = type;
        this.emplacement_ev = emplacement;
        this.date_dev = date_dev;
        this.date_fev = date_fev;
        this.temps_dev =  Time.valueOf(LocalTime.parse(temps_dev));
        this.temps_fev =  Time.valueOf(LocalTime.parse(temps_fev));
        this.age_min = age_min;
        this.age_max = age_max; 
    }*/

    public Ev(int id_ev, String titre, String type, String emplacement, String date_dev, String date_fev, String temps_dev, String temps_fev, String age_min, String age_max,String image,int id_act) {
     this.id_ev=id_ev;
        this.titre_ev = titre;
        this.type_ev = type;
        this.emplacement_ev = emplacement;
        this.date_dev = date_dev;
        this.date_fev = date_fev;
        this.temps_dev =  temps_dev;
        this.temps_fev =  temps_fev;
        this.age_min = age_min;
        this.age_max = age_max;
        this.image=image;
        this.id_act=id_act;
    }

       public Ev(int id_ev, String titre, String type, String emplacement, String date_dev, String date_fev, String temps_dev, String temps_fev, String age_min,String age_max,String image) {
     this.id_ev=id_ev;
        this.titre_ev = titre;
        this.type_ev = type;
        this.emplacement_ev = emplacement;
        this.date_dev = date_dev;
        this.date_fev = date_fev;
        this.temps_dev =  temps_dev;
        this.temps_fev = temps_fev;
        this.age_min = age_min;
        this.age_max = age_max;
        this.image=image;
       }

    public Ev(String text, String value, String text0, String valueOf, String valueOf0, String valueOf1,String valueOf2, String parseInt, String parseInt0, String text1) {
   this.titre_ev = text;
        this.type_ev = value;
        this.emplacement_ev = text0;
        this.date_dev = valueOf;
        this.date_fev = valueOf0;
        this.temps_dev =  valueOf1;
        this.temps_fev =  valueOf2;
        this.age_min = parseInt;
        this.age_max = parseInt0;
        this.image= text1;
    }

    public Ev() {
    }

 
      



    public int getId_act() {
        return id_act;
    }
    

    public Ev(String titre_ev) {
        this.titre_ev = titre_ev;
    }
    

//    public Ev( String titre, String type, String emplacement, String date_dev, String date_fev, String temps_dev, String temps_fev, int age_max, int age_min) {
//        this.titre_ev = titre;
//        this.type_ev = type;
//        this.emplacement_ev = emplacement;
//        this.date_dev = date_dev;
//        this.date_fev = date_fev;
//        this.temps_dev = temps_dev;
//        this.temps_fev = temps_fev;
//        this.age_max = age_max;
//        this.age_min = age_min;
//    }


// public Ev(int id_ev, String titre, String type, String emplacement, String date_dev, String date_fev,String temps_dev, String temps_fev, int age_max, int age_min) {
//      
//     this.titre_ev = titre;
//        this.type_ev = type;
//        this.emplacement_ev = emplacement;
//        this.date_dev = date_dev;
//        this.date_fev = date_fev;
//        this.temps_dev = temps_dev;
//        this.temps_fev = temps_fev;
//        this.age_max = age_max;
//        this.age_min = age_min;
//          this.id_ev=id_ev;
// }
//   

    public int getId_ev() {
        return id_ev;
    }
    
public void setId_ev(int id){
this.id_ev=id;
}
    public String getTitre_ev() {
        return titre_ev;
    }

    public void setTitre_ev(String titre) {
        this.titre_ev = titre;
    }

    public String getType_ev() {
        return type_ev;
    }

    public void setType_ev(String type) {
        this.type_ev = type;
    }

    public String getEmplacement_ev() {
        return emplacement_ev;
    }

    public void setEmplacement_ev(String emplacement) {
        this.emplacement_ev = emplacement;
    }

    public String getDate_dev() {
        return date_dev;
    }

    public void setDate_dev(String date_dev) {
        this.date_dev = date_dev;
    }

    public String getDate_fev() {
        return date_fev;
    }

    public void setDate_fev(String date_fev) {
        this.date_fev = date_fev;
    }

    public String getTemps_dev() {
        return temps_dev;
    }

    public void setTemps_dev(String temps_dev) {
        this.temps_dev = temps_dev;
    }

    public String getTemps_fev() {
        return temps_fev;
    }

    public void setTemps_fev(String temps_fev) {
        this.temps_fev = temps_fev;
    }

    public String getAge_max() {
        return age_max;
    }

    public void setAge_max(String age_max) {
        this.age_max = age_max;
    }

    public String getAge_min() {
        return age_min;
    }

    public void setAge_min(String age_min) {
        this.age_min = age_min;
    }

 

 

  
    @Override
    public String toString() {
        return "Ev{" + "id_ev=" + id_ev + ", titre_ev=" + titre_ev + ", type_ev=" + type_ev + ", emplacement_ev=" + emplacement_ev + ", date_dev=" + date_dev + ", date_fev=" + date_fev + ", temps_dev=" + temps_dev + ", temps_fev=" + temps_fev + ", age_min=" + age_min + ", age_max=" + age_max + ", image=" + image + ", id_act=" + id_act + '}';
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

   
    @Override
    public int hashCode() {
        int hash = 7;
        hash = 31 * hash + this.id_ev;
        hash = 31 * hash + Objects.hashCode(this.titre_ev);
        hash = 31 * hash + Objects.hashCode(this.type_ev);
        hash = 31 * hash + Objects.hashCode(this.emplacement_ev);
        hash = 31 * hash + Objects.hashCode(this.date_dev);
        hash = 31 * hash + Objects.hashCode(this.date_fev);
        hash = 31 * hash + Objects.hashCode(this.temps_dev);
        hash = 31 * hash + Objects.hashCode(this.temps_fev);
        hash = 31 * hash +  Objects.hashCode( this.age_max);
        hash = 31 * hash + Objects.hashCode(this.age_min);
        hash = 31 * hash + this.id_act;
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Ev other = (Ev) obj;
        if (this.id_ev != other.id_ev) {
            return false;
        }
        if (this.age_max != other.age_max) {
            return false;
        }
        if (this.age_min != other.age_min) {
            return false;
        }
        if (this.id_act != other.id_act) {
            return false;
        }
        if (!Objects.equals(this.titre_ev, other.titre_ev)) {
            return false;
        }
        if (!Objects.equals(this.type_ev, other.type_ev)) {
            return false;
        }
        if (!Objects.equals(this.emplacement_ev, other.emplacement_ev)) {
            return false;
        }
        if (!Objects.equals(this.date_dev, other.date_dev)) {
            return false;
        }
        if (!Objects.equals(this.date_fev, other.date_fev)) {
            return false;
        }
        if (!Objects.equals(this.temps_dev, other.temps_dev)) {
            return false;
        }
        if (!Objects.equals(this.temps_fev, other.temps_fev)) {
            return false;
        }
        return true;
    }

   
    }

    

