package com.example.anything;


import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class DataValidation {

	// validity of user name contain more than 4 characters
	public boolean usernameValidate(String login) {
		boolean valid = false;
		if (login.length() >= 4) {
			valid = true;
		}
		return valid;
	}

	// validity of full name contain more than 10 characters
	public boolean fullnameValidate(String login) {
		boolean valid = false;
		if (login.length() >= 10) {
			valid = true;
		}
		return valid;
	}

	// validity if email address
	public boolean mailValidate(String mail) {
		String email = mail;
		Pattern pattern = Pattern.compile(".+@.+\\.[a-z]+.");
		Matcher match = pattern.matcher(mail);
		boolean valid = match.matches();
		if (mail == null && email.equals("")) {
			valid = false;
		}
		return valid;
	}

	// validity of phone number
	public boolean phoneValidate(String phone) {
		boolean valid = true;
		int length = phone.length();

		if (length < 10) {
			valid = false;
		} else {
			for (int i = 0; i < length; i++) {
				String sub = (String) phone.subSequence(i, i + 1);

				if (sub.equals("0") || sub.equals("1") || sub.equals("2")
						|| sub.equals("3") || sub.equals("4")
						|| sub.equals("5") || sub.equals("6")
						|| sub.equals("7") || sub.equals("8")
						|| sub.equals("9") || sub.equals("-")) {

					valid = true;
				} else {
					valid = false;
				}

			}

		}
		return valid;
	}

	// validity of a postal address
	public boolean addressValidate(String address) {
		boolean valid = true;
		if (address.length() <= 1) {
			valid = false;
		}
		return valid;
	}

	// check password match
	public boolean passwordMissmatch(String password, String repassword) {
		boolean match = false;
		if (password.equals(repassword)) {
			match = true;
		}
		return match;
	}

	// validity of a password
	public boolean passwordValidate(String password) {
		boolean valid = false;
		if (password.length() >= 4) {
			valid = true;
		}
		return valid;
	}

}
