package zack.bugbountyreborn;

import android.content.Context;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.support.design.widget.TextInputLayout;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;

import android.content.Intent;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    private static final String MAIN_TAG = "MainActivity";
    private static final int NETWORK_REQUEST = 2;
    TextView mainTextView1;
    TextView mainTextView2;
    EditText usernameEditText;
    EditText passwordEditText;
    Button loginButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.content_main);

        mainTextView1 = (TextView) findViewById(R.id.main_title_textview1);
        mainTextView1.setTextColor(ContextCompat.getColor(this, R.color.main_text));

        mainTextView2 = (TextView) findViewById(R.id.main_title_textview2);
        mainTextView2.setTextColor(ContextCompat.getColor(this, R.color.main_text));

        usernameEditText = (EditText) findViewById(R.id.main_username);
        setupUsernameFloatingLabelError();

        passwordEditText = (EditText) findViewById(R.id.main_password);
        setupPasswordFloatingLabelError();

        loginButton = (Button) findViewById((R.id.main_login));
        loginButton.setOnClickListener(loginHandler);

        //asyncCallForLogin("testMarshall1", "testMarshall1");
    }

    View.OnClickListener loginHandler = new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            String username = usernameEditText.getText().toString();
            String password = passwordEditText.getText().toString();

            if (username.length() == 0 || password.length() == 0) {
                Animation shake = AnimationUtils.loadAnimation(MainActivity.this, R.anim.shake);
                findViewById(R.id.main_bug_img).startAnimation(shake);

                Snackbar.make(findViewById(android.R.id.content), "fields can't be empty", Snackbar.LENGTH_LONG)
                        .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                        .setActionTextColor(ContextCompat.getColor(v.getContext(), R.color.colorAccent))
                        .show();
            } else {

                Log.d(MAIN_TAG, "username is " + username);
                Log.d(MAIN_TAG, "password is " + password);
                asyncCallForLogin(username, password);
            }
        }
    };

    /*View.OnClickListener searchHandler = new View.OnClickListener() {
        @Override
        public void onClick(View v) {
            String query = usernameEditText.getText().toString();
            mArrayAdapter.clear();
            accessGoogleBooks(query);
        }
    };*/

    @Override
    public void onRequestPermissionsResult(int requestCode,
                                           String permissions[],
                                           int[] grantResults) {
        switch (requestCode) {
            case NETWORK_REQUEST: {
                if (grantResults.length > 0
                        && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                    Log.d(MAIN_TAG, "permission has been granted");
                } else { // permission is denied

                }
                return;
            }
        }
    }

    public void asyncCallForLogin(String username, String password) {
        if (PackageManager.PERMISSION_GRANTED != ContextCompat.checkSelfPermission(this,
                android.Manifest.permission.ACCESS_NETWORK_STATE)) {
            Log.d(MAIN_TAG, "do not have permission to access network state");
            ActivityCompat.requestPermissions(this,
                    new String[]{android.Manifest.permission.ACCESS_NETWORK_STATE},
                    NETWORK_REQUEST);
        } else {
            Log.d(MAIN_TAG, "Launching the network application");
            ConnectivityManager connectMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
            NetworkInfo ntwkInfo = connectMgr.getActiveNetworkInfo();
            if (ntwkInfo != null && ntwkInfo.isConnected()) {
                new LoginTask().execute("http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/api/loginUser", username, password);
            }
            else {}
        }
    }


    // this function is adapted from an example found here:
    // https://github.com/codepath/android_guides/wiki/Working-with-the-EditText
    private void setupUsernameFloatingLabelError() {
        final TextInputLayout floatingUsernameLabel = (TextInputLayout) findViewById(R.id.username_textlayout);
        floatingUsernameLabel.getEditText().addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence text, int start, int count, int after) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("username can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }
            @Override
            public void beforeTextChanged(CharSequence text, int start, int count, int after) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("username can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }

            @Override
            public void afterTextChanged(Editable text) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("username can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }
        });
    }

    // this function is adapted from an example found here:
    // https://github.com/codepath/android_guides/wiki/Working-with-the-EditText
    private void setupPasswordFloatingLabelError() {
        final TextInputLayout floatingUsernameLabel = (TextInputLayout) findViewById(R.id.password_textlayout);
        floatingUsernameLabel.getEditText().addTextChangedListener(new TextWatcher() {
            @Override
            public void onTextChanged(CharSequence text, int start, int count, int after) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("password can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }
            @Override
            public void beforeTextChanged(CharSequence text, int start, int count, int after) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("password can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }

            @Override
            public void afterTextChanged(Editable text) {
                if (text.length() == 0) {
                    floatingUsernameLabel.setError("password can't be blank");
                    floatingUsernameLabel.setErrorEnabled(true);
                } else {
                    floatingUsernameLabel.setErrorEnabled(false);
                }
            }
        });
    }

    @Override
    public void onClick(View v) {}

    public class LoginTask extends AsyncTask<String, Void, String> {
        private static final String LOGIN_TAG = "LoginTask";

        @Override
        protected String doInBackground(String... params) {
            try {
                return queryServerForLogin(params[0], params[1], params[2]);
            } catch (IOException e) {
                return "unable to retrieve data from the BugBounty server";
            }
        }

        @Override
        protected void onPostExecute(String result) {
            class loginRunnable implements Runnable {
                private String m_data;
                public loginRunnable(String data) { this.m_data = data; }
                public void setData(String data) { this.m_data = data; }
                public void run() {
                    try {
                        Intent i = new Intent(getApplicationContext(), ProfileActivity.class);
                        i.putExtra("username", m_data);
                        Thread.sleep(500);
                        startActivity(i);
                        finish();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }

            try {
                JSONObject loginResult = new JSONObject(result);
                Log.d(LOGIN_TAG, loginResult.getString("error"));
                if (!loginResult.getString("error").equals("0")){
                    Animation shake = AnimationUtils.loadAnimation(MainActivity.this, R.anim.shake);
                    findViewById(R.id.main_bug_img).startAnimation(shake);

                    Snackbar.make(findViewById(android.R.id.content), "combination is incorrect", Snackbar.LENGTH_LONG)
                            .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                            .setActionTextColor(ContextCompat.getColor(MainActivity.this, R.color.colorAccent))
                            .show();
                } else if (!loginResult.getJSONObject("result").getString("userType").equals("marshall")) {
                    Animation shake = AnimationUtils.loadAnimation(MainActivity.this, R.anim.shake);
                    findViewById(R.id.main_bug_img).startAnimation(shake);

                    Snackbar.make(findViewById(android.R.id.content), "hunters can't login yet", Snackbar.LENGTH_LONG)
                            .setAction("Dismiss", new View.OnClickListener() { @Override public void onClick(View v) {} })
                            .setActionTextColor(ContextCompat.getColor(MainActivity.this, R.color.colorAccent))
                            .show();
                } else {
                    new Thread(new loginRunnable(loginResult.getJSONObject("result").getString("username"))).start();
                }

                //JSONArray bookItems = resultJson.getJSONArray("items");

                /*for (int i = 0; i < resultJson.length(); i++) {
                    try {
                        JSONObject book = bookItems.getJSONObject(i);
                        JSONObject bookInfo = book.getJSONObject("volumeInfo");
                        String title = bookInfo.getString("title");
                        JSONArray authors = bookInfo.getJSONArray("authors");
                        String author = authors.getString(0);

                        Log.d(SEARCH_TAG, "title is: " + title);
                        Log.d(SEARCH_TAG, "author is: " + author);
                        mBookList.add(title);
                        mBookList.add(author);
                        mArrayAdapter.notifyDataSetChanged();
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }*/
            } catch (JSONException e) {
                Log.d(LOGIN_TAG, "could not convert string to json");
                e.printStackTrace();
            }

            Log.d(LOGIN_TAG, "I got: " + result);
        }

        private String queryServerForLogin(String passedURL, String username, String password) throws IOException {
            InputStream iStream = null;

            try {
                URL url = new URL(passedURL);
                HttpURLConnection connHandler = (HttpURLConnection) url.openConnection();
                connHandler.setReadTimeout(10000); // milliseconds
                connHandler.setConnectTimeout((15000)); // milliseconds
                connHandler.setRequestMethod("POST");
                connHandler.setDoInput(true);
                connHandler.setDoOutput(true);

                Uri.Builder builder = new Uri.Builder()
                        .appendQueryParameter("username", username)
                        .appendQueryParameter("password", password);
                String query = builder.build().getEncodedQuery();

                OutputStream os = connHandler.getOutputStream();
                BufferedWriter writer = new BufferedWriter(
                        new OutputStreamWriter(os, "UTF-8"));
                writer.write(query);
                writer.flush();
                writer.close();
                os.close();

                connHandler.connect(); // start the query
                int response = connHandler.getResponseCode();
                Log.d(LOGIN_TAG, "successfully got a response");
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