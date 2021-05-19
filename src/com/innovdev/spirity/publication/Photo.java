/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.innovdev.spirity.publication;
/**
 *
 * @author HP I5
 */
public class Photo{
    private int id;
    private int id_pub;
    private String url;

    public Photo() {
    }

    public int getId_pub() {
        return id_pub;
    }

    public void setId_pub(int id_pub) {
        this.id_pub = id_pub;
    }
    
    public Photo(int id, int id_pub, String url) {
        this.id = id;
        this.id_pub = id_pub;
        this.url = url;
    }

    public Photo(int id) {
        this.id = id;
    }

    public Photo(int id_pub, String url) {
        this.id_pub = id_pub;
        this.url = url;
    }
    public String getUrl() {
        return url;
    }

    public void setUrl(String url) {
        this.url = url;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
/*
    @Override
    public ArrayList select_all(Object t) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }

    @Override
    public void update(Object t) {
        ConnectionDB cnx = (ConnectionDB) t;
        try{
        Connection cn = cnx.getInstance().getConn();
        PreparedStatement posted = cn.prepareStatement("UPDATE `photo` SET `lien` ="+"'"+url+"'"+" WHERE `id_ph` ="+id+"AND `id_pub`="+id_pub+";");
        ResultSet result = posted.executeQuery();
        posted.executeUpdate();
        System.out.println("Update Photo complete !");
           }
           
        catch(SQLException e)
        {
            System.out.println(e);
        }
    }

    @Override
    public void insert(Object t) {
        ConnectionDB cnx = (ConnectionDB) t;
         try{
        Connection cn = cnx.getInstance().getConn();
        PreparedStatement posted = cn.prepareStatement("INSERT INTO `photo_publications` (`id_pub`, `lien`) VALUES ("+id_pub+","+"'"+url+"'"+");");
        posted.executeUpdate();
        System.out.println("Insertion d'image complete !");
        }
        catch(SQLException e)
        {
            System.out.println(e);
        }
    }

    @Override
    public void delete(Object t) {
        ConnectionDB cnx = (ConnectionDB) t;
        try{
        Connection cn = cnx.getInstance().getConn();
        PreparedStatement posted = cn.prepareStatement("DELETE FROM `photo_publications` WHERE `id_ph` ="+id+";");
        posted.executeUpdate();
        System.out.println("suppression d'image complete !");
        }
        catch(SQLException e)
        {
            System.out.println(e);
        }
    }*/

    @Override
    public String toString() {
        return "Photo{" + "id=" + id + ", id_pub=" + id_pub + ", url=" + url + '}';
    }
    
}
