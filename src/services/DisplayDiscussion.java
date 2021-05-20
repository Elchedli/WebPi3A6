/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package services;

import com.codename1.ui.Button;
import com.codename1.ui.Container;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.spinner.Picker;
import entities.Discussion;
import entities.userclient;
import java.util.ArrayList;

/**
 *
 * @author chado
 */
public class DisplayDiscussion extends Form{
        DisplayDiscussion current=this;
        ServiceDiscussion SSerivce;
        public DisplayDiscussion(){
            super("Discussion", BoxLayout.y());
            current=this;
            ArrayList<Discussion> list = ServiceDiscussion.getInstance().getMessages();
            Container cnt = new Container(BoxLayout.y());
            for(int i= 0;i<=list.size()-1;i++){
                Discussion s = list.get(i);
                Label message = new Label(s.getSender()+" : "+s.getMessage());
                cnt.add(message);
            }
            TextField send = new TextField("","message a écrire");
            Button Envoyer = new Button("Envoyer");
            addAll(cnt,send,Envoyer);
            Envoyer.addActionListener((e) -> {
                if(send.getText().compareTo("") != 0){
                     Label message = new Label(userclient.getUser()+" : "+send.getText());
                     cnt.add(message);
                     removeAll();
                     addAll(cnt,send,Envoyer);
                     ServiceDiscussion.getInstance().addMessage(send.getText());
                }  
            });
            
        }
}
