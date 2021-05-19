/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.innovdev.spirity.publication;

import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextComponent;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import entities.userclient;
import java.io.IOException;
import services.DisplayLogin;

/**
 *
 * @author HP I5
 */
public class UpdatePublicationForm extends Form{
 int ID = userclient.getId();
    String USERNAME=userclient.getUser();
    public UpdatePublicationForm(DisplayPublicationForm previous, Publication p)
    {
        super("Update Publication",BoxLayout.y());
        getToolbar().addMaterialCommandToLeftBar("",FontImage.MATERIAL_ARROW_BACK,e->previous.showBack());
        Label l= new Label("Write here:\n");
        Button btnAdd = new Button("Changer");
        l.getAllStyles().setFgColor(0xb8b8b8);
        TextComponent tc = new TextComponent().multiline(true);
        
      btnAdd.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt)
            {
               
                try
                {
                    if(ServicePublication.getInstance().UpdatePub(p.getId(),tc.getText()))
                    {
                        Dialog.show("Success","Publication Mis a jour avec Succée",new Command("Ok"));
                        p.setText(tc.getText());
                    }
                    else
                        Dialog.show("Failed","Echec de L'ajout",new Command("Ok"));
                }
                catch(NumberFormatException e)
                {
                    Dialog.show("ERROR","Status must be a number",new Command("Ok"));
                }
                           DisplayPublicationForm refreshed = null;
                try {
                    refreshed = new DisplayPublicationForm(new DisplayAllPublicationForm(),p);
                    refreshed.show();
                } catch (IOException ex) {
                    
                }
              
            }
        });
        add(l);
        add(tc);
        add(btnAdd);
    }
}
