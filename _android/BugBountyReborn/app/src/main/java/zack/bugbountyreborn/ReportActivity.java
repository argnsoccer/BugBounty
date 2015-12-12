package zack.bugbountyreborn;

import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.NavUtils;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class ReportActivity extends AppCompatActivity {
    private static final String REPORT_TAG = "ReportActivity";
    private static final int NETWORK_REQUEST = 2;
    String username;
    String reportClicked;
    Toolbar reportToolbar;
    ArrayList<String> reportInfo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.report_main);
        reportToolbar = (Toolbar) findViewById(R.id.profile_toolbar);
        setSupportActionBar(reportToolbar);
        reportToolbar.setNavigationIcon(R.drawable.tb_marshal);
        reportToolbar.setTitle(getString(R.string.app_name));

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            username = extras.getString("username");
            reportClicked = extras.getString("reportClicked");
            reportInfo = extras.getStringArrayList("reportInfo");
        }

        Log.d(REPORT_TAG, "" + reportClicked);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setHomeButtonEnabled(true);
        getSupportActionBar().show();
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_logout:
                asyncCallForLogout();
                return true;
            case android.R.id.home:
                try {
                    Intent i = new Intent(getApplicationContext(), ProfileActivity.class);
                    i.putExtra("username", username);
                    Thread.sleep(500);
                    startActivity(i);
                    finish();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            default:
                return super.onOptionsItemSelected(item); //invoke super class
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           String permissions[],
                                           int[] grantResults) {
        switch (requestCode) {
            case NETWORK_REQUEST: {
                if (grantResults.length > 0
                        && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                    Log.d(REPORT_TAG, "permission has been granted");
                } else { // permission is denied

                }
                return;
            }
        }
    }

    public void asyncCallForLogout() {
        if (PackageManager.PERMISSION_GRANTED != ContextCompat.checkSelfPermission(this,
                android.Manifest.permission.ACCESS_NETWORK_STATE)) {
            Log.d(REPORT_TAG, "do not have permission to access network state");
            ActivityCompat.requestPermissions(this,
                    new String[]{android.Manifest.permission.ACCESS_NETWORK_STATE},
                    NETWORK_REQUEST);
        } else {
            Log.d(REPORT_TAG, "Launching the network application");
            ConnectivityManager connectMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo ntwkInfo = connectMgr.getActiveNetworkInfo();
            if (ntwkInfo != null && ntwkInfo.isConnected()) {
                new LogoutTask().execute("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/deleteSession");
            }
            else {}
        }
    }

    public class LogoutTask extends AsyncTask<String, Void, String> {
        private static final String LOGOUT_TAG = "LogoutTask";

        @Override
        protected String doInBackground(String... params) {
            try {
                return queryServerForLogout(params[0]);
            } catch (IOException e) {
                return "unable to retrieve data from the BugBounty server";
            }
        }

        @Override
        protected void onPostExecute(String result) {
            try {
                JSONObject logoutResult = new JSONObject(result);
                Log.d(LOGOUT_TAG, logoutResult.getString("error"));
                if (!logoutResult.getString("error").equals("0")) {
                    Snackbar.make(findViewById(android.R.id.content), "something went wrong", Snackbar.LENGTH_LONG)
                            .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                            .setActionTextColor(ContextCompat.getColor(ReportActivity.this, R.color.colorAccent))
                            .show();
                } else {
                    new Thread() {
                        public void run() {
                            try {
                                Intent i = new Intent(getApplicationContext(), MainActivity.class);
                                Thread.sleep(500);
                                startActivity(i);
                                finish();
                            } catch (InterruptedException e) {
                                e.printStackTrace();
                            }
                        }
                    }.start();
                }
            } catch (JSONException e) {
                Log.d(LOGOUT_TAG, "could not convert string to json");
                e.printStackTrace();
            }

            Log.d(LOGOUT_TAG, "I got: " + result);
        }

        private String queryServerForLogout(String passedURL) throws IOException {
            InputStream iStream = null;

            try {
                URL url = new URL(passedURL);
                HttpURLConnection connHandler = (HttpURLConnection) url.openConnection();
                connHandler.setReadTimeout(10000); // milliseconds
                connHandler.setConnectTimeout((15000)); // milliseconds
                connHandler.setRequestMethod("GET");
                connHandler.setDoInput(true);

                connHandler.connect(); // start the query
                int response = connHandler.getResponseCode();
                Log.d(LOGOUT_TAG, "successfully got a response");
                iStream = connHandler.getInputStream();

                BufferedReader streamReader = new BufferedReader(new InputStreamReader(iStream, "UTF-8"));
                StringBuilder responseStrBuilder = new StringBuilder();

                String inputStr;
                while ((inputStr = streamReader.readLine()) != null)
                    responseStrBuilder.append(inputStr);
                return responseStrBuilder.toString();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return "";
        }
    }
}
