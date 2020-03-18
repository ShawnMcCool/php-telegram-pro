<?php namespace Tests;

trait ExampleWebhooks
***REMOVED***
    protected string $messageWithText = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "type": "private",
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "text":"/start"
***REMOVED***
***REMOVED***';

    protected string $forwardedMessage = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "type": "private",
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "forward_from": ***REMOVED***
     "last_name":"Forward Lastname",
     "id": 222222,
     "first_name":"Forward Firstname"
  ***REMOVED***,
  "forward_date":1441645550,
  "text":"/start"
***REMOVED***
***REMOVED***';

    protected string $forwardedChannelMessage = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "forward_from_chat": ***REMOVED***
     "id": -10000000000,
     "type": "channel",
     "title": "Test channel"
  ***REMOVED***,
  "forward_date":1441645550,
  "text":"/start"
***REMOVED***
***REMOVED***';

    protected string $messageWithAReply = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "text":"/start",
  "reply_to_message":***REMOVED***
      "date":1441645000,
      "chat":***REMOVED***
          "last_name":"Reply Lastname",
          "type": "private",
          "id":1111112,
          "first_name":"Reply Firstname",
          "username":"Testusername"
      ***REMOVED***,
      "message_id":1334,
      "text":"Original"
  ***REMOVED***
***REMOVED***
***REMOVED***';

    protected string $editedMessage = '***REMOVED***
"update_id":10000,
"edited_message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "text":"Edited text",
  "edit_date": 1441646600
***REMOVED***
***REMOVED***';

    protected string $messageWithEntities = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "text":"Bold and italics",
  "entities": [
      ***REMOVED***
          "type": "italic",
          "offset": 9,
          "length": 7
      ***REMOVED***,
      ***REMOVED***
          "type": "bold",
          "offset": 0,
          "length": 4
      ***REMOVED***
      ]
***REMOVED***
***REMOVED***';

    protected string $messageWithAudio = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "audio": ***REMOVED***
      "file_id": "AwADBAADbXXXXXXXXXXXGBdhD2l6_XX",
      "duration": 243,
      "mime_type": "audio/mpeg",
      "file_size": 3897500,
      "title": "Test music file"
  ***REMOVED***
***REMOVED***
***REMOVED***';

    protected string $voiceMessage = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "voice": ***REMOVED***
      "file_id": "AwADBAADbXXXXXXXXXXXGBdhD2l6_XX",
      "duration": 5,
      "mime_type": "audio/ogg",
      "file_size": 23000
  ***REMOVED***
***REMOVED***
***REMOVED***';

    protected string $messageWithADocument = '***REMOVED***
"update_id":10000,
"message":***REMOVED***
  "date":1441645532,
  "chat":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "message_id":1365,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "document": ***REMOVED***
      "file_id": "AwADBAADbXXXXXXXXXXXGBdhD2l6_XX",
      "file_name": "Testfile.pdf",
      "mime_type": "application/pdf",
      "file_size": 536392
  ***REMOVED***
***REMOVED***
***REMOVED***';

    protected string $inlineQuery = '***REMOVED***
"update_id":10000,
"inline_query":***REMOVED***
  "id": 134567890097,
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "query": "inline query",
  "offset": ""
***REMOVED***
***REMOVED***';

    protected string $chosenInlineQuery = '***REMOVED***
"update_id":10000,
"chosen_inline_result":***REMOVED***
  "result_id": "12",
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "query": "inline query",
  "inline_message_id": "1234csdbsk4839"
***REMOVED***
***REMOVED***';

    protected string $callbackQuery = '***REMOVED***
"update_id":10000,
"callback_query":***REMOVED***
  "id": "4382bfdwdsb323b2d9",
  "from":***REMOVED***
     "last_name":"Test Lastname",
     "type": "private",
     "id":1111111,
     "first_name":"Test Firstname",
     "username":"Testusername"
  ***REMOVED***,
  "data": "Data from button callback",
  "inline_message_id": "1234csdbsk4839"
***REMOVED***
***REMOVED***';
***REMOVED***