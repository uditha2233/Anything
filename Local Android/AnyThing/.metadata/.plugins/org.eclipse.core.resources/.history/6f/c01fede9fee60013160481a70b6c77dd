package com.example.anything;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v7.app.ActionBarActivity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;

public class LoadingScreenActivity extends ActionBarActivity {

	ProgressBar bar;
	int progress = 0;
	Handler handle = new Handler();
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_loading_screen);

		bar = (ProgressBar) findViewById(R.id.progressBar1);
//		bar.getLayoutParams().width = 200;
		new Thread(new Runnable() {

			@Override
			public void run() {
				for (int i = 0; i < 100; i++) {
					progress += 1;
					handle.post(new Runnable() {

						@Override
						public void run() {

							bar.setProgress(progress);
							if (progress == bar.getMax()) {
								// bar.setVisibility(4);
								Intent in = new Intent(getApplicationContext(),
										LoginActivity.class);
								// startActivity(in);
								in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
								startActivity(in);
								finish();
							}

						}
					});

					try {
						Thread.sleep(50);
					} catch (InterruptedException e) {

					}
				}

			}
		}).start();
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {

		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.loading_screen, menu);
		setTitle("Loading...");
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		if (id == R.id.action_settings) {
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

	/**
	 * A placeholder fragment containing a simple view.
	 */
	public static class PlaceholderFragment extends Fragment {

		public PlaceholderFragment() {
		}

		@Override
		public View onCreateView(LayoutInflater inflater, ViewGroup container,
				Bundle savedInstanceState) {
			View rootView = inflater.inflate(R.layout.fragment_loading_screen,
					container, false);
			return rootView;
		}
	}

}
