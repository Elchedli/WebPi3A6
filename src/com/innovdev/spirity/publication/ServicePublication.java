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
import com.codename1.ui.List;
import com.codename1.ui.events.ActionListener;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Collections;
import java.util.Map;

/**
 *
 * @author HP I5
 */
public class ServicePublication {
        public String BASE_URL= "http://127.0.0.1:8000/publications/MobilePublication/";
        public static ServicePublication instance;
        public boolean resultOK;
        public ArrayList<Publication> pubs;
        private ConnectionRequest req;
        public ServicePublication()
        {
            req = new ConnectionRequest();
        }
        public static ServicePublication getInstance()
        {
            if(instance == null)
                instance = new ServicePublication();
            
            return instance;
        }
        
        public ArrayList<Publication>parsePub(String jsonText) throws IOException
        {
            pubs = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> PubsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            ArrayList<Map<String,Object>> list = (ArrayList<Map<String,Object>>)PubsListJson.get("root");
          for (Map<String,Object> obj : list)
          {
              Publication pub = new Publication();
              float id = Float.parseFloat(obj.get("id_pub").toString());
              float id_user = Float.parseFloat(obj.get("id_user").toString());
              float likes = Float.parseFloat(obj.get("nb_reaction").toString());
              String date = obj.get("date_pub").toString();
              String text = obj.get("texte").toString();
              String username = obj.get("username").toString();
              pub.setId((int)id);
              pub.setUser_id((int)id_user);
              pub.setDate(date);
              pub.setNb_react((int)likes);
              pub.setText(text);
              pub.setUsername(username);
              pubs.add(pub);
          }
            return pubs;
        }
        public ArrayList<Publication>getAllPubs()
        {
             String url= BASE_URL+"JSONALL";
             req.setUrl(url);
             req.setPost(false);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        try {
                            ArrayList<Publication> pubs = parsePub(new String(req.getResponseData()));
                            req.removeResponseListener(this);
                        } catch (IOException ex) {
                          
                        }
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            Collections.reverse(pubs);
           return pubs;
        } 
        public boolean AddPub(Publication p)
        {
            String url= BASE_URL+"WJSON?id="+p.getUser_id()+"&username="+p.getUsername()+"&texte="+p.getText();
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
        public boolean UpdatePub(int id,String text)
        {
            String url= BASE_URL+"UJSON?id="+id+"&texte="+text;
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
        
        public boolean LikePub(int id,int id_user)
        {
            String url= BASE_URL+"LJSON_"+id+"_"+id_user;
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
        
        public boolean DltPub(Publication p)
        {
            String url= BASE_URL+"DJSON_"+p.getId();
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
         public ArrayList<Publication>getPub(int id)
        {
             String url= BASE_URL+"RJSON_"+id;
             req.setUrl(url);
             req.setPost(false);
            req.addResponseListener(new ActionListener<NetworkEvent>(){
                    @Override public void actionPerformed(NetworkEvent evt) 
                    {
                        try {
                            ArrayList<Publication> pubs = parsePub(new String(req.getResponseData()));
                            req.removeResponseListener(this);
                        } catch (IOException ex) {
                          
                        }
                    }
                    });
            NetworkManager.getInstance().addToQueueAndWait(req);
            Collections.reverse(pubs);
           return pubs;
        } 
}
