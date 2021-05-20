/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.mycompany.entities.Article;
import com.mycompany.entities.Categorie;
import utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collection;
import java.util.List;
import java.util.Map;

/**
 *
 * @author bhk
 */
public class ServiceCateg {

    public ArrayList<Categorie> cat;
    
    public static ServiceCateg instance=null;
    public boolean resultOK;
    private ConnectionRequest req;

    public ServiceCateg() {
         req = new ConnectionRequest();
    }

    public static ServiceCateg getInstance() {
        if (instance == null) {
            instance = new ServiceCateg();
        }
        return instance;
    }

    public boolean addTask(Categorie t) {
String url = Statics.BASE_URL + "/categorie/addCartJSON/new?titre="+ t.getTitre_cat(); //création de l'URL
        req.setUrl(url);// Insertion de l'URL de notre demande de connexion
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this); //Supprimer cet actionListener
                /* une fois que nous avons terminé de l'utiliser.
                La ConnectionRequest req est unique pour tous les appels de 
                n'importe quelle méthode du Service task, donc si on ne supprime
                pas l'ActionListener il sera enregistré et donc éxécuté même si 
                la réponse reçue correspond à une autre URL(get par exemple)*/
                
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }

    public ArrayList<Categorie> parseTasks(String jsonText){
        try {
            cat=new ArrayList<>();
            JSONParser j = new JSONParser();// Instanciation d'un objet JSONParser permettant le parsing du résultat json

            
            Map<String,Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
              
            List<Map<String,Object>> list = (List<Map<String,Object>>)tasksListJson.get("root");
            
            //Parcourir la liste des tâches Json
            for(Map<String,Object> obj : list){
                //Création des tâches et récupération de leurs données
                Categorie t = new Categorie();
                float idCat = Float.parseFloat(obj.get("idCat").toString());
               t.setId_cat((int)idCat);
                t.setTitre_cat(obj.get("titreCat").toString());
                //t.setAuteur_art(obj.get("auteur_art").toString());
                //t.setDescription_art(obj.get("date_art").toString());
                //t.setDescription_art(obj.get("description_art").toString());
               // t.setId_cat(obj.get("id_cat").toString());
                //t.setNomcat(obj.get("nomcat").toString());
                //Ajouter la tâche extraite de la réponse Json à la liste
                cat.add(t);
            }
            
            
        } catch (IOException ex) {
             System.err.println(ex.getMessage());
        }
         /*
            A ce niveau on a pu récupérer une liste des tâches à partir
        de la base de données à travers un service web
        
        */
        return cat;
    }
    
    public ArrayList<Categorie> getAllTasks(){
        try {
            
        
        String url = Statics.BASE_URL+"/categorie/displayAllCat";
        req.setUrl(url);
        req.setPost(false);
 
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cat = parseTasks(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        
        NetworkManager.getInstance().addToQueueAndWait(req);
        } catch (Exception e) {
           System.err.println(e.getMessage());
        }
        return cat;
        
    }
        
}
