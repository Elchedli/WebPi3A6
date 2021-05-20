/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gui;

import com.codename1.components.ScaleImageLabel;
import com.codename1.components.SpanLabel;
import com.codename1.ui.Button;
import com.codename1.ui.ButtonGroup;
import com.codename1.ui.Command;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import static com.codename1.ui.Component.LEFT;
import static com.codename1.ui.Component.RIGHT;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.EncodedImage;
import com.codename1.ui.Font;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.RadioButton;
import com.codename1.ui.Slider;
import com.codename1.ui.Tabs;
import com.codename1.ui.TextComponent;
import com.codename1.ui.Toolbar;
import com.codename1.ui.URLImage;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.geom.Dimension;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.layouts.LayeredLayout;
import com.codename1.ui.plaf.Border;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.mycompany.entities.Categorie;
import com.mycompany.entities.Article;
import com.mycompany.services.ServiceCateg;
import com.mycompany.services.ServiceArticles;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author user
 */
public class ListProduitsForm extends BaseForm {
    Form current;

      private Resources theme;
    public ListProduitsForm(Resources res) {
        
        super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Liste des Articles");
        getContentPane().setScrollVisible(false);
        super.addSideMenu(res);
        tb.addSearchCommand(e -> {});
        Tabs swipe = new Tabs();
        Label s1 = new Label();
        Label s2 = new Label();
        addTab(swipe, s1, res.getImage("ok.png"),"","",res);
        
        swipe.setUIID("Container");
        swipe.getContentPane().setUIID("Container");
        swipe.hideTabs();
        
        ButtonGroup bg = new ButtonGroup();
        int size = Display.getInstance().convertToPixels(1);
        Image unselectedWalkthru = Image.createImage(size, size, 0);
        Graphics g = unselectedWalkthru.getGraphics();
        g.setColor(0xffffff);
        g.setAlpha(100);
        g.setAntiAliased(true);
        g.fillArc(0, 0, size, size, 0, 360);
        Image selectedWalkthru = Image.createImage(size, size, 0);
        g = selectedWalkthru.getGraphics();
        g.setColor(0xffffff);
        g.setAntiAliased(true);
        g.fillArc(0, 0, size, size, 0, 360);
        RadioButton[] rbs = new RadioButton[swipe.getTabCount()];
        FlowLayout flow = new FlowLayout(CENTER);
        flow.setValign(BOTTOM);
        Container radioContainer = new Container(flow);
        for(int iter = 0 ; iter < rbs.length ; iter++) {
            rbs[iter] = RadioButton.createToggle(unselectedWalkthru, bg);
            rbs[iter].setPressedIcon(selectedWalkthru);
            rbs[iter].setUIID("Label");
            radioContainer.add(rbs[iter]);
        }
                
        rbs[0].setSelected(true);
        swipe.addSelectionListener((i, ii) -> {
            if(!rbs[ii].isSelected()) {
                rbs[ii].setSelected(true);
            }
        });
        
        Component.setSameSize(radioContainer, s1, s2);
        add(LayeredLayout.encloseIn(swipe, radioContainer));
        
        ButtonGroup barGroup = new ButtonGroup();
        RadioButton produits = RadioButton.createToggle("Articles", barGroup);
        produits.setUIID("SelectBar");
        RadioButton ajouter = RadioButton.createToggle("Ajouter", barGroup);
        ajouter.setUIID("SelectBar");
         RadioButton stat = RadioButton.createToggle("Statistique", barGroup);
        ajouter.setUIID("SelectBar");
        Label arrow = new Label(res.getImage("news-tab-down-arrow.png"), "Container");
        
        add(LayeredLayout.encloseIn(
                GridLayout.encloseIn(3, produits, ajouter,stat),
                FlowLayout.encloseBottom(arrow)
        ));
        
        produits.setSelected(true);
        arrow.setVisible(false);
        addShowListener(e -> {
            arrow.setVisible(true);
            updateArrowPosition(produits, arrow);
        });
        ajouter.addActionListener(l -> {
            new AjouterProduitForm(res).show();
        });
        stat.addActionListener(l -> {
            new StatForm(res).show();
        });
        bindButtonSelection(produits, arrow);
        bindButtonSelection(ajouter, arrow);
        bindButtonSelection(stat, arrow);
        
        // special case for rotation
        addOrientationListener(e -> {
            updateArrowPosition(barGroup.getRadioButton(barGroup.getSelectedIndex()), arrow);
        });
         TextComponent recherche = new TextComponent().label("Recherche");
               Button btnc=new Button("ok");
               addAll(recherche,btnc);
               theme = UIManager.initFirstTheme("/theme_1_1");
      btnc.addActionListener(new ActionListener() {
                 
         
            @Override
            public void actionPerformed(ActionEvent evt) {
               
                    try {
                 
                      current = new Form("Les articles", BoxLayout.y());
                     
                        if( recherche.getText().length()>0|| ServiceArticles.getInstance().getSug(recherche.getText()).size()>0){
           ArrayList<Article> array=ServiceArticles.getInstance().getSug(recherche.getText());
                          for(Article s:array){
   
          System.out.print(s);
       Container cnt1=new Container(BoxLayout.y());
        Label lbdes=new Label("Nom :"+s.getTitre_art());
        Label lbtype=new Label("Auteur :"+s.getAuteur_art());
        Label lbdesc=new Label("Description :"+s.getDescription_art());
        Label lbi=new Label("Image :"+s.getPhoto());
     
        Button btn=new Button("Retour");
               btn.addActionListener(e -> {
             new ListProduitsForm(res).show();
         });
         
        
        cnt1.add(lbdes);
        cnt1.add(lbtype);
        cnt1.add(lbdesc);
        cnt1.add(lbi);
        cnt1.add(rating());
        
     
       
       
        cnt1.add(btn);
        Container cnt2=new Container(BoxLayout.x());
        Label lbimg=new Label(theme.getImage(s.getTitre_art()));
       
        cnt2.add(lbimg);
        cnt2.add(cnt1);
        current.add(cnt2);
        current.show();
        

                          }
                        }
                        else
                            Dialog.show("Vide", "Acune Suggestion de ce type", new Command("OK"));
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
                    }
                   
                }

            
               
           
        });
        ArrayList<Article> list = ServiceArticles.getInstance().getAllTasks();
        for(Article prod : list) {
            Label labelimage = new Label();
                Image img=null;
                try {
              
                    img = Image.createImage("file://C:/Users/chado/Documents/NetBeansProjects/WorkshopOarsingJson/src/com/mycompany/uploads/"+prod.getPhoto()).scaledWidth(Math.round(Display.getInstance().getDisplayWidth()));                   
                    labelimage.setIcon(img);
                } catch (IOException ex) {
                    
                }

            addButton(img,prod, res);
        }
    }
    
