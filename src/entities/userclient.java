/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

/**
 *
 * @author chado
 */
public class userclient {
   static private int id = 0;
   static private String user = "";
   static private String type = "";

    static public int getId() {
        return id;
    }

    static public void setId(int id) {
        userclient.id = id;
    }

    static public String getUser() {
        return user;
    }

    static public void setUser(String user) {
        userclient.user = user;
    }

    static public String getType() {
        return type;
    }

    static public void setType(String type) {
        userclient.type = type;
    }
   
}
