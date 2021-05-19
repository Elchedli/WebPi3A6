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
public class ServiceSuivi {
    public String BASE_URL= "http://127.0.0.1:8000/";
    public static ServiceSuivi instance;
    public boolean resultOK;
    public ArrayList<Suivi> suivis;
    private ConnectionRequest req;
     public ServiceSuivi(){
            req = new ConnectionRequest();
     }
     
     public static ServiceSuivi getInstance()
        {
            if(instance == null) instance = new ServiceSuivi();
            return instance;
        }
     
     public ArrayList<Suivi>parseSuivi(String jsonText) throws IOException
        {
        ArrayList<Suivi> suivis = new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> PubsListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            ArrayList<Map<String,Object>> list = (ArrayList<Map<String,Object>>)PubsListJson.get("root");
          for (Map<String,Object> obj : list)
          {
              Suivi suivi = new Suivi();
              System.out.println(obj);
              float id = Float.parseFloat(obj.get("idS").toString());
              String titre = obj.get("titreS").toString();
              String client = obj.get("client").toString();
              String date_ds = obj.get("DateDs").toString();
              String date_fs = obj.get("DateFs").toString();
              String temps_ds = obj.get("tempsDs").toString();
              String temps_fs = obj.get("tempsFs").toString();
              suivi.setId_s((int)id);
              suivi.setClient(client);
               suivi.setTitre_s(titre);
              suivi.setDate_ds(date_ds);
              suivi.setDate_fs(date_fs);
              suivi.setTemps_ds(temps_ds);
              suivi.setTemps_fs(temps_fs);
              suivis.add(suivi);
          }
            return suivis;
        }
     
     public  ArrayList<Suivi>getSuivi(){
        String url =BASE_URL+"suivi/indexjson?user="+userclient.getUser();
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>(){
                @Override public void actionPerformed(NetworkEvent evt) 
                {
                    try {
                        suivis = parseSuivi(new String(req.getResponseData()));
                        req.removeResponseListener(this);
                    } catch (IOException ex) {
                    
                    }
                }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
       return suivis;
    }
    
     public boolean supprimerSuivi(int id){
        String url = BASE_URL+"suivi/supprimerjson?id="+id;
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

    boolean AjouterSuivi(Suivi suiv) {
        String url = BASE_URL+"suivi/newjson?username="+userclient.getUser()+"&client="+suiv.getClient()+"&titre="+suiv.getTitre_s()+"&dateds="+suiv.getDate_ds()+"&datefs="+suiv.getDate_fs()+"&tempsds="+suiv.getTemps_ds()+"&tempsfs="+suiv.getTemps_fs();
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
