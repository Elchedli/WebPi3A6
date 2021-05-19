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
import com.codename1.ui.spinner.Picker;
import com.innovdev.spirity.publication.DisplayAllPublicationForm;
import entities.userclient;

/**
 *
 * @author chado
 */
public class DisplayLogin extends Form{
        DisplayLogin current=this;
        ServiceLogin Slogin;
         public Form loginchoice(){
         Form f1 = new Form("Choix", BoxLayout.y());
         Button btnarticle = new Button("Article");
         Button btntaches = new Button("Taches");
         Button btnsuivi = new Button("Suivi");
         Button btnchat = new Button("Discussion");
         Button btnpub = new Button("Publication");
         btnsuivi.addActionListener((e) -> {
            DisplaySuivi SuiviForm = new DisplaySuivi();
            SuiviForm.show();
        });
         btnpub.addActionListener((e) -> {
            DisplayAllPublicationForm pubForm = new DisplayAllPublicationForm();
            pubForm.show();
        });
        switch(userclient.getType()){
            case "psycho":
                f1.addAll(btnarticle,btntaches,btnsuivi,btnchat,btnpub);
              break;
            case "simple":
                f1.addAll(btnarticle,btntaches,btnchat,btnpub);
              break;
            case "nutri":
                 f1.addAll(btnpub);
              break;
             case "coach":
                  f1.addAll(btnpub);
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
