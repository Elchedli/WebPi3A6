package com.mycompany.myapp.services;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.Dialog;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Act;
import com.mycompany.myapp.utils.Statics;
import java.io.IOException;

import java.util.List;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.LinkedHashMap;
import java.util.Map;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
/**
 *
 * @author Islem
 */
public class Activite {
 //singleton
    public static Activite instance = null;
    private ConnectionRequest req;
    ArrayList<Act> act;
    boolean t;
     private boolean resultatOk ;
    
    public static Activite getInstance(){
        if (instance == null) {
            instance = new Activite();
        }
        return instance;
    }
    
    public Activite(){
        req = new ConnectionRequest();
        
    }

    public Activite(String title) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
  

    public void ajouter(Act act){

        String url=Statics.BASE_URL+ "/act/addActJSON/new?Nom="+act.getNom_act()+"&Type=" +act.getType_act()+"&image=" +act.getImage();
        req.setUrl(url);
        req.addResponseListener((e)->{
            String str = new String(req.getResponseData()); //reponse JSON
            System.out.println("data "+str);
            Dialog.show("Confirmation", "success", "Ok", null);
        });
        
        NetworkManager.getInstance().addToQueueAndWait(req); //execution de requete
        
    }
    //affichage
    public ArrayList<Act> parseTasks(String jsonText){
        try {
            act=new ArrayList<>();
            JSONParser j = new JSONParser();// Instanciation d'un objet JSONParser permettant le parsing du résultat json

//            Map<String,Object> list = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
//              System.out.println(list);
//            List<Map<String,Object>> listJ = (List<Map<String,Object>>)list.get("root");
            Map<String,Object> associationsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));            
            java.util.List<Map<String,Object>> list = (java.util.List<Map<String,Object>>)associationsListJson.get("root");
            System.out.println("alaa");
            //Parcourir la liste des tâches Json
            int i =0;
            for(Map<String,Object> obj : list){
                //Création des tâches et récupération de leurs données
               Act t = new Act();
                System.out.println("avantact");
               float idAct = Float.parseFloat(obj.get("idAct").toString());
               t.setId_act((int)idAct);
               t.setNom_act((obj.get("nomAct").toString()));
               t.setType_act((obj.get("typeAct").toString()));
               t.setImage((obj.get("image").toString()));
                //Ajouter la tâche extraite de la réponse Json à la liste
                System.out.println("est ce que ca marche?");
                i++;
                System.out.println("test "+i+" est égale a : "+t);
                act.add(t);
            }
           
           
        } catch (IOException ex) {
           
        }
         /*
            A ce niveau on a pu récupérer une liste des tâches à partir
        de la base de données à travers un service web
       
        */
         System.out.println("est ce que tu retourne?");
        return act;
    }
       public ArrayList<Act> display(){
        String url = Statics.BASE_URL+"/act/actJSON";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                
                String reponsejson=new String(req.getResponseData());
                System.out.println("test variable : "+reponsejson);
                act = parseTasks(reponsejson);
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return act;
    }
       
       public ArrayList<Act> getSug(String s){
        String url = Statics.BASE_URL+"/act/Recherche/"+s;
        req.setUrl(url);
        req.setPost(false);
        
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                String reponsejson=new String(req.getResponseData());
                
               act = parseTasks(reponsejson);
                
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return act;
    }

//    public ArrayList<Act> getAllAct() {
//        ArrayList<Act> result = new ArrayList<>();
//        String url = Statics.BASE_URL + "/act/actJSON";
//        req.setUrl(url);
//        req.setPost(false);
//        req.addResponseListener(new ActionListener<NetworkEvent>() {
//            @Override
//            public void actionPerformed(NetworkEvent evt) {
//                JSONParser jsonp;
//                jsonp = new JSONParser();
//                
//                try{
//                    Map<String,Object>mapTopics=jsonp.parseJSON(new CharArrayReader(new String(req.getResponseData()).toCharArray()));
//                    List<Map<String,Object>> listOfMaps = (List<Map<String,Object>>) mapTopics.get("root");
//                    
//                for (Map<String, Object> obj : listOfMaps) {
//                   Act acts= new Act();
//                     float f = Float.parseFloat(obj.get("idAct").toString());
//                    acts.setId_act((int) f);
//                    
//                    acts.setNom_act(obj.get("nomAct").toString());
//                    acts.setType_act (obj.get("typeAct").toString());
//                    // acts.setImage(obj.get("image").toString());
//                    //insert data
//                    result.add(acts);
//                   
//            }
//                }catch(Exception ex){
//                    ex.printStackTrace();
//                }
//                
//            }
//        });
//        NetworkManager.getInstance().addToQueueAndWait(req);
//        return result;
//    }

    public boolean modifier(Act p) {
        String url = Statics.BASE_URL+"/act/editActJSON/"+p.getId_act()+"?Nom="+p.getType_act()+"&Type="+p.getType_act();
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
}
//    public void supprimer(Act gmi) {
//        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
//    }
//     parse topic
//    public ArrayList<Act> parseTopic(String jsonText) {
//        try {
//            act = new ArrayList<>();
//            JSONParser j = new JSONParser();
//            Map<String, Object> PostsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
//            
//            List<Map<String, Object>> list = (List<Map<String, Object>>) PostsListJson.get("root");
//            //parsing json  
//            for (Map<String, Object> obj : list) {
//               Act topic = new Act();
//
//                float id_act = Float.parseFloat(obj.get("idAct").toString());
//                topic.setId_act((int) id_act);
//                
////                Object idu = obj.get("idu");
////                LinkedHashMap<Object, Object> lhm = new LinkedHashMap<>();
////                lhm = (LinkedHashMap<Object, Object>) obj.get("User_id");
////                topic.setUser_id(lhm);
//                
//                topic.setNom_act(obj.get("nomAct").toString());
//                topic.setType_act(obj.get("typeAct").toString());
//                
//
//                
//                
//            }
//
//        } catch (IOException ex) {
//            System.out.println("Exception in parsing topic ");
//        }
//
//        return act;
//    }
// 