    private void addStringValue(String s, Component v) {
        add(BorderLayout.west(new Label (s, "PadddedLabel")).add(BorderLayout.CENTER, v));
        add(createLineSeparator(0xeeeeee));
    }

    private void addTab(Tabs swipe, Label spacer, Image image, String string, String text, Resources res) {
        int size = Math.min(Display.getInstance().getDisplayWidth(), Display.getInstance().getDisplayHeight());
        if(image.getHeight() < size) {
            image = image.scaledHeight(size);
        }
        if(image.getHeight() > Display.getInstance().getDisplayHeight() / 2) {
            image = image.scaledHeight(Display.getInstance().getDisplayHeight() / 2);
        }
        ScaleImageLabel imageScale = new ScaleImageLabel(image);
        imageScale.setUIID("Container");
        imageScale.setBackgroundType(Style.BACKGROUND_IMAGE_SCALED_FILL);
        Label overLay = new Label("", "ImageOverlay");
        Container page1 = 
                LayeredLayout.encloseIn(
                        imageScale, 
                        overLay, 
                        BorderLayout.south(
                                BoxLayout.encloseY(
                                        new SpanLabel(text, "LargeWhiteText"),  
                                        spacer
                                )
                        )
                );
        swipe.addTab("", res.getImage("news-item-1.jpg"), page1);
    }
    public void bindButtonSelection(Button btn, Label l) {
        btn.addActionListener(E -> {
            if(btn.isSelected()) {
                updateArrowPosition(btn,l);
            }
        });
    }

    private void updateArrowPosition(Button btn, Label l) {
        l.getUnselectedStyle().setMargin(LEFT, btn.getX() + btn.getWidth() / 2 - l.getWidth() / 2);
        l.getParent().repaint();
    }

