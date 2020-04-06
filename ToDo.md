- ui should always be typed
- fix 'curl attachment' concept in nested request (return curlfile arrays/collections instead)
- ensure that constructors are private when appropriate
- ensure a clean read / write model separation

# documentation

## Construction Pipeline

To send commands to telegram we must construct requests. The requests are based on a 'method' such as "sendMessage" or "sendPhoto".

The body is a json object with parameters. When it's necessary to send files the files are sent as a part of a multi-part form.

Since this SDK uses an object model that mirrors the telegram data structures we must have a process to bubble up files that may be nested below.   

## advantages
    
    - a completely fleshed out object graph
        - no magic objects
        - no need to look up the telegram documentation to construct requests or consume responses
        - documentation is integrated into objects
        - separation between read / write models
    - add design decisions document
        - create structures that match the telegram api as accurately as possible
        - turn primitives into objects when invariants can be guarded or if it makes the sdk more usable
        - fromApi() is how you construct objects from telegram. this is true even if it's just a wrapper object for a string. If you need to generate an object from string and it only contains a fromApi() constructor then create a new fromString() constructor. Superficially it may seem that they're the same but they're not.