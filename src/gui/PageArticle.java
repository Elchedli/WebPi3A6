/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gui;

import com.codename1.components.FloatingHint;
import com.codename1.components.ScaleImageLabel;
import com.codename1.components.SliderBridge;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.NetworkManager;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.EncodedImage;
import com.codename1.ui.Font;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.Slider;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.geom.Dimension;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.plaf.Border;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Article;
import com.mycompany.services.ServiceArticles;
import java.io.IOException;

/**
 *
 * @author ASUS
 */
public class PageArticle extends BaseForm {
Form current;

    public PageArticle(Resources res, Article p) {
         super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Article");
        getContentPane().setScrollVisible(false);
        
        
//        TextField tfnom = new TextField(p.getTitre_art(), "Titre", 20, TextField.ANY);
//        TextField tfcategorie = new TextField((p.getDescription_art()), "Desciption", 20, TextField.ANY);
////        TextField tfprix = new TextField(String.valueOf(p.getPrix()), "Prix", 20, TextField.ANY);
////        TextField tfimage = new TextField(p.getImage(), "Image", 20, TextField.ANY);
////        
//        tfnom.setUIID("TextFieldBlack");
//        tfcategorie.setUIID("TextFieldBlack");
////        tfprix.setUIID("TextFieldBlack");
////        tfimage.setUIID("TextFieldBlack");
//        
//        tfnom.setSingleLineTextArea(true);
//        tfcategorie.setSingleLineTextArea(true);
////        tfprix.setSingleLineTextArea(true);
////        tfimage.setSingleLineTextArea(true);
////        
//         Button btnModifier = new Button("Modifier");
//         btnModifier.setUIID("Button");
//         btnModifier.addPointerPressedListener(l -> {
//             p.setTitre_art(tfnom.getText());
//             p.setDescription_art(tfcategorie.getText());
////             p.setPrix(Double.parseDouble(tfprix.getText()));
////             p.setImage(tfimage.getText());
//             
           //  ServiceArticles.getInstance().getRecalamation(2, p);
             
        
         
   
         
     
         Slider s = new Slider();
        s.setEditable(true);
       s.setMinValue(0);
      s.setMaxValue(5);
      s.setIncrements(1);
      // s.setProgress(5);
   
    Font fnt = Font.createTrueTypeFont("native:MainLight", "native:MainLight").
            derive(Display.getInstance().convertToPixels(5, true), Font.STYLE_PLAIN);
    Style style = new Style(0xffff33, 0, fnt, (byte)0);
    Image fullStar = FontImage.createMaterial(FontImage.MATERIAL_STAR, style).toImage();
    style.setOpacity(100);
    style.setFgColor(0);
    Image emptyStar = FontImage.createMaterial(FontImage.MATERIAL_STAR, style).toImage();
    initStarRankStyle(s.getSliderEmptySelectedStyle(), emptyStar);
    initStarRankStyle(s.getSliderEmptyUnselectedStyle(), emptyStar);
    initStarRankStyle(s.getSliderFullSelectedStyle(), fullStar);
    initStarRankStyle(s.getSliderFullUnselectedStyle(), fullStar);
    s.setPreferredSize(new Dimension(fullStar.getWidth() * 5, fullStar.getHeight()));
     Button btnE = new Button("Enregistrer votre notation");
    // Label l1 = new Label ("Vous pouvez noter cette formation");
      Font mediumBoldSystemFont = Font.createSystemFont(Font.FACE_SYSTEM, Font.STYLE_BOLD, Font.SIZE_MEDIUM);
      
     Label l = new Label ("Note");
       l.getUnselectedStyle().setFont(mediumBoldSystemFont);
     s.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                
                    l.setText(Integer.toString(s.getProgress(evt)));
              
            }

             
        });
          
     
      btnE.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                //FormationService fs = new FormationService();
                // FormationService.getInstance().AjouterRating(s.getProgress(evt), f);
//              if(  FormationService.getInstance().isRated(1, f)==0)     {

// FormationService.getInstance().AjouterRating(s.getProgress(evt), f,UserService.getCurrentUser().getUser_id());

//System.out.println(f.getFormation_id());

Dialog.show("success", "Notation est Bien ajoutée", new Command("OK"));
               
            } 
      } );
     
     Container cn = new Container();
     cn.add(s);
     cn.add(l);
    cn.add(btnE);
