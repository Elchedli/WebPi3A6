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
import com.mycompany.entities.Categorie;
import com.mycompany.entities.Article;
import com.mycompany.services.ServiceCateg;
import com.mycompany.services.ServiceArticles;

/**
 *
 * @author user
 */
public class ModifierProduitForm extends BaseForm{
        Form current;

     public ModifierProduitForm(Resources res, Article p) {
        super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Modifier Produit");
        getContentPane().setScrollVisible(false);
        
        
        TextField tfnom = new TextField(p.getTitre_art(), "Titre", 20, TextField.ANY);
        TextField tfcategorie = new TextField((p.getDescription_art()), "Desciption", 20, TextField.ANY);
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
             p.setTitre_art(tfnom.getText());
             p.setDescription_art(tfcategorie.getText());
//             p.setPrix(Double.parseDouble(tfprix.getText()));
//             p.setImage(tfimage.getText());
             
             if(ServiceArticles.getInstance().modifier(p)) {
                 new ListProduitsForm(res).show();
             }
         
         });
         Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new ListProduitsForm(res).show();
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
