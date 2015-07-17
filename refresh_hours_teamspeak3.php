<?php
$page = $_SERVER['PHP_SELF'];
 $sec = "60";
 header("Refresh: $sec; url=$page");
$date = date("D d F Y H:i");


require_once('libraries/TeamSpeak3/TeamSpeak3.php');
    $server = array(
        "tsip" => "localhost",
        "tsport" => "9987",
        "ts_query_admin" => "serveradmin",
        "ts_query_password" => "password",
        "ts_query_port" => "10011",
        "ts_channel_id" => "id_channel", /* in number ex: 254*/
    );
try
{
  TeamSpeak3::init();
  /* connect to server, login and get TeamSpeak3_Node_Server object by URI */
  $ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$server["ts_query_admin"].":".$server["ts_query_password"]."@".$server["tsip"].":".$server["ts_query_port"]."/?server_port=".$server["tsport"]."&channel_id=".$server["ts_channel_id"]."");

  /* Edit channel and get new ID */
  echo "Edit channel with date on virtual server " . $ts3_VirtualServer . " ... ";
  $channel = $ts3_VirtualServer->channelGetById($server["ts_channel_id"]);
  $change = array( 'channel_name' => "[cspacer0] $date");
  $channel->modify($change);

}
catch(Exception $e)
{
  echo "Error (ID " . $e->getCode() . ") <b>" . $e->getMessage() . "</b>";
}

?>
?>