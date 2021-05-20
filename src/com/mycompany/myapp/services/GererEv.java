/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.services;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import javafx.scene.control.TableColumn;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.l10n.ParseException;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Act;
import java.util.Map;
import com.mycompany.myapp.entities.Ev;
import com.mycompany.myapp.utils.Statics;
import java.io.IOException;

/**
 *
 * @author Islem
 */
public class GererEv  {
      public ArrayList<Ev> Events;
    public static GererEv instance=null;
    public boolean resultOK;
    private final ConnectionRequest req;
    
        public static GererEv getInstance() {
        if (instance == null) {
            instance = new GererEv();
        }
        return instance;
    }
    public GererEv(){
 req = new ConnectionRequest();
}

    public GererEv(String title) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
     public ArrayList<Ev> parseEvents(String jsonText) throws ParseException {
        try {
            Events=new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> associationsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));            
            java.util.List<Map<String,Object>> list = (java.util.List<Map<String,Object>>)associationsListJson.get("root");
            for(Map<String,Object> obj : list){
                Ev e = new Ev ();
                float id = Float.parseFloat(obj.get("idEv").toString());
                e.setId_ev((int)id);               
                e.setTitre_ev(obj.get("titreEv").toString());
                e.setType_ev(obj.get("typeEv").toString());
                e.setEmplacement_ev(obj.get("emplacementEv").toString());
                String h3=obj.get("dateDev").toString();  
                e.setDate_dev(h3.substring(0, h3.indexOf("T00")));
                String h4=obj.get("dateFev").toString();  
                e.setDate_fev(h4.substring(0, h4.indexOf("T00")));
             
//                e.setTemps_dev(obj.get("tempsDev").toString());
                  String h5=obj.get("tempsDev").toString();
                 e.setTemps_dev(h5.substring(11, h5.indexOf("+")));
                  String h6=obj.get("tempsFev").toString();
                 e.setTemps_fev(h6.substring(11, h6.indexOf("+")));
//                e.setTemps_fev(obj.get("tempsFev").toString());

               String h=obj.get("ageMin").toString();
               e.setAge_min(h.substring(0, h.indexOf(".")));
                String h1=obj.get("ageMax").toString();
               e.setAge_max(h1.substring(0, h1.indexOf(".")));
              
//               e.setAge_max(Integer.parseInt(obj.get("ageMax").toString()));
                
                e.setImage(obj.get("image").toString());
                     
                             
                //float id = Float.parseFloat(obj.get("id").toString());
                //m.setId((int)id)
                
               //  m.setQuantity(Integer.parseInt(obj.get("quantity").toString()));
                 
                Events.add(e);
                
                
            }
            
            
        } catch (IOException ex) {

        }
        return Events;
     }
     
    
    public ArrayList<Ev> getAllEvents(){
        String url = Statics.BASE_URL+"/evenement/mobile";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                try {
                    Events = parseEvents(new String(req.getResponseData()));
                } catch (ParseException ex) {
//                    Logger.getLogger(GererEv.class.getName()).log(Level.SEVERE, null, ex);
                }
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return Events;
    }

 
}

   
    