//  public ArrayList<Act> getAllAct() {
//        ArrayList<Act> result = new ArrayList<>();
//        String url = Statics.BASE_URL + "/act/actJSON";
//
//        req.setUrl(url);
//        req.setPost(false);
//        req.addResponseListener(new ActionListener<NetworkEvent>() {
//            @Override
//            public void actionPerformed(NetworkEvent evt) {
//                JSONParser jsonp;
//                jsonp = new JSONParser();
//                
//                try{
//                    Map<String,Object>mapTopics=jsonp.parseJSON(new CharArrayReader(new String(req.getResponseData()).toCharArray()));
//                    List<Map<String,Object>> listOfMaps = (List<Map<String,Object>>) mapTopics.get("root");
//                    
//                for (Map<String, Object> obj : listOfMaps) {
//                    Act act = new Act();
//
////                    float id = Float.parseFloat(obj.get("id_act").toString());
////                    act.setId_act((int) id);
//                    
////                    Object user = obj.get("user_id");
////                    LinkedHashMap<Object, Object> lhm = new LinkedHashMap<>();
//                   
//                    
//                    act.setNom_act(obj.get("nom_act").toString());
//                    act.setType_act(obj.get("type_act").toString());
//                    
////                    Map<String, Object> mapDateCreation = (Map<String, Object>) obj.get("date");
////                    float dateC = Float.parseFloat(mapDateCreation.get("timestamp").toString());
////                    String date = new SimpleDateFormat("dd/MM/yyyy").format(new Date((long) (dateC* 1000L)));
////                    topics.setDate(date);
////                    
//                    //insert data
//                    result.add(act);
//                    
//
//            }
//                }catch(Exception ex){
//                    ex.printStackTrace();
//                }
//                
//            }
//        });
//        NetworkManager.getInstance().addToQueueAndWait(req);
//        return result;
//    }
//}
//
//// public ArrayList<Act> getListOeuvres(){      
////        ConnectionRequest con = new ConnectionRequest();
////    String url = Statics.BASE_URL+"/oeuvrage/aa/listO";
////     con.setUrl(url);
////           con.addResponseListener(new ActionListener<NetworkEvent>() {
////            @Override
////            public void actionPerformed(NetworkEvent evt) {
////              acts = listActForm(new String(con.getResponseData()));
////                con.removeResponseListener(this);
////            }
////        });
//// 
//// NetworkManager.getInstance().addToQueueAndWait(con);
//////       return acts;
//////   }
////    public void supprimer(Act gmi) {
////        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
////    }
////}
////    
//   /*
//    public void supprimer(Act t) {
//     try {
//         String requete = "DELETE FROM act WHERE id_act=?";
//            PreparedStatement pst = cnx.prepareStatement(requete);
//            pst.setString(1,t.getNom_act());
//            pst.executeUpdate();
//            System.out.println("l'activité supprimée avec succés  ! \n");
//        } 
//catch (SQLException ex) {
//            System.out.println("erreur lors de la suppression \n" + ex.getMessage());
//        }
//    } 
//   
//
//    @Override
//    public void modifier(Act t) {
//           
//     
//try { 
//            String requete = "UPDATE `act` SET nom_act=?, type_act=?, image=? WHERE id_act= ?";;
//            PreparedStatement pst = cnx.prepareStatement(requete);
//            pst.setInt(4,t.getId_act());
//            pst.setString(1, t.getNom_act());
//            pst.setString(2, t.getType_act());
//              pst.setString(3, t.getImage());
//            pst.executeUpdate();
//            System.out.println("Activité modifié avec succés \n ");
//        } catch (SQLException ex) {
//            System.out.println("erreur lors de la modification \n " + ex.getMessage());
//        }
//    }
//
//    @Override
//    public List<Act> afficher() {
//        List<Act> activite = new ArrayList<>();
//        String requete = "Select * from act";
//
//        try {
//            PreparedStatement pst = cnx.prepareStatement(requete);
//            ResultSet rs = pst.executeQuery();
//            while (rs.next()) {
//             activite.add(new Act( rs.getInt(1), rs.getString(2), rs.getString(3),rs.getString(4)));
//            }
//        } catch (SQLException ex) {
//            System.out.println("Erreur lors d'extraction des données \n" + ex.getMessage());
//        }
//        return activite;
//    } 
//      public static Comparator <Act> actComparator = (Act s1, Act s2) -> {
//        String Act1 = s1.getNom_act();
//        String Act2 = s2.getType_act();
//        return Act1.compareTo(Act2);
//      };
//       public ArrayList<Act> RechercheNom(String x) {
//        
//        ArrayList<Act> act = new ArrayList<>();
//        String requete = "select * from act where titre_ev ='"+x+"'";
//        try {
//            PreparedStatement pst = cnx.prepareStatement(requete);
//            ResultSet rs = pst.executeQuery();
//            while (rs.next()) {
//
//             act.add(new Act( rs.getString(1), rs.getString (2)));}
//             Collections.sort(act,actComparator );
//            Collections.reverse(act);
//        } catch (SQLException ex) {
//            System.out.println("Erreur lors d'extraction des données \n" + ex.getMessage());
//        }
//        return act;
//    }
//}
//*/
// 


    