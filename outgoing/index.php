<?php
    include 'php/Parser.php';
    include 'php/Logger.php';

    $clientId = '4134371454.278412442948';
    $clientSecret = 'd48eb9552f6b55df66b7a9be6a695d46';
    $verificationToken = 'xByEWF7zpp1EpjCyJSC0Mopj';

    date_default_timezone_set('Europe/London');
    header('Content-type: application/json');

    define('ROOT', realpath(dirname(__FILE__)));
    define('LOGS_DIR', ROOT.'/logs');

    /* TOKENS */
    $outgoingHookToken = 'RL7LayGC2YdJuVeU3FWQYlYu';
    $slashToken = 'sPt3P5EiRmPHtiOG4rRnrt6M';

    $receivedToken = isset($_POST['token']) && $_POST['token'] === $outgoingHookToken;

    /* OUTGOING
    token=RL7LayGC2YdJuVeU3FWQYlYu
    team_id=T0001
    team_domain=example
    channel_id=C2147483705
    channel_name=test
    timestamp=1355517523.000005
    user_id=U2147483697
    user_name=Steve
    text=googlebot: What is the air-speed velocity of an unladen swallow?
    trigger_word=googlebot:
    */

    /* SLASH
    token=sPt3P5EiRmPHtiOG4rRnrt6M
    team_id=T0001
    team_domain=example
    channel_id=C2147483705
    channel_name=test
    user_id=U2147483697
    user_name=Steve
    command=/football
    text=94070
    response_url=https://hooks.slack.com/commands/1234/5678
    */

    writeInputLog('====> NEW REQUEST');

    if ($receivedToken) {
        writeInputLog(json_encode($_POST));
    }

    if (isset($_POST['trigger_word'])) {
        $buffer = [
            '====> Outgoing hook trigger word triggered.',
        ];

        writeInputLog($buffer);
    }

    if (isset($_POST['command'])) {
        $buffer = [
            '====> Slash Command incoming.',
        ];

        writeInputLog($buffer);
    }

    $command = trim(str_replace($_REQUEST['trigger_word'], '', $_REQUEST['text']));

    writeInputLog([
        "COMMAND RECEIVED: $command",
        'Incoming data:',
        print_r($_REQUEST, true),
    ]);

    if (strlen($command) > 0) {
        $parser = new Parser();

        writeInputLog(json_encode($parser->commands));

        $result = $parser->runCommand($command);

        echo json_encode(['text' => $result]);
    } else {
        echo json_encode(['text' => 'African or European?']);
    }
