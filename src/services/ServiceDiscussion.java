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
import com.codename1.ui.events.ActionListener;
import entities.Discussion;
import entities.Suivi;
import entities.userclient;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author chado
 */
public class ServiceDiscussion {
    public String BASE_URL= "http://127.0.0.1:8000/";
    public static ServiceDiscussion instance;
    public boolean resultOK;
    public ArrayList<Discussion> messages;
    private ConnectionRequest req;
     public ServiceDiscussion(){
            req = new ConnectionRequest();
     }
     
     public static ServiceDiscussion getInstance()
        {
            if(instance == null) instance = new ServiceDiscussion();
            return instance;
        }
     
     public ArrayList<Discussion>parseMessages(String jsonText) throws IOException
        {
        ArrayList<Discussion> messages = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> PubsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            ArrayList<Map<String,Object>> list = (ArrayList<Map<String,Object>>)PubsListJson.get("root");
          for (Map<String,Object> obj : list)
          {
              Discussion message = new Discussion();
              String desc = obj.get("contenu_msg").toString();
              String destinataire = obj.get("sender").toString();
              message.setMessage(desc);
              message.setSender(destinataire);
              messages.add(message);
          }
            return messages;
        }
     
     public  ArrayList<Discussion>getMessages(){
        String url =BASE_URL+"/handler.php";
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>(){
                @Override public void actionPerformed(NetworkEvent evt) 
                {
                    try {
                        messages = parseMessages(new String(req.getResponseData()));
                    } catch (IOException ex) {
                        
                    }
                    req.removeResponseListener(this);
                }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
       return messages;
    }

    boolean addMessage(String text) {
        String url = BASE_URL+"handler.php?task=write&author="+userclient.getUser()+"&content="+text;
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
