/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.innovdev.spirity.publication;

import com.codename1.components.SpanButton;
import com.codename1.components.SpanLabel;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Component;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextArea;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.GridLayout;
import entities.userclient;
import java.io.IOException;
import java.util.ArrayList;
import services.DisplayLogin;

/**
 *
 * @author HP I5
 */
public class DisplayAllPublicationForm extends Form{
    DisplayAllPublicationForm current;
    int ID = userclient.getId();
    String USERNAME=userclient.getUser();
    
    public DisplayAllPublicationForm()
    {
        super("Publications", new GridLayout(2,1));
       
        current=this;
        Button btnAddPub = new Button("Ajouter une Publication");
        
        btnAddPub.addActionListener(e->new AddPublicationForm(current).show());
        if(userclient.getType() != "simple")
        {
        addAll(btnAddPub);
        }
        SpanLabel sp = new SpanLabel();
        ArrayList<Publication> list = ServicePublication.getInstance().getAllPubs();
        for(int i= 0;i<=list.size()-1;i++)
        {
            Publication p = list.get(i);
            Button btnSeePub = new Button("Voir");
            btnSeePub.addActionListener(e->{
                try {
                    new DisplayPublicationForm(current,p).show();
                } catch (IOException ex) {
                    
                }
            });
            
            
            Button btnLike = new Button("Like / Dislike");
            Button btnDlt = new Button("Supprimer");
            btnDlt.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt)
            {
                try
                {
                    if(ServicePublication.getInstance().DltPub(p))
                        Dialog.show("Success","Publication supprimer avec Succée !",new Command("Ok"));
                    else
                        Dialog.show("Failed","Echec de Supprission",new Command("Ok"));
                }
                catch(NumberFormatException e)
                {
                    Dialog.show("ERROR","Status must be a number",new Command("Ok"));
                }
              DisplayAllPublicationForm refreshed = new DisplayAllPublicationForm();
              refreshed.show();
            }
        });
            btnLike.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt)
            {
                try
                {
                    if(ServicePublication.getInstance().LikePub(p.getId(),ID))
                        Dialog.show("Success","Publication Aimée avec Succée !",new Command("Ok"));
                    else
                        Dialog.show("Failed","Echec de Supprission",new Command("Ok"));
                }
                catch(NumberFormatException e)
                {
                    Dialog.show("ERROR","Status must be a number",new Command("Ok"));
                }
              DisplayAllPublicationForm refreshed = new DisplayAllPublicationForm();
              refreshed.show();
            }
        });
            Container c = new Container(BoxLayout.y());
            String date = list.get(i).getDate();
            
             Label username= new Label(p.getUsername() + " à dit:");
             TextArea text= new TextArea("''"+p.getText()+"''");
             SpanLabel likes = new SpanLabel("Likes: "+Integer.toString(p.getNb_react()));
             SpanLabel Date = new SpanLabel("Le: "+getDay(date)+"\nà: "+getTime(date));
             
            
             
             
             
             c.add(username);
             c.add(text);
             c.add(likes);
             c.add(Date);
             
                        c.add(btnLike);
                        c.add(btnSeePub);

            if(list.get(i).getUser_id()==ID)
                c.add(btnDlt);

            add(c);
            
        }
    }
   public String getDay(String Date)
   {
       return Date.substring(6,16);
   }
    public String getTime(String Date)
   {
       return Date.substring(17,25);
   }
    public Form refresh()
    {
        return new DisplayAllPublicationForm();
    }
}
