/*
Tugasan 3 : Socket Programming Using PHP
Author Azhari Hj Salleh
Github ID : github/azharisalleh
Title : Server - Client Program
*/
$host = "127.0.0.1";
$port = "8888";
 
set_time_limit(0);
 
print "Starting Socket Server...\n";
 
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 
socket_bind($sock, $host, $port);
 
socket_listen($sock, 4);
 
$childSocket = socket_accept($sock);
 
do
{
    // look for new messages
 
    $incomingData = socket_read($childSocket, 2048);
 
    if(trim($incomingData) == "are you hungry?")
    {
        $response = "Server Response > I could eat!\n";
        socket_write($childSocket, $response, strlen($response));
    }
    else if(trim($incomingData) == "exit")
    {
        $response = "Goodbye!\n";
        socket_write($childSocket, $response, strlen($response));
        socket_close($childSocket);
        break;
    }
    else
    {
        $response = strtoupper(trim($incomingData)) . "\n";
        $writeResp = socket_write($childSocket, $response, strlen($response));
        if($writeResp === FALSE)
        {
            socket_close($childSocket);
            break;
        }
    }
 
}
while(true);
 
socket_close($sock);
 
?>