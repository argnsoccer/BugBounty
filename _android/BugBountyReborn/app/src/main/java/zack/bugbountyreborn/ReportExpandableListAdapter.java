package zack.bugbountyreborn;

import android.app.Activity;
import android.content.Intent;
import android.util.SparseArray;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.BaseExpandableListAdapter;
import android.widget.CheckedTextView;
import android.widget.ExpandableListView;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.util.ArrayList;

public class ReportExpandableListAdapter extends BaseExpandableListAdapter {
    private static final String ADAPTER_TAG = "ReportAdapter";

    private final SparseArray<Group> groups;
    public ArrayList<String> reportInfo;
    public String username;
    public LayoutInflater inflater;
    public Activity activity;

    public ReportExpandableListAdapter(Activity act, SparseArray<Group> groups, String username) {
        activity = act;
        this.groups = groups;
        this.username = username;
        inflater = act.getLayoutInflater();
    }

    public void setReportInfo(ArrayList<String> info) {
        reportInfo = new ArrayList<String>(info);
    }

    @Override
    public Object getChild(int groupPosition, int childPosition) {
        return groups.get(groupPosition).children.get(childPosition);
    }

    @Override
    public long getChildId(int groupPosition, int childPosition) {
        return 0;
    }

    @Override
    public View getChildView(int groupPosition, final int childPosition,
                             boolean isLastChild, View convertView, ViewGroup parent) {
        final String children = (String) getChild(groupPosition, childPosition);
        TextView text = null;
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.listrow_details, null);
        }
        text = (TextView) convertView.findViewById(R.id.textView1);
        text.setText(children);
        convertView.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(activity, children,
                        Toast.LENGTH_SHORT).show();

                new Thread() {
                    public void run() {
                        try {
                            Intent i = new Intent(activity, ReportActivity.class);
                            i.putExtra("username", username);
                            i.putExtra("reportInfo", reportInfo);
                            i.putExtra("reportClicked", children);
                            Thread.sleep(500);
                            activity.startActivity(i);
                            activity.finish();
                        } catch (InterruptedException e) {
                            e.printStackTrace();
                        }
                    }
                }.start();
            }
        });
        return convertView;
    }

    @Override
    public int getChildrenCount(int groupPosition) {
        return groups.get(groupPosition).children.size();
    }

    @Override
    public Object getGroup(int groupPosition) {
        return groups.get(groupPosition);
    }

    @Override
    public int getGroupCount() {
        return groups.size();
    }

    @Override
    public void onGroupCollapsed(int groupPosition) {
        super.onGroupCollapsed(groupPosition);
    }

    @Override
    public void onGroupExpanded(int groupPosition) {
        super.onGroupExpanded(groupPosition);
    }

    @Override
    public long getGroupId(int groupPosition) {
        return 0;
    }

    @Override
    public View getGroupView(int groupPosition, boolean isExpanded,
                             View convertView, ViewGroup parent) {
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.listrow_group, null);
        }
        Group group = (Group) getGroup(groupPosition);
        CheckedTextView text1 = (CheckedTextView) convertView.findViewById(R.id.textView1);
        text1.setText(group.string1);
        TextView text2 = (TextView) convertView.findViewById(R.id.textView2);
        text2.setText(group.string2);
        return convertView;
    }

    @Override
    public boolean hasStableIds() {
        return true;
    }

    @Override
    public boolean isChildSelectable(int groupPosition, int childPosition) {
        return true;
    }
}
