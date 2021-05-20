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
import com.mycompany.myapp.gui.BaseForm;
import entities.Categories;
import entities.Reclamation;
import services.ServiceCat;
import services.ServiceRec;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author user
 */
public class ListRec extends BaseForm {
    Form current;

      private Resources theme;
    public ListRec(Resources res) {
        
        super("Spirity", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Liste Des Réclamations");
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
        RadioButton rec = RadioButton.createToggle("Réclamations", barGroup);
        rec.setUIID("SelectBar");
        RadioButton ajouter = RadioButton.createToggle("Ajouter", barGroup);
        ajouter.setUIID("SelectBar");
         RadioButton stat = RadioButton.createToggle("Statistique", barGroup);
        ajouter.setUIID("SelectBar");
        Label arrow = new Label(res.getImage("news-tab-down-arrow.png"), "Container");
        
        add(LayeredLayout.encloseIn(
                GridLayout.encloseIn(3, rec, ajouter, stat),
                FlowLayout.encloseBottom(arrow)
        ));
        
        rec.setSelected(true);
        arrow.setVisible(false);
        addShowListener(e -> {
            arrow.setVisible(true);
            updateArrowPosition(rec, arrow);
        });
        ajouter.addActionListener(l -> {
            new AddRec(res).show();
        });
        stat.addActionListener(l -> {
            new StatRecForm(res).show();
        });
        bindButtonSelection(rec, arrow);
        bindButtonSelection(ajouter, arrow);
        bindButtonSelection(stat, arrow);
        
        // special case for rotation
        addOrientationListener(e -> {
            updateArrowPosition(barGroup.getRadioButton(barGroup.getSelectedIndex()), arrow);
        });
         TextComponent recherche = new TextComponent().label("Recherche");
               Button btnc=new Button("ok");
               addAll(recherche,btnc);
               theme = UIManager.initFirstTheme("/theme");
      btnc.addActionListener(new ActionListener() {
                 
         
            @Override
            public void actionPerformed(ActionEvent evt) {
               
                    try {
                 
                      current = new Form("Les réclamations", BoxLayout.y());
                     
                        if( recherche.getText().length()>0|| ServiceRec.getInstance().getSug(recherche.getText()).size()>0){
           ArrayList<Reclamation> array=ServiceRec.getInstance().getSug(recherche.getText());
                          for(Reclamation s:array){
   
          System.out.print(s);
       Container cnt1=new Container(BoxLayout.y());
        Label lbdes=new Label("Objet : "+s.getObj_rec());
        Label lbdesc=new Label("Description : "+s.getSuj_rec());
        Label lbtype=new Label("Etat : "+s.getEtat_rec());
        
        Button btn=new Button("Retour");
               btn.addActionListener(e -> {
             new ListRec(res).show();
         });
         
        
        cnt1.add(lbdes);
        cnt1.add(lbtype);
        cnt1.add(lbdesc);
        
        cnt1.add(btn);
        Container cnt2=new Container(BoxLayout.x());
        Label lbimg=new Label(theme.getImage(s.getObj_rec()));
       
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
      ArrayList<Reclamation> list = ServiceRec.getInstance().getAllTasks();
        for(Reclamation prod : list) {
             String urlImage ="back-logo.jpeg";//image statique pour le moment ba3d taw fi  videos jayin nwarikom image 
            
             Image placeHolder = Image.createImage(120, 90);
             EncodedImage enc =  EncodedImage.createFromImage(placeHolder,false);
             URLImage urlim = URLImage.createToStorage(enc, urlImage, urlImage, URLImage.RESIZE_SCALE);
             
                addButton(urlim,prod,res);
        
                ScaleImageLabel image = new ScaleImageLabel(urlim);
                
                Container containerImg = new Container();
                
                image.setBackgroundType(Style.BACKGROUND_IMAGE_SCALED_FILL);
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

    private void addButton(URLImage urlim, Reclamation prod, Resources res) {
        Container cnt = new Container(new BorderLayout());
        int height = Display.getInstance().convertToPixels(22.5f);
        int width = Display.getInstance().convertToPixels(17f);
       
        
        Label lbnom = new Label("Objet : "+prod.getObj_rec(), "NewsTopLine");
        //Label lbcategorie = new Label("Cat : "+String.valueOf(prod.getId_cat()), "NewsTopLine");
        Label lbprix = new Label("Description : "+prod.getSuj_rec(), "NewsTopLine");
        Label lbetat = new Label("Etat : "+prod.getEtat_rec(), "NewsTopLine");
        //Label lbcat = new Label("Catégorie : "+prod.getNom_cat(), "NewsTopLine");

        Label lbSupprimer = new Label("");
        lbSupprimer.setUIID("NewsTopLine2");
        Style supprimerStyle =new Style(lbSupprimer.getUnselectedStyle());
        supprimerStyle.setFgColor(0xf21f1f);
        FontImage supprimerImage = FontImage.createMaterial(FontImage.MATERIAL_DELETE, supprimerStyle);
        lbSupprimer.setIcon(supprimerImage);
        lbSupprimer.setTextPosition(RIGHT);
        
        lbSupprimer.addPointerPressedListener(l -> {
            Dialog dig = new Dialog("Suppression");
            if(dig.show("suppression", "Voulez-vous SUPPRIMER cette réclamation ?", "Annuler", "Oui")) {
                dig.dispose();
            } else {
                dig.dispose();
                if(ServiceRec.getInstance().supprimer(prod.getId_rec())) {
                    new ListRec(res).show();
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
            new EditRec(res, prod).show();
            
        });
        
        
        cnt.add(BorderLayout.CENTER, BoxLayout.encloseY(lbnom, lbprix, lbetat));
        cnt.add(BorderLayout.EAST, BoxLayout.encloseX(lbSupprimer,lbModifier));
        cnt.add(BorderLayout.SOUTH, "---------------------------------------------------------------------------------------");
        
        add(cnt); 
        
    }
    
             
        
         
   
         
     

    
    
}
