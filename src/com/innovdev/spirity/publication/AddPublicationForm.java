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
import com.codename1.ui.PickerComponent;
import com.codename1.ui.TextArea;
import com.codename1.ui.TextComponent;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.TextModeLayout;
import com.codename1.ui.validation.LengthConstraint;
import com.codename1.ui.validation.NumericConstraint;
import com.codename1.ui.validation.Validator;
import entities.userclient;
import java.util.Date;
import services.DisplayLogin;

/**
 *
 * @author HP I5
 */
public class AddPublicationForm extends Form{
int ID = userclient.getId();
    String USERNAME=userclient.getUser();
    public AddPublicationForm(DisplayAllPublicationForm previous) {
        super("Ajouter une publication",new TextModeLayout(3,2));
        getToolbar().addMaterialCommandToLeftBar("",FontImage.MATERIAL_ARROW_BACK,e->previous.showBack());
        Label l= new Label("Write here:\n");
        Button btnAdd = new Button("Publier");
        l.getAllStyles().setFgColor(0xb8b8b8);
        TextComponent tc = new TextComponent().multiline(true);
        
        
      btnAdd.addActionListener(new ActionListener(){
            @Override
            public void actionPerformed(ActionEvent evt)
            {
               
                try
                {
                    Publication p= new Publication();
                    p.setText(tc.getText());
                    p.setUsername(USERNAME);
                    p.setUser_id(ID);
                    if(ServicePublication.getInstance().AddPub(p))
                        Dialog.show("Success","Publication Ajoutée avec Succée",new Command("Ok"));
                    else
                        Dialog.show("Failed","Echec de L'ajout",new Command("Ok"));
                }
                catch(NumberFormatException e)
                {
                    Dialog.show("ERROR","Status must be a number",new Command("Ok"));
                }
              DisplayAllPublicationForm refreshed = new DisplayAllPublicationForm();
              refreshed.show();
            }
        });
        add(l);
        add(tc);
        add(btnAdd);
    }
    
    
}
