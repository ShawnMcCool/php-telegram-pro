# Paradigm

Methods = Send  
Responses = Receive

# To-do

- Deal with the fact that the edit methods have atypical returns
- Outline the models, files, methods, types, etc
- Methods/ and Types/ should be hierarchical equals
- Make sure all Request types (json, multipart, etc) are correct.
- Give response interface a unifying result() in addition to domain-specific result parameters
- Give response interfaces a unifying resultJson() 
- Implement response parameters
    - https://core.telegram.org/bots/api#responseparameters
- Rate limiting is a naive spike.  
- Security certificate
- Add Update class 'resolved' functions to the UpdateTest
- Make sure the massive Message class has fields named in accordance to modern standards
- Update UpdateTest
- Verify that all test function names are correct
- Expand the capabilities of all collections 
- Make sure that set chat sticker group works
- Document .bot-test-config
- ArrayOf Types should have correct ApiWriteType and ApiReadType bits
- Unify ArrayOf Collection methods
- All response 'result' references in fromApi() should use null coalescence 
- Method test names are often incorrect
- Tests should check result type and function as partial documentation for result types
- Carefully look through each folder to make sure files weren't created in the wrong place
- Provide separate methods for split requirements. (edit message text, chat+message vs inline)
- Consider how to test seemingly superfluous fields like parsemode and disable notifications 
- Review @todos
- When caption is returned, it's a string.. this was due to cqrs concerns, we came up with apireadtype / writetype for this reason and it should be replaced 
- Return types should expose all values
- The whole InputFile, InputMediaFile thing was designed early on, sort that out
- See how EditMessageMedia uses Media File as json
- Add a request log TelegramApi decorator
- ReplyMarkup stuff is also old, sort it out
- Ensure no global artifacts