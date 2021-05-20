/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package gui;

import com.codename1.capture.Capture;
import com.codename1.components.InfiniteProgress;
import com.codename1.components.ScaleImageLabel;
import com.codename1.components.SpanLabel;
import com.codename1.io.MultipartRequest;
import com.codename1.io.NetworkManager;
import com.codename1.notifications.LocalNotification;
import com.codename1.ui.Button;
import com.codename1.ui.ButtonGroup;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import static com.codename1.ui.Component.LEFT;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.RadioButton;
import com.codename1.ui.Tabs;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.layouts.LayeredLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.spinner.Picker;
import com.codename1.ui.util.Resources;
import com.codename1.ui.validation.GroupConstraint;
import com.codename1.ui.validation.LengthConstraint;
import com.codename1.ui.validation.RegexConstraint;
import com.codename1.ui.validation.Validator;
import com.mycompany.entities.Categorie;
import com.mycompany.entities.Article;
import com.mycompany.myapp.gui.ListeActivite;
import com.mycompany.services.ServiceCateg;
import com.mycompany.services.ServiceArticles;
import java.io.IOException;

/**
 *
 * @author user
 */
public class AjouterProduitForm extends BaseForm {
    Form current;
    String file ;
    
    public AjouterProduitForm(Resources res) {
        super("Newsfeed", BoxLayout.y());
        Toolbar tb = new Toolbar(true);
        current = this;
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Ajouter ARTICLE");
        getContentPane().setScrollVisible(false);
        super.addSideMenu(res);
        tb.addSearchCommand(e -> {
            
        });
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
        Label arrow = new Label(res.getImage("news-tab-down-arrow.png"), "Container");
        
        add(LayeredLayout.encloseIn(
                GridLayout.encloseIn(2, produits, ajouter),
                FlowLayout.encloseBottom(arrow)
        ));
        
        ajouter.setSelected(true);
        arrow.setVisible(false);
        addShowListener(e -> {
            arrow.setVisible(true);
            updateArrowPosition(ajouter, arrow);
        });
        produits.addActionListener(l -> {
            new ListProduitsForm(res).show();
        });
        bindButtonSelection(produits, arrow);
        bindButtonSelection(ajouter, arrow);
        
        // special case for rotation
        addOrientationListener(e -> {
            updateArrowPosition(barGroup.getRadioButton(barGroup.getSelectedIndex()), arrow);
        });
        
        TextField tfnom = new TextField("", "Titre");
        tfnom.setUIID("TextFieldBlack");
        addStringValue("Titre", tfnom);
        Validator val = new Validator();
        val.setShowErrorMessageForFocusedComponent(true);
        val.addConstraint(tfnom,
                new GroupConstraint(
                        new LengthConstraint(5, "Minimum 5 caracteres"),
                        new RegexConstraint("^([a-zA-Z ÉéèÈêÊôÔ']*)$", "Veuillez saisir que des caracteres")));
        
        ComboBox<Categorie> cmb_type1 = new ComboBox();
        ComboBox cmb = new ComboBox();
         ComboBox<String> cmb_type2 = new ComboBox();
           
                            cmb_type1.setUIID("txtn");
                            for (Categorie cat : new ServiceCateg().getAllTasks()) {

                               
                                 cmb_type1.addItem(cat);
                                 cmb.addItem(cat.getTitre_cat());
                                

                            }
        addStringValue("Categorie", cmb);
//         TextField tfTitre = new TextField("","Titre");
//        TextField tfa = new TextField("","Auteur");
//        TextField tfd = new TextField("","Desription");
//        TextField tfc = new TextField("","Cat");

        TextField tfa = new TextField("", "Auteur");
        tfa.setUIID("TextFieldBlack");
        addStringValue("Auteur", tfa);
        
        TextField tfd = new TextField("", "Description");
        tfd.setUIID("TextFieldBlack");
        addStringValue("Description", tfd);
         val.setShowErrorMessageForFocusedComponent(true);
        val.addConstraint(tfd,
                new GroupConstraint(
                        new LengthConstraint(5, "Minimum 5 caracteres"),
                        new RegexConstraint("^([a-zA-Z ÉéèÈêÊôÔ']*)$", "Veuillez saisir que des caracteres")));
      
        
        SpanLabel imagename = new SpanLabel();
        Button upload = new Button("Télécharger une Image");

         upload.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                try {
                      
                    String fileNameInServer = "";
                    MultipartRequest cr = new MultipartRequest();
                    String filepath = Capture.capturePhoto(-1, -1);
                    cr.setUrl("http://127.0.0.1:8000/uploadimage.php");
                    cr.setPost(true);
                    String mime = "image/jpeg";
                    cr.addData("file", filepath, mime);
                    String out = tfnom.getText();
                    cr.setFilename("file", out + ".jpg");//any unique name you want
                    
                    fileNameInServer += tfnom.getText() + ".jpg";
                    System.err.println("path2 =" + fileNameInServer);
                    file=fileNameInServer;
                    InfiniteProgress prog = new InfiniteProgress();
                    Dialog dlg = prog.showInifiniteBlocking();
                    cr.setDisposeOnCompletion(dlg);
                    NetworkManager.getInstance().addToQueueAndWait(cr);
                    imagename.setText(file);
                   // current.refreshTheme();
                } catch (IOException ex) {
                    System.out.println(ex.getMessage());
                }
                                        
            }
        });
        addAll(imagename,upload);
        Button btnAjouter = new Button("Ajouter");
        addStringValue("", btnAjouter);
        btnAjouter.addActionListener((e) -> {
            try {
                if(tfnom.getText().equals("") || tfa.getText().equals("")) {
                    Dialog.show("Veuillez vérifier les données !", "", "Annuler", "OK");
                } else {
                    InfiniteProgress ip = new InfiniteProgress();
                    final Dialog iDialog = ip.showInfiniteBlocking();
                    Article p = new Article(String.valueOf(tfnom.getText()),tfa.getText(),tfd.getText(),cmb_type1.getSelectedItem().getId_cat(), file);
                    System.out.println("Data produit == "+p);
                    //tfTitre.getText(), tfa.getText(),tfd.getText(), tfc.getText(),tfp.getText())
                    ServiceArticles.getInstance().addTask(p);
                    LocalNotification n = new LocalNotification();
        n.setId("demo-notification");
        n.setAlertBody("It's time to take a break and look at me");
        n.setAlertTitle("Activités ajoutée!");
        n.setAlertSound("/notification_sound_bells.mp3"); //file name must begin with notification_sound


        Display.getInstance().scheduleLocalNotification(
                n,
                System.currentTimeMillis() , // fire date/time
                LocalNotification.REPEAT_MINUTE  // Whether to repeat and what frequency
        );
                   
                iDialog.dispose();
                    
                    new ListProduitsForm(res).show();
                    refreshTheme();
                }
            } catch(Exception ex) {
                ex.printStackTrace();
            }
        });
          Button btnAnnuler = new Button("Annuler");
         btnAnnuler.addActionListener(e -> {
             new ListProduitsForm(res).show();
         });
         Container content = BoxLayout.encloseY(
                 btnAnnuler
         );
         add(content);
        
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
        swipe.addTab("", res.getImage("categories-back.jpg"), page1);
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
    
}
