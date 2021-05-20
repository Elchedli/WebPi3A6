/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

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
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.RadioButton;
import com.codename1.ui.Tabs;
import com.codename1.ui.TextComponent;
import com.codename1.ui.Toolbar;
import com.codename1.ui.URLImage;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.layouts.LayeredLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.entities.Ev;
import com.mycompany.myapp.services.GererEv;
import java.io.IOException;
import java.util.ArrayList;
import services.DisplayLogin;

/**
 *
 * @author user
 */
public class EvenementListForm extends BaseForm {
    Form current;
     Form rech;
      private Resources theme;

    public EvenementListForm (Resources res) {
        super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Liste des evenements");
        getContentPane().setScrollVisible(false);
        super.addSideMenu(res);
        tb.addSearchCommand(e -> {});
        Tabs swipe = new Tabs();
        Label s1 = new Label();
        Label s2 = new Label();
        addTab(swipe, s1, res.getImage("news-item-1.jpg"),"","",res);
        
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
        RadioButton produits = RadioButton.createToggle("List events", barGroup);
        produits.setUIID("SelectBar");
        RadioButton ajouter = RadioButton.createToggle("Statistique", barGroup);
        ajouter.setUIID("SelectBar");
        Label arrow = new Label(res.getImage("news-tab-down-arrow.png"), "Container");
        
        add(LayeredLayout.encloseIn(
                GridLayout.encloseIn(2, produits, ajouter),
                FlowLayout.encloseBottom(arrow)
        ));
        
        produits.setSelected(true);
        arrow.setVisible(false);
        addShowListener(e -> {
            arrow.setVisible(true);
            //updateArrowPosition(produits, arrow);
        });
        ajouter.addActionListener(l -> {
            new StatisticForm(res).show();
        });
        //bindButtonSelection(produits, arrow);
        //bindButtonSelection(ajouter, arrow);
        
        // special case for rotation
        addOrientationListener(e -> {
           // updateArrowPosition(barGroup.getRadioButton(barGroup.getSelectedIndex()), arrow);
        });
        setTitle("List of Events");
       

//                        
//                        else
//                            Dialog.show("Vide", "Acune Suggestion de ce type", new Command("OK"));
//                    } catch (NumberFormatException e) {
//                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
//                    }
//                    
//                }
//                
            
        //});
        ArrayList<Ev> list = GererEv.getInstance().getAllEvents();
        for(Ev prod : list) {
            Label labelimage = new Label();
                Image img=null;
                try {
              
                   img = Image.createImage("file://C:/Users/chado/Documents/NetBeansProjects/WorkshopOarsingJson/src/com/mycompany/uploads/"+prod.getImage()).scaledWidth(Math.round(Display.getInstance().getDisplayWidth()));                   
                    labelimage.setIcon(img);
                } catch (IOException ex) {
                    
                }

            addButton(img,prod, res);
        }
        
        Button btnAnnuler = new Button("Retour");
         btnAnnuler.addActionListener(e -> {
             new DisplayLogin().show();
         });
         Container content = BoxLayout.encloseY(
                 btnAnnuler
         );
         add(content);
    }

//    public ListProduitsForm(Form current) {
//    
//    }
    
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

    private void addButton(Image img, Ev prod, Resources res) {
        int height = Display.getInstance().convertToPixels(22.5f);
        int width = Display.getInstance().convertToPixels(17f);
        
        Button image = new Button(img.fill(width, height));
        image.setUIID("Label");
        Container cnt = BorderLayout.west(image);
        
        Label lbnom = new Label("Nom : "+prod.getTitre_ev(), "NewsTopLine");
        
        Label lbtype = new Label((prod.getType_ev()), "NewsTopLine2");
        Label lbemp = new Label((prod.getEmplacement_ev()), "NewsTopLine2");
         Label lbdate1 = new Label((prod.getDate_dev()), "NewsTopLine2");
          Label lbdate2 = new Label((prod.getDate_fev()), "NewsTopLine2");
           Label lbtemps1 = new Label((prod.getTemps_dev()), "NewsTopLine2");
            Label lbtemps2 = new Label((prod.getTemps_fev()), "NewsTopLine2");
             Label lbagem = new Label((prod.getAge_min()), "NewsTopLine2");
             Label lbpagemm = new Label((prod.getAge_max()), "NewsTopLine2");
        Label lbimage = new Label(prod.getImage(), "NewsTopLine2");
      

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
        
//        lbSupprimer.addPointerPressedListener(l -> {
//            Dialog dig = new Dialog("Suppression");
//            if(dig.show("suppression", "Voulez-vous SUPPRIMER cette produit ?", "Annuler", "Oui")) {
//                dig.dispose();
//            } else {
//                dig.dispose();
//                if(ServiceArticles.getInstance().supprimer(prod.getId_art())) {
//                    new ListProduitsForm(res).show();
//                }
//            }
//        });
        
        Label lbModifier = new Label("");
        lbModifier.setUIID("NewsTopLine2");
        Style modifierStyle =new Style(lbModifier.getUnselectedStyle());
        modifierStyle.setFgColor(0xf7ad02);
        FontImage modifierImage = FontImage.createMaterial(FontImage.MATERIAL_MODE_EDIT, modifierStyle);
        lbModifier.setIcon(modifierImage);
        lbModifier.setTextPosition(RIGHT);
        
//        lbModifier.addPointerPressedListener(l -> {
//            new ModifierProduitForm(res, prod).show();
//            
//        });
//        
        Container add = cnt.add(BorderLayout.CENTER, BoxLayout.encloseY(BoxLayout.encloseX(lbnom), BoxLayout.encloseX(lbtype),BoxLayout.encloseX(lbemp),BoxLayout.encloseX(lbdate1),BoxLayout.encloseX(lbdate2),BoxLayout.encloseX(lbtemps1),BoxLayout.encloseX(lbtemps2),BoxLayout.encloseX(lbagem),BoxLayout.encloseX(lbpagemm)));
        cnt.add(BorderLayout.EAST, BoxLayout.encloseX(lbSupprimer, lbModifier));
        cnt.add(BorderLayout.SOUTH, "---------------------------------------------------------------------------------------");
        add(cnt); //, BoxLayout.encloseY(lbSupprimer, lbModifier)
    }
    
    
}
