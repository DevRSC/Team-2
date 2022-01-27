package ngaleng.hillsea.mealsformakers;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.preference.PreferenceManager;
import android.text.InputType;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.webkit.CookieManager;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Reader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.ProtocolException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.Map;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.silencedut.taskscheduler.Task;
import com.silencedut.taskscheduler.TaskScheduler;

import org.json.JSONArray;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity {
    WebView webView;
    SwipeRefreshLayout swiperefresh;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().hide();
        webView = findViewById(R.id.webView);
        swiperefresh = findViewById(R.id.swiperefresh);
        swiperefresh.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                webView.reload();
            }
        });
        if (savedInstanceState != null) {
            webView.restoreState(savedInstanceState);
            checkStartup();
        } else {
            webView.getSettings().setJavaScriptEnabled(true);
            webView.getSettings().setUseWideViewPort(true);
            webView.getSettings().setLoadWithOverviewMode(true);
            webView.getSettings().setSupportZoom(true);
            webView.getSettings().setSupportMultipleWindows(false);
            webView.setScrollBarStyle(WebView.SCROLLBARS_INSIDE_OVERLAY);
            webView.setBackgroundColor(Color.parseColor("#ddceb9"));
            webView.setWebChromeClient(new WebChromeClient() {
                @Override
                public void onProgressChanged(WebView view, int newProgress) {
                    super.onProgressChanged(view, newProgress);

                }
                @Override
                public boolean onJsAlert(WebView view, String url, String message, final JsResult result) {
                    AlertDialog dialog = new AlertDialog.Builder(view.getContext()).
                            setTitle("Meals for Makers | Notification").
                            setMessage(message).
                            setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    //do nothing
                                    result.confirm();
                                    dialog.dismiss();
                                }
                            }).create();
                    dialog.show();
                    //result.confirm();
                    return true;
                }

        });

        }
        webView.setWebViewClient(new WebViewClient() {
            @Override
            public boolean shouldOverrideUrlLoading(WebView view, String url) {
                view.loadUrl(url);
                CookieManager.getInstance().setAcceptCookie(true);
                return true;
            }

            @Override
            public void onPageFinished(WebView view, String url) {
                swiperefresh.setRefreshing(false);
                if (url.toLowerCase().contains("https://mealsformakers.xyz/Login".toLowerCase())) {
                    stopServ();
                    showLoginDialog();
                } else {
                    try {
                        mad.dismiss();
                    } catch (Exception e) { }
                }
                super.onPageFinished(view, url);
            }
        });

        checkStartup();



    }
    public void checkStartup() {
        try {
            if (getIntent().getExtras().getBoolean("fromServ", false)) {
                int mode = getIntent().getExtras().getInt("mainid", 0);
                String val = getIntent().getExtras().getString("mainstat", "nuull");
                switch (mode) {
                    case 0:
                        webView.loadUrl("https://mealsformakers.xyz/Landing");
                        break;
                    case 2:
                    case 3:
                        try {
                            webView.loadUrl("https://mealsformakers.xyz/Recipeview?r=" + URLEncoder.encode(val, "utf-8"));
                        } catch (UnsupportedEncodingException e) {
                            webView.loadUrl("https://mealsformakers.xyz/Landing");
                        }
                        break;
                    case 4:
                        webView.loadUrl("https://mealsformakers.xyz/Messaging");
                        break;
                }

            } else {
                webView.loadUrl("https://mealsformakers.xyz/Landing");
            }
        } catch (Exception e) {
            webView.loadUrl("https://mealsformakers.xyz/Landing");
        }
    }
    @Override
    public void onBackPressed() {
        webView.goBack();
    }
    private boolean isNetworkConnected() {
        ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        return cm.getActiveNetworkInfo() != null && cm.getActiveNetworkInfo().isConnected();
    }
    EditText usname;
    EditText pword;
    AlertDialog.Builder ad;
    AlertDialog mad;
    public void showLoginDialog() {
       ad = new AlertDialog.Builder(MainActivity.this);
        ad.setTitle("Welcome to Meals for Makers!");
        ad.setMessage("Login / Sign up");
        ad.setCancelable(false);
        LinearLayout ll = new LinearLayout(MainActivity.this);
        ll.setOrientation(LinearLayout.VERTICAL);
         usname = new EditText(MainActivity.this);
         pword = new EditText(MainActivity.this);
        usname.setInputType(InputType.TYPE_CLASS_TEXT);
        usname.setHint("Username / Email...");
        pword.setHint("Password...");
        usname.setSingleLine(true);
        usname.setMaxLines(1);
        usname.setLines(1);
        pword.setSingleLine(true);
        pword.setMaxLines(1);
        pword.setLines(1);
        usname.setLayoutParams(new LinearLayout.LayoutParams
                (LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT, 1.0f));
        pword.setLayoutParams(new LinearLayout.LayoutParams
                (LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT, 1.0f));
        ll.addView(usname);
        ll.addView(pword);
        pword.setTransformationMethod(PasswordTransformationMethod.getInstance());
        ad.setView(ll);
        ad.setPositiveButton(
                "Login",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        initBackServ( usname.getText().toString() + ",,," +  pword.getText().toString());
                        webView.evaluateJavascript("document.getElementById('musername').value = '" + usname.getText().toString() + "';document.getElementById('mpass').value = '" + pword.getText().toString() + "';document.getElementById('mform').submit();", null);
                        //webView.loadUrl("https://mealsformakers.xyz/Supersecretloginapi?us=" + usname.getText().toString() + "&ps=" + pword.getText().toString());
                        dialog.cancel();
                    }
                });
        ad.setNeutralButton(
                "More...",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        AlertDialog.Builder add = new AlertDialog.Builder(MainActivity.this);
                        add.setTitle("More options...");
                        add.setMessage("Select one option...");
                        add.setCancelable(false);
                        add.setPositiveButton("Forgot password?", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        webView.evaluateJavascript("document.body.innerHTML = '';", null);
                                        webView.loadUrl("https://mealsformakers.xyz/forgotpass");
                                        dialogInterface.dismiss();
                                        dialog.cancel();
                                    }
                                });
                        add.setNegativeButton("Landing page", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                webView.evaluateJavascript("document.body.innerHTML = '';", null);
                                webView.loadUrl("https://mealsformakers.xyz/Landing");
                                dialogInterface.dismiss();
                                dialog.cancel();
                            }
                        });
                        add.setNeutralButton("Go Back", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                webView.evaluateJavascript("document.body.innerHTML = '';", null);
                                webView.loadUrl("https://mealsformakers.xyz/Login");
                                dialogInterface.dismiss();
                                dialog.cancel();
                            }
                        });

                        add.show();
                    }
                });
        ad.setNegativeButton(
                "Sign Up",
                new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        webView.evaluateJavascript("document.body.innerHTML = '';", null);
                        webView.loadUrl("https://mealsformakers.xyz/register");
                        dialog.cancel();
                    }
                });

        mad = ad.show();
    }
    public void setMainDataforservice(String a) {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
        preferences.edit()
                .putString("||serviceMainID|inv", a)
                .apply();
    }

    public void stopServ() {
        try {
            Intent i = new Intent(getApplicationContext(),UpdateService.class);
            stopService(i);
        } catch (Exception e) {}
    }
    public void initBackServ(String b) {

        setMainDataforservice(b);
        new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent i = new Intent(getApplicationContext(),UpdateService.class);
                startService(i);
            }
        }, 3000);

    }

}