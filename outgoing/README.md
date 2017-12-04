
# Sending Requests

CURT POST request to Slack Web API, using the message file as body.
Use Postman... don't know why this won't work, lol.

curl -vX POST https://slack.com/api/chat.postMessage -d @messages/playGame.json \
--header "Content-Type: application/json" --header "Authorization: Bearer xoxp-4134371454-4134371456-281904522710-e573dd392cbdc8e8d0f9e9063dd714bd"