package com.example.anything;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

public class UserData {
	
	private String userName;
	private String password;

	private JSONParser jsonParser;
	private String url = "http://192.168.172.1:80/shop_webservice/index.php";
	
	public UserData() {
		// TODO Auto-generated constructor stub
		jsonParser = new JSONParser();
	}
	
	public String getUserName() {
		return userName;
	}
	public void setUserName(String userName) {
		this.userName = userName;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	
	public JSONObject loginUser(String login, String password){
		
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("login",login));
		params.add(new BasicNameValuePair("password", password));
		JSONObject json = jsonParser.getJsonFromUrl(url, params);
		return json;
	}

}
