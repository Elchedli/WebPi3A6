package utils;

import com.codename1.io.BufferedInputStream;
import com.codename1.io.CharArrayReader;
import com.codename1.io.JSONParser;
import com.codename1.io.URL;
import com.codename1.io.URL.HttpURLConnection;
import com.innovdev.spirity.publication.Publication;
import entities.Suivi;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.ArrayList;
import java.util.Map;
import org.apache.commons.io.IOUtils;
import org.json.JSONObject;

public class json {
    
	public static void Post_JSON() {
           String query_url = "http://127.0.0.1:8000/suivi/indexjson";
           String json = "{ \"username\" : \"mgkpsy\"}";
           try {
           URL url = new URL(query_url);
           HttpURLConnection conn = (HttpURLConnection) url.openConnection();
           conn.setConnectTimeout(5000);
           conn.setRequestProperty("Content-Type", "application/json; charset=UTF-8");
           conn.setDoOutput(true);
           conn.setDoInput(true);
           conn.setRequestMethod("GET");
           OutputStream os = conn.getOutputStream();
           os.write(json.getBytes("UTF-8"));
           os.close(); 
           // read the response
           InputStream in = new BufferedInputStream(conn.getInputStream());
           String result = IOUtils.toString(in, "UTF-8");
           System.out.println("resultat apres : "+result);
           System.out.println("result after Reading JSON Response");
//           JSONObject myResponse = new JSONObject(result);
//           System.out.println(myResponse);
//           System.out.println("jsonrpc- "+myResponse.getString("jsonrpc"));
//           System.out.println("id- "+myResponse.getInt("id"));
//           System.out.println("result- "+myResponse.getString("result"));
           in.close();
           } catch (Exception e) {
   			System.out.println(e);
   		}
	
	}
}	
