package com.innovdev.spirity.publication;


import com.codename1.components.SpanLabel;
import com.codename1.ui.BrowserComponent;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.innovdev.spirity.publication.DisplayAllPublicationForm;
import com.innovdev.spirity.publication.Publication;
import com.innovdev.spirity.publication.ServicePublication;
import entities.userclient;
import java.io.IOException;
import java.util.ArrayList;
import services.DisplayLogin;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author HP I5
 */
public class DisplayPublicationForm extends Form{
    int ID = userclient.getId();
    String USERNAME = userclient.getUser();
    DisplayPublicationForm current=this;
   public DisplayPublicationForm(DisplayAllPublicationForm previous,Publication p) throws IOException
           {
               super("Publication",BoxLayout.y());
               getToolbar().addMaterialCommandToLeftBar("",FontImage.MATERIAL_ARROW_BACK,e->previous.showBack());
               Button btnAddCom = new Button("Ajouter un Commentaire");
        Button btnupdatePub = new Button("Modifier");
        btnupdatePub.addActionListener(e->new UpdatePublicationForm(current,p).show());
        btnAddCom.addActionListener(e->new AddCommentForm(current,p).show());
      
       
               
             
               Container c = new Container(BoxLayout.y());
              
            String date = p.getDate();
            ArrayList<Commentaire> Coms = ServiceCommentaire.getInstance().getComs();
            ArrayList<Commentaire> ComsPub = new ArrayList();
            for(int i=0;i<=Coms.size()-1;i++)
            {
                if(Coms.get(i).getId_pub()==p.getId())
                    ComsPub.add(Coms.get(i));
            }
               
            add(new SpanLabel("\n"+p.getUsername()+" à dit:\n''"+p.getText()+"''\nLikes: "+p.getNb_react()+"\nLe: "+getDay(date)+"\nà: "+getTime(date)+"\n"));
            add(btnAddCom);
             if(p.getUser_id()==ID)
        {
            add(btnupdatePub);
        }
            for(int i=0;i<=ComsPub.size()-1;i++)
            {
                Commentaire com = ComsPub.get(i);
                c.add(new SpanLabel(com.getUsername()+" à commenté(e):\n''"+com.getContent()+"''\nLe: "+getDay(com.getDate())+"\nà: "+getTime(com.getDate())));
                  
            Button btnDlt = new Button("Supprimer");
            
            btnDlt.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt)
            {
                try
                {
                    if(ServiceCommentaire.getInstance().DltCom(com))
                        Dialog.show("Success","Commentaire supprimer avec Succée !",new Command("Ok"));
                    else
                        Dialog.show("Failed","Echec de Suppression",new Command("Ok"));
                }
                catch(NumberFormatException e)
                {
                    Dialog.show("ERROR","Status must be a number",new Command("Ok"));
                }
             DisplayPublicationForm refreshed = null;
                try {
                    refreshed = new DisplayPublicationForm(new DisplayAllPublicationForm(),p);
                } catch (IOException ex) {
                    
                }
              refreshed.show();
            }
        });
            if(com.getId_user()==ID)
            {
                c.add(btnDlt);
                
            }
          
            }
            
            
            
            
            add(c);
           }
     public String getDay(String Date)
   {
       return Date.substring(6,16);
   }
    public String getTime(String Date)
   {
       return Date.substring(17,25);
   }
}
