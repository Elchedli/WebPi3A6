/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.l10n.ParseException;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.events.ActionListener;
import entities.Reclamation;
import entities.Categories;
import entities.userclient;
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
public class ServiceRec {

    public ArrayList<Reclamation> recla;
    
    public static ServiceRec instance=null;
    public boolean resultOK;
    private ConnectionRequest req;
    private boolean resultatOk ;

    public ServiceRec() {
         req = new ConnectionRequest();
    }

    public static ServiceRec getInstance() {
        if (instance == null) {
            instance = new ServiceRec();
        }
        return instance;
    }

    public boolean addTask(Reclamation t) {
    t.setUsername(userclient.getUser());
String url = Statics.BASE_URL + "/reclamation/addRecJSON/new?user=" + t.getUsername() + "&objet=" + t.getObj_rec() + "&description=" + t.getSuj_rec() + "&cat=" + t.getId_cat(); 
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

    public ArrayList<Reclamation> parseTasks(String jsonText) throws ParseException{
        
        try {
            recla=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> tasksListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)tasksListJson.get("root");
            
            //Parcourir la liste des tâches Json
            for(Map<String,Object> obj : list){
                //Création des tâches et récupération de leurs données
                Reclamation t = new Reclamation();
                float idRec = Float.parseFloat(obj.get("idRec").toString());
               t.setId_rec((int)idRec);
                t.setUsername(obj.get("username").toString());
                t.setObj_rec(obj.get("objRec").toString());

                t.setSuj_rec(obj.get("sujRec").toString());
                //t.setDescription_art(obj.get("descriptionArt").toString());
               // t.setId_cat(obj.get("idCat").toString());
               
//                 String h4=obj.get("idCat").toString();  
//                t.setId_cat(h4.substring(22,h4.indexOf("_")));
                
                t.setEtat_rec(obj.get("etatRec").toString());
                //t.setLikes((int) Double.parseDouble(obj.get("likes").toString()));
//               String h3=obj.get("dateArt").toString();  
//                t.setDate_art(h3.substring(96,104));

//                         String nomcat = obj.get("idCat").toString();
//                        t.setNomcat(nomcat.substring(21,nomcat.indexOf("_")));
//               
                //Ajouter la tâche extraite de la réponse Json à la liste
                recla.add(t);
            }
            
            
        } catch (IOException ex) {
             System.err.println(ex.getMessage());
        }
         /*
            A ce niveau on a pu récupérer une liste des tâches à partir
        de la base de données à travers un service web
        
        */
        return recla;
    }
    
    public ArrayList<Reclamation> getAllTasks(){
        try {
            
        
        String url = Statics.BASE_URL+"/reclamation/displayAllJSON";
        req.setUrl(url);
        req.setPost(false);
 
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                
                try {
                    recla = parseTasks(new String(req.getResponseData()));
                } catch (ParseException ex) {
                    
                }
                req.removeResponseListener(this);
            

            }
        });
        
        NetworkManager.getInstance().addToQueueAndWait(req);
        } catch (Exception e) {
           System.err.println(e.getMessage());
        }
        return recla;
        
    }
        public boolean modifier(Reclamation p) {
        String url = Statics.BASE_URL+"/reclamation/editRecJSON/"+p.getId_rec()+"?objet="+p.getObj_rec()+"&description="+p.getSuj_rec();
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
        
        public ArrayList<Reclamation> getSug(String s){
        String url = Statics.BASE_URL+"/reclamation/recherche/"+s;
        req.setUrl(url);
        req.setPost(false);
       
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                String reponsejson=new String(req.getResponseData());
               
                try {
                    recla = parseTasks(reponsejson);
                } catch (ParseException ex) {
              
                }
               
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return recla;
    }
        public boolean supprimer(int id) {
        String url = Statics.BASE_URL +"/reclamation/deleteRecJSON/"+id;
       
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
        public Reclamation getRecalamation(int id , Reclamation art) {
       
        String url = Statics.BASE_URL+"/reclamation/getReclamation/"+id;
        req.setUrl(url);
       
        String str  = new String(req.getResponseData());
        req.addResponseListener((new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                JSONParser jsonp = new JSONParser();
                try {
                    
                    Map<String,Object>obj = jsonp.parseJSON(new CharArrayReader(new String(str).toCharArray()));
                    
                    art.setObj_rec(obj.get("objRec").toString());
                    art.setSuj_rec(obj.get("sujRec").toString());
                    art.setEtat_rec(obj.get("etatRec").toString());
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
