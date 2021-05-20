/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.spinner.Picker;
import com.codename1.ui.util.Resources;
import com.innovdev.spirity.publication.DisplayAllPublicationForm;
import com.mycompany.myapp.gui.EvenementListForm;
import com.mycompany.myapp.gui.ListeActivite;
import entities.userclient;
import gui.ListProduitsForm;
import gui.ListRec;
import gui.News;

/**
 *
 * @author chado
 */
public class DisplayLogin extends Form{
        Resources theme;
        DisplayLogin current=this;
        ServiceLogin Slogin;
         public Form loginchoice(){
               //new EvenementListForm(theme).show();
       // new Home().show();
     //   new AddActForm(theme).show();
//       new StatisticForm(current).show();
       // new ListEventForm(current).show();
       // new AddTopicForm(current).show();
        //new WalkthruForm(theme).show();
         Form f1 = new Form("Choix", BoxLayout.y());
         Button btnarticle = new Button("Article");
         Button btntaches = new Button("Taches");
         Button btnsuivi = new Button("Suivi");
         Button btnevent = new Button("Evenement");
         Button btnact = new Button("Activitée");
         Button btnchat = new Button("Discussion");
         Button btnpub = new Button("Publication");
         Button btnRec = new Button("Reclamation");
         btnchat.addActionListener((e) -> {
            theme =  UIManager.initFirstTheme("/theme_1");
            new DisplayDiscussion().show();
        });
         btnRec.addActionListener((e) -> {
             theme =  UIManager.initFirstTheme("/theme_3");
            new DisplayDiscussion().show();
        });
         btnevent.addActionListener((e) -> {
             theme =  UIManager.initFirstTheme("/theme_3");
            new EvenementListForm(theme).show();
        });
         btnact.addActionListener((e) -> {
             theme =  UIManager.initFirstTheme("/theme_3");
             new ListeActivite(theme).show();   
        });
         
          btnarticle.addActionListener((e) -> {
              theme =  UIManager.initFirstTheme("/theme_3");
             new ListProduitsForm(theme).show();   
        });
         
         btnsuivi.addActionListener((e) -> {
            theme =  UIManager.initFirstTheme("/theme_1");
            new DisplaySuivi().show();
        });
         btnpub.addActionListener((e) -> {
             theme =  UIManager.initFirstTheme("/theme_1");
            DisplayAllPublicationForm pubForm = new DisplayAllPublicationForm();
            pubForm.show();
        });
        switch(userclient.getType()){
            case "psycho":
                f1.addAll(btnarticle,btntaches,btnsuivi,btnchat,btnpub,btnevent,btnact,btnRec);
              break;
            case "simple":
                f1.addAll(btnarticle,btntaches,btnchat,btnpub,btnevent,btnact,btnRec);
              break;
            case "nutri":
                 f1.addAll(btnpub,btnevent,btnact,btnarticle,btnRec);
              break;
             case "coach":
                  f1.addAll(btnpub,btnevent,btnact,btnarticle,btnRec);
              break;
            default:
              // code block
        }
        return f1;
    }
         public DisplayLogin(){
             super("Connexion", BoxLayout.y());
            current=this;
            ComboBox<String> combo = new ComboBox<> (
               "simple",
               "psycho",
               "nutri",
               "coach"     
            );
            TextField tuser = new TextField("", "Utisateur");
            TextField tpass = new TextField("", "Mot de passe");
            tpass.setConstraint(TextField.PASSWORD);
            Button btnLogin = new Button("Connexion");
            Button btnEnregistrer = new Button("Inscription");
            
            this.addAll(combo,tuser,tpass,btnLogin,btnEnregistrer);
            btnLogin.addActionListener((e) -> {
                String i = combo.getSelectedItem();
                System.out.println("i est : "+i);
                if(Slogin.getInstance().veriflogin(tuser.getText(),tpass.getText(),i)){
                    Form fchoice = loginchoice();
                    fchoice.show();
                }
            });
            btnEnregistrer.addActionListener((e) -> {
                Form finscription = new Form("Inscription", BoxLayout.y());
                Button btnAjouterC = new Button("Ajouter Utilisateur");
                TextField tuserinscrit = new TextField("", "Utisateur");
                TextField tpassinscrit = new TextField("", "Mot de passe");
                Picker date = new Picker();
                date.setType(Display.PICKER_TYPE_DATE);
                TextField tmail = new TextField("", "Email");
                 ComboBox<String> combo1 = new ComboBox<> (
                    "simple",
                    "psycho",
                    "nutri",
                    "coach"     
                   );
                btnAjouterC.addActionListener((i) -> {
                      if(Slogin.getInstance().inscription(tuserinscrit.getText(),tpassinscrit.getText(),date.getText(),tmail.getText(),combo1.getSelectedItem())){
                          Dialog.show("Success","Utilisateur ajouter !",new Command("Ok"));
                          DisplayLogin dl = new DisplayLogin();
                          dl.show();
                     }else{
                           Dialog.show("Failed","Echec de l'ajout",new Command("Ok"));
                      }
                });
                finscription.addAll(combo1,tuserinscrit,tpassinscrit,tmail,date,btnAjouterC);
                finscription.show();
            });
         }
        
}
