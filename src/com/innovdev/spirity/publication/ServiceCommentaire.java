/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.innovdev.spirity.publication;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.Dialog;
import com.codename1.ui.events.ActionListener;
import static com.innovdev.spirity.publication.ServicePublication.instance;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Map;

/**
 *
 * @author HP I5
 */
public class ServiceCommentaire {
     public String BASE_URL= "http://127.0.0.1:8000/commentaire/MobileCommentaire/";
     public static ServiceCommentaire instance;
        public boolean resultOK;
        public ArrayList<Commentaire> Coms=null;
        private ConnectionRequest req;
        public ServiceCommentaire()
        {
            req = new ConnectionRequest();
        }
        public static ServiceCommentaire getInstance()
        {
            if(instance == null)
                instance = new ServiceCommentaire();
            
            return instance;
        }
       public ArrayList<Commentaire>parseCom(String jsonText) throws IOException
        {
            Coms = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> ComsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            ArrayList<Map<String,Object>> list = (ArrayList<Map<String,Object>>)ComsListJson.get("root");
     
          for (Map<String,Object> obj : list)
          {
              Commentaire com = new Commentaire();
              float id = Float.parseFloat(obj.get("id").toString());
              float id_pub = Float.parseFloat(obj.get("id_pub").toString());
              float id_user = Float.parseFloat(obj.get("id_user").toString());
              String date = obj.get("date").toString();
              String text = obj.get("contenu").toString();
              String username = obj.get("username").toString();
              com.setId((int)id);
              com.setId_user((int)id_user);
              com.setId_pub((int)id_pub);
              com.setDate(date);
              com.setContent(text);
              com.setUsername(username);
              Coms.add(com);
      
          }
            return Coms;
        }
       public ArrayList<Commentaire>getComs()
        {
            Coms = new ArrayList();
             String url= BASE_URL+"JSONALL";
             req.setUrl(url);
             req.setPost(false);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        try {
                            ArrayList<Commentaire> coms = parseCom(new String(req.getResponseData()));
                            req.removeResponseListener(this);
                        } catch (IOException ex) {
                            
                        }
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            Collections.reverse(Coms);
           return Coms;
        } 
       
 public boolean AddCom(Commentaire c)
        {
            String url= BASE_URL+"WJSON?id_pub="+c.getId_pub()+"&id_user="+c.getId_user()+"&username="+c.getUsername()+"&texte="+c.getContent();
            ConnectionRequest req = new ConnectionRequest(url);
            req.setPost(true);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        resultOK=req.getResponseCode()==200;
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            return resultOK;
        }
 public boolean DltCom(Commentaire c)
        {
            String url= BASE_URL+"DJSON_"+c.getId();
            ConnectionRequest req = new ConnectionRequest(url);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        resultOK=req.getResponseCode()==200;
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            return resultOK;
        }
 public boolean UpdateCom(int id,String text)
        {
            String url= BASE_URL+"UJSON?id="+id+"&?texte="+text;
            ConnectionRequest req = new ConnectionRequest(url);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        resultOK=req.getResponseCode()==200;
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            return resultOK;
        }
}
