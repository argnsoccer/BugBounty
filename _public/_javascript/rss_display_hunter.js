var subscriptionString = "";

for (var i = 0; i < subscriptions.length; ++i) {
  subscriptionString = subscriptionString + "|" + subscriptions[i];
}

if (subscriptionString == '') {
  $("#rssBox").append("<p>Go to a company's page to subscrive to their webste</p>");
}
else {

  (function() {var params = 
  {
    rssmikle_url: subscriptionString,
    rssmikle_frame_width: "350",
    rssmikle_frame_height: "400",
    frame_height_by_article: "0",
    rssmikle_target: "_blank",
    rssmikle_font: "Arial, Helvetica, sans-serif",
    rssmikle_font_size: "12",
    rssmikle_border: "off",
    responsive: "off",
    rssmikle_css_url: "",
    text_align: "left",
    text_align2: "left",
    corner: "off",
    scrollbar: "on",
    autoscroll: "off",
    scrolldirection: "up",
    scrollstep: "3",
    mcspeed: "20",sort: "Off",
    rssmikle_title: "on",
    rssmikle_title_sentence: "BugBounty News",
    rssmikle_title_link: "",
    rssmikle_title_bgcolor: "#E74C3C",
    rssmikle_title_color: "#FFFFFF",
    rssmikle_title_bgimage: "",
    rssmikle_item_bgcolor: "#FFFFFF",
    rssmikle_item_bgimage: "",
    rssmikle_item_title_length: "55",
    rssmikle_item_title_color: "#E74C3C",
    rssmikle_item_border_bottom: "on",
    rssmikle_item_description: "on",
    item_link: "off",
    rssmikle_item_description_length: "150",
    rssmikle_item_description_color: "#666666",
    rssmikle_item_date: "gl1",
    rssmikle_timezone: "Etc/GMT",
    datetime_format: "%b %e, %Y %l:%M %p",
    item_description_style: "text+tn",
    item_thumbnail: "full",
    item_thumbnail_selection: "media_thumbnail",
    article_num: "15",
    rssmikle_item_podcast: "off",
    keyword_inc: "",
    keyword_exc: ""
  };
  feedwind_show_widget_iframe(params)
;})();

}

console.log(subscriptionString);