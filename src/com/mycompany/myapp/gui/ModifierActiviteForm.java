/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.FloatingHint;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.entities.Act;
import com.mycompany.myapp.services.Activite;


/**
 *
 * @author user
 */
public class ModifierActiviteForm extends BaseForm {
        Form current;

     public ModifierActiviteForm(Resources res, Act p) {
        super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Modifier Produit");
        getContentPane().setScrollVisible(false);
        
        
        TextField tfnom = new TextField(p.getNom_act(), "Nom", 20, TextField.ANY);
        TextField tfcategorie = new TextField((p.getType_act()), "Type", 20, TextField.ANY);
//        TextField tfprix = new TextField(String.valueOf(p.getPrix()), "Prix", 20, TextField.ANY);
//        TextField tfimage = new TextField(p.getImage(), "Image", 20, TextField.ANY);
//        
        tfnom.setUIID("TextFieldBlack");
        tfcategorie.setUIID("TextFieldBlack");
//        tfprix.setUIID("TextFieldBlack");
//        tfimage.setUIID("TextFieldBlack");
        
        tfnom.setSingleLineTextArea(true);
        tfcategorie.setSingleLineTextArea(true);
//        tfprix.setSingleLineTextArea(true);
//        tfimage.setSingleLineTextArea(true);
//        
         Button btnModifier = new Button("Modifier");
         btnModifier.setUIID("Button");
         btnModifier.addPointerPressedListener(l -> {
             p.setNom_act(tfnom.getText());
             p.setType_act(tfcategorie.getText());
//             p.setPrix(Double.parseDouble(tfprix.getText()));
//             p.setImage(tfimage.getText());
             
             if(Activite.getInstance().modifier(p)) {
                 new ListeActivite(res).show();
             }
         
         });
         Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new ListeActivite(res).show();
         });
         
         Container content = BoxLayout.encloseY(
                 new FloatingHint(tfnom),
                 createLineSeparator(),
                 new FloatingHint(tfcategorie),
                 createLineSeparator(),
//                 new FloatingHint(tfprix),
//                 createLineSeparator(),
//                 new FloatingHint(tfimage),
//                 createLineSeparator(),
                 btnModifier,
                 btnAnnuler
         );
         
         add(content);
         show();
         Button btnRetour = new Button("Retour");
         btnRetour.addActionListener(e -> {
             new ListeActivite(res).show();
         });
         Container contenu = BoxLayout.encloseY(
                 btnRetour
         );
         add(contenu);
     }
}
