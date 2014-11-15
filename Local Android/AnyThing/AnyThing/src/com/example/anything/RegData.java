package com.example.anything;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

public class RegData {

	private String password;
	private String fullName;
	private String email;
	private String phone;
	private JSONParser jsonParser;
	private String url = "http://192.168.172.1:80/shop_webservice/index.php";

	public RegData() {
		// TODO Auto-generated constructor stub
		jsonParser = new JSONParser();
	}

	private String userName;

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

	public String getFullName() {
		return fullName;
	}

	public void setFullName(String fullName) {
		this.fullName = fullName;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	public String getPhone() {
		return phone;
	}

	public void setPhone(String phone) {
		this.phone = phone;
	}


	public JSONObject regUser(String login, String password, String fullName, String email, String phone) {

		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("userName", "\"" + login + "\""));
		params.add(new BasicNameValuePair("password", "\"" + password + "\""));
		params.add(new BasicNameValuePair("fullname", "\"" + fullName + "\""));
		params.add(new BasicNameValuePair("email", "\"" + email + "\""));
		params.add(new BasicNameValuePair("phoneNo", "\"" + phone + "\""));
		JSONObject json = jsonParser.getJsonFromUrl(url, params);
		return json;
		
		
	}

}
