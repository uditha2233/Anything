package com.example.anything;

import java.io.File;

import android.app.ActionBar;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.os.Parcelable;
import android.provider.MediaStore;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.ConsoleMessage;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings.PluginState;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

public class AdavancedRegActivity extends Activity {

	// private Button button;
	private WebView webView;
	final Activity activity = this;
	public Uri imageUri;
	private String userId;
	
	

	private static final int FILECHOOSER_RESULTCODE = 2888;
	private ValueCallback<Uri> mUploadMessage;
	private Uri mCapturedImageURI = null;

	public void onCreate(Bundle savedInstanceState) {

		super.onCreate(savedInstanceState);

		Bundle b = getIntent().getExtras();
		userId = b.getString("key");
		Log.d("usename", userId);

		setContentView(R.layout.activity_adavanced_reg);

		int currentAPIVersion = android.os.Build.VERSION.SDK_INT;

		if (currentAPIVersion >= android.os.Build.VERSION_CODES.HONEYCOMB) {

			// RUN THE CODE SPECIFIC TO THE API LEVELS ABOVE HONEYCOMB (API 11+)
			ActionBar actionBar = getActionBar();
			actionBar.setDisplayHomeAsUpEnabled(true);
		}

		// Get webview
		webView = (WebView) findViewById(R.id.webView1);

		// Define url that will open in webview
		String webViewUrl = "http://192.168.172.1:80/shop_webservice/ProfileUpdate.php?userlog="
				+ userId;

		// Javascript inabled on webview
		webView.getSettings().setJavaScriptEnabled(true);

		// Other webview options
		webView.getSettings().setLoadWithOverviewMode(true);

		// webView.getSettings().setUseWideViewPort(true);

		// Other webview settings
		webView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
		webView.setScrollbarFadingEnabled(false);
		webView.getSettings().setBuiltInZoomControls(true);
		webView.getSettings().setPluginState(PluginState.ON);
		webView.getSettings().setAllowFileAccess(true);
		webView.getSettings().setSupportZoom(true);

		// Load url in webview
		webView.loadUrl(webViewUrl);

		// Define Webview manage classes
		startWebView();

	}

	private void startWebView() {

		// Create new webview Client to show progress dialog
		// Called When opening a url or click on link
		// You can create external class extends with WebViewClient
		// Taking WebViewClient as inner class

		webView.setWebViewClient(new WebViewClient() {
			ProgressDialog progressDialog;

			// If you will not use this method url links are open in new brower
			// not in webview
			public boolean shouldOverrideUrlLoading(WebView view, String url) {

				if (url.contains("backToTheMain")) {
					
					Log.d("URL", url);

					return false;

				} else {

					view.loadUrl(url);
					return true;
				}

			}

			// Show loader on url load
			public void onLoadResource(WebView view, String url) {

				// if url contains string androidexample
				// Then show progress Dialog
				if (progressDialog == null && url.contains("backToTheMain")) {

					// in standard case YourActivity.this
					Intent myIntent = new Intent(AdavancedRegActivity.this,
							MainPageActivity.class);
					Bundle b = new Bundle();
					b.putString("key", userId);
					myIntent.putExtras(b);
					myIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
					startActivity(myIntent);
					finish();

				}
			}

			

		});

		// You can create external class extends with WebChromeClient
		// Taking WebViewClient as inner class
		// we will define openFileChooser for select file from camera or sdcard

		webView.setWebChromeClient(new WebChromeClient() {

			// openFileChooser for Android 3.0+
			public void openFileChooser(ValueCallback<Uri> uploadMsg,
					String acceptType) {

				// Update message
				mUploadMessage = uploadMsg;

				try {

					// Create AndroidExampleFolder at sdcard

					File imageStorageDir = new File(
							Environment
									.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES),
							"AndroidExampleFolder");

					if (!imageStorageDir.exists()) {
						// Create AndroidExampleFolder at sdcard
						imageStorageDir.mkdirs();
					}

					// Create camera captured image file path and name
					File file = new File(imageStorageDir + File.separator
							+ "IMG_"
							+ String.valueOf(System.currentTimeMillis())
							+ ".jpg");

					mCapturedImageURI = Uri.fromFile(file);

					// Camera capture image intent
					final Intent captureIntent = new Intent(
							android.provider.MediaStore.ACTION_IMAGE_CAPTURE);

					captureIntent.putExtra(MediaStore.EXTRA_OUTPUT,
							mCapturedImageURI);

					Intent i = new Intent(Intent.ACTION_GET_CONTENT);
					i.addCategory(Intent.CATEGORY_OPENABLE);
					i.setType("image/*");

					// Create file chooser intent
					Intent chooserIntent = Intent.createChooser(i,
							"Image Chooser");

					// Set camera intent to file chooser
					chooserIntent.putExtra(Intent.EXTRA_INITIAL_INTENTS,
							new Parcelable[] { captureIntent });

					// On select image call onActivityResult method of activity
					startActivityForResult(chooserIntent,
							FILECHOOSER_RESULTCODE);

				} catch (Exception e) {
					Toast.makeText(getBaseContext(), "Exception:" + e,
							Toast.LENGTH_LONG).show();
				}

			}

			// openFileChooser for Android < 3.0
			public void openFileChooser(ValueCallback<Uri> uploadMsg) {
				openFileChooser(uploadMsg, "");
			}

			// openFileChooser for other Android versions
			public void openFileChooser(ValueCallback<Uri> uploadMsg,
					String acceptType, String capture) {

				openFileChooser(uploadMsg, acceptType);
			}

			// The webPage has 2 filechoosers and will send a
			// console message informing what action to perform,
			// taking a photo or updating the file

			public boolean onConsoleMessage(ConsoleMessage cm) {

				onConsoleMessage(cm.message(), cm.lineNumber(), cm.sourceId());
				return true;
			}

			public void onConsoleMessage(String message, int lineNumber,
					String sourceID) {
			

			}
		});

	}

	// Return here when file selected from camera or from SDcard

	@Override
	protected void onActivityResult(int requestCode, int resultCode,
			Intent intent) {

		if (requestCode == FILECHOOSER_RESULTCODE) {

			if (null == this.mUploadMessage) {
				return;

			}

			Uri result = null;

			try {
				if (resultCode != RESULT_OK) {

					result = null;

				} else {

					// retrieve from the private variable if the intent is null
					result = intent == null ? mCapturedImageURI : intent
							.getData();
				}
			} catch (Exception e) {
				Toast.makeText(getApplicationContext(), "activity :" + e,
						Toast.LENGTH_LONG).show();
			}

			mUploadMessage.onReceiveValue(result);
			mUploadMessage = null;

		}

	}

	// Open previous opened link from history on webview when back button
	// pressed

	@Override
	// Detect when the back button is pressed
	public void onBackPressed() {

		if (webView.canGoBack()) {

			webView.goBack();

		} else {
			// Let the system handle the back button
			super.onBackPressed();
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {

		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.adavanced_reg, menu);

		setTitle("Profile Update");

		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		
		return super.onOptionsItemSelected(item);
	}


}