/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextArea;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.spinner.Picker;
import entities.Suivi;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author chado
 */
public class DisplaySuivi extends Form{
        DisplaySuivi current;
        ServiceSuivi SSerivce;
        public DisplaySuivi(){
             super("Suivi", BoxLayout.y());
            current=this;
            ArrayList<Suivi> list = ServiceSuivi.getInstance().getSuivi();
            System.out.println("liste est : "+list);
            Button Ajouter = new Button("Ajouter");
            Ajouter.addActionListener(e->{
                Form fajouter = new Form("Ajouter Suivi",BoxLayout.y());
                TextField client = new TextField("", "client");
                TextField titre = new TextField("", "Titre");
                Picker datedeb = new Picker();
                datedeb.setType(Display.PICKER_TYPE_DATE);
                Picker datefin = new Picker();
                datefin.setType(Display.PICKER_TYPE_DATE);
                Picker tempsdeb = new Picker();
                tempsdeb.setType(Display.PICKER_TYPE_TIME);
                Picker tempsfin = new Picker();
                tempsfin.setType(Display.PICKER_TYPE_TIME);
                Button add = new Button("Ajouter suivi");
                add.addActionListener(h->{
                        Suivi suiv = new Suivi(client.getText(),titre.getText(),datedeb.getText(),datefin.getText(),tempsdeb.getText(),tempsfin.getText());
                        boolean verif = SSerivce.getInstance().AjouterSuivi(suiv);
                        if(verif){
                            Dialog.show("Success","Suivi ajouter !",new Command("Ok"));
                             DisplaySuivi ds = new DisplaySuivi();
                            ds.show();
                        }else{
                            Dialog.show("Failed","Echec de l'ajout",new Command("Ok"));
                        }
                });
                fajouter.addAll(client,titre,datedeb,datefin,tempsdeb,tempsfin,add);
                fajouter.show();
            });
            add(Ajouter);
            for(int i= 0;i<=list.size()-1;i++){
                Suivi s = list.get(i);
                Container cnt = new Container(BoxLayout.y());
                Label lclient = new Label("client : "+s.getClient());
                Label ltitre = new Label("titre : "+s.getTitre_s());
                Label ldate_ds = new Label("date debut : "+getDay(s.getDate_ds()));
                Label ldate_fs = new Label("date fin : "+getDay(s.getDate_fs()));
                Label ltemps_ds  = new Label("temps debut : "+getTime(s.getTemps_ds()));
                Label ltemps_fs  = new Label("temps fin : "+getTime(s.getTemps_fs()));
                cnt.addAll(lclient,ltitre,ldate_ds,ldate_fs,ltemps_ds,ltemps_fs);
                Container cnt2 = new Container(new GridLayout(2,1));
                Button supprimer = new Button("Supprimer");
                supprimer.addActionListener(e->{
                  boolean verif = SSerivce.getInstance().supprimerSuivi(s.getId_s());
                  if(verif){
                       Dialog.show("Success","Suivi supprimée !",new Command("Ok"));
                  }else{
                      Dialog.show("Failed","Echec de Supprission",new Command("Ok"));
                  }
                  removeAll();
                  DisplaySuivi ds = new DisplaySuivi();
                  ds.show();
                });
                cnt2.add(supprimer);
                addAll(cnt,cnt2);
            }
        }
        public String getDay(String Date)
        {
            return Date.substring(6,16);
        }
    public String getTime(String Date)
    {
        return Date.substring(17,25);
    }
}
