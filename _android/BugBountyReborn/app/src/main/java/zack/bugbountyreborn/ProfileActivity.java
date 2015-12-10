package zack.bugbountyreborn;

import android.content.Context;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import android.content.Intent;

public class ProfileActivity extends AppCompatActivity {
    private static final String PROFILE_TAG = "ProfileActivity";
    private static final int NETWORK_REQUEST = 2;
    Toolbar profileToolbar;
    ListView mainListView;
    ArrayAdapter mArrayAdapter;
    ArrayList mBountyList = new ArrayList();

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile_main);

        String username = "";
        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            username = extras.getString("username");
        }

        profileToolbar = (Toolbar) findViewById(R.id.profile_toolbar);
        setSupportActionBar(profileToolbar);
        profileToolbar.setNavigationIcon(R.drawable.tb_marshal);
        profileToolbar.setTitle(getString(R.string.app_name));

        mainListView = (ListView) findViewById(R.id.profile_listview);
        mArrayAdapter = new ArrayAdapter(this,
                android.R.layout.simple_list_item_1,
                mBountyList);
        mainListView.setAdapter(mArrayAdapter);
        asyncCallForGetBounties(username);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_logout:
                asyncCallForLogout();
                return true;
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
                    Log.d(PROFILE_TAG, "permission has been granted");
                } else { // permission is denied

                }
                return;
            }
        }
    }

    public void asyncCallForLogout() {
        if (PackageManager.PERMISSION_GRANTED != ContextCompat.checkSelfPermission(this,
                android.Manifest.permission.ACCESS_NETWORK_STATE)) {
            Log.d(PROFILE_TAG, "do not have permission to access network state");
            ActivityCompat.requestPermissions(this,
                    new String[]{android.Manifest.permission.ACCESS_NETWORK_STATE},
                    NETWORK_REQUEST);
        } else {
            Log.d(PROFILE_TAG, "Launching the network application");
            ConnectivityManager connectMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo ntwkInfo = connectMgr.getActiveNetworkInfo();
            if (ntwkInfo != null && ntwkInfo.isConnected()) {
                new LogoutTask().execute("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/deleteSession");
            }
            else {}
        }
    }

    public void asyncCallForGetBounties(String username) {
        if (PackageManager.PERMISSION_GRANTED != ContextCompat.checkSelfPermission(this,
                android.Manifest.permission.ACCESS_NETWORK_STATE)) {
            Log.d(PROFILE_TAG, "do not have permission to access network state");
            ActivityCompat.requestPermissions(this,
                    new String[]{android.Manifest.permission.ACCESS_NETWORK_STATE},
                    NETWORK_REQUEST);
        } else {
            Log.d(PROFILE_TAG, "Launching the network application");
            ConnectivityManager connectMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo ntwkInfo = connectMgr.getActiveNetworkInfo();
            if (ntwkInfo != null && ntwkInfo.isConnected()) {
                new GetBountiesTask().execute("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/getActiveBounties/" + username);
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
                            .setActionTextColor(ContextCompat.getColor(ProfileActivity.this, R.color.colorAccent))
                            .show();
                } else {
                    new Thread() {
                        public void run() {
                            try {
                                Intent i = new Intent(getApplicationContext(), MainActivity.class);
                                Thread.sleep(2000);
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

    public class GetBountiesTask extends AsyncTask<String, Void, String> {
        private static final String BOUNTIES_TAG = "BountiesTask";

        @Override
        protected String doInBackground(String... params) {
            try {
                return queryServerForBounties(params[0]);
            } catch (IOException e) {
                return "unable to retrieve data from the BugBounty server";
            }
        }

        @Override
        protected void onPostExecute(String result) {
            try {
                JSONObject bountiesResult = new JSONObject(result);
                Log.d(BOUNTIES_TAG, bountiesResult.getString("error"));
                if (!bountiesResult.getString("error").equals("0")) {
                    Snackbar.make(findViewById(android.R.id.content), "can't load bounties", Snackbar.LENGTH_LONG)
                            .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                            .setActionTextColor(ContextCompat.getColor(ProfileActivity.this, R.color.colorAccent))
                            .show();
                } else {
                    /*new Thread() {
                        public void run() {
                            try {
                                Intent i = new Intent(ProfileActivity.this, MainActivity.class);
                                Thread.sleep(2000);
                                startActivity(i);
                                finish();
                            } catch (InterruptedException e) {
                                e.printStackTrace();
                            }
                        }
                    }.start();*/
                }

                JSONArray bountyItems = bountiesResult.getJSONArray("activeBounties");

                for (int i = 0; i < bountyItems.length(); i++) {
                    try {
                        JSONObject bounty = bountyItems.getJSONObject(i);
                        String bountyName = bounty.getString("bountyName");
                        //String title = bookInfo.getString("title");
                        //JSONArray authors = bookInfo.getJSONArray("authors");
                        //String author = authors.getString(0);

                        Log.d(BOUNTIES_TAG, "bounty name is: " + bountyName);
                        mBountyList.add(bountyName);
                        mArrayAdapter.notifyDataSetChanged();
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            } catch (JSONException e) {
                Log.d(BOUNTIES_TAG, "could not convert string to json");
                e.printStackTrace();
            }

            Log.d(BOUNTIES_TAG, "I got: " + result);
        }

        private String queryServerForBounties(String passedURL) throws IOException {
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
                Log.d(BOUNTIES_TAG, "successfully got a response");
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