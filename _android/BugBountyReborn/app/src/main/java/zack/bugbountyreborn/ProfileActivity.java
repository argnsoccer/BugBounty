package zack.bugbountyreborn;

import android.app.Activity;
import android.os.Bundle;
import android.util.SparseArray;
import android.view.Menu;
import android.widget.BaseExpandableListAdapter;
import android.widget.ExpandableListView;
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
import android.widget.TextView;
import android.widget.Toast;

public class ProfileActivity extends AppCompatActivity {
    private static final String PROFILE_TAG = "ProfileActivity";
    private static final int NETWORK_REQUEST = 2;
    String username;
    TextView mainTextView1;
    TextView mainTextView2;
    Toolbar profileToolbar;
    ExpandableListView listView;
    ArrayAdapter mArrayAdapter;
    ReportExpandableListAdapter adapter;
    ArrayList<String> mBountyInfoList = new ArrayList();
    SparseArray<Group> groups = new SparseArray<>();

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile_main);

        mainTextView1 = (TextView) findViewById(R.id.profile_title_textview1);
        mainTextView1.setTextColor(ContextCompat.getColor(this, R.color.main_text));

        mainTextView2 = (TextView) findViewById(R.id.profile_title_textview2);
        mainTextView2.setTextColor(ContextCompat.getColor(this, R.color.main_text));

        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            username = extras.getString("username");
        }

        profileToolbar = (Toolbar) findViewById(R.id.profile_toolbar);
        setSupportActionBar(profileToolbar);
        profileToolbar.setNavigationIcon(R.drawable.tb_marshal);
        profileToolbar.setTitle(getString(R.string.app_name));

        //createData();
        listView = (ExpandableListView) findViewById(R.id.listView);
        adapter = new ReportExpandableListAdapter(this, groups, username);
        listView.setAdapter(adapter);

        listView.setOnGroupClickListener(new ExpandableListView.OnGroupClickListener() {

            @Override
            public boolean onGroupClick(ExpandableListView parent, View v, int groupPosition, long id) {
                Log.d(PROFILE_TAG, "got the click");
                if (!parent.isGroupExpanded(groupPosition))
                    ((ExpandableListView) parent).collapseGroup(groupPosition);
                else
                    ((ExpandableListView) parent).expandGroup(groupPosition, true);
                return false;
            }
        });

        /*listView.setOnChildClickListener(new ExpandableListView.OnChildClickListener() {
            @Override
            public boolean onChildClick(ExpandableListView parent, View v, int groupPosition, int childPosition, long id) {
                Log.d(PROFILE_TAG, "child " + childPosition + " clicked");
                return true;
            }
        });*/

        asyncCallForGetBountiesAndReports(username);
    }

    public void createData() {
        for (int j = 0; j < 5; j++) {
            Group group = new Group("Test " + j, "something");
            for (int i = 0; i < 5; i++) {
                group.children.add("Sub Item" + i);
            }
            groups.append(j, group);
        }
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

    public void asyncCallForGetBountiesAndReports(String username) {
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
                listView.setAdapter((BaseExpandableListAdapter) null);
                listView.setAdapter(adapter);
                GetBountiesTask bounties = new GetBountiesTask();
                mBountyInfoList.add("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/getActiveBounties/" + username);
                mBountyInfoList.add("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/getReportsFromBountyID/");
                bounties.execute(mBountyInfoList);
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
                            //try {
                                Intent i = new Intent(getApplicationContext(), MainActivity.class);
                                //Thread.sleep(500);
                                startActivity(i);
                                finish();
                            //} catch (InterruptedException e) {
                            //    e.printStackTrace();
                            //}
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

    public class GetBountiesTask extends AsyncTask<ArrayList<String>, Void, ArrayList<String>> {
        private static final String BOUNTIES_TAG = "BountiesTask";

        @Override
        protected ArrayList<String> doInBackground(ArrayList<String>... params) {
            try {
                String getBountiesUrl = params[0].get(0);
                String getReportsUrl = params[0].get(1);
                return queryServerForBountiesAndReports(getBountiesUrl, getReportsUrl);
            } catch (IOException e) {
                ArrayList<String> error = new ArrayList<>();
                error.add("something went wrong");
                return error;
            }
        }

        @Override
        protected void onPostExecute(ArrayList<String> result) {
            /* try {
                JSONObject bountiesResult = new JSONObject(result);
                Log.d(BOUNTIES_TAG, bountiesResult.getString("error"));
                if (!bountiesResult.getString("error").equals("0")) {
                    Snackbar.make(findViewById(android.R.id.content), "can't load bounties", Snackbar.LENGTH_LONG)
                            .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                            .setActionTextColor(ContextCompat.getColor(ProfileActivity.this, R.color.colorAccent))
                            .show();
                } else {}

                JSONArray bountyItems = bountiesResult.getJSONArray("result");

                for (int i = 0; i < bountyItems.length(); i++) {
                    try {
                        JSONObject bounty = bountyItems.getJSONObject(i);
                        String bountyName = bounty.getString("bountyName");
                        String dateCreated = bounty.getString("dateCreated");
                        String dateEnding = bounty.getString("dateEnding");
                        Log.d(BOUNTIES_TAG, "bounty name is: " + bountyName);
                        Log.d(BOUNTIES_TAG, "date created is: " + dateCreated);
                        Log.d(BOUNTIES_TAG, "date ending is: " + dateEnding);

                        Group group = new Group(bountyName, "Date Created: " + dateCreated);
                        groups.append(i, group);
                        Log.d(BOUNTIES_TAG, "poolID is: " + bounty.getString("poolID"));
                        mBountyIdList.add(bounty.getString("poolID"));

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            } catch (JSONException e) {
                Log.d(BOUNTIES_TAG, "could not convert string to json");
                e.printStackTrace();
            }

            Log.d(BOUNTIES_TAG, "I got: " + result); */
        }

        private ArrayList<String> queryServerForBountiesAndReports(String passedURL1, String passedURL2) throws IOException {
            ArrayList<String> resultJson = new ArrayList<>();
            ArrayList<String> reportJson = new ArrayList<>();
            ArrayList<String> bountyIds = new ArrayList<>();
            InputStream iStream = null;

            try {
                URL url = new URL(passedURL1);
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
                resultJson.add(responseStrBuilder.toString());
                Log.d(BOUNTIES_TAG, "bounty json is: " + responseStrBuilder.toString());
            } catch (IOException e) {
                e.printStackTrace();
            }

            try {
                JSONObject bountyInfo = new JSONObject(resultJson.get(0));
                JSONArray bountyItems = bountyInfo.getJSONArray("result");

                for (int i = 0; i < bountyItems.length(); i++) {
                    JSONObject bounty = bountyItems.getJSONObject(i);
                    bountyIds.add(bounty.getString("poolID"));
                }

                for (int i = 0; i < bountyIds.size(); ++i) {
                    try {
                        URL url = new URL(passedURL2 + bountyIds.get(i));
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
                        reportJson.add(responseStrBuilder.toString());
                        Log.d(BOUNTIES_TAG, "report json is: " + responseStrBuilder.toString());
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                }

                adapter.setReportInfo(reportJson);

                Log.d(BOUNTIES_TAG, "bounty items length is: " + bountyItems.length());

                for (int i = 0; i < bountyItems.length(); i++) {
                    JSONObject bounty = bountyItems.getJSONObject(i);
                    String bountyName = bounty.getString("bountyName");
                    String dateCreated = bounty.getString("dateCreated");
                    String dateEnding = bounty.getString("dateEnding");
                    Log.d(BOUNTIES_TAG, "bounty name is: " + bountyName);
                    Log.d(BOUNTIES_TAG, "date created is: " + dateCreated);
                    Log.d(BOUNTIES_TAG, "date ending is: " + dateEnding);

                    Group group = new Group(bountyName, "Date Created: " + dateCreated);

                    JSONObject reportInfo = new JSONObject(reportJson.get(i));
                    JSONArray reportItems = reportInfo.getJSONArray("result");
                    for (int k = 0; k < reportItems.length(); k++) {
                        JSONObject report = reportItems.getJSONObject(k);
                        String reportId = report.getString("reportID");
                        group.children.add("ReportID: " + reportId);
                    }
                    groups.append(i, group);
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
            return reportJson;
        }
    }

    public class GetReportsTask extends AsyncTask<ArrayList<String>, Void, ArrayList<String>> {
        private static final String REPORTS_TAG = "ReportsTask";

        @Override
        protected ArrayList<String> doInBackground(ArrayList<String>... params) {
            try {
                Log.d(REPORTS_TAG, "running reports async task");
                return queryServerForReports(params[0]);
            } catch (IOException e) {
                return new ArrayList<>();
            }
        }

        @Override
        protected void onPostExecute(ArrayList<String> result) {
            for (int i = 0; i < result.size(); ++i) {
                Log.d(REPORTS_TAG, "result is: " + result.get(i));
            }
        }

        private ArrayList<String> queryServerForReports(ArrayList<String> ids) throws IOException {
            ArrayList<String> reportJson = new ArrayList<>();
            InputStream iStream = null;
            String serverRoot = ids.get(0);
            ids.remove(0);

            try {
                for (int i = 0; i < ids.size(); ++i) {
                    URL url = new URL(serverRoot + ids.get(i));
                    HttpURLConnection connHandler = (HttpURLConnection) url.openConnection();
                    connHandler.setReadTimeout(10000); // milliseconds
                    connHandler.setConnectTimeout((15000)); // milliseconds
                    connHandler.setRequestMethod("GET");
                    connHandler.setDoInput(true);

                    connHandler.connect(); // start the query
                    int response = connHandler.getResponseCode();
                    Log.d(REPORTS_TAG, "successfully got a response");
                    iStream = connHandler.getInputStream();

                    BufferedReader streamReader = new BufferedReader(new InputStreamReader(iStream, "UTF-8"));
                    StringBuilder responseStrBuilder = new StringBuilder();

                    String inputStr;
                    while ((inputStr = streamReader.readLine()) != null)
                        responseStrBuilder.append(inputStr);
                    reportJson.add(responseStrBuilder.toString());
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            return reportJson;
        }
    }
}