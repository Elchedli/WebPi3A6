/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gui;

import com.codename1.components.FloatingHint;
import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.util.Resources;
import entities.Categories;
import entities.Reclamation;
import services.ServiceCat;
import services.ServiceRec;

/**
 *
 * @author user
 */
public class EditRec extends BaseForm{
        Form current;

     public EditRec(Resources res, Reclamation p) {
        super("Spirity", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Modifier Réclamation");
        getContentPane().setScrollVisible(false);
        
        TextField tfcategorie = new TextField((p.getSuj_rec()), "Description", 20, TextField.ANY);
        TextField tfnom = new TextField(p.getObj_rec(), "Objet", 20, TextField.ANY);
        
//        TextField tfprix = new TextField(String.valueOf(p.getPrix()), "Prix", 20, TextField.ANY);
//        TextField tfimage = new TextField(p.getImage(), "Image", 20, TextField.ANY);
//        

tfcategorie.setUIID("TextFieldBlack");
        tfnom.setUIID("TextFieldBlack");
        
//        tfprix.setUIID("TextFieldBlack");
//        tfimage.setUIID("TextFieldBlack");
        tfcategorie.setSingleLineTextArea(true);
        tfnom.setSingleLineTextArea(true);
        
//        tfprix.setSingleLineTextArea(true);
//        tfimage.setSingleLineTextArea(true);
//        
         Button btnModifier = new Button("Modifier");
         btnModifier.setUIID("Button");
         btnModifier.addPointerPressedListener(l -> {
             p.setSuj_rec(tfcategorie.getText());
             p.setObj_rec(tfnom.getText());
             
//             p.setPrix(Double.parseDouble(tfprix.getText()));
//             p.setImage(tfimage.getText());
             
             if(ServiceRec.getInstance().modifier(p)) {
                 new ListRec(res).show();
             }
         
         });
         Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new ListRec(res).show();
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
         
     }
}
