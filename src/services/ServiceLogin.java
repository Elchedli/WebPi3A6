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
import com.codename1.ui.Button;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import entities.Suivi;
import entities.userclient;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author chado
 */
public class ServiceLogin {
    public String BASE_URL= "http://127.0.0.1:8000/";
    public static ServiceLogin instance;
    public boolean resultOK;
    private ConnectionRequest req;
     public ServiceLogin(){
            req = new ConnectionRequest();
     }
     
     public static ServiceLogin getInstance()
        {
            if(instance == null) instance = new ServiceLogin();
            return instance;
        }
     
    boolean veriflogin(String user,String mdp,String type){
        String url = BASE_URL+"simplefront/Simple/signin?user="+user+"&password="+mdp+"&type="+type;
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>(){
                @Override public void actionPerformed(NetworkEvent evt) 
                {
                    resultOK = new String(req.getResponseData()).contains("false");
                    if(!resultOK){
                        userclient.setUser(user);
                        userclient.setType(type);
                        userclient.setId(Integer.parseInt(new String(req.getResponseData())));
                        System.out.println("l 'i d est : "+userclient.getId());
                    }
//                    System.out.println("total est : "+resultOK);
                    req.removeResponseListener(this);
                }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return !resultOK;
//        ConnectionRequest req = new ConnectionRequest(url);
//        req.addResponseListener(new ActionListener<NetworkEvent>(){
//            @Override 
//            public void actionPerformed(NetworkEvent evt) {
//                resultOK=req.getResponseCode()==200;
//            }
//        });
//        NetworkManager.getInstance().addToQueueAndWait(req);
//        return resultOK;
    }
    
   boolean inscription(String username,String password,String date,String mail,String type) {
        String url = BASE_URL+"simplefront/Simple/inscription?username="+username+"&password="+password+"&date="+date+"&mail="+mail+"&type="+type;
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