this.add(cn);
}
    public void initStarRankStyle(Style s, Image star) {
    s.setBackgroundType(Style.BACKGROUND_IMAGE_TILE_BOTH);
    s.setBorder(Border.createEmpty());
    s.setBgImage(star);
    s.setBgTransparency(0);
}
    public  Container rating () {
        getTitleArea().setUIID("Container");
        setTitle("Article");
        getContentPane().setScrollVisible(false);
        
        
//        TextField tfnom = new TextField(p.getTitre_art(), "Titre", 20, TextField.ANY);
//        TextField tfcategorie = new TextField((p.getDescription_art()), "Desciption", 20, TextField.ANY);
////        TextField tfprix = new TextField(String.valueOf(p.getPrix()), "Prix", 20, TextField.ANY);
////        TextField tfimage = new TextField(p.getImage(), "Image", 20, TextField.ANY);
////        
//        tfnom.setUIID("TextFieldBlack");
//        tfcategorie.setUIID("TextFieldBlack");
////        tfprix.setUIID("TextFieldBlack");
////        tfimage.setUIID("TextFieldBlack");
//        
//        tfnom.setSingleLineTextArea(true);
//        tfcategorie.setSingleLineTextArea(true);
////        tfprix.setSingleLineTextArea(true);
////        tfimage.setSingleLineTextArea(true);
////        
//         Button btnModifier = new Button("Modifier");
//         btnModifier.setUIID("Button");
//         btnModifier.addPointerPressedListener(l -> {
//             p.setTitre_art(tfnom.getText());
//             p.setDescription_art(tfcategorie.getText());
////             p.setPrix(Double.parseDouble(tfprix.getText()));
////             p.setImage(tfimage.getText());
//             
           //  ServiceArticles.getInstance().getRecalamation(2, p);
             
        
         
   
         
     
         Slider s = new Slider();
        s.setEditable(true);
       s.setMinValue(0);
      s.setMaxValue(5);
      s.setIncrements(1);
      // s.setProgress(5);
   
    Font fnt = Font.createTrueTypeFont("native:MainLight", "native:MainLight").
            derive(Display.getInstance().convertToPixels(5, true), Font.STYLE_PLAIN);
    Style style = new Style(0xffff33, 0, fnt, (byte)0);
    Image fullStar = FontImage.createMaterial(FontImage.MATERIAL_STAR, style).toImage();
    style.setOpacity(100);
    style.setFgColor(0);
    Image emptyStar = FontImage.createMaterial(FontImage.MATERIAL_STAR, style).toImage();
    initStarRankStyle(s.getSliderEmptySelectedStyle(), emptyStar);
    initStarRankStyle(s.getSliderEmptyUnselectedStyle(), emptyStar);
    initStarRankStyle(s.getSliderFullSelectedStyle(), fullStar);
    initStarRankStyle(s.getSliderFullUnselectedStyle(), fullStar);
    s.setPreferredSize(new Dimension(fullStar.getWidth() * 5, fullStar.getHeight()));
     Button btnE = new Button("Enregistrer votre notation");
    // Label l1 = new Label ("Vous pouvez noter cette formation");
      Font mediumBoldSystemFont = Font.createSystemFont(Font.FACE_SYSTEM, Font.STYLE_BOLD, Font.SIZE_MEDIUM);
      
     Label l = new Label ("Note");
       l.getUnselectedStyle().setFont(mediumBoldSystemFont);
     s.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                
                    l.setText(Integer.toString(s.getProgress(evt)));
              
            }

             
        });
          
     
      btnE.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                //FormationService fs = new FormationService();
                // FormationService.getInstance().AjouterRating(s.getProgress(evt), f);
//              if(  FormationService.getInstance().isRated(1, f)==0)     {

// FormationService.getInstance().AjouterRating(s.getProgress(evt), f,UserService.getCurrentUser().getUser_id());

//System.out.println(f.getFormation_id());

Dialog.show("success", "Notation est Bien ajoutée", new Command("OK"));
               
            } 
      } );
     
     Container cn = new Container();
     cn.add(s);
     cn.add(l);
    cn.add(btnE);
return cn;
    }
    
}

