package zack.bugbountyreborn;

import java.util.ArrayList;
import java.util.List;

public class Group {

    public String string1;
    public String string2;
    public final List<String> children = new ArrayList<String>();

    public Group(String string1, String string2) {
        this.string1 = string1;
        this.string2 = string2;
    }
}
