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
if ($secret != "24324473106b803349a8b0d71e960129") {
  echo ("Invalid hook\n");
  http_response_code(403);
} elseif($json = json_decode(file_get_contents("php://input"), true)) {
  $data = $json;
  $event_key = $_SERVER['HTTP_X_EVENT_KEY'];
  echo ("Event:".$event_key.":\n");

  $subject = "";
  $msg = "";

  switch($event_key) {
  case "repo:push":
    $subject = sprintf("commit/%s: new changesets", $data['repository']['name']);
    $msg .= sprintf("new commits in %s:\n\n", $data['repository']['name']);
    $push = $data['push'];
    foreach($push['changes'] as $change) {
      if($change['new']) {
        $date = pr($change['new']['target']['date']);
        $branch = pr($change['new']['name']);
      } elseif($change['old']) {
        $date = pr($change['old']['target']['date']);
        $branch = pr($change['old']['name']);
      } else {
        $date = "unknown";
        $branch = "unknown";
      }
      foreach($change['commits'] as $commit) {
        $msg .= $commit['links']['html']['href'] . "\n";
        $msg .= sprintf("%-12s %s\n", "Changeset:", pr($commit['hash']);
        $msg .= sprintf("%-12s %s\n", "Branch:", ptr($branch));
        $msg .= sprintf("%-12s %s\n", "User:", pr($commit['author']);
        $msg .= sprintf("%-12s %s\n", "Date:", pr($date));
        $msg .= sprintf("%-12s %s\n", "Summary:", pr($commit['message']));
      }
      if($change['truncated']) {
        $mag .= "[further commits truncated]\n";
      }
    }
    break;
  case "repo:updated":
    break;
  }
  $url = $data['repository']['links']['html']['href'];
  $msg .= sprintf("Repository URL: %s\n", $url);

  if ($subject != "") {
    if(isset($data['actor'])) {
      $headers  = sprintf("From: \"%s\" <commits-noreply@bitbucket.org>\r\n", $data['actor']['display_name']);
    } else {
      $headers  = "From: commits-noreply@bitbucket.org\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email = 'commits@einsteintoolkit.org';
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

