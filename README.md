# Paradigm

Methods = Send  
Responses = Receive

# To-do

- Make sure all Request types (json, multipart, etc) are correct.
- Give response interface a unifying result()
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