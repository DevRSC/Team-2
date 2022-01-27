package ngaleng.hillsea.mealsformakers;

import android.app.ActivityManager;
import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.BitmapFactory;
import android.os.Handler;
import android.os.IBinder;
import android.os.Looper;
import android.preference.PreferenceManager;
import android.util.Log;

import androidx.core.app.NotificationCompat;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Objects;
import java.util.Random;

public class UpdateService extends Service {
    public String maindata = "nuull";
    public Context context = this;
    public Handler handler = null;
    public static Runnable runnable = null;
    public int  mainid = 1;

    public UpdateService() {
    }

    private boolean applicationInForeground() {
        ActivityManager activityManager = (ActivityManager) getSystemService(Context.ACTIVITY_SERVICE);
        List<ActivityManager.RunningAppProcessInfo> services = activityManager.getRunningAppProcesses();
        boolean isActivityFound = false;

        if (services.get(0).processName
                .equalsIgnoreCase(getPackageName()) && services.get(0).importance == ActivityManager.RunningAppProcessInfo.IMPORTANCE_FOREGROUND) {
            isActivityFound = true;
        }

        return isActivityFound;
    }
    public void showNotif(String title, String text, int offset, String mstat) {
        final int min = 1;
        final int max = 20;
        mainid = new Random().nextInt((max - min) + 1) + min;
        Intent ii;
        if (applicationInForeground()) {
            try {
                ii = new Intent(this, MainActivity.class);
            } catch ( Exception e) {
                ii = new Intent(this, MainActivity.class);
            }
        } else {
            ii = new Intent(this, MainActivity.class);
        }
        ii.putExtra("fromServ",true);
        ii.putExtra("mainid",offset);
        ii.putExtra("mainstat",mstat);


        PendingIntent snn =
                PendingIntent.getActivity(getApplicationContext(), 0, ii,  PendingIntent.FLAG_UPDATE_CURRENT);

        NotificationCompat.BigTextStyle inboxStyle = new NotificationCompat.BigTextStyle();
        NotificationCompat.Builder notificationBuilder = new NotificationCompat.Builder(this)
                .setSmallIcon(R.drawable.mealsformakerslogo)
                .setLargeIcon(BitmapFactory.decodeResource(getResources(), R.drawable.mealsformakerslogo))
                .setContentTitle(title)
                .setContentIntent(snn)
                .setAutoCancel(true)
                .setContentText(text);

        Notification notification;

        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.O) {
            String CHANNEL_ID = "chan_id_" + (mainid + 12 + offset) + "";
            int importance = NotificationManager.IMPORTANCE_HIGH;

            NotificationChannel mChannel = new NotificationChannel(CHANNEL_ID, "WakeUp", importance);
            notificationBuilder.setChannelId(CHANNEL_ID);
            notificationBuilder.setContentIntent(snn);
            //notificationBuilder.setBadgeIconType(BADGE_ICON_SMALL);
            notification = notificationBuilder.build();
            notification.flags = Notification.FLAG_AUTO_CANCEL;
            NotificationManager mNotificationManager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
            mNotificationManager.createNotificationChannel(mChannel);
            mNotificationManager.notify((mainid + 12 + offset), notification);
        } else {
            notification = notificationBuilder.build();
            notification.flags = Notification.FLAG_AUTO_CANCEL;
            NotificationManager mNotificationManager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);

            if (mNotificationManager != null) {
                mNotificationManager.notify((mainid + 12 + offset), notification);
            }
        }
    }
    public String getMainID() {
        SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
        return preferences.getString("||serviceMainID|inv", "nuull");
    }
    @Override
    public int onStartCommand(Intent intent, int flags, int startId){
        maindata = getMainID();
        return START_REDELIVER_INTENT;
    }
    @Override
    public IBinder onBind(Intent intent) {
        // TODO: Return the communication channel to the service.
        throw new UnsupportedOperationException("Not yet implemented");
    }

    RequestQueue requestQueue;
    public String muser = "nuull";
    public String mpass = "nuull";
    public String previousID = "nuull";
    public String previousID1 = "nuull";
    public String previousID2 = "nuull";
    @Override
    public void onCreate() {
        maindata = getMainID();
        if (!maindata.equals("nuull")) {
            muser = maindata.split(",,,")[0];
            mpass = maindata.split(",,,")[1];
            previousID = "nuull";
            previousID1 = "nuull";
            previousID2 = "nuull";
            requestQueue = Volley.newRequestQueue(context);
            handler = new Handler();
            runnable = new Runnable() {
                @Override
                public void run() {
                    postData();
                    handler.postDelayed(runnable, 3000);
                }
            };
            handler.postDelayed(runnable, 3000);
        }
    }
    public void postData() {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, "https://mealsformakers.xyz/Mobapigetlatestrecipe", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                final String response_dec = (response);
                        try {
                            JSONArray jsonArrayh = new JSONArray(response_dec);
                            JSONObject joh = jsonArrayh.getJSONObject(0);
                            //latest recipes notif
                            JSONArray jsonArray = new JSONArray(joh.getString("dataLatestRecipe"));
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject jo = jsonArray.getJSONObject(i);
                                String mid = jo.getString("recipeIndex");
                                if (!mid.equals(previousID)) {
                                    showNotif("New recipe was uploaded!", jo.getString("recipeTitle") + " has been uploaded! Check it out!",2,jo.getString("recipeTitle"));
                                    previousID = mid;
                                }

                            }

                            //latest comments notif
                            JSONArray jsonArray1 = new JSONArray(joh.getString("dataLatestComments"));
                            for (int i = 0; i < jsonArray1.length(); i++) {
                                JSONObject jo = jsonArray1.getJSONObject(i);
                                String mid = jo.getString("commIndex");
                                String commenter = jo.getString("commenter");
                                String recipename = jo.getString("recipename");
                                String comment = jo.getString("comment");
                                if (!mid.equals(previousID1)) {
                                    showNotif("Someone commented on your " + recipename + " recipe", commenter + " said: \"" + (comment.length() > 70 ? (comment.substring(0, 70) + "...\"") : comment), 3, jo.getString("recipename"));
                                    previousID1 = mid;
                                }
                            }

                            //latest messages notif
                            JSONArray jsonArray2 = new JSONArray(joh.getString("dataLatestMessageIndex"));
                            for (int i = 0; i < jsonArray2.length(); i++) {
                                JSONObject jo = jsonArray2.getJSONObject(i);
                                String mid = jo.getString("msgIndex");
                                if (!mid.equals(previousID2)) {
                                    showNotif("You have new message(s).", "Click here to go see your latest messages now.", 4, "nobro");
                                    previousID2 = mid;
                                }
                            }
                        } catch (Exception e) {
                            Log.i("ERROR", "ERROR: " + e.getMessage());
                        }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                //a

            }
        }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<String, String>();
                headers.put("Content-Type", "application/x-www-form-urlencoded");
                return headers;
            }

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                HashMap<String, String> params2 = new HashMap<String, String>();
                params2.put("us", muser);
                params2.put("ps", mpass);
                return params2;
            }
        };

        requestQueue.add(stringRequest);
    }
}