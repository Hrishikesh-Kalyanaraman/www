<?php header("Content-Type: text/html; charset=utf-8"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <title>Issue webhook received</title>
</head>
<body>
<pre>
<?php

include 'utils.php';

// from https://lornajane.net/posts/2017/handling-incoming-webhooks-in-php
// webhook syntax for bitbucket is here: https://confluence.atlassian.com/bitbucket/event-payloads-740262817.html#EventPayloads-Issueevents
$secret = $_GET['secret'];
// a random number to ensure that not everyone can use the hook
if ($secret != "ee472624c1534255ef7b3637d04aea680bf57601d1dd320faef52a75f458c281") {
  echo ("Invalid hook\n");
  http_response_code(403);
} elseif($json = json_decode(file_get_contents("php://input"), true)) {
  $data = $json;
  $event_key = $_SERVER['HTTP_X_EVENT_KEY'];
  echo ("Event:".$event_key.":\n");

  $subject = "";
  // alternatively, use text/plain and the 'raw' content for the actual
  // markdown and plain ASCII emails
  $msg = "<html>";
  if(isset($data['issue']['milestone']['name']))
    $milestone = $data['issue']['milestone']['name'];
  else
    $milestone = "";
  if(isset($data['issue']['component']['name']))
    $component = $data['issue']['component']['name'];
  else
    $component = "";
  if(isset($data['issue']['version']['name']))
    $version = $data['issue']['version']['name'];
  else
    $version = "";

  $subject = sprintf("#%s: %s", $data['issue']['id'], $data['issue']['title']);
  $msg .= sprintf("#%s: %s\n", $data['issue']['id'], $data['issue']['title']);
  $msg .= "<table style='border-spacing: 1ex 0pt; '>\n";
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", " Reporter", $data['issue']['reporter']['display_name']);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", "   Status", $data['issue']['state']);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", "Milestone", $milestone);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", "  Version", $version);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", "     Type", $data['issue']['kind']);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", " Priority", $data['issue']['priority']);
  $msg .= sprintf("<tr><td style='text-align:right'>%s:</td><td>%s</td></tr>\n", "Component", $component);
  $msg .= "</table>\n";
  $msg .= "\n";
  switch($event_key) {
  case "issue:updated":
    $msg .= sprintf("<p>Changes (by %s):</p>\n", $data['actor']['display_name']);
    # report all changes other than a change in "content" as a nice table
    $have_changes = false;
      foreach ($data['changes'] as $change => $diff) {
        if($change != "content") {
          if(!$have_changes) {
            $msg .= "<p><table>\n";
            $have_changes = true;
          }
          if ($change == "attachment") {
            # attachements have not "new" and "old" fields
            # href is a list but seems to only ever contain a single entry
            # BUG: right now there seems a bug in the API so that even if multiple
            # files are attached, only one is listed in the json payload
            $msg .= sprintf("<tr><td>%s:</td><td><a href=\"%s\">%s</a></td></tr>\n", $change,
                            pr($diff['name']), $diff['links']['self']['href'][0]);
          } else {
            $msg .= sprintf("<tr><td>%s:</td><td>%s (was %s)</td></tr>\n", $change,
                            pr($diff['new']), pr($diff['old']));
          }
        }
      }
    if($have_changes) {
      $msg .= "</table></p>\n";
    }
    if(isset($data['changes']['content'])) {
      $msg .= $data['issue']['content']['html'] . "\n";
    }
    # a comment block exists all the time even when no comment was made,
    # "raw" is null and "html" is the empty string in that case
    if($data['comment']['content']['html'] != "") {
      $msg .= sprintf("<p>Comment (by %s):</p>\n", $data['actor']['display_name']);
      $msg .= $data['comment']['content']['html'] . "\n";
    }
    break;
  case "issue:created":
    $msg .= $data['issue']['content']['html'] . "\n";
    $attachments = call_REST($data['issue']['links']['attachments']['href']);
    if($attachments['size'] > 0) {
      $msg .= "<p><table>";
      foreach ($attachments['values'] as $attachment) {
        $msg .= sprintf("<tr><td>%s:</td><td><a href=\"%s\">%s</a></td></tr>\n", 'attachment',
                        pr($attachment['name']), $attachment['links']['self']['href'][0]);
      }
      $msg .= "</table></p>\n";
    }
    break;
  case "issue:comment_created":
    # BUG: attachments do not show up in the comment created json payload
    $msg .= sprintf("<p>Comment (by %s):</p>\n", $data['actor']['display_name']);
    $msg .= $data['comment']['content']['html'] . "\n";
    break;
  }
  $msg .= "<p>--<br/>\n";
  $url = $data['issue']['links']['html']['href'];
  $msg .= sprintf("Ticket URL: <a href='%s'>%s</a></p>\n", $url, $url);
  $msg .= "</html>";

  if ($subject != "") {
    if(isset($data['actor'])) {
      $headers  = sprintf("From: \"%s\" <trac-noreply@einsteintoolkit.org>\r\n", $data['actor']['display_name']);
    } else {
      $headers  = "From: trac-noreply@einsteintoolkit.org\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email = 'trac@einsteintoolkit.org';
    $rc = mail($email, $subject, $msg, $headers);
    echo ("mail sent successfully:".$rc);
  } else {
    echo ("unknown event type, nomail sent");
  }
} else {
  echo ("Invalid request\n");
  http_response_code(400);
}
?>
</pre>

</body>
</html>

