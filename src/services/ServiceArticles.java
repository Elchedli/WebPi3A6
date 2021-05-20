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
import com.codename1.l10n.ParseException;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.events.ActionListener;
import com.mycompany.entities.Article;
import com.mycompany.entities.Categorie;
import utils.Statics;
import java.io.IOException;



import java.util.ArrayList;
import java.util.Collection;
import java.util.Date;
import java.util.List;
import java.util.Map;





/**
 *
 * @author bhk
 */
public class ServiceArticles {

    public ArrayList<Article> articles;
    
    public static ServiceArticles instance=null;
    public boolean resultOK;
    private ConnectionRequest req;
    private boolean resultatOk ;

    public ServiceArticles() {
         req = new ConnectionRequest();
    }

    public static ServiceArticles getInstance() {
        if (instance == null) {
            instance = new ServiceArticles();
        }
        return instance;
    }

    public boolean addTask(Article t) {
String url = Statics.BASE_URL + "/Articles/addArtJSON/new?titre="+ t.getTitre_art()+ "&auteur="+t.getAuteur_art()+ "&description="+t.getDescription_art()+"&id_cat="+t.getId_cat()+"&photo="+t.getPhoto(); //création de l'URL
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

    public ArrayList<Article> parseTasks(String jsonText) throws ParseException{
        
        try {
            articles=new ArrayList<>();
            JSONParser j = new JSONParser();// Instanciation d'un objet JSONParser permettant le parsing du résultat json

            
            Map<String,Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
              
            List<Map<String,Object>> list = (List<Map<String,Object>>)tasksListJson.get("root");
            
            //Parcourir la liste des tâches Json
            for(Map<String,Object> obj : list){
                //Création des tâches et récupération de leurs données
                Article t = new Article();
                float idArt = Float.parseFloat(obj.get("idArt").toString());
               t.setId_art((int)idArt);
                t.setTitre_art(obj.get("titreArt").toString());
                t.setAuteur_art(obj.get("auteurArt").toString());

                t.setDescription_art(obj.get("descriptionArt").toString());
                //t.setDescription_art(obj.get("descriptionArt").toString());
               // t.setId_cat(obj.get("idCat").toString());
               
//                 String h4=obj.get("idCat").toString();  
//                t.setId_cat(h4.substring(22,h4.indexOf("_")));
                
                t.setPhoto(obj.get("photo").toString());
                t.setLikes((int) Double.parseDouble(obj.get("likes").toString()));
//               String h3=obj.get("dateArt").toString();  
//                t.setDate_art(h3.substring(96,104));

//                         String nomcat = obj.get("idCat").toString();
//                        t.setNomcat(nomcat.substring(21,nomcat.indexOf("_")));
//               
                //Ajouter la tâche extraite de la réponse Json à la liste
                articles.add(t);
            }
            
            
        } catch (IOException ex) {
             System.err.println(ex.getMessage());
        }
         /*
            A ce niveau on a pu récupérer une liste des tâches à partir
        de la base de données à travers un service web
        
        */
        return articles;
    }
    
    public ArrayList<Article> getAllTasks(){
        try {
        String url = Statics.BASE_URL+"/Articles/displayAllArticles";
        req.setUrl(url);
        req.setPost(false);
 
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                
                try {
                    articles = parseTasks(new String(req.getResponseData()));
                } catch (ParseException ex) {
                    
                }
                req.removeResponseListener(this);
            

            }
        });
        
        NetworkManager.getInstance().addToQueueAndWait(req);
        } catch (Exception e) {
           System.err.println(e.getMessage());
        }
        return articles;
        
    }
        public boolean modifier(Article p) {
        String url = Statics.BASE_URL+"/Articles/editArtJSON/"+p.getId_art()+"?titre="+p.getTitre_art()+"&description="+p.getDescription_art();
        req.setUrl(url);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultatOk = req.getResponseCode() == 200;
                req.removeResponseCodeListener(this);
            }
            
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultatOk;
    }
        
        public ArrayList<Article> getSug(String s){
        String url = Statics.BASE_URL+"/Articles/Recherche/"+s;
        req.setUrl(url);
        req.setPost(false);
       
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                String reponsejson=new String(req.getResponseData());
               
                try {
                    articles = parseTasks(reponsejson);
                } catch (ParseException ex) {
              
                }
               
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return articles;
    }
        public boolean supprimer(int id) {
        String url = Statics.BASE_URL +"/Articles/deleteArtJSON/"+id;
       
        req.setUrl(url);
       
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                   
                    req.removeResponseCodeListener(this);
                    resultOK=true;
            }
        });
       
        NetworkManager.getInstance().addToQueueAndWait(req);
        return  resultOK;
    }
        public Article getRecalamation(int id , Article art) {
       
        String url = Statics.BASE_URL+"/Articles/getArticles/"+id;
        req.setUrl(url);
       
        String str  = new String(req.getResponseData());
        req.addResponseListener((new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                JSONParser jsonp = new JSONParser();
                try {
                    
                    Map<String,Object>obj = jsonp.parseJSON(new CharArrayReader(new String(str).toCharArray()));
                    
                    art.setTitre_art(obj.get("titreArt").toString());
                    art.setAuteur_art(obj.get("auteurArt").toString());
                    art.setDescription_art(obj.get("descriptionArt").toString());
//                    art.setNomcat(obj.get("etatRec").toString());
//                     art.setLikes(obj.get("etatRec").toString());
                    
                }catch(IOException ex) {
                    System.out.println("error related to sql :( "+ex.getMessage());
                }
                
                
                System.out.println("data === "+str);
            }
        }));
       
              NetworkManager.getInstance().addToQueueAndWait(req);
              return art;
       
       
    }
        
}