    private void addButton(Image img, Article prod, Resources res) {
        int height = Display.getInstance().convertToPixels(22.5f);
        int width = Display.getInstance().convertToPixels(17f);
        
        Button image = new Button(img.fill(width, height));
        image.setUIID("Label");
        Container cnt = BorderLayout.west(image);
        
        Label lbnom = new Label("Titre : "+prod.getTitre_art(), "NewsTopLine");
        Label lbcategorie = new Label("cat : "+String.valueOf(prod.getId_cat()), "NewsTopLine");
        Label lbprix = new Label("Auteur : "+prod.getAuteur_art(), "NewsTopLine");
        Label lbd = new Label(("Desc : "+prod.getDescription_art()), "NewsTopLine");
        Label lbimage = new Label("Photo : "+prod.getPhoto(), "NewsTopLine");
//        Label lbcat = new Label("Catégorie : "+prod.getNomcat(), "NewsTopLine");
        Label lbl = new Label("Likes : "+String.valueOf(prod.getLikes()), "NewsTopLine");
         Label lbdat = new Label("Date : "+prod.getDate_art(), "NewsTopLine");
        /*Label lbchamp = new Label(class.getchamp(), "NewsTopLine2");
        cnt.add(BorderLayout.CENTER, 
                BoxLayout.encloseY(
                        BoxLayout.encloseX(lbtitre)
                        //,BoxLayout.encloseX(lbchamp)
                ));*/
        Label lbSupprimer = new Label("");
        lbSupprimer.setUIID("NewsTopLine2");
        Style supprimerStyle =new Style(lbSupprimer.getUnselectedStyle());
        supprimerStyle.setFgColor(0xf21f1f);
        FontImage supprimerImage = FontImage.createMaterial(FontImage.MATERIAL_DELETE, supprimerStyle);
        lbSupprimer.setIcon(supprimerImage);
        lbSupprimer.setTextPosition(RIGHT);
        
        lbSupprimer.addPointerPressedListener(l -> {
            Dialog dig = new Dialog("Suppression");
            if(dig.show("suppression", "Voulez-vous SUPPRIMER cette produit ?", "Annuler", "Oui")) {
                dig.dispose();
            } else {
                dig.dispose();
                if(ServiceArticles.getInstance().supprimer(prod.getId_art())) {
                    new ListProduitsForm(res).show();
                }
            }
        });
        
        Label lbModifier = new Label("");
        lbModifier.setUIID("NewsTopLine2");
        Style modifierStyle =new Style(lbModifier.getUnselectedStyle());
        modifierStyle.setFgColor(0xf7ad02);
        FontImage modifierImage = FontImage.createMaterial(FontImage.MATERIAL_MODE_EDIT, modifierStyle);
        lbModifier.setIcon(modifierImage);
        lbModifier.setTextPosition(RIGHT);
        
        lbModifier.addPointerPressedListener(l -> {
            new ModifierProduitForm(res, prod).show();
            
        });
        
//        Label lbModifier = new Label("");
//        lbModifier.setUIID("NewsTopLine2");
//        Style modifierStyle =new Style(lbModifier.getUnselectedStyle());
//        modifierStyle.setFgColor(0xf7ad02);
//        FontImage modifierImage = FontImage.createMaterial(FontImage.MATERIAL_MODE_EDIT, modifierStyle);
//        lbModifier.setIcon(modifierImage);
//        lbModifier.setTextPosition(RIGHT);
//        
//        lbModifier.addPointerPressedListener(l -> {
//            new PageArticle(res, prod).show();
//            
//        });
        
        cnt.add(BorderLayout.CENTER, BoxLayout.encloseY(BoxLayout.encloseX(lbnom), BoxLayout.encloseX(lbprix),BoxLayout.encloseX(lbd),BoxLayout.encloseX(lbl)));
        cnt.add(BorderLayout.EAST, BoxLayout.encloseX(lbSupprimer, lbModifier));
        cnt.add(BorderLayout.SOUTH, "---------------------------------------------------------------------------------------");
        add(cnt); //, BoxLayout.encloseY(lbSupprimer, lbModifier)
        add(rating());
    }
    public void initStarRankStyle(Style s, Image star) {
    s.setBackgroundType(Style.BACKGROUND_IMAGE_TILE_BOTH);
    s.setBorder(Border.createEmpty());
    s.setBgImage(star);
    s.setBgTransparency(0);}
    
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
